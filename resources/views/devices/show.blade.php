<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $device->name }} Details - PiPulse</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">{{ $device->name }} Details</h1>
        <div class="bg-white rounded-lg shadow-md p-6">
            <p class="mb-2"><strong>Location:</strong> {{ $device->location }}</p>
            <p class="mb-2"><strong>Status:</strong> 
                <span class="{{ $device->status === 'up' ? 'text-green-600' : 'text-red-600' }}">
                    {{ ucfirst($device->status) }}
                </span>
            </p>
            <p class="mb-2"><strong>IP Address:</strong> {{ $device->ip_address }}</p>
            <p class="mb-2"><strong>CPU Usage:</strong> {{ $device->cpu_usage }}%</p>
            <p class="mb-2"><strong>Memory Usage:</strong> {{ $device->memory_usage }}%</p>
            <p class="mb-2"><strong>Disk Space:</strong> {{ $device->disk_space }}%</p>
            <p class="mb-2"><strong>Temperature:</strong> {{ $device->temperature }}°C</p>
            <p class="mb-2"><strong>Last Downtime:</strong> {{ $device->last_downtime ? $device->last_downtime->format('Y-m-d H:i:s') : 'N/A' }}</p>
            <p class="mb-2"><strong>Last Updated:</strong> {{ $device->updated_at->format('Y-m-d H:i:s') }}</p>
            <div class="mt-4">
                <h3 class="text-lg font-semibold mb-2">Running Processes:</h3>
                <ul class="list-disc list-inside">
                    @foreach(json_decode($device->running_processes) as $process)
                        <li>{{ $process }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <a href="{{ route('devices.index') }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Back to Dashboard</a>
    </div>
</body>
</html>
