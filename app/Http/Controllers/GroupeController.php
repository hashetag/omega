<?php

namespace App\Http\Controllers;

use App\Groupe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GroupeController extends Controller
{
	public function index(Request $request)
    {
      if (!$request->ajax()) return redirect('/');
      $search = $request->search;
      $criteria = $request->criteria;

      if ($search==''){
<<<<<<< HEAD
        $groupes = Groupe::all()->orderBy('groupes.id', 'asc')->paginate(20);
      }
      else{
        $groupes = Groupe::all()
=======
        $groupes = Groupe::join('higroupes','groupes.higroup_id','=','higroupes.id')
        ->select('groupes.id', 'groupes.name','groupes.description','groupes.logo','groupes.color','groupes.slug', 'groupes.status','groupes.higroup_id','higroupes.name as higroupe')
        ->orderBy('groupes.id', 'asc')->paginate(20);
      }
      else{
        $groupes = Groupe::join('higroupes','groupes.higroup_id','=','higroupes.id')
        ->select('groupes.id', 'groupes.name','groupes.description','groupes.logo','groupes.color','groupes.slug', 'groupes.status','groupes.higroup_id','higroupes.name as higroupe')
>>>>>>> a7f46dba2b390825d66a2b719184eec6042b2b72
        ->where('groupes.'.$criteria, 'like', '%'. $search . '%')
        ->orderBy('groupes.id', 'asc')->paginate(20);
      }

      return [
        'pagination' => [
          'total'        => $groupes->total(),
          'current_page' => $groupes->currentPage(),
          'per_page'     => $groupes->perPage(),
          'last_page'    => $groupes->lastPage(),
          'from'         => $groupes->firstItem(),
          'to'           => $groupes->lastItem(),
        ],
        'groupes' => $groupes
      ];
      //return response()->json(['data' => $bus], 200);
    }

	public function select(Request $request)
  {
    if (!$request->ajax()) return redirect('/');
    $groupes = Groupe::all()->where('status','=',1);
    return ['groupes' => $groupes];
  } 

	public function store(Request $request)
  {
    if (!$request->ajax()) return redirect('/');
    $groupe = new Groupe();
<<<<<<< HEAD
=======
    $groupe->higroup_id = $request->higroup_id;
>>>>>>> a7f46dba2b390825d66a2b719184eec6042b2b72
    $groupe->name = $request->name;
    $groupe->description = $request->description;
    $groupe->logo = $request->logo;
    $groupe->color = $request->color;
    $groupe->slug = str_slug($request->name, "-");
    $groupe->status = '1';
    $groupe->save();
  }

  public function update(Request $request)
  {
    if (!$request->ajax()) return redirect('/');
    $groupe = Groupe::findOrFail($request->id);
<<<<<<< HEAD
=======
    $groupe->higroup_id = $request->higroup_id;
>>>>>>> a7f46dba2b390825d66a2b719184eec6042b2b72
    $groupe->name = $request->name;
    $groupe->description = $request->description;
    $groupe->logo = $request->logo;
    $groupe->color = $request->color;
    $groupe->slug = str_slug($request->name, "-");
    $groupe->status = '1';
    $groupe->save();
  }

  public function desactivate(Request $request)
  {
    if (!$request->ajax()) return redirect('/');
    $groupe = Groupe::findOrFail($request->id);
    $groupe->status = '0';
    $groupe->save();
  }

  public function activate(Request $request)
  {
    if (!$request->ajax()) return redirect('/');
    $groupe = Groupe::findOrFail($request->id);
    $groupe->status = '1';
    $groupe->save();
  }

  public function destroy($id)
	{
    $b = Groupe::findOrFail($id);
    $b->delete();
    return response()->json(['data' => $b], 200);
	}
}
