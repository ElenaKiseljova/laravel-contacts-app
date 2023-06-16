<?php

namespace App\Models;

use App\Models\Scopes\SimpleSoftDeletes;
use App\Models\Scopes\SimpleSoftDeletingScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
  use HasFactory, SimpleSoftDeletes;

  // protected $guarded = [];
  protected $fillable = [
    'first_name',
    'last_name',
    'phone',
    'address',
    'email',
    'company_id'
  ];

  public function company()
  {
    return $this->belongsTo(Company::class);
  }

  public function tasks()
  {
    return $this->hasMany(Task::class);
  }
}
