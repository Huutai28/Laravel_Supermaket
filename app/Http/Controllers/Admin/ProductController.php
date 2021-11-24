<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Product\AddRequest;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    //
    public function list ()
    {
        $data['prodlist'] = DB::table('products')
                            ->join('categories','products.prod_cate','=','categories.cate_id')
                            ->get();
        return view('admin.list_product', $data);
    }
    public function createForm ()
    {
        $data['catelist'] = Category::all();
        return view('admin.add_product', $data);
    }
    public function create (AddRequest $request)
    {
        $slug = Str::slug($request->name, '-');
        $filename = $request->image->getClientOriginalName();

        $product = new Product;
        $product->prod_name = $request->name;
        $product->prod_slug = $slug;
        $product->prod_image = $filename;
        $product->prod_price = $request->price;
        $product->prod_mass = $request->mass;
        $product->prod_description = $request->description;
        $product->prod_cate = $request->category;

        $product->save();

        $request->image->storeAs('upload',$filename);
        return back();
    }

public function editForm ($id)
{   $data['catelist'] = Category::all();
    $data['product'] = Product::find($id);
    return view('admin.edit_product', $data);
}
public function edit (Request $request,$id)
{
    $slug = Str::slug($request->name, '-');
    $product = new Product;

    $arr['prod_name'] = $request->name;
    $arr['prod_slug'] = $slug;
    $arr['prod_mass'] = $request->mass;
    $arr['prod_price'] = $request->price;
    $arr['prod_cate'] = $request->category;
    $arr['prod_description'] = $request->description;

    if ($request->hasFile('image'))
    {
        $filename = $request->image->getClientOriginalName();
        $arr['prod_image'] = $filename;
        $request->image->storeAs('upload',$filename);
    }

    $product::Where('prod_id',$id)->update($arr);
    return redirect('admin/product');
}
public function delete ($id)
{
        Product::destroy($id);
        return back();
}
}
