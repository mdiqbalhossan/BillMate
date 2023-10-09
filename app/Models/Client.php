<?php

namespace App\Models;

use App\Traits\AvatarTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes, AvatarTrait;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'website',
        'zip_code',
        'country',
        'state',
        'city',
        'address',
        'notes',
        'avatar',
        'user_id',
    ];

}
