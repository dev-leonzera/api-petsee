<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pet extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function tutor(): BelongsTo {
        return $this->belongsTo(Cliente::class);
    }
}
