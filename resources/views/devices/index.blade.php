<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PiPulse Dashboard</title>
</head>
<body>
    <h1>PiPulse Dashboard</h1>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Location</th>
                <th>Status</th>
                <th>Last Downtime</th>
            </tr>
        </thead>
        <tbody>
            @foreach($devices as $device)
                <tr>
                    <td>{{ $device->name }}</td>
                    <td>{{ $device->location }}</td>
                    <td>{{ $device->status }}</td>
                    <td>{{ $device->last_downtime }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
