<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\transaction;
use App\product;
use App\frontend;

class backendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $jumlah_product = product::all()->count();
      $jumlah_transaksi = transaction::where("status",1)->groupBy('id_transaksi')->count();
      $barang_dibeli = transaction::where("status",1)->count();
       return view("backend.index",compact('jumlah_product','jumlah_transaksi','barang_dibeli'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->has('logo')){
            $data = [
            "logo"=>$request->logo,
            "pagination"=>$request->pagination
            ];
            frontend::find(1)->update($data);
            return redirect()->back()->with("success","Data berhasil di update");
        }
        else{
            $data = [
                "tentang"=>$request->tentang,
                "facebook"=>$request->facebook,
                "instagram"=>$request->instagram,
                "copyright"=>$request->copyright,
                "github"=>$request->github
                ];
                frontend::find(1)->update($data);
                return redirect()->back()->with("success","Data berhasil di update");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($id == "home"){
            $data = frontend::find(1);
            return view('backend.showHome',compact('data'));
        }
        else{
            $data = frontend::find(1);
            return view('backend.showFooter',compact('data'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
