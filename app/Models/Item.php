<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Item extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user(): HasOne {
        return $this->hasOne(User::class, 'id', 'user_id');
        // return $this->hasOne(Phone::class, 'foreign_key', 'local_key');
    }
}
