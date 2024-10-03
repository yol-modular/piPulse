<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $device->name }} Details
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Device Information</h3>
                            <table class="w-full">
                                <tr>
                                    <td class="py-2 font-semibold">Location:</td>
                                    <td>{{ $device->location }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 font-semibold">Status:</td>
                                    <td>
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $device->status === 'up' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ ucfirst($device->status) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 font-semibold">IP Address:</td>
                                    <td>{{ $device->ip_address }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 font-semibold">Last Downtime:</td>
                                    <td>{{ $device->last_downtime ? $device->last_downtime->format('Y-m-d H:i:s') : 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 font-semibold">Last Updated:</td>
                                    <td>{{ $device->updated_at->format('Y-m-d H:i:s') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Current Metrics</h3>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-blue-100 rounded-lg p-4">
                                    <p class="text-sm text-blue-600">CPU Usage</p>
                                    <p class="text-2xl font-bold">{{ number_format($device->cpu_usage, 1) }}%</p>
                                </div>
                                <div class="bg-green-100 rounded-lg p-4">
                                    <p class="text-sm text-green-600">Memory Usage</p>
                                    <p class="text-2xl font-bold">{{ number_format($device->memory_usage, 1) }}%</p>
                                </div>
                                <div class="bg-yellow-100 rounded-lg p-4">
                                    <p class="text-sm text-yellow-600">Disk Space</p>
                                    <p class="text-2xl font-bold">{{ number_format($device->disk_space, 1) }}%</p>
                                </div>
                                <div class="bg-red-100 rounded-lg p-4">
                                    <p class="text-sm text-red-600">Temperature</p>
                                    <p class="text-2xl font-bold">{{ number_format($device->temperature, 1) }}°C</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-4">Historical Data</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-white rounded-lg shadow">
                                <canvas id="cpuChart"></canvas>
                            </div>
                            <div class="bg-white rounded-lg shadow">
                                <canvas id="memoryChart"></canvas>
                            </div>
                            <div class="bg-white rounded-lg shadow">
                                <canvas id="diskChart"></canvas>
                            </div>
                            <div class="bg-white rounded-lg shadow">
                                <canvas id="temperatureChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold mb-4">Running Processes</h3>
                        <ul class="list-disc list-inside bg-gray-100 rounded-lg p-4">
                            @foreach(json_decode($device->running_processes) as $process)
                                <li>{{ $process }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const labels = @json($labels);
        const cpuData = @json($cpuData);
        const memoryData = @json($memoryData);
        const diskData = @json($diskData);
        const temperatureData = @json($temperatureData);

        function createChart(elementId, label, data, color) {
            new Chart(document.getElementById(elementId), {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: label,
                        data: data,
                        borderColor: color,
                        backgroundColor: color.replace(')', ', 0.1)').replace('rgb', 'rgba'),
                        tension: 0.1,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: label
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100
                        }
                    }
                }
            });
        }

        createChart('cpuChart', 'CPU Usage (%)', cpuData, 'rgb(59, 130, 246)');
        createChart('memoryChart', 'Memory Usage (%)', memoryData, 'rgb(16, 185, 129)');
        createChart('diskChart', 'Disk Space (%)', diskData, 'rgb(245, 158, 11)');
        createChart('temperatureChart', 'Temperature (°C)', temperatureData, 'rgb(239, 68, 68)');
    </script>
</x-app-layout>