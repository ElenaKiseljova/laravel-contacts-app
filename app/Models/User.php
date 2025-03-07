<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
  use HasApiTokens, HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'name',
    'email',
    'password',
    'phone',
    'country',
    'company',
    'address',
    'profile_picture'
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  // Задание по дефолту Eager loading для компаний и контактов
  // protected $with = ['contacts', 'companies'];

  public function companies()
  {
    return $this->hasMany(Company::class);
  }

  public function contacts()
  {
    return $this->hasMany(Contact::class);
  }

  public function profilePictureUrl()
  {
    return $this->profile_picture && Storage::exists($this->profile_picture) ?
      Storage::url($this->profile_picture) :
      'https://via.placeholder.com/150x150';
  }
}
