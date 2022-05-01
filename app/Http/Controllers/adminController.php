<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\product;

use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class adminController extends Controller
{
    //

    //Register New User

    public function register(Request $request ){

        $request->validate([

            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        $register = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        if ($register) {
            return response()->json(['message'=> 'success']);
        }
        return response()->json(['message'=>'error']);
    }

    //login New User

    public function login(Request $request ){


        $user = User::where('email' , $request->email)->first();

        if (!$user) {
            return response()->json(['message'=> 'User Not Found']);
        }
        if (Hash::check($request->password , $user->password )) {
            if($user->role === 1){
              return  response()->json(['message'=>'Admin Details' , $user]);
            }
            return response()->json(['message'=>'User Details' , $user]);
        }
        return response()->json(['message'=>'Incorrect Details']);
        //return Response()->json(['message' => 'Incorrect Details']);
    }

    //Get Products
    public function getProducts(){
        $products = product::all();

        if ($products) {
            return response()->json(['status'=> 'ok' , $products] , 200);
        }
        return response()->json(['status'=> 'error fetching Records' ] , 401);
    }

    //Activate Product
    public function activateProduct(Request $request){

        //$prod = product::findOrFail();
       $product = product::find($request->productId);
        if ($product) {
            $product->status = 1;
            $product->save();
            if($product->save()){
                return response()->json(['message' => 'Successful']);
            }
            return response()->json(['message' => 'Unuccessful']);
        }

    }
    public function deActivateProduct(Request $request){

        //$prod = product::findOrFail();
       $product = product::find($request->productId);
        if ($product) {
            $product->status = 0;
            $product->save();
            if($product->save()){
                return response()->json(['message' => 'Successful']);
            }
            return response()->json(['message' => 'Unuccessful']);
        }

    }

    //delete Products

    public function deleteProduct($id){

        $product = product::find($id);
        if($product){
            $product->delete();
            return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'product Already Deleted or Does not Exist']);
    }

}
