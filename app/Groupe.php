<?php

namespace App;

use App\Higroupe;
use App\Empresa;
use Illuminate\Database\Eloquent\Model;

class Groupe extends Model
{
  protected $table = 'groupes';
  protected $fillable = ['higroup_id', 'name', 'description', 'logo', 'color', 'slug'];

  public function higroupes()
  {
    return $this->belongsTo(Higroupe::class);
  }

  public function empresa()
  {
    return $this->hasMany(Empresa::class);
  }
}
