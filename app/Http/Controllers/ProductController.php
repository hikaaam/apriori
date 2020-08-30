<?php

namespace App\Http\Controllers;

use App\product;
use App\categories;
use App\transaction;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = categories::all();
        return view("backend.product.store",compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(product::where('nama_barang',$request->nama_barang)->count()>=1){
            return redirect()->back()->with('error', "Maaf Barang Tersebut Sudah Ada!!");
        }
        $target_dir = base_path('public\images\product\\');
        $target_file = $target_dir . basename($_FILES["img"]["name"]);
        $foto = "images\product\\".basename($_FILES["img"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["img"]["tmp_name"]);
        if($check !== false) {
            // echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            return redirect()->back()->with('error', "Format file harus berbentuk image");
            $uploadOk = 0;
        }
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            return redirect()->back()->with('error', "File foto hanya boleh png, jpeg, jpg");
        $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            return redirect()->back()->with('error', "Terjadi Error Saat Mengupload Foto");
        // if everything is ok, try to upload file
        } else {
        if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["img"]["name"]). " has been uploaded.";
        } else {
            return redirect()->back()->with('error', "Terjadi Error Saat Mengupload Foto");
        }
        }

        $data = [
            "id_kategori"=>$request->id_kategori,
            "nama_barang"=>$request->nama_barang,
            "harga"=>$request->harga,
            "img"=>$foto
        ];
        product::create($data);
        return redirect()->back()->with('success', "Barang Berhasil Ditambahkan!!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $data = product::find($id);
       $kategori = categories::all();
       return view("backend.product.edit",compact('data','kategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = product::find($id);
        if( !$request->has('img')){
            $foto = $data->img;
        }
        else{        
            $target_dir = base_path('public\images\product\\');
            $target_file = $target_dir . basename($_FILES["img"]["name"]);
            $foto = "images\product\\".basename($_FILES["img"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
            // Check if image file is a actual image or fake image
            if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["img"]["tmp_name"]);
            if($check !== false) {
                // echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                return redirect()->back()->with('error', "Format file harus berbentuk image");
                $uploadOk = 0;
            }
            }
    
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                return redirect()->back()->with('error', "File foto hanya boleh png, jpeg, jpg");
            $uploadOk = 0;
            }
    
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                return redirect()->back()->with('error', "Terjadi Error Saat Mengupload Foto");
            // if everything is ok, try to upload file
            } else {
            if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
                echo "The file ". basename( $_FILES["img"]["name"]). " has been uploaded.";
            } else {
                return redirect()->back()->with('error', "Terjadi Error Saat Mengupload Foto");
            }
            }
    }
        $data = [
            "id_kategori"=>$request->id_kategori,
            "nama_barang"=>$request->nama_barang,
            "harga"=>$request->harga,
            "img"=>$foto
        ];
        product::find($id)->update($data);
        return redirect()->back()->with('success', "Barang Berhasil Diupdate!!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        product::find($id)->delete();
        transaction::where("id_barang",$id)->delete();
        return redirect()->back()->with('success', "Barang Berhasil Dihapus!");
    }
}
