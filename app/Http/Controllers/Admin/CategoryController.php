<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\Category\AddRequest;
use App\Http\Requests\Category\EditRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    //
    public function list ()
    {
        $data['catelist'] = Category::all();
        return view('admin.list_category', $data);
    }

    public function createForm () {
        return view('admin.add_category');
    }

    public function create (AddRequest $request) {
        $slug = Str::slug($request->name, '-');

        $category = new Category;
        $category->cate_name = $request->name;
        $category->cate_description = $request->description;
        $category->cate_slug = $slug;

        $category->save();
        return redirect()->back();
    }
    public function editForm ($id) {
        $data['cate'] = Category::find($id);
        return view('admin.edit_category', $data);
    }
    public function edit (EditRequest $request, $id)
    {
        $slug = Str::slug($request->name, '-');

        $category = Category::find($id);
        $category->cate_name = $request->name;
        $category->cate_description = $request->description;
        $category->cate_slug = $slug;
        $category->save();
        return redirect()->intended('admin/category');
    }
    public function delete($id){
        Category::destroy($id);
        return back();
    }
}
