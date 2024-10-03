<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;

class DeviceDataController extends Controller
{
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

        if ($device->status === 'down' && $device->wasChanged('status')) {
            $device->last_downtime = now();
            $device->save();
        }

        return response()->json(['message' => 'Data received successfully'], 200);
    }
}
