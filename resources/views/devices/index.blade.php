<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('PiPulse Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2">Summary Statistics</h3>
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <div class="bg-blue-100 p-4 rounded">
                                <p class="text-sm text-blue-600">Total Devices</p>
                                <p class="text-2xl font-bold">{{ $devices->count() }}</p>
                            </div>
                            <div class="bg-green-100 p-4 rounded">
                                <p class="text-sm text-green-600">Online Devices</p>
                                <p class="text-2xl font-bold">{{ $devices->where('status', 'up')->count() }}</p>
                            </div>
                            <div class="bg-red-100 p-4 rounded">
                                <p class="text-sm text-red-600">Offline Devices</p>
                                <p class="text-2xl font-bold">{{ $devices->where('status', 'down')->count() }}</p>
                            </div>
                            <div class="bg-yellow-100 p-4 rounded">
                                <p class="text-sm text-yellow-600">Avg CPU Usage</p>
                                <p class="text-2xl font-bold">{{ number_format($devices->avg('cpu_usage'), 1) }}%</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2">Device Search</h3>
                        <input type="text" id="deviceSearch" placeholder="Search devices..." class="w-full px-3 py-2 border rounded">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="deviceGrid">
                        @foreach($devices as $device)
                            <div class="bg-white rounded-lg shadow-md p-6 device-card">
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
            </div>
        </div>
    </div>

    <script>
        document.getElementById('deviceSearch').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const deviceCards = document.querySelectorAll('.device-card');

            deviceCards.forEach(card => {
                const deviceName = card.querySelector('h2').textContent.toLowerCase();
                const deviceLocation = card.querySelector('p').textContent.toLowerCase();

                if (deviceName.includes(searchTerm) || deviceLocation.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    </script>
</x-app-layout>