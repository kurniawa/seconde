<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PeminatItem extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    function peminat()
    {
        return $this->HasOne(User::class, 'id', 'user_id');
    }
}
