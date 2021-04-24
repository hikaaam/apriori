<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\transaction;
use App\product;
use App\frontend;
use App\categories;
use App\User;
use Illuminate\Support\Facades\Auth;

class backendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $jumlah_product = product::all();
        $jumlah_product = count($jumlah_product);
        $jumlah_transaksi = transaction::where("status", 1)->groupBy('id_transaksi')->get();
        $jumlah_transaksi = \count($jumlah_transaksi);
        $barang_dibeli = transaction::where("status", 1)->get();
        $barang_dibeli = count($barang_dibeli);
        return view("backend.index", compact('jumlah_product', 'jumlah_transaksi', 'barang_dibeli'));
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
        if ($request->has('logo')) {
            $data = [
                "logo" => $request->logo,
                "pagination" => $request->pagination
            ];
            frontend::find(1)->update($data);
            return redirect()->back()->with("success", "Data berhasil di update");
        } else {
            $data = [
                "tentang" => $request->tentang,
                "facebook" => $request->facebook,
                "instagram" => $request->instagram,
                "copyright" => $request->copyright,
                "github" => $request->github
            ];
            frontend::find(1)->update($data);
            return redirect()->back()->with("success", "Data berhasil di update");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($admin)
    {
        $id = $admin;
        if ($id == "home") {
            $data = frontend::find(1);
            return view('backend.showHome', compact('data'));
        } else if ($id == "product") {
            $data = product::all();
            return view("backend.product.index", compact('data'));
        } else if ($id == "categories") {
            $data = categories::all();
            return view("backend.categories.index", compact('data'));
        } else if ($id == "transaction") {
            $harga = [];
            $data = transaction::groupBy('id_transaksi')->orderBy('id', 'desc')->get();
            foreach ($data as $d) {
                $temp = transaction::where('id_transaksi', $d->id_transaksi)->get();
                $count = 0;
                foreach ($temp as $t) {
                    $zz = product::find($t->id_barang);
                    $count = $count + $zz->harga;
                }
                array_push($harga, $count);
            }
            return view("backend.transaction.index", compact('data', 'harga'));
        } else {
            $data = frontend::find(1);
            return view('backend.showFooter', compact('data'));
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
function anotherGuard()
{
    if (Auth::user()->role !== 'user') {
        return redirect()->back()->with("failed", "Data berhasil di update");
    }
}
