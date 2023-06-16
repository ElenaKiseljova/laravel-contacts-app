<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
  use HasFactory, SoftDeletes;

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

  public function scopeSortByNameAlpha(Builder $query)
  {
    return $query->orderBy('first_name');
  }

  public function scopeFilterByCompany(Builder $query)
  {
    if ($company_id = request()->query('company_id')) {
      $query->where('company_id', $company_id);
    }

    return $query;
  }
}
