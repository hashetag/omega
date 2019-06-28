<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;

class RoleController extends Controller
{
  public function index(Request $request)
  {
    if (!$request->ajax()) return redirect('/');
    $buscar = $request->buscar;
    $criterio = $request->criterio;
    
    if ($buscar==''){
      $roles = Role::orderBy('id', 'asc')->paginate(10);
    }
    else{
      $roles = Role::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'asc')->paginate(10);
    }

    return [
      'pagination' => [
        'total'        => $roles->total(),
        'current_page' => $roles->currentPage(),
        'per_page'     => $roles->perPage(),
        'last_page'    => $roles->lastPage(),
        'from'         => $roles->firstItem(),
        'to'           => $roles->lastItem(),
      ],
      'roles' => $roles
    ];
  }

  public function select(Request $request)
  {
    if (!$request->ajax()) return redirect('/');
    $roles = Role::all();
    return ['roles' => $roles];
  } 
}
