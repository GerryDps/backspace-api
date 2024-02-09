<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Paziente extends Model implements CanResetPasswordContract
{
    use HasApiTokens, HasFactory, Notifiable, Authenticatable, CanResetPassword;
    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'Patient';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'hasDoctor' => 'boolean',
        'hasQuestionary' => 'boolean',
    ];
}
