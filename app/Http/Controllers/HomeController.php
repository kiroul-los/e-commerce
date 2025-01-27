<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class HomeController extends Controller
{
    public function redirect(){
        $usertype=Auth::user()->usertype;
        if ($usertype == 1) {
            // Admin logic
            return view('admin.home');
//            return 'hello admin';
        }

      else{
          $products = Product::all();
          return view('home.userpage', compact('products'));
      }
    }

    public function index(){
        $products = Product::all();
        return view('home.userpage', compact('products'));
    }

    public function showProductDetails($id){
        $product=Product::find($id);
        return view('home.uproductdetails',compact('product'));
     }
    }
