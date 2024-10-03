<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function index()
    {
        $devices = Device::all();
        return view('devices.index', compact('devices'));
    }

    public function show(Device $device)
    {
        $historicalData = $device->historicalData()
            ->orderBy('created_at', 'desc')
            ->take(24)
            ->get()
            ->reverse();

        $labels = $historicalData->pluck('created_at')->map(function($date) {
            return $date->format('H:i');
        });

        $cpuData = $historicalData->pluck('cpu_usage');
        $memoryData = $historicalData->pluck('memory_usage');
        $diskData = $historicalData->pluck('disk_space');
        $temperatureData = $historicalData->pluck('temperature');

        return view('devices.show', compact('device', 'labels', 'cpuData', 'memoryData', 'diskData', 'temperatureData'));
    }
}
