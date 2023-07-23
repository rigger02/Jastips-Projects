<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Firebase\JWT\JWT;
use App\Models\User;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\Store;
use App\Models\Driver;
use App\Models\Log;
use App\Models\Address;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function registerStore(Request $request)
    {
        $validator = validator::make($request->all(),[
            'name_tms' => 'required',
            'phone_tms' => 'required',
            'image_tms' => 'mimes:png,jpg,jpeg',
            'address_tms' => 'required',
        ]);

        if ($validator->fails()){
            return messageError($validator->messages()->toArray());
        }

        $thumbnail = $request->file('image_tms');
        $filename = now()->timestamp."_".$request->image_tms->getClientOriginalName();
        $thumbnail->move('uploads',$filename);

        $id_tmu =$request->input('id_tmu');

        $store = Store::where('id_tmu',$id_tmu)->count();
        $user = $validator->validated();
        // return response()->json([$store],200);

        if($store == 1){

            return response()->json(["User has a Store"],402);
            
        }else{

            Store::create([
                'name_tms'=>$user['name_tms'],
                'phone_tms' => $user['phone_tms'],
                'image_tms'=>'uploads/'.$filename,
                'address_tms'=>$user['address_tms'],
                'id_tmu'=>$id_tmu,
            ]);

            log::create([
                'module'=>'Store',
                'action'=>'Register Store',
                'useraccess'=>$id_tmu
            ]);

            return response()->json(["Register Store Success"],200);
            
        }

    }

    public function registerDriver(Request $request)
    {
        $validator = validator::make($request->all(),[
            'name_tmd' => 'required',
            'phone_tmd' => 'required',
            'image_tmd' => 'mimes:png,jpg,jpeg|max:2048',
        ]);

        if ($validator->fails()){
            return messageError($validator->messages()->toArray());
        }

        $thumbnail = $request->file('image_tmd');
        $filename = now()->timestamp."_".$request->image_tmd->getClientOriginalName();
        $thumbnail->move('uploads',$filename);

        $id_tmu =$request->input('id_tmu');

        $driver = Driver::where('id_tmu',$id_tmu)->count();
        $user = $validator->validated();
        // return response()->json([$driver],200);

        if($driver == 1){

            return response()->json(["User already a Driver"],402);
            
        }else{

            Driver::create([
                'name_tmd'=>$user['name_tmd'],
                'phone_tmd' => $user['phone_tmd'],
                'image_tmd'=>'uploads/'.$filename,
                'id_tmu'=>$id_tmu,
            ]);

            log::create([
                'module'=>'Driver',
                'action'=>'Register Driver',
                'useraccess'=>$id_tmu
            ]);

            return response()->json(["Register Driver Success"],200);
            
        }

    }

    public function changeStore(Request $request){
        $id_tmu = $request->input('id_tmu');
        $store = Store::where('id_tmu',$id_tmu)->get();
        

        if($store->count() == 0){
            return response()->json(["You aren't seller"],200);
        }else{
            $update = User::where('id_tmu',$id_tmu)->update(['role'=>'store']);
            $user = User::where('id_tmu',$id_tmu)->get();

            $payload =[
                'id_tmu' => $id_tmu,
                'id_tms' => $store[0]->id_tms,
                'role' => $user[0]->role,
                'iat' => now()->timestamp, // waktu  di buat
                'exp' => now()->timestamp + 7200 // waktu toen kadaluarsa (2 jam setelah token dibuat)
            ];
    
            $token = JWT::encode($payload,env('JWT_SECRET_KEY'),'HS256');
    
            Log::create([
                'module'=>'Store',
                'action'=>'Change User to Store',
                'useraccess'=>$id_tmu
            ]);
    
            return response()->json([
                "data" => [ 
                    'id_tmu' => $id_tmu,
                    'id_tms' => $store[0]->id_tms,
                    'role' => $user[0]->role],
                "token"=> "Bearer {$token}"
            ],200);    
        }
    }


    public function getStore()
    {
        $datas = Store::select('*')
                ->where('status_tms', '=', 'open')
                ->get();
        $store = [];
                foreach ($datas as $data) {
                $imageUrl = url($data->image_tms);
                $data->image_tms = $imageUrl;
                    array_push($store,$data);
                }
                return response()->json(['data'=>$store]);

    }

    public function productByStore($id){ 
        $datas = Product::where('id_tms', $id)
                ->where('status_ttps','publish')
                ->get();
        $products=[]; 
        foreach ($datas as $data) {
            $imageUrl = url($data->image_ttps);
                $data->image_ttps = $imageUrl;
            array_push($products,$data); 
        } 
        return response()->json(['data'=>$products]); 
 
    }

   
    public function showOrder(Request $request)
    {
        $id_tmu = $request->input('id_tmu');

        /**SELECT 
            ttop.id_ttop,
            ttop.status_ttop,
            GROUP_CONCAT(ttps.name_ttps SEPARATOR ', ') name_ttps,
            tms.name_tms,
            tms.phone_tms,
            COUNT(ttop.transaction_ttop) items,
            SUM(ttoc.total_price_ttoc) total_ttop,
            ttop.created_at
        FROM 
            tbl_t_order_purchase ttop
        JOIN 
            tbl_t_order_cart ttoc ON ttoc.id_ttoc = ttop.id_ttoc
        JOIN 
            tbl_t_product_store ttps ON ttps.id_ttps = ttoc.id_ttps
        JOIN 
            tbl_m_store tms ON tms.id_tms = ttps.id_tms
        JOIN 
            tbl_t_customer_address ttca ON ttca.id_ttca = ttop.id_ttca
        WHERE 
            ttca.id_tmu = 1
        GROUP BY 
            ttop.transaction_ttop; */


        $query = DB::table('tbl_t_order_purchase as ttop')
    ->join('tbl_t_product_store as ttps', 'ttps.id_ttps', '=', 'ttop.id_ttps')
    ->join('tbl_m_store as tms', 'tms.id_tms', '=', 'ttps.id_tms')
    ->join('tbl_t_customer_address as ttca', function ($join) use ($id_tmu) {
        $join->on('ttca.id_tmu', '=', DB::raw($id_tmu))
            ->where('ttca.isActive_ttca', '=', DB::raw('1'));
    })
    ->select(
        'ttop.status_ttop',
        'tms.name_tms','tms.image_tms',
        DB::raw('GROUP_CONCAT(ttps.name_ttps SEPARATOR ", ") as product'),
        DB::raw('SUM(ttop.qty_ttop) as quantity'),
        DB::raw('SUM(ttps.price_ttps * ttop.qty_ttop) as price'),
        DB::raw('DATE(ttop.created_at) as date_ttop'),
        DB::raw('DATE_FORMAT(ttop.created_at, "%H:%i") as time_ttop')
    )
    ->where('ttca.id_tmu', '=', $id_tmu)
    ->groupBy('ttop.status_ttop', 'tms.name_tms', 'ttop.transaction_ttop', 'ttop.created_at','image_tms')
    ->get();
        

        $data=[];

        foreach ($query as $key) {
            array_push($data,[
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
    public function orderDetail(Request $request, $id)
    {
        $id_tmu = $request->input('id_tmu');

        /**SELECT 
            ttop.status_ttop,
            ttps.name_ttps,
            ttoc.qty_ttoc,
            ttps.price_ttps,
            ttoc.total_price_ttoc,
            tms.name_tms,
            tms.phone_tms,
            tms.address_tms,
            ttca.name_ttca,
            ttca.static_ttca,
            ttca.dynamic_ttca,
            ttop.transaction_ttop
        FROM 
            tbl_t_order_purchase ttop
        LEFT JOIN 
            tbl_t_order_cart ttoc ON ttoc.id_ttoc = ttop.id_ttoc
        LEFT JOIN 
            tbl_t_product_store ttps ON ttps.id_ttps = ttoc.id_ttps
        LEFT JOIN 
            tbl_m_store tms ON tms.id_tms = ttps.id_tms
        LEFT JOIN 
            tbl_t_customer_address ttca ON ttca.id_ttca = ttop.id_ttca
        WHERE 
            ttop.transaction_ttop = '1685032651_MPwlJg'; */


            $query = DB::table('tbl_t_order_purchase as ttop')
            ->select([
                'ttop.status_ttop',
                'ttps.name_ttps',
                'ttoc.qty_ttoc',
                'ttps.price_ttps',
                'ttoc.total_price_ttoc',
                'tms.name_tms',
                'tms.phone_tms',
                'tms.address_tms',
                'ttca.name_ttca',
                'ttca.static_ttca',
                'ttca.dynamic_ttca',
                'ttop.transaction_ttop',
            ])
            ->leftJoin('tbl_t_order_cart as ttoc', 'ttoc.id_ttoc', '=', 'ttop.id_ttoc')
            ->leftJoin('tbl_t_product_store as ttps', 'ttps.id_ttps', '=', 'ttoc.id_ttps')
            ->leftJoin('tbl_m_store as tms', 'tms.id_tms', '=', 'ttps.id_tms')
            ->leftJoin('tbl_t_customer_address as ttca', 'ttca.id_ttca', '=', 'ttop.id_ttca')
            ->where('ttop.transaction_ttop', $id)
            ->get();
        

        $data=[];

        foreach ($query as $key) {
            array_push($data,$key);
            
        }
        return response()->json(['data'=>$data]);
        
    }

    public function addAddress(Request $request)
    {
        $validator = validator::make($request->all(),[
            'name_ttca' => 'required',
            'phone_ttca' => 'required',
            'static_ttca' => 'required',
            'dynamic_ttca' => ''
        ]);

        if ($validator->fails()){
            return messageError($validator->messages()->toArray());
        }
        
        $id_tmu =$request->input('id_tmu');

        $address = $validator->validated();
        $exAddress = Address::where('id_tmu', $id_tmu)
                ->where('isActive_ttca', 1)->first();
        

        if(!$exAddress){
            Address::create([
                'name_ttca' => $address['name_ttca'],
                'phone_ttca' => $address['phone_ttca'],
                'static_ttca' => $address['static_ttca'],
                'dynamic_ttca' => $address['dynamic_ttca'],
                'isActive_ttca' => 1,
                'id_tmu' => $id_tmu
            ]);
            
            Log::create([
                'module'=>'Address',
                'action'=>"Add Address id: {$id_tmu} to Address",
                'useraccess'=>$id_tmu
            ]);
            return response()->json('Address default berhasil ditambahkan');

        }else {
            Address::create([
                'name_ttca' => $address['name_ttca'],
                'phone_ttca' => $address['phone_ttca'],
                'static_ttca' => $address['static_ttca'],
                'dynamic_ttca' => $address['dynamic_ttca'],
                'id_tmu' => $id_tmu
            ]);
            
            Log::create([
                'module'=>'Address',
                'action'=>"Add Address id: {$id_tmu} to Address",
                'useraccess'=>$id_tmu
            ]);
            return response()->json('Address baru berhasil ditambahkan');

        }
        
    }
    
    public function editAddress(Request $request, $id)
{
    $validator = Validator::make($request->all(), [
        'name_ttca' => 'required',
        'phone_ttca' => 'required',
        'static_ttca' => 'required',
        'dynamic_ttca' => ''
    ]);

    if ($validator->fails()) {
        return messageError($validator->messages()->toArray());
    }

    $id_tmu = $request->input('id_tmu');
    $name_ttca = $request->input('name_ttca');
    $phone_ttca = $request->input('phone_ttca');
    $static_ttca = $request->input('static_ttca');
    $dynamic_ttca = $request->input('dynamic_ttca');

    $affectedRows = DB::table('tbl_t_customer_address')
        ->where('id_tmu', $id_tmu)
        ->where('id_ttca', $id)
        ->update([
            'name_ttca' => $name_ttca,
            'phone_ttca' => $phone_ttca,
            'static_ttca' => $static_ttca,
            'dynamic_ttca' => $dynamic_ttca
        ]);

    if ($affectedRows > 0) {
        // Data berhasil diperbarui
        return response()->json([
            'message' => 'Alamat berhasil diperbarui'
        ]);
    } else {
        // Jika alamat dengan ID yang diberikan tidak ditemukan
        return response()->json([
            'message' => 'Alamat tidak ditemukan'
        ], 404);
    }
}
    
    
    public function getAddressActive(Request $request){
        $id_tmu=$request->input('id_tmu');

        $address = Address::where('id_tmu', $id_tmu)->where('isActive_ttca', 1)->first();
        
        if(!$address){
            return;
        }else {
            
        return response()->json($address);
        }

    }
    
    public function getAddress(Request $request){
        $id_tmu=$request->input('id_tmu');

        $address = Address::where('id_tmu', $id_tmu)->get();
        
        if(!$address){
            return;
        }else {
            
        return response()->json(["data" => $address]);
        }

    }
    
    


     public function addOrder(Request $request)
    {

        /**SELECT *, sum(total_price_ttoc) as total FROM `tbl_t_order_cart`
            WHERE id_tmu = 1 and status_ttoc = 'cart';*/
        $validator = validator::make($request->all(),[
            'product_ttop'=>'required'
            // 'qty_ttop' => 'required',
            // 'description_ttoc' => '',
            // 'id_ttps' => 'required',
            // 'id_tmd' => '',
            // 'id_ttca' => 'required'
        ]);

        $id_tmu=$request->input('id_tmu');
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $rand = substr(str_shuffle($characters), 0, 6);

        $trans = now()->timestamp."_".$rand;
        
        $address = Address::where('id_tmu', $id_tmu)
                    ->where('isActive_ttca', 1)
                    ->first();
        // return response()->json($address->id_ttca,200);
        
        foreach (json_decode($request->product_ttop) as $order) {

            Order::create([
                'qty_ttop' => $order->qty_ttop,
                'description_ttop' => $order->description_ttop,
                'id_ttps' => $order->id_ttps,
                'transaction_ttop'=>$trans,
                'id_ttca' => $address->id_ttca
                // 'id_ttoc'=>$cart->id_ttoc,
                // 'id_ttca'=>$address[0]->id_ttca,
                // 'transaction_ttop'=>$trans
            ]);
            
        }

        return response()->json("Data added to order",200);
    }
    
    
    public function feedback(Request $request)
    {
        $validator = validator::make($request->all(),[
            'feedback' => 'required',
        ]);
        if ($validator->fails()){
            return messageError($validator->messages()->toArray());
        }

        $data=$request->input('email');
        $feedback = $validator->validated();
        feedback::create([
            'feedback' => $feedback['feedback'],
            'validateEmail' => $data
        ]);
        Log::create([
            'module'=>'feedback',
            'action'=>'user do feedback',
            'useraccess'=>$data
        ]);
        return response()->json([
            "data"=> [
                "msg"=>"feedback success"
            ]
        ],200);
    }
    // public function selesai($id)
    // {
    //     $keranjang = Pesanan::where('idPesanan',$id);
    //     $keranjang->update([
    //         'pesananStatus'=>'selesai'
    //     ]);
    //     $pesanan = DB::table('pesanan')
    // ->join('keranjang', 'pesanan.idKeranjang', '=', 'keranjang.idKeranjang')
    // ->where('pesanan.idPesanan', $id)
    // ->get();


    //     foreach ($pesanan as $key) {
    //         Transaksi::create([
    //             'idPesanan'=>$key->idPesanan,
    //             'totalHarga'=>$key->totalHarga
    //         ]);
    //         Log::create([
    //             'module'=>'Transaksi',
    //             'action'=>'Selesai',
    //             'useraccess'=>$key->createBy
    //         ]);
    //         Log::create([
    //             'module'=>'Pesanan',
    //             'action'=>'selesai',
    //             'useraccess'=>$key->createBy
    //         ]);
    //     }
    //     return response()->json(["Berhasil"],200);
    // }

 


    /**SELECT status_ttop, name_ttps, image_ttps, total_price_ttoc, price_ttps, name_tms, phone_tms, address_tms, street_ttca, other_ttca, transaction_ttop, COUNT(transaction_ttop) items, sum(total_price_ttoc)
        FROM tbl_t_order_purchase ttop
        LEFT JOIN tbl_t_order_cart ttoc ON ttoc.id_ttoc = ttop.id_ttoc
        LEFT JOIN tbl_t_product_store ttps ON ttps.id_ttps = ttoc.id_ttps
        LEFT JOIN tbl_m_store tms ON tms.id_tms = ttps.id_tms
        LEFT JOIN tbl_t_customer_address ttca ON ttca.id_ttca = ttop.id_ttca; */


    // public function total($id)
    // {
    //     $data=[];
    //     $result = DB::table('keranjang')
    //     ->join('produk', 'keranjang.idProduk', '=', 'produk.idProduk')
    //     ->where('keranjang.status', 'keranjang')
    //     ->where('keranjang.createBy', 'LIKE','%'.$id.'%')
    //     ->select('produk.namaProduk', 'produk.harga', 'keranjang.jumlahBarang', DB::raw('SUM(keranjang.totalHarga) AS subtotal'))
    //     ->groupBy('produk.namaProduk', 'produk.harga', 'keranjang.jumlahBarang')
    //     ->get();
    //     foreach ($result as $key) {
    //         array_push($data,[
    //             'namaProduk'=>$key->namaProduk,
    //             'harga'=>$key->harga,
    //             'jumlahBarang'=>$key->jumlahBarang,
    //             'subtotal'=>$key->subtotal

    //         ]);
    //     }
    //     return response()->json(['data'=>$data]);
        
    // }
}
