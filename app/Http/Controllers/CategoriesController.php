<?php

namespace App\Http\Controllers;

use App\categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view("backend.categories.store");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            "nama_kategori" => $request->nama_kategori
        ];
        categories::create($data);
        return redirect()->back()->with('success', "Kategori Berhasil Ditambahkan!!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function edit($category)
    {
        $id = $category;
        $data = categories::find($id);
        return view("backend.categories.edit", compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $category)
    {
        $id = $category;
        $data = [
            "nama_kategori" => $request->nama_kategori
        ];
        categories::find($id)->update($data);
        return redirect()->back()->with('success', "Kategori Berhasil Diupdate!!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy($category)
    {
        $id = $category;
        categories::find($id)->delete();
        return redirect()->back()->with('success', "Kategori Berhasil Dihapus!");
    }
}
