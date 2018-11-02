<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\InvoicePaid;

class User extends Authenticatable
{
    use Notifiable;
   

   
    protected $fillable = [
        'name', 'email', 'password',
    ];
   

    protected $hidden = [
        'password', 'remember_token',
    ];

    
}
