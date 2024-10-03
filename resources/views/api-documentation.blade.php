<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('API Documentation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">Device Data API</h3>
                    <p class="mb-4">Use this API to send device data to the PiPulse system.</p>

                    <h4 class="text-md font-semibold mb-2">Endpoint:</h4>
                    <pre class="bg-gray-100 p-2 rounded mb-4">POST /api/device-data</pre>

                    <h4 class="text-md font-semibold mb-2">Headers:</h4>
                    <pre class="bg-gray-100 p-2 rounded mb-4">
Content-Type: application/json
Accept: application/json</pre>

                    <h4 class="text-md font-semibold mb-2">Request Body:</h4>
                    <pre class="bg-gray-100 p-2 rounded mb-4">
{
    "name": "Device Name",
    "location": "Device Location",
    "status": "up",
    "ip_address": "192.168.1.100",
    "cpu_usage": 25.5,
    "memory_usage": 60.2,
    "disk_space": 75.8,
    "temperature": 42.3,
    "running_processes": ["process1", "process2", "process3"]
}</pre>

                    <h4 class="text-md font-semibold mb-2">Response:</h4>
                    <pre class="bg-gray-100 p-2 rounded mb-4">
{
    "message": "Data received successfully"
}</pre>

                    <p class="mt-4">Note: All fields are required except for ip_address and running_processes.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
