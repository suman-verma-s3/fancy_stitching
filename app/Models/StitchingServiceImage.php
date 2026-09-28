<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StitchingServiceImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'stitching_service_id',
        'image',
        'is_primary',
        'sort_order',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
    ];

    public function stitchingService(): BelongsTo
    {
        return $this->belongsTo(StitchingService::class);
    }
}