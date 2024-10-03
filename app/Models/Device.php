<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'status',
        'last_downtime',
        'ip_address',
        'cpu_usage',
        'memory_usage',
        'disk_space',
        'temperature',
        'running_processes',
    ];

    protected $casts = [
        'last_downtime' => 'datetime',
        'running_processes' => 'array',
    ];

    public function historicalData()
    {
        return $this->hasMany(DeviceHistoricalData::class);
    }
}
