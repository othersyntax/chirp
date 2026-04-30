<?php

namespace App\Models;

use App\Events\ChirpCreated;
use Illuminate\Container\Attributes\Storage as AttributesStorage;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Chirp extends Model
{
    protected $fillable = [
        'user_id',
        'path',
        'message',
    ];

    protected $dispatchesEvents = [
        'created' => ChirpCreated::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn () => Storage::disk('public')->url($this->path),
        );
    }
}
