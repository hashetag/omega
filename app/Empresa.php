<?php

namespace App;

<<<<<<< HEAD
=======
use App\Role;
>>>>>>> a7f46dba2b390825d66a2b719184eec6042b2b72
use App\City;
use App\Groupe;
use App\Type;
use App\Category;
use App\Product;
use App\Order;
use App\Review;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Empresa extends Authenticatable
{
    use Notifiable;

    protected $guard = 'empresa';
    //protected $table = 'empresas';

    protected $fillable = [
<<<<<<< HEAD
        'isAdmin', 'name', 'email', 'password', 'groupe_id', 'city_id', 'type_id', 'cuit', 'avatar', 'phone', 'address', 'openhours', 'openhours_2', 'minimum', 'latitud','longitud', 'slug', 'website',
=======
        'role_id', 'name', 'email', 'password', 'groupe_id', 'city_id', 'type_id', 'cuit', 'avatar', 'phone', 'address', 'openhours', 'minimum', 'latitud','longitud', 'slug',
>>>>>>> a7f46dba2b390825d66a2b719184eec6042b2b72
    ];

   
    protected $hidden = [
        'password', 'remember_token',
    ];

    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

<<<<<<< HEAD
  
  public static function navigation()
  {
    return auth()->check() ? auth()->empresa()->role->name : 'guest' ;
  }

=======
    
    public static function navigation()
    {
        return auth()->check() ? auth()->empresa()->role->name : 'guest' ;
    }

    public function roles()
    {
      return $this->belongsTo(Role::class);
    }
>>>>>>> a7f46dba2b390825d66a2b719184eec6042b2b72

    public function groupes()
  {
    return $this->belongsTo(Groupe::class);
  }

  public function cities()
  {
    return $this->belongsTo(City::class);
  }

  public function types()
  {
    return $this->belongsTo(Type::class);
  }

  public function categories()
  {
    return $this->hasMany(Category::class);
  }

  public function products()
  {
    return $this->hasMany(Product::class);
  }

  public function orders()
  {
    return $this->hasMany(Order::class);
  }

  public function reviews()
  {
    return $this->hasMany(Review::class);
  }
}
