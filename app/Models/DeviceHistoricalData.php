<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceHistoricalData extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_id',
        'cpu_usage',
        'memory_usage',
        'disk_space',
        'temperature',
    ];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}
