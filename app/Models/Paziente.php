<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Paziente extends Model 
{
    use HasApiTokens, HasFactory, Notifiable, Authenticatable;

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'Paziente';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password'];
}
