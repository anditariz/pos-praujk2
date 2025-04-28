<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // return Auth::check();

        $title = "Data Categories";
        $datas = Categories::all();
        $privilageAll = Session::get('privilage');
        $path = request()->path();
        $currentpath = "/{$path}";
        $privilage = $privilageAll[$currentpath];
        return view('categories.index', compact('title', 'datas' , 'privilage'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        Categories::create([
            'category_name' => $request->category_name,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category added successfully');
    }

   public function edit($id)
    {
        $edit = Categories::find($id);
        return view('categories.edit', compact('edit'));
    }

    public function update(Request $request, string $id)
    {
        Categories::where('id',$id)->update([
            'category_name' => $request->category_name,
        ]);
        return redirect()->route('categories.index')->with('success', 'Category updated successfully');

    }

    public function destroy(string $id)
    {
        Categories::where('id', $id)->delete();
        return redirect()->route('categories.index')->with('success', 'Category delete successfully');

    }

}
