<?php

namespace App\Http\Controllers;

use App\Higroupe;
use Illuminate\Http\Request;

class HigroupeController extends Controller
{
  public function index(Request $request)
  {
    if (!$request->ajax()) return redirect('/');
    $buscar = $request->buscar;
    $criterio = $request->criterio;
    
    if ($buscar==''){
      $higroupes = Higroupe::orderBy('id', 'asc')->paginate(10);
    }
    else{
      $higroupes = Higroupe::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'asc')->paginate(10);
    }

    return [
      'pagination' => [
        'total'        => $higroupes->total(),
        'current_page' => $higroupes->currentPage(),
        'per_page'     => $higroupes->perPage(),
        'last_page'    => $higroupes->lastPage(),
        'from'         => $higroupes->firstItem(),
        'to'           => $higroupes->lastItem(),
      ],
      'higroupes' => $higroupes
    ];
  }

  public function select(Request $request)
  {
    if (!$request->ajax()) return redirect('/');
    $higroupes = Higroupe::all()->where('status','=',1);
    return ['higroupes' => $higroupes];
  } 

  public function store(Request $request)
  {
    if (!$request->ajax()) return redirect('/');
    $higroupe = new Higroupe();
    $higroupe->name = $request->name;
    $higroupe->description = $request->description;
    $higroupe->slug = str_slug($request->name, "-");
    $higroupe->status = '1';
    $higroupe->save();
  }

  public function update(Request $request)
  {
    if (!$request->ajax()) return redirect('/');
    $higroupe = Higroupe::findOrFail($request->id);
    $higroupe->name = $request->name;
    $higroupe->description = $request->description;
    $higroupe->slug = str_slug($request->name, "-");
    $higroupe->status = '1';
    $higroupe->save();
  }

  public function desactivate(Request $request)
  {
    if (!$request->ajax()) return redirect('/');
    $higroupe = Higroupe::findOrFail($request->id);
    $higroupe->status = '0';
    $higroupe->save();
  }

  public function activate(Request $request)
  {
    if (!$request->ajax()) return redirect('/');
    $higroupe = Higroupe::findOrFail($request->id);
    $higroupe->status = '1';
    $higroupe->save();
  }

  public function destroy($id)
	{
    $b = Higroupe::findOrFail($id);
    $b->delete();
    return response()->json(['data' => $b], 200);
	}
}
