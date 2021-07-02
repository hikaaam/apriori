<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\product;
use App\transaction;
use App\frontend;
use App\akun;
use App\categories;
use App\Mail\NotifMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

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
        $cat = categories::all();
        $active = 'Semua';
        return view("frontend.index", compact('data', 'cat', 'active'));
    }

    public function select($id)
    {
        try {
            $cat = categories::all();
            foreach ($cat as $key => $value) {
                if ($id === $value->nama_kategori) {
                    $f = frontend::find(1);
                    $paginate = $f->pagination;
                    $data = product::where("id_kategori", $value->id)->paginate($paginate);
                    $active = $value->nama_kategori;
                    return view("frontend.index", compact('data', 'cat', 'active'));
                }
            }
            return abort(404);
        } catch (\Throwable $th) {
            // $f = frontend::find(1);
            // $paginate = $f->pagination;
            // $data = product::paginate($paginate);
            // $cat = categories::all();
            // $active = 'Semua';
            // return view("frontend.index", compact('data', 'cat', 'active'));
            return abort(404);
        }
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
    public function show($product)
    {
        $id = $product;
        $historyExist = false;
        // try {
        $product = product::findOrFail($id); //mengambil detail data yang diklik atau barang A
        $id_transaksi = transaction::select("id_transaksi")->where('id_barang', $id)->where('status', 1)->get();
        //kemudian cari semua transaksi yang mengandung barang A
        $jumlah_antecedent = count($id_transaksi); //jumlah antecendent A || jumlah transaksi mengandung A

        $seluruhTransaksi = transaction::groupBy("id_transaksi")->where('status', 1)->get();
        //ambil total transaksi dari database
        $jumlah_transaksi = count($seluruhTransaksi); //jumlah total transaksi

        // dd($jumlah_transaksi); //total seluruh transaksi
        // dd($jumlah_antecedent); //total ancedent A
        // dd($id_transaksi); //atencedent A

        $dataRaw = [];
        foreach ($id_transaksi as $idt) {
            $barang = transaction::where('id_transaksi', $idt->id_transaksi)->get();
            $listBarang = [];
            foreach ($barang as $b) {
                $current_id = $b->id_transaksi;
                if ($b->id_barang != $id) {
                    array_push($listBarang, $b->id_barang);
                }
            }
            array_push($dataRaw, $listBarang);
        } //72-83 ambil barang yang berhubungan dengan A dari antecedent A (seluruh transasksi yg mengandung A)

        // dd($dataRaw); //check AUB

        $arrayCount = [];


        foreach ($dataRaw as $dr) {
            foreach ($dr as $subdr) {
                array_push($arrayCount, $subdr);
            }
        }  //taruh barang 1 - 1 dari antecedent A kedalam array



        $jumlah = array_count_values($arrayCount); //jumlah barang AUB + tptal barang

        // dd($jumlah); //di gabung seluruh AUB

        $hasil = [];

        foreach ($jumlah as $key => $value) {
            $confidence = ($value / $jumlah_antecedent);
            $support = ($value / $jumlah_transaksi);
            // return $support*$confidence;
            $isi = [
                "value" => $confidence * $support,
                "key" => $key,
                "confidence" => $confidence,
                "support" => $support
            ];
            array_push($hasil, $isi);
        } //108 - 119 perhitungan confidence, support dan apriori

        // dd($hasil); //sebelum sorting

        usort($hasil, function ($a, $b) {
            if ($a == $b) {
                return 0;
            }
            return ($a > $b) ? -1 : 1;
        });

        // dd($hasil); //sesudah sorting terbesar ke terkecil

        $historyExist = count($hasil) >= 1; //check if history exist

        // return $hasil;
        $data = [];
        $limit = 4;
        foreach ($hasil as $key => $value) {

            //==> better code 
            if ($key + 1 <= $limit) {
                $newProduk = product::find($value['key']);
                array_push($data, $newProduk);
            }
        } //di ambil 4 barang

        // dd($data); //check 4 barang rekomendasi apriori

        if (count($data) <= 0) {
            //kie wik default ketika pertama ngisi
            $katz = $product->id_kategori;
            $sqlQuery = "SELECT transactions.*, count(transactions.id_barang) as 'most_buy' FROM `transactions` INNER JOIN" .
                " products ON products.id = transactions.id_barang INNER JOIN categories ON products.id_kategori = categories.id" .
                " WHERE categories.id = " . $katz . " GROUP BY transactions.id_barang ORDER BY most_buy desc limit 1";
            //mencari product terlaris dengan kategori yg sama kemudian cari nilai apriori nya;
            $getProduct = DB::select($sqlQuery);
            // dd($getProduct); //uncomment ini untuk lihat product yg terlaris (most_buy)
            if (count($getProduct) > 0) {
                $mostbuyid = $getProduct[0]->id_barang;
                // dd(apriori($mostbuyid));
                $data = apriori($mostbuyid); //cari lagi id product dengan apriori
                $historyExist = true;
            }
        }
        return view("frontend.show", compact("product", "data", "historyExist"));
        // } catch (\Throwable $th) {
        //     return abort(500);
        // }
    }
    public function search(Request $request)
    {
        $id = $request->search;
        $f = frontend::find(1);
        $paginate = $f->pagination;
        $data = product::where('nama_barang', 'like', "%" . $id . "%")->paginate($paginate);
        $message = "Search Result of " . $id;
        return view("frontend.index", compact('data', 'message'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($product)
    {
        $id = $product;
        function generateRandomString($length = 25)
        {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }
        function randomId()
        {
            $id_transaksi = generateRandomString();
            if (transaction::where("id_transaksi", $id_transaksi)->count() < 1) {
                return $id_transaksi;
            } else {
                randomId();
            }
        }
        //code here
        if (Session::has('nama')) {
            $akun = akun::where('email', Session::get('email'))->get();
            $id_user = $akun[0]['id'];
            $barang = product::find($id);
            $check = transaction::where("status", 0)->get();

            if (count($check) < 1) {
                $id_transaksi = randomId();
                $data = [
                    "id_transaksi" => $id_transaksi,
                    "id_barang" => $id,
                    "id_user" => $id_user,
                    "nama_barang" => $barang->nama_barang
                ];
                transaction::create($data);
                return redirect()->back()->with('modal', 'show');
            } else {
                $check2 = transaction::where("id_barang", $id)->where("status", 0)->get();
                if (count($check2) < 1) {
                    $id_transaksi = $check[0]['id_transaksi'];
                    $data = [
                        "id_transaksi" => $id_transaksi,
                        "id_barang" => $id,
                        "id_user" => $id_user,
                        "nama_barang" => $barang->nama_barang
                    ];
                    transaction::create($data);
                    return redirect()->back()->with('modal', 'show');
                } else {
                    return redirect()->back()->with('modal', 'show');
                }
            }
        } else {
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
    public function update(Request $request, $product)
    {
        $id = $product;
        $data = transaction::where('id_transaksi', $id)->get();
        if ($request->has("update")) {
            $total = 0;
            foreach ($data as $d) {
                $harga = product::select('harga')->find($d->id_barang);
                $total = $total + $harga['harga'];
            }
            return view('frontend.checkout', compact('id', 'total'));
            // $data=[
            //     "status"=>1
            // ];
            // transaction::where("id_transaksi",$id)->update($data);
            // return redirect()->to("/")->with('modal','show'); 
        }
        if ($request->has("img")) {
            if (!$request->has('img')) {
                $foto = $data->img;
            } else {
                $target_dir = base_path('public/images/transaksi/');
                $uploadOk = 1;
                $ext = strtolower(pathinfo(basename($_FILES["img"]["name"]), PATHINFO_EXTENSION));
                $imagename = Carbon::now()->unix() . basename($_FILES["img"]["name"]);
                $target_file = $target_dir . $imagename;
                $imageFileType = $ext;
                $foto = "images\\transaksi\\" . $imagename;
                // Check if image file is a actual image or fake image
                if (isset($_POST["submit"])) {
                    $check = getimagesize($_FILES["img"]["tmp_name"]);
                    if ($check !== false) {
                        // echo "File is an image - " . $check["mime"] . ".";
                        $uploadOk = 1;
                    } else {
                        return redirect()->back()->with('error', "Format file harus berbentuk image");
                        $uploadOk = 0;
                    }
                }

                // Allow certain file formats
                if (
                    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif"
                ) {
                    return redirect()->back()->with('error', "File foto hanya boleh png, jpeg, jpg");
                    $uploadOk = 0;
                }

                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    return redirect()->back()->with('error', "Terjadi Error Saat Mengupload Foto");
                    // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
                        // echo "The file " . basename($_FILES["img"]["name"]) . " has been uploaded.";
                    } else {
                        return redirect()->back()->with('error', "Terjadi Error Saat Mengupload Foto");
                    }
                }
            }

            $target = "supmarhernanda@gmail.com";
            // $target = "andrenuryana@gmail.com";
            $data = ['data' => $id];
            try {
                Mail::to($target)->Send(new NotifMail($data));
            } catch (\Throwable $th) {
                return $th->getMessage();
            }
            $data = [
                "status" => 2,
                "img" => $foto
            ];
            transaction::where("id_transaksi", $id)->update($data);
            return redirect()->to("/")->with('modal', 'show');
        } else {
            transaction::where("id_transaksi", $id)->where("id_barang", $request->id)->delete();
            return redirect()->to($request->link)->with('modal', 'show');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($product)
    {
        //
    }
}
function apriori($id)
{
    $product = product::find($id);
    $id_transaksi = transaction::select("id_transaksi")->where('id_barang', $id)->where('status', 1)->get();
    $jumlah_antecedent = count($id_transaksi);
    // dd($product);
    $seluruhTransaksi = transaction::groupBy("id_transaksi")->where('status', 1)->get();
    $jumlah_transaksi = count($seluruhTransaksi);

    $dataRaw = [];
    foreach ($id_transaksi as $idt) {
        $barang = transaction::where('id_transaksi', $idt->id_transaksi)->get();
        $listBarang = [];
        foreach ($barang as $b) {
            $current_id = $b->id_transaksi;
            if ($b->id_barang != $id) {
                array_push($listBarang, $b->id_barang);
            }
        }
        array_push($dataRaw, $listBarang);
    }
    // return $dataRaw;
    $arrayCount = [];


    foreach ($dataRaw as $dr) {
        foreach ($dr as $subdr) {
            array_push($arrayCount, $subdr);
        }
    }

    // return $arrayCount;

    $jumlah = array_count_values($arrayCount);

    $hasil = [];

    foreach ($jumlah as $key => $value) {
        $confidence = ($value / $jumlah_antecedent);
        $support = ($value / $jumlah_transaksi);
        // return $support*$confidence;
        $isi = [
            "value" => $confidence * $support,
            "key" => $key
        ];
        array_push($hasil, $isi);
    }

    usort($hasil, function ($a, $b) {
        if ($a == $b) {
            return 0;
        }
        return ($a < $b) ? -1 : 1;
    });

    // return $hasil;
    $data = [];
    $i = 0;
    foreach ($hasil as $key => $value) {

        if ($i == 0) {
            $product1 = product::find($value['key']);
            array_push($data, $product1);
        } else if ($i == 1) {
            $product2 = product::find($value['key']);
            array_push($data, $product2);
        } else if ($i == 2) {
            $product3 = product::find($value['key']);
            array_push($data, $product3);
        } else if ($i == 3) {
            $product4 = product::find($value['key']);
            array_push($data, $product4);
        }
        $i++;
    }
    return $data;
}
