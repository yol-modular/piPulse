<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Statistics Grid -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-8">
                        <div class="bg-blue-100 rounded-lg p-4 aspect-square sm:aspect-auto flex flex-col justify-center items-center">
                            <p class="text-sm text-blue-600 text-center">Total Devices</p>
                            <p class="text-2xl font-bold">{{ $devices->count() }}</p>
                        </div>
                        <div class="bg-green-100 rounded-lg p-4 aspect-square sm:aspect-auto flex flex-col justify-center items-center">
                            <p class="text-sm text-green-600 text-center">Online Devices</p>
                            <p class="text-2xl font-bold">{{ $devices->where('status', 'up')->count() }}</p>
                        </div>
                        <div class="bg-red-100 rounded-lg p-4 aspect-square sm:aspect-auto flex flex-col justify-center items-center">
                            <p class="text-sm text-red-600 text-center">Offline Devices</p>
                            <p class="text-2xl font-bold">{{ $devices->where('status', 'down')->count() }}</p>
                        </div>
                        <div class="bg-yellow-100 rounded-lg p-4 aspect-square sm:aspect-auto flex flex-col justify-center items-center">
                            <p class="text-sm text-yellow-600 text-center">Avg CPU Usage</p>
                            <p class="text-2xl font-bold">{{ number_format($devices->avg('cpu_usage'), 1) }}%</p>
                        </div>
                    </div>

                    <!-- Devices Table -->
                    <h3 class="text-lg font-semibold mb-4">Devices</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Updated</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($devices as $device)
                                    <tr class="{{ $device->status === 'down' ? 'pulse-red' : '' }}">
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $device->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $device->location }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $device->status === 'up' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ ucfirst($device->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $device->updated_at->diffForHumans() }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('devices.show', $device->id) }}" class="text-indigo-600 hover:text-indigo-900">View Details</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>