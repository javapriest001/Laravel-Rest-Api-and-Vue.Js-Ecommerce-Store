<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;

class userController extends Controller
{
    //get Active Products
    public function getActiveProducts(): \Illuminate\Http\JsonResponse
    {
        $products = product::where('status' , 1)->get();

        if ($products) {
            return response()->json(['status'=> 'ok' , $products] , 200);
        }
        return response()->json(['status'=> 'error fetching Record' ] , 401);
    }



    public function deleteProduct($id){

        $product = product::find($id);
        if($product){
            $product->delete();
            return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'product Already Deleted or Does not Exist']);
    }
}
