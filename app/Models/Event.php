<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\Category;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'start_at',
        'end_at',
        'venue',
        'lat',
        'lng',
        'image_url'
    ];

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}