<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Product;
use App\Models\Store;
use App\Models\Order;
use App\Models\Log;
use Illuminate\Support\Facades\DB;


class StoreController extends Controller
{
    
    public function orderStore(Request $request)
    {
        $id_tms = $request->input('id_tms');
        $id_tmu = $request->input('id_tmu');

         $query = DB::table('tbl_t_order_purchase as ttop')
            ->join('tbl_t_product_store as ttps', 'ttps.id_ttps', '=', 'ttop.id_ttps')
            ->join('tbl_m_store as tms', function ($join) use ($id_tms) {
                $join->on('tms.id_tms', '=', 'ttps.id_tms')
                    ->where('tms.id_tms', '=', $id_tms);
            })
            ->select(
                'ttop.transaction_ttop',
                'ttop.status_ttop',
                'tms.name_tms',
                'tms.image_tms',
                DB::raw('GROUP_CONCAT(ttps.name_ttps SEPARATOR ", ") as product'),
                DB::raw('SUM(ttop.qty_ttop) as quantity'),
                DB::raw('SUM(ttps.price_ttps * ttop.qty_ttop) as price'),
                DB::raw('DATE(ttop.created_at) as date_ttop'),
                DB::raw('DATE_FORMAT(ttop.created_at, "%H:%i") as time_ttop')
            )
            ->groupBy(
                'ttop.transaction_ttop',
                'ttop.status_ttop',
                'tms.name_tms',
                'ttop.created_at',
                'tms.image_tms'
            )
            ->get();
        

        $data=[];

        foreach ($query as $key) {
            array_push($data,[
                'transaction' => $key->transaction_ttop,
                'date_ttop' => $key->date_ttop,
                'name_tms' => $key->name_tms,
                'status_ttop' => $key->status_ttop,
                'image_tms' => url($key->image_tms),
                'product' => $key->product,
                'quantity' => $key->quantity,
                'price' => $key->price,
                'time_ttop' => $key->time_ttop,
                ]);
            
        }
        return response()->json(['data'=>$data]);
        
    }
    
    
    public function productForStore(Request $request){ 
        $id_tms = $request->input('id_tms');
        $datas = Product::where('id_tms', $id_tms)
                ->get();
        $products=[]; 
        foreach ($datas as $data) {
            $imageUrl = url($data->image_ttps);
                $data->image_ttps = $imageUrl;
            array_push($products,$data); 
        } 
        return response()->json(['data'=>$products]); 
 
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getStoreId($id){
        $store = Store::where('id_tms', $id)->first();

        return response()->json([
                'name_tms'=>$store->name_tms,
                'image_tms'=>url($store->image_tms),
                'id_tmu'=>$store->id_tmu,
                'id_tms'=>$store->id_tms,
                'phone_tms'=>$store->phone_tms,
                'status_tms'=>$store->status_tms,
                'address_tms'=>$store->address_tms
                ]);
    }

    public function createProduct(Request $request)
    {
        $validator = validator::make($request->all(),[
            'name_ttps' => 'required',
            'image_ttps' => 'required|string',
            'price_ttps' => 'required|numeric',
        ]);
        if ($validator->fails()){
            return messageError($validator->messages()->toArray());
        }

        $id_tms = $request->input('id_tms');
        $id_tmu = $request->input('id_tmu');
        
        $imagePath = 'uploads';
        $imageExtension = '';
    
        if (preg_match('/^data:image\/(\w+);base64,/', $request->image_ttps, $imageExtensionMatch)) {
            $imageExtension = $imageExtensionMatch[1];
        }
        $imageData = substr($request->image_ttps, strpos($request->image_ttps, ',') + 1);
        $imageData = base64_decode($imageData);
    
        $imageName = time() . '.' . $imageExtension;
        file_put_contents($imagePath . '/' . $imageName, $imageData);

        $product = $validator->validated();
        Product::create([
            'name_ttps' => $product['name_ttps'],
            'image_ttps' => 'uploads/'.$imageName,
            'price_ttps' => $product['price_ttps'],
            'id_tms' => $id_tms
        ]);
        Log::create([
            'module'=>'product',
            'action'=>'add '.$product['name_ttps'],
            'useraccess'=>$id_tmu
        ]);
        return response()->json(['success' => 'Image uploaded successfully'],200);
    }

    public function updateProduct(Request $request,$id)
    {

        $validator = validator::make($request->all(),[
            'name_ttps' => 'required',
            'image_ttps' => 'required|string',
            'price_ttps' => 'required',
        ]);
        if ($validator->fails()){
            return messageError($validator->messages()->toArray());
        }

        $id_tmu = $request->input('id_tmu');
        
        $imagePath = 'uploads';
        $imageExtension = '';
    
        if (preg_match('/^data:image\/(\w+);base64,/', $request->image_ttps, $imageExtensionMatch)) {
            $imageExtension = $imageExtensionMatch[1];
        }
        $imageData = substr($request->image_ttps, strpos($request->image_ttps, ',') + 1);
        $imageData = base64_decode($imageData);
    
        $imageName = time() . '.' . $imageExtension;
        file_put_contents($imagePath . '/' . $imageName, $imageData);

        $product = $validator->validated();
        
        $update = Product::where('id_ttps',$id)->update([
            'name_ttps' => $product['name_ttps'],
            'image_ttps' => 'uploads/'.$imageName,
            'price_ttps' => $product['price_ttps']
        ]);
        Log::create([
            'module'=>'Product',
            'action'=>'update '.$product['name_ttps'],
            'useraccess'=>$id_tmu
        ]);
        return response()->json(["msg"=>"Product Updated"],200);
    }


    public function deleteProduct(Request $request, $id)
    {       
        $id_tmu = $request->input('id_tmu');
        $products = Product::where('id_ttps',$id)->get();
            foreach ($products as $product) {
                Log::create([
                    'module'=>'Product',
                    'action'=>'delete '.$product->name_ttps,
                    'useraccess'=>$id_tmu
                ]);

            }
        $products = Product::where('id_ttps',$id)->delete();
        return response()->json(["Product Deleted"],200);

    }

    
    
     public function publishProduct(Request $request, $id)
    {
        $id_tmu = $request->input('id_tmu');
        $update = Product::where('id_ttps',$id)->update(['status_ttps'=>'publish']);
        $publish = Product::where('id_ttps',$id)->get();
        if ($update) {
            foreach ($publish as $key) {
                Log::create([
                    'module'=>'Product',
                    'action'=>'Update '.$key->name_ttps.' status publish',
                    'useraccess'=>$id_tmu
                ]);
                return response()->json(["Product Published"],200);
            }
        } else {
            return response()->json(["Product with id {$id} doesn't exist"], 200);
        }
            
    }

    public function unpublishProduct(Request $request, $id)
    {
        $id_tmu = $request->input('id_tmu');
        $update = Product::where('id_ttps',$id)->update(['status_ttps'=>'unpublish']);
        $unpublish = Product::where('id_ttps',$id)->get();
        if ($update) {
            foreach ($unpublish as $key) {
                Log::create([
                    'module'=>'Product',
                    'action'=>'Update '.$key->name_ttps.' status unpublish',
                    'useraccess'=>$id_tmu
                ]);
                return response()->json(["Product Unpublished"],200);
            }
        } else {
            return response()->json(["Product with id {$id} doesn't exist"], 200);
        }
    }

    public function openStore(Request $request, $id)
    {
        $id_tmu = $request->input('id_tmu');

        $update = Store::where('id_tms',$id)->update(['status_tms'=>'open']);
        $seller = Store::where('id_tms',$id)->get();
        if ($update) {
                Log::create([
                    'module'=>'Store',
                    'action'=>'Update status open',
                    'useraccess'=>$id_tmu
                ]);
                return response()->json(["Open Store Success"],200);
        } else {
            return response()->json(["Store with id {$id} doesn't exist"], 200);
        }
    }
    
    
    
    public function closeStore(Request $request, $id)
    {

        $id_tmu = $request->input('id_tmu');

        $update = Store::where('id_tms',$id)->update(['status_tms'=>'close']);
        $seller = Store::where('id_tms',$id)->get();
        if ($update) {
                Log::create([
                    'module'=>'Store',
                    'action'=>'Update status close',
                    'useraccess'=>$id_tmu
                ]);
                return response()->json(["Close Store Success"],200);
        } else {
            return response()->json(["Store with id {$id} doesn't exist"], 200);
        }
    }
    
    public function takeOrder($id)
    {
        $affectedRows = Order::where('transaction_ttop', $id)
            ->update(['status_ttop' => 'process']);
    
        if ($affectedRows > 0) {
            return response()->json(['msg' => "Anda telah berhasil menerima pesanan"]);
        } else {
            return response()->json(['msg' => "Pesanan tidak ditemukan"]);
        }
    }



    // public function perjalanan($id)
    // {
    //     $data = Pesanan::where('idPesanan',$id);
    //     $update = $data->update(['status'=>'perjalanan']);

        
    //     if ($update) {
    //         $data = Pesanan::where('idPesanan',$id)->get();
    //         foreach ($data as $key) {
    //             Log::create([
    //                 'module'=>'Pesanan',
    //                 'action'=>'status perjalanan '.$key->validateEmail,
    //                 'useraccess'=>$key->validateEmail
    //             ]);
    //             // kirim response ke pengguna
    //             return response()->json(["Berhasil"],200);
    //         }
    //     } else {
    //         return response()->json(['produk dengan id '.$id.' tidak ditemukan'], 200);
    //     }
    // }

     // public function index($id)
    // {
    //     $data = Produk::where('validateEmail','LIKE','%'.$id.'%')->get();

    //     $produk = [];
    //     foreach ($data as $datas) {
    //         array_push($produk,[
    //             'idProduk'=>$datas->idProduk,
    //             'gambar'=>url($datas->gambar),
    //             'jenis'=>$datas->jenis,
    //             'role'=>$datas->role,
    //             'harga'=>$datas->harga,
    //             'deskripsi'=>$datas->deskripsi,
    //             'validateEmail'=>$datas->validateEmail,
    //         ]);
    //     }
    //     return response()->json(['data'=>$produk]);
    // }
    // public function cari($id)
    // {
    //     if (is_numeric($id)) {
    //         $show = Produk::where('idProduk',$id)->get();
    //         if ($show==null) {
    //             return "data tidak ditemukan";
    //         } else {
    //             $produk = [];
    //             foreach ($show as $datas) {
    //                 array_push($produk,[
    //                     'idProduk'=>$datas->idProduk,
    //                     'gambar'=>url($datas->gambar),
    //                     'jenis'=>$datas->jenis,
    //                     'role'=>$datas->role,
    //                     'harga'=>$datas->harga,
    //                     'deskripsi'=>$datas->deskripsi,
    //                     'validateEmail'=>$datas->validateEmail,
    //                 ]);
    //             }
    //             return response()->json(['data'=>$produk]);
    //         }
    //     } else {
    //         $show = Produk::where('namaProduk','LIKE','%'.$id.'%')->get();
    //         if($show->isEmpty()){
    //             return "data tidak ditemukan";
    //         } else {
    //             $produk = [];
    //             foreach ($show as $datas) {
    //                 array_push($produk,[
    //                     'idProduk'=>$datas->idProduk,
    //                     'gambar'=>url($datas->gambar),
    //                     'jenis'=>$datas->jenis,
    //                     'role'=>$datas->role,
    //                     'harga'=>$datas->harga,
    //                     'deskripsi'=>$datas->deskripsi,
    //                     'validateEmail'=>$datas->validateEmail,
    //                 ]);
    //             }
    //             return response()->json(['data'=>$produk]);
    //         }
    //     } 
    // }
}
