<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
	public function index(Request $request)
  {
    if (!$request->ajax()) return redirect('/');
    $b_id = $request->empresa_id;
    $search = $request->search;
    $criteria = $request->criteria;

    if ($search==''){
      $products = Product::join('empresas', 'empresas.id', '=', 'products.empresa_id')
      ->join('categories', 'categories.id', '=', 'products.category_id')
      ->select('products.id', 'products.name', 'products.code', 'products.picture', 'products.price', 'products.stock', 'products.description', 'products.slug', 'products.status', 'products.empresa_id', 'empresas.name as empresa', 'products.category_id', 'categories.name as category')
      ->where('products.empresa_id', $b_id)
      ->orderBy('products.id', 'asc')->paginate(20);
    }
    else{
      $products = Product::join('empresas', 'empresas.id', '=', 'products.empresa_id')
      ->join('categories', 'categories.id', '=', 'products.category_id')
      ->select('products.id', 'products.name', 'products.code', 'products.picture', 'products.price', 'products.stock', 'products.description', 'products.slug', 'products.status', 'products.empresa_id', 'empresas.name as empresa', 'products.category_id', 'categories.name as category')
      ->where('products.empresa_id', $b_id)
      ->where('products.'.$criteria, 'like', '%'. $search . '%')->first()
      ->orderBy('products.id', 'asc')->paginate(20);
    }

    return [
      'pagination' => [
        'total'        => $products->total(),
        'current_page' => $products->currentPage(),
        'per_page'     => $products->perPage(),
        'last_page'    => $products->lastPage(),
        'from'         => $products->firstItem(),
        'to'           => $products->lastItem(),
      ],
      'products' => $products
    ];
    //return response()->json(['data' => $bus], 200);
  }

	public function select(Request $request)
  {
    if (!$request->ajax()) return redirect('/');
    $products = Product::all()->where('status','=',1);
    return ['products' => $products];
  } 

	public function store(Request $request)
  {
    if (!$request->ajax()) return redirect('/');
    $product = new Product();

    if($request->get('picture'))
    {
      $image = $request->get('picture');
      $new_picture = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
      \Image::make($request->get('picture'))->save(public_path('img_product/').$new_picture);
    }

    $product->empresa_id  = $request->empresa_id;
    $product->category_id = $request->category_id;
    $product->name        = $request->name;
    $product->description = $request->description;
    $product->code        = $request->code;
    $product->picture     = $new_picture;
    $product->price       = $request->price;
    $product->discount    = $request->discount;
    $product->stock       = $request->stock;
    
    $sl_cat = Category::where('id', $request->category_id)->first();
    $slg_cat = $sl_cat->slug;

    $slug_prod = str_slug($request->name, "-");
    $product->slug = $slg_cat.'/'.$slug_prod;  

    //$product->slug        = str_slug($request->name, "-");
    $product->status      = '1';
    $product->save();
  }

  public function update(Request $request)
  {
    if (!$request->ajax()) return redirect('/');
    $product = Product::findOrFail($request->id);


    if($request->get('picture')){
    
      $image = $request->get('picture');
      $new_picture = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
      \Image::make($request->get('picture'))->save(public_path('img_product/').$new_picture);
    }

    $categoriesId = Product::where('id', $request->id)->first();
    $catId    = $categoriesId->category_id; 
    //$old_pic  = $categoriesId->picture;
    //$old_pic  = '1561291191.jpeg';

    $product->category_id = $request->category_id;
    $product->name        = $request->name;
    $product->description = $request->description;
    $product->code        = $request->code;

    //if ($new_picture !== null) {
      $product->picture   = $new_picture;
    //}else{
     // $product->picture   = '1561291191.jpeg';
    //}
    
    $product->price       = $request->price;
    if ($request->discount == null) {
      $product->discount   = 0;
    }else{
      $product->discount    = $request->discount;
    }
    $product->stock       = $request->stock;
    
    $sl_cat = Category::select('slug')->where('id', $catId)->first();
    $slg_cat = $sl_cat->slug;

    $slug_prod = str_slug($request->name, "-");
    $product->slug = $slg_cat.'/'.$slug_prod;  

    //$product->slug        = str_slug($request->name, "-");
    $product->status      = '1';
    $product->save();
  }

  public function desactivate(Request $request)
  {
    if (!$request->ajax()) return redirect('/');
    $product = Product::findOrFail($request->id);
    $product->status = '0';
    $product->save();
  }

  public function activate(Request $request)
  {
    if (!$request->ajax()) return redirect('/');
    $product = Product::findOrFail($request->id);
    $product->status = '1';
    $product->save();
  }

  public function destroy($id)
	{
    $b = Product::findOrFail($id);
    $b->delete();
    return response()->json(['data' => $b], 200);
	}
}
