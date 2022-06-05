<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\product;
use App\Models\wishlist;

use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
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
        $token = $register->createToken('token')->plainTextToken;
        if ($register) {
            return response()->json(['message'=> 'success' , 'user' => $register , 'token'=>$token]);
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
            $token = $user->createToken('token')->plainTextToken;
            if($user->role === 1){
              return  response()->json(['message'=>'Admin Details' , 'data' => $user , 'token' => $token ]);
            }

            return response()->json(['message'=>'User Details' , 'data' => $user , 'token' => $token]);
        }
        return response()->json(['message'=>'Incorrect Details']);
        //return Response()->json(['message' => 'Incorrect Details']);
    }

    //Return products unique to logged in user
    public function getUserProducts($id){
        $products = product::where('user_id', $id)->get();
        if ($products){
            return response()->json(['message'=>'products Details' , 'data' => $products]);
        }
        return response()->json(['message'=>'products not Fount']);

    }
    public function getWishlist($id) {
        $wishlist = wishlist::where('user_id', $id)->get();
            if($wishlist){
                return response()->json(['message'=>'wishlist' , 'data' => $wishlist]);
            }
        return response()->json(['message'=>'no wishlist']);
    }

    public function addWishlist(request $request , $id){
        $wishlist = wishlist::find($id);
    }
    //Get Products
    public function getProducts(){
        $products = product::all();

        if ($products) {
            return response()->json(['status'=> 'ok' ,  'data' => $products] , 200);
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
            return response()->json(['message' => 'Unsuccessful']);
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
            return response()->json(['message' => 'Unsuccessful']);
        }

    }
    //Add To wishlist

    public function addNewWishlist($id , $userID){
        //Getting the single product details
        $products = product::where('id' , $id)->first();
       //  Checking If a user has already added the selected product
        $wishlist =  DB::table('wishlists')
            ->where('user_id' , $userID)
            ->where('id' , $id)
            ->get();
        //


        if($wishlist->count() === 1){
            $list= wishlist::find($id);
            if($list->delete()){
                return response()->json(['message' => 'Wishlist Deleted successfully']);
            }

        }
        // Add the product to the database
        $add = wishlist::create([
            'user_id' => $userID,
            'name' => $products->name,
            'desc' => $products->desc,
            'slug' => $products->slug,
            'price' => $products->price,
            'sale_price' => $products->sale_price,
            'product_img' => $products->product_img,
            'category_id' => $products->category_id,

        ]);
        //check
        if($add){
            return response()->json(['message' => 'success', 'data' => $add]);
        }
        return response()->json(['message' => 'failed']);
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

    public function logout(){
        auth()->user()->tokens()->delete();
        return response()->json(['status' => 'Logged Out']);
    }
}

//public function
