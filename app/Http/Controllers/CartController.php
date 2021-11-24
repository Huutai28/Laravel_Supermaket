<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    public function addCart (Request $request)
    {
        $id = $request->id;
        $quantity = $request->quantity;
        dd($id.''.$quantity);
    }
}
