<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeePercentage extends Model
{
    use HasFactory;
    protected $fillable = ['fee_preset_id', 'service_id', 'threshold_id', 'percentage'];

    public function feePreset()
    {
        return $this->belongsTo(FeePreset::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function threshold()
    {
        return $this->belongsTo(Threshold::class);
    }
}
