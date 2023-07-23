<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Exceptions\HttpResponseException;
use Firebase\JWT\JWT;
use App\Models\User;
use App\Models\Store;
use App\Models\Driver;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\Address;
use App\Models\Log;
use Illuminate\Auth\Events\Validated;

use function PHPUnit\Framework\directoryExists;

class AuthController extends Controller
{
     public function register(Request $request)
    {
        $validator = validator::make($request->all(),[
            'name_tmu' => 'required',
            'phone_tmu' => 'required',
            'password' => 'required|min:3',
        ]);
        if ($validator->fails()){
            return messageError($validator->messages()->toArray());
        }
        $valid = $validator->validated();

        $user = User::where('phone_tmu', $valid['phone_tmu'])
                ->where(function ($query) {
                    $query->where('role', 'customer')
                    ->orWhere('role', 'admin');
        })->first();

        if ($user) {
            return response()->json('phone already exist', 403);
        } else {
            User::create([
                'name_tmu' => $valid['name_tmu'],
                'phone_tmu' => $valid['phone_tmu'],
                'password' => $valid['password'],
            ]);
        
            // Buat login
        
            // Kirim response ke pengguna
            return response()->json("Register success", 200);
        }
    }

    public function login(Request $request){
        
        $validator = Validator::make($request->all(),[
            'phone_tmu'=>'required',
            'password'=>'required'
        ]);
        if ($validator->fails()){
            return messageError($validator->messages()->toArray());
        }
        if ((Auth::attempt($validator->validated()))) {
            $store = Store::where('id_tmu', Auth::user()->id_tmu)->first();
            if($store){
                $payload =[
                    'id_tmu'=> Auth::user()->id_tmu,
                    'id_tms'=> $store->id_tms,
                    'phone_tmu'=> Auth::user()->phone_tmu,
                    'role'=>Auth::user()->role,
                    'iat'=> now()->timestamp, // waktu  di buat
                    'exp'=>now()->timestamp + 604800000 // waktu toen kadaluarsa (2 jam setelah token dibuat)
                ];
                $token = JWT::encode($payload,env('JWT_SECRET_KEY'),'HS256');
                Log::create([
                    'module'=>'Login',
                    'action'=>'User do login',
                    'useraccess'=>Auth::user()->id_tmu
                ]);
                return response()->json([
                    "data" => [ 
                        "id_tmu" => Auth::user()->id_tmu,
                        'id_tms'=> $store->id_tms,
                        "phone_tmu" => Auth::user()->phone_tmu,
                        "name_tmu" => Auth::user()->name_tmu,
                        "role" => Auth::user()->role],
    
                    "token"=> "Bearer {$token}"
                ],200);
            }else{
                $payload =[
                    'id_tmu'=> Auth::user()->id_tmu,
                    'phone_tmu'=> Auth::user()->phone_tmu,
                    'role'=>Auth::user()->role,
                    'iat'=> now()->timestamp, // waktu  di buat
                    'exp'=>now()->timestamp + 604800000 // waktu toen kadaluarsa (2 jam setelah token dibuat)
                ];
                $token = JWT::encode($payload,env('JWT_SECRET_KEY'),'HS256');
                Log::create([
                    'module'=>'Login',
                    'action'=>'User do login',
                    'useraccess'=>Auth::user()->id_tmu
                ]);
                return response()->json([
                    "data" => [ 
                        "id_tmu" => Auth::user()->id_tmu,
                        "phone_tmu" => Auth::user()->phone_tmu,
                        "name_tmu" => Auth::user()->name_tmu,
                        "role" => Auth::user()->role],
    
                    "token"=> "Bearer {$token}"
                ],200);
            }

        }
        return response()->json("Phone or password incorrect",422);
    }


    public function registerDriver(Request $request)
    {
        $validator = validator::make($request->all(),[
            'name_tmu' => 'required',
            'phone_tmu' => 'required',
            'password' => 'required|min:3',
        ]);
        if ($validator->fails()){
            return messageError($validator->messages()->toArray());
        }
        $valid = $validator->validated();

        $user = User::where('phone_tmu', $valid['phone_tmu'])
            ->where('role', 'driver')->first();
            

        if ($user) {
            return response()->json('Driver already exist', 403);
        } else {
            User::create([
                'name_tmu' => $valid['name_tmu'],
                'phone_tmu' => $valid['phone_tmu'],
                'password' => $valid['password'],
                'role' => 'driver'
            ]);

            $user = User::where('phone_tmu', $valid['phone_tmu'])
                ->where('role', 'driver')->first();

            Driver::create([
                'id_tmu'=>$user->id_tmu,
            ]);

            $payload =[
                'id_tmu'=> $user->id_tmu,
                'phone_tmu'=> $user->phone_tmu,
                'role'=>"driver",
                'iat'=> now()->timestamp, // waktu  di buat
                'exp'=>now()->timestamp + 604800000 // waktu toen kadaluarsa (2 jam setelah token dibuat)
            ];
            $token = JWT::encode($payload,env('JWT_SECRET_KEY'),'HS256');
            Log::create([
                'module'=>'Driver',
                'action'=>'Driver do Register',
                'useraccess'=>$user->id_tmu
            ]);
            return response()->json([
                "data" => [ 
                    "id_tmu" => $user->id_tmu,
                    "phone_tmu" => $user->phone_tmu,
                    "name_tmu"=>$user->name_tmu,
                    "role" => "driver"],

                "token"=> "Bearer {$token}"
            ],200);

        }

    }
    public function loginDriver(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'phone_tmu'=>'required',
            'password'=>'required'
        ]);
        if ($validator->fails()){
            return messageError($validator->messages()->toArray());
        }
        if (($valid = ($validator->validated()))) {

            $user = User::where('phone_tmu', $valid['phone_tmu'])
                    ->where('role', 'driver')->first();

            $driver = Driver::where('id_tmu', $user->id_tmu)->first();

            if($driver->status_active_account === 0){
                return response()->json("Driver got banned",422);
            }else {

                $payload =[
                    'id_tmu'=> $user->id_tmu,
                    'id_tmd'=> $driver->id_tmd,
                    'phone_tmu'=> $user->phone_tmu,
                    'name_tmu'=> $user->name_tmu,
                    'role'=>"driver",
                    'iat'=> now()->timestamp, // waktu  di buat
                    'exp'=>now()->timestamp + 604800000 // waktu toen kadaluarsa (2 jam setelah token dibuat)
                ];
                $token = JWT::encode($payload,env('JWT_SECRET_KEY'),'HS256');
                Log::create([
                    'module'=>'Login',
                    'action'=>'User do login',
                    'useraccess'=>$user->id_tmu
                ]);
                return response()->json([
                    "data" => [ 
                        "id_tmu" => $user->id_tmu,
                        "id_tmd" => $driver->id_tmd,
                        "phone_tmu" => $user->phone_tmu,
                        "role" => "driver"],
    
                    "token"=> "Bearer {$token}"
                ],200);
            }
        }
        return response()->json("email atau password salah",422);
    }





    
}
