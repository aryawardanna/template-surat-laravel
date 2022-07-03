<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(5);
        $activeCategory = 'active';
        return view('admin.category.index', ['categories' => $categories, 'activeCategory' => $activeCategory]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $activeCategory = 'active';
        return view('admin.category.create', ['activeCategory' => $activeCategory]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $activeCategory = 'active';
        // validasi
        $request->validate([
            'name' => 'required|min:3'
        ]);

        $input = $request->all();

        Category::create($input);

        return redirect()->route('category.index', ['activeCategory' => $activeCategory])->with('success', 'Category berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::findOrFail($id); //select * from category where idcategory = $id
        $activeCategory = 'active';
        // return $categories;

        return view('admin.category.edit', ['categories' => $categories, 'activeCategory' => $activeCategory]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // validasi
        $request->validate([
            'name' => 'required|min:3'
        ]);
        $categories = Category::find($id);

        $categories->name = $request->name;
        $categories->description = $request->description;

        $categories->update();

        return redirect()->route('category.index')->with('success', 'Category berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categories = Category::find($id);
        $categories->delete();

        return redirect()->route('category.index')->with('success', 'Category berhasil di hapus');
    }
}
