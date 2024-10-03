<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PiPulse Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">PiPulse Dashboard</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($devices as $device)
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-2">{{ $device->name }}</h2>
                    <p class="text-gray-600 mb-2">Location: {{ $device->location }}</p>
                    <p class="mb-2">
                        Status: 
                        <span class="font-semibold {{ $device->status === 'up' ? 'text-green-600' : 'text-red-600' }}">
                            {{ ucfirst($device->status) }}
                        </span>
                    </p>
                    <p class="text-sm text-gray-500">Last Updated: {{ $device->updated_at->diffForHumans() }}</p>
                    <a href="{{ route('devices.show', $device->id) }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">View Details</a>
                </div>
            @endforeach
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.Echo.channel('devices')
                .listen('DeviceUpdated', (e) => {
                    let deviceElement = document.getElementById(`device-${e.device.id}`);
                    if (deviceElement) {
                        // Update the device information
                        deviceElement.querySelector('.status').textContent = e.device.status;
                        deviceElement.querySelector('.last-updated').textContent = 'Just now';
                        // Add more updates as needed
                    }
                });
        });
    </script>
</body>
</html>
