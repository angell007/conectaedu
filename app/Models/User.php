<?php

namespace App\Models;

use App\JobSkill;
use App\JobApply;
use App\Permission;
use App\CompanyMessage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class User extends  Authenticatable implements JWTSubject
{

    use HasFactory, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    // protected $table = 'users';

    protected $fillable = [
        'name', 'email', 'password', 
    ];
    protected $dates = ['created_at', 'updated_at', 'date_of_birth', 'package_start_date', 'package_end_date'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getdateOfBirthAttribute()
    {
        // return date('Y-m-d');

        return Carbon::parse($this->attributes['date_of_birth'])->format('Y-m-d');
    }

    public function printUserImage($width = 0, $height = 0)
    {

        // $image = (string)$this->image;
        // $image = (!empty($image)) ? $image : 'perfil.png';
        // return ImgUploader::print_image("user_images/$image", $width, $height, '/admin_assets/no-image.png', $this->getName());
    }
}
