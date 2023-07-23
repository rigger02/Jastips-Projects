<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Driver;
use App\Models\Order;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DriverController extends Controller
{
    
    public function history(Request $request){
        $id_tmd = $request->input('id_tmd');
        $history = DB::table('vw_driver_history')->get();
        
        return response()->json([
            "data" => $history
            ]);
    }
    
    public function getOrderReady(){
        $query = DB::table('tbl_t_order_purchase as ttop')
    ->select('ttop.transaction_ttop','tms.image_tms','tms.name_tms', 'ttop.transaction_ttop', 'ttca.name_ttca', 'ttca.phone_ttca', 'ttca.static_ttca', 'ttca.dynamic_ttca')
    ->selectRaw('SUM(ttps.price_ttps * ttop.qty_ttop) as total')
    ->selectRaw('GROUP_CONCAT(ttps.name_ttps SEPARATOR ", ") as product_ttps')
    ->selectRaw('SUM(ttop.qty_ttop) as item_qty')
    ->join('tbl_t_customer_address as ttca', 'ttca.id_ttca', '=', 'ttop.id_ttca')
    ->join('tbl_t_product_store as ttps', 'ttps.id_ttps', '=', 'ttop.id_ttps')
    ->join('tbl_m_store as tms', 'tms.id_tms', '=', 'ttps.id_tms')
    ->where('ttop.status_ttop', '=', 'process')
    ->whereNull('ttop.id_tmd')
    ->groupBy('ttop.transaction_ttop','tms.image_tms','tms.name_tms', 'ttop.transaction_ttop', 'ttca.name_ttca', 'ttca.phone_ttca', 'ttca.static_ttca', 'ttca.dynamic_ttca')->get();
    
    return response()->json(["data" => $query]);

    }
    
    public function takeOrderDriver(Request $request, $id)
    {
        $id_tmd = $request->input('id_tmd');
        $affectedRows = Order::where('transaction_ttop', $id)
            ->update(['status_ttop' => 'onTheWay', 'id_tmd' => $id_tmd]);
    
        if ($affectedRows > 0) {
            return response()->json(['msg' => "Anda telah berhasil menerima pesanan"]);
        } else {
            return response()->json(['msg' => "Pesanan tidak ditemukan"]);
        }
    }
    
    public function pesanan()
    {
        $pesananItems = DB::table('pesanan')
                        ->join('keranjang', 'pesanan.idKeranjang', '=', 'keranjang.idKeranjang')
                        ->join('produk', 'keranjang.idProduk', '=', 'produk.idProduk')
                        ->join('seller', 'produk.validateEmail', '=', 'seller.validateEmail')
                        ->where('pesanan.pesananStatus', 'proses')
                        ->get();
        $data=[];
        foreach ($pesananItems as $key) {
            array_push($data,[
                'gambar'=>url($key->gambar),
                'namaToko'=>$key->namaToko,
                'alamatToko'=>$key->alamatToko,
                'namaProduk'=>$key->namaProduk,
                'harga'=>$key->harga,
                'jumlahBarang'=>$key->jumlahBarang,
                'totalHarga'=>$key->totalHarga,
                'namaUser'=>$key->namaUser,
                'phoneUser'=>$key->phoneUser,
                'alamatUser'=>$key->alamatUser,
                'emailKurir'=>$key->emailKurir,
                'namaKurir'=>$key->namaKurir,
                'phoneKurir'=>$key->phoneKurir,
            ]);
            
        }
        return response()->json(['data'=>$data]);
        
    }
    public function ambil()
    {
        $pesananItems = DB::table('pesanan')
                        ->join('keranjang', 'pesanan.idKeranjang', '=', 'keranjang.idKeranjang')
                        ->join('produk', 'keranjang.idProduk', '=', 'produk.idProduk')
                        ->join('seller', 'produk.validateEmail', '=', 'seller.validateEmail')
                        ->where('pesanan.pesananStatus', 'proses')
                        ->get();
        $data=[];
        foreach ($pesananItems as $key) {
            array_push($data,[
                'gambar'=>url($key->gambar),
                'namaToko'=>$key->namaToko,
                'alamatToko'=>$key->alamatToko,
                'namaProduk'=>$key->namaProduk,
                'harga'=>$key->harga,
                'jumlahBarang'=>$key->jumlahBarang,
                'totalHarga'=>$key->totalHarga,
                'namaUser'=>$key->namaUser,
                'phoneUser'=>$key->phoneUser,
                'alamatUser'=>$key->alamatUser,
                'emailKurir'=>$key->emailKurir,
                'namaKurir'=>$key->namaKurir,
                'phoneKurir'=>$key->phoneKurir,
            ]);
            
        }
        return response()->json(['data'=>$data]);
    }


}
