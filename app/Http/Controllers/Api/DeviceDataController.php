<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;
use App\Events\DeviceUpdated;
use App\Services\TelegramService;

class DeviceDataController extends Controller
{
    protected $telegramService;

    public function __construct(TelegramService $telegramService)
    {
        $this->telegramService = $telegramService;
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'location' => 'required|string',
            'status' => 'required|string',
            'ip_address' => 'nullable|ip',
            'cpu_usage' => 'nullable|numeric',
            'memory_usage' => 'nullable|numeric',
            'disk_space' => 'nullable|numeric',
            'temperature' => 'nullable|numeric',
            'running_processes' => 'nullable|json',
        ]);

        $device = Device::updateOrCreate(
            ['name' => $validatedData['name']],
            $validatedData
        );

        // Store historical data
        $device->historicalData()->create([
            'cpu_usage' => $validatedData['cpu_usage'],
            'memory_usage' => $validatedData['memory_usage'],
            'disk_space' => $validatedData['disk_space'],
            'temperature' => $validatedData['temperature'],
        ]);

        // Check if the device status changed to 'down'
        if ($device->status === 'down' && $device->wasChanged('status')) {
            $device->last_downtime = now();
            $device->save();

            // Send Telegram alert
            $this->telegramService->sendMessage("🚨 Alert: {$device->name} at {$device->location} is down!");
        }

        // Check for other critical conditions
        if ($validatedData['cpu_usage'] > 90) {
            $this->telegramService->sendMessage("⚠️ Warning: High CPU usage ({$validatedData['cpu_usage']}%) on {$device->name}");
        }

        if ($validatedData['memory_usage'] > 90) {
            $this->telegramService->sendMessage("⚠️ Warning: High memory usage ({$validatedData['memory_usage']}%) on {$device->name}");
        }

        if ($validatedData['disk_space'] > 90) {
            $this->telegramService->sendMessage("⚠️ Warning: Low disk space ({$validatedData['disk_space']}% used) on {$device->name}");
        }

        if ($validatedData['temperature'] > 80) {
            $this->telegramService->sendMessage("🔥 Warning: High temperature ({$validatedData['temperature']}°C) on {$device->name}");
        }

        broadcast(new DeviceUpdated($device))->toOthers();

        return response()->json(['message' => 'Data received successfully'], 200);
    }
}
