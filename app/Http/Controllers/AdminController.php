<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Produk;
use App\Models\Log;
use App\Models\feedback;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showUser()
    {
        $user=User::get();
        return response()->json($user);
    }

    public function showFeedback()
    {
        $feedback=feedback::get();
        return response()->json($feedback);
    }

    public function regis(Request $request)
    {
        $validator = validator::make($request->all(),[
            'username' => 'required',
            'email' => 'required',
            'password' => 'required|min:8',
        ]);
        $user = $validator->validated();
        User::create([
            'username'=>$user['username'],
            'email'=>$user['email'],
            'password'=>$user['password'],
            'role'=>'seller',
        ]);
        // kirim response ke pengguna
        return response()->json(["Berhasil"],200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function userdelete($id)
    {
        User::where('idUsers',$id)->delete();
        Log::create([
            'module'=>'hapus user',
            'action'=>'id '.$id,
            'useraccess'=>'admin'
        ]);

        return response()->json([
            "data"=>[
                'Berhasil di hapus produk id '=>$id
            ],
           
        ],200);
    }
}
