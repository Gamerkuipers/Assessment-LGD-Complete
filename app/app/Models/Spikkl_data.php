<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spikkl_data extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setCoordinates($lat,$lon) {
        $this->attributes['coordinates'] = json_encode([$lat,$lon]);
    }
}
