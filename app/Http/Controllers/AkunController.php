<?php

namespace App\Http\Controllers;

use App\akun;
use App\product;
use Session;
use Illuminate\Http\Request;

class AkunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.akun.index');
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
        if($request->has('nama')){
            $data = [
                "nama"=>$request->nama,
                "alamat"=>$request->alamat,
                "email"=>$request->email,
                "password"=>md5($request->password)
            ];
            // Session::push("data",$data);
            // return view("frontend.akun.konfirmasi"); auth
            $check = akun::where('email',$request->email)->get();
            if(\count($check)>0){
                return back()->WithErrors("Akun sudah terdaftar");
            }
            else{
                akun::create($data);
                Session::push('nama',$request->nama);
                Session::push('alamat',$request->alamat);
                Session::push('email',$request->email);
                return redirect('');
            }
        }   
        else{
            $email = $request->email;
            $password = md5($request->password);
            $data = akun::where('email',$email)->where('password',$password)->get();
            if(count($data)>0){
                Session::push('nama',$data[0]['nama']);
                Session::push('alamat',$data[0]['nama']);
                Session::push('email',$request->email);
                return redirect('');
            }
            else{
                return back()->WithErrors("Password anda salah");
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\akun  $akun
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($id == "register"){
            return view('frontend.akun.register');
        }
        else if($id == "logout"){
            Session::forget('nama');
            Session::forget('alamat');
            Session::forget('email');
            return redirect('');
        }
        else{
            return abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\akun  $akun
     * @return \Illuminate\Http\Response
     */
    public function edit(akun $akun)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\akun  $akun
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, akun $akun)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\akun  $akun
     * @return \Illuminate\Http\Response
     */
    public function destroy(akun $akun)
    {
        //
    }
}
