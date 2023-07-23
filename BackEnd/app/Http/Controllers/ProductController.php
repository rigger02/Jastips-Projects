<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    public function get_all_product(){
        $datas = Product::select('*')->get();
        $products = [];
            foreach ($datas as $data) {
                array_push($products,[
                    'id_ttps'=>$data->id_ttps,
                    'name_ttps'=>$data->name_ttps,
                    'image_ttps'=>url($data->image_ttps),
                    'price_ttps'=>$data->price_ttps,
                    'status_ttps'=>$data->status_ttps,
                    'id_tms'=>$data->id_tms,

                ]);
            }
            return response()->json(['data'=>$products]);
    }

    public function product_by_store($id){
        $datas = Product::where('id_tms', $id)
                ->where('status_ttps','publish')
                ->get();
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
    
    public function getOrderDetails($transaction)
    {
        $result = DB::table('tbl_t_order_purchase as ttop')
            ->join('tbl_t_product_store as ttps', 'ttps.id_ttps', '=', 'ttop.id_ttps')
            ->join('tbl_m_store as tms', 'tms.id_tms', '=', 'ttps.id_tms')
            ->join('tbl_t_customer_address as ttca', 'ttca.id_ttca', '=', 'ttop.id_ttca')
            ->select(
                DB::raw("DATE_FORMAT(ttop.updated_at, '%d %M %Y') AS date"),
                DB::raw("DATE_FORMAT(ttop.updated_at, '%H:%i') AS time"),
                'ttca.phone_ttca',
                'ttop.status_ttop',
                'tms.name_tms',
                'tms.address_tms',
                'ttca.name_ttca',
                'ttca.static_ttca',
                'ttca.dynamic_ttca',
                'ttps.name_ttps',
                'ttps.price_ttps',
                'ttop.qty_ttop',
                'ttop.transaction_ttop'
            )
            ->where('ttop.transaction_ttop', $transaction)
            ->get();

        return response()->json($result);
    }
}
