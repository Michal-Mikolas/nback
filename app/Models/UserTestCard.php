<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserTestCard extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function test()
    {
        return $this->belongsTo(UserTest::class);
    }
}
