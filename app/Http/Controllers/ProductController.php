<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{

    public function getProduct()
    {
        $datas = DB::table('products')
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->select([
            'products.id as id',
            'products.product_name as name',
            'categories.category_name as category',
            'products.product_price as price',
            DB::raw('100 as stock')
        ])
        ->get();
        $datas = $datas->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'category' => $item->category,
                'price' => (float) $item->price,
                'stock' => (int) $item->stock,
            ];
        });
        return response()->json($datas->toArray());
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Data Products";
        $datas = Products::with('category')->get();
        $categories = Categories::all();
        $privilageAll = Session::get('privilage');
        $path = request()->path();
        $currentpath = "/{$path}";
        $privilage = $privilageAll[$currentpath];
        return view('products.index', compact('title', 'datas' , 'categories' , 'privilage'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categories::orderBy('id', 'desc')->get();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $is_active = 1;

        if ($request->is_active == "nonaktif") {
            $is_active = 0;
        }

        $data = [
            'category_id' => $request->category_id,
            'product_name' => $request->product_name,
            'product_price' => $request->product_price,
            'product_description' => $request->product_description,
            'is_active' => $is_active,
        ];
        if($request->hasFile('product_photo')) {
            $photo = $request->file('product_photo')->store('products', 'public');
            $data['product_photo'] = $photo;
        }

        Products::create($data);

        return redirect()->route('products.index')->with('success', 'Product added successfully');

    }

   public function edit($id)
    {
        $edit = Products::find($id);
        $categories = Categories::orderBy('id', 'desc')->get();
        return view('products.edit', compact('edit', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $product = Products::find($id);

    $product->category_id = $request->category_id;
    $product->product_name = $request->product_name;
    $product->product_price = $request->product_price;
    $product->product_description = $request->product_description;
    $product->is_active = $request->is_active;


    if ($request->hasFile('product_photo')) {
        if ($product->product_photo) {
            File::delete(public_path('storage/' . $product->product_photo));
        }

        $photo = $request->file('product_photo')->store('products', 'public');
        $product->product_photo = $photo;
    }

    $product->save();
    Alert::image('Product Updated!','Product update was successful!',
    asset('storage/products/download.jpg'),'500px','250px','Product Success Image');


    return redirect()->route('products.index');

    }

    public function destroy(string $id)
    {
        $product = Products::find($id);
        File::delete(public_path('storage/' . $product->product_photo));
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }

}
