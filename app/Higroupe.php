<?php

namespace App;

use App\Groupe;
use Illuminate\Database\Eloquent\Model;

class Higroupe extends Model
{
  protected $table = 'higroupes';
  protected $fillable = ['name', 'description', 'logo', 'slug'];

  public function groupes()
  {
    return $this->hasMany(Groupe::class);
  }
 
}
