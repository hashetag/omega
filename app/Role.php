<?php

namespace App;

use App\Empresa;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
  protected $table = 'roles';
  protected $fillable = ['name','description'];
  public $timestamps = false;

  public function empresas()
  {
    return $this->hasMany(Empresa::class);
  }
}
