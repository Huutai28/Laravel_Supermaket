<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ClientController extends Controller
{
    //
    public function index ()
    {
        $data['news'] = Product::orderBy('prod_id','desc')->take(4)->get();
        return view('index',$data);
    }

    public function productPage ($id)
    {
        $data['products'] = Product::where('prod_cate',$id)->orderBy('prod_id','desc')->get();
        $data['cate'] = Category::find($id);
        return view('products',$data);
    }

    public function singlePage ($id)
    {
        $data['prod'] = Product::find($id);
        return view('single',$data);
    }
    public function search (Request $request)
    {
        $result = $request->result;
        $data['keyword'] = $result;
        $result = str_replace(' ','%', $result);
        $data['items'] = Product::where('prod_name','like','%'.$result.'%')->get();
        return view('search',$data);
    }

    public function checkoutPage ()
    {
        return view('checkout');
    }
}
