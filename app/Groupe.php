<?php

namespace App;

<<<<<<< HEAD
=======
use App\Higroupe;
>>>>>>> a7f46dba2b390825d66a2b719184eec6042b2b72
use App\Empresa;
use Illuminate\Database\Eloquent\Model;

class Groupe extends Model
{
  protected $table = 'groupes';
<<<<<<< HEAD
  protected $fillable = ['name', 'description', 'logo', 'color', 'slug'];
=======
  protected $fillable = ['higroup_id', 'name', 'description', 'logo', 'color', 'slug'];

  public function higroupes()
  {
    return $this->belongsTo(Higroupe::class);
  }
>>>>>>> a7f46dba2b390825d66a2b719184eec6042b2b72

  public function empresa()
  {
    return $this->hasMany(Empresa::class);
  }
}
