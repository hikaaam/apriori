<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\product;
use App\transaction;
use App\frontend;
use App\akun;
use Session;
use App\Mail\NotifMail;
use Illuminate\Support\Facades\Mail;

class frontendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $f = frontend::find(1);
        $paginate = $f->pagination;
        $data = product::paginate($paginate);
        return view("frontend.index",compact('data'));
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
        $product = product::find($id);
        
        $id_transaksi = transaction::select("id_transaksi")->where('id_barang',$id)->where('status',1)->get();
        $jumlah_antecedent = count($id_transaksi);
        
        $seluruhTransaksi = transaction::groupBy("id_transaksi")->where('status',1)->get();
        $jumlah_transaksi = count($seluruhTransaksi);

        $dataRaw = [];
        foreach($id_transaksi as $idt){
            $barang = transaction::where('id_transaksi',$idt->id_transaksi)->get();
            $listBarang = [];
            foreach($barang as $b){
                $current_id = $b->id_transaksi;
                if($b->id_barang != $id){
                array_push($listBarang,$b->id_barang);
                }
            }
            array_push($dataRaw,$listBarang);
        }
        // return $dataRaw;
        $arrayCount = [];
      
        
        foreach($dataRaw as $dr){  
      
            foreach($dr as $subdr){
            array_push($arrayCount,$subdr);  
            }
        }
      
        // return $arrayCount;

        $jumlah = array_count_values($arrayCount);

        $hasil = [];

        foreach($jumlah as $key => $value){
            $confidence = ($value/$jumlah_antecedent);
            $support = ($value/$jumlah_transaksi);
            // return $support*$confidence;
            $isi = [
                "value"=>$confidence*$support,
                "key"=>$key
            ];
            array_push($hasil,$isi);
        }

        usort($hasil, function($a,$b){
          return  $a["value"] < $b["value"];
        });

        // return $hasil;
        $data = [];
        $i = 0;
        foreach($hasil as $key => $value){
       
           if($i == 0){
            $product1 = product::find($value['key']);
            array_push($data,$product1);
           }
           else if($i == 1){
            $product2 = product::find($value['key']);
            array_push($data,$product2);
           }
           else if($i == 2){
           $product3 = product::find($value['key']);
           array_push($data,$product3);
           }
          else if($i == 3 ){
           $product4 = product::find($value['key']);
           array_push($data,$product4);
          }
          $i++;
        }
       return view("frontend.show",compact("product","data"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        function generateRandomString($length = 25) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }
      function randomId(){
        $id_transaksi = generateRandomString();
        if(transaction::where("id_transaksi",$id_transaksi)->count()<1){
            return $id_transaksi;
        }
        else{
            randomId();
        }
      }
      //code here
      if(Session::has('nama')){
        $akun = akun::where('email',Session::get('email'))->get();
        $id_user = $akun[0]['id'];
        $barang = product::find($id);
        $check = transaction::where("status",0)->get();
        
            if(count($check)<1){
                $id_transaksi = randomId();
                $data = [
                    "id_transaksi"=>$id_transaksi,
                    "id_barang"=>$id,
                    "id_user"=>$id_user,
                    "nama_barang"=>$barang->nama_barang
                ];
                transaction::create($data);
                return redirect()->back()->with('modal','show');
            }
            else{
                $check2 = transaction::where("id_barang",$id)->where("status",0)->get();
                if(count($check2)<1){
                    $id_transaksi = $check[0]['id_transaksi'];
                    $data = [
                        "id_transaksi"=>$id_transaksi,
                        "id_barang"=>$id,
                        "id_user"=>$id_user,
                        "nama_barang"=>$barang->nama_barang
                    ];
                    transaction::create($data);
                    return redirect()->back()->with('modal','show');
                }
                else{
                    return redirect()->back()->with('modal','show');
                }
            }
        }
        else{
            return view('frontend.akun.index');
        }
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
        if($request->has("update")){
            $data = transaction::where('id_transaksi',$id)->get();
            $total = 0;
            foreach($data as $d){
                $harga = product::select('harga')->find($d->id_barang);
                $total = $total + $harga['harga'];
            }
            return view('frontend.checkout',compact('id','total'));
            // $data=[
            //     "status"=>1
            // ];
            // transaction::where("id_transaksi",$id)->update($data);
            // return redirect()->to("/")->with('modal','show'); 
        }
        if($request->has("img")){
            if( !$request->has('img')){
                $foto = $data->img;
            }
            else{        
                $target_dir = base_path('public\images\transaksi\\');
                $target_file = $target_dir . basename($_FILES["img"]["name"]);
                $foto = "images\\transaksi\\".basename($_FILES["img"]["name"]);
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
        
            $target = "supmarhernanda@gmail.com";
            $data = ['data'=>$id];
                try {
                    //code...
                    Mail::to($target)->Send(new NotifMail($data));
                    // return $otp;
                } 
                catch (\Throwable $th) {
                    return $th;
                }
            $data=[
                "status"=>2,
                "img"=>$foto
            ];
            transaction::where("id_transaksi",$id)->update($data);
            return redirect()->to("/")->with('modal','show'); 
        }
        else{
        transaction::where("id_transaksi",$id)->where("id_barang",$request->id)->delete();
        return redirect()->to($request->link)->with('modal','show'); 
       
        }
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
