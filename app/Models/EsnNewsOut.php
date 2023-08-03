<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EsnNewsOut extends Model
{
    public function esnNews(): BelongsTo
    {
        return $this->belongsTo(EsnNews::class);
    }
}
