<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\transaction;
use App\product;
class transaksiController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($id == "TB"){
            $harga = [];
            $data = transaction::where('status',0)->groupBy('id_transaksi')->orderBy('id','desc')->get();
            foreach($data as $d){
               $temp = transaction::where('id_transaksi',$d->id_transaksi)->where('status',0)->get();
               $count = 0;
               foreach($temp as $t){
                   $zz = product::find($t->id_barang);
                   $count = $count+$zz->harga;
               }
               array_push($harga,$count);
            }
            return view("backend.transaction.index",compact('data','harga'));
        }
        else if($id == "BD"){
            $harga = [];
            $data = transaction::where('status',2)->groupBy('id_transaksi')->orderBy('id','desc')->get();
            foreach($data as $d){
               $temp = transaction::where('id_transaksi',$d->id_transaksi)->where('status',2)->get();
               $count = 0;
               foreach($temp as $t){
                   $zz = product::find($t->id_barang);
                   $count = $count+$zz->harga;
               }
               array_push($harga,$count);
            }
            return view("backend.transaction.index",compact('data','harga'));
        }
        else{
            $harga = [];
            $data = transaction::where('status',1)->groupBy('id_transaksi')->orderBy('id','desc')->get();
            foreach($data as $d){
               $temp = transaction::where('id_transaksi',$d->id_transaksi)->where('status',1)->get();
               $count = 0;
               foreach($temp as $t){
                   $zz = product::find($t->id_barang);
                   $count = $count+$zz->harga;
               }
               array_push($harga,$count);
            }
            return view("backend.transaction.index",compact('data','harga'));
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
        $item = transaction::where('id_transaksi',$id)->limit(1)->get();
        $item = $item[0];
        return view("backend.transaction.edit",compact('item'));
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
        $data = [
            "status"=>$request->status
        ];
        transaction::where('id_transaksi',$id)->update($data);
        return redirect()->back()->with('success', "Transaksi Berhasil Diupdate!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        transaction::where('id_transaksi',$id)->delete();
        return redirect()->back()->with('success', "Transaksi Berhasil Dihapus!");
    }
}
