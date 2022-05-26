<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCategory\ProductCategoryCollection;
use App\Models\ProductCategoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductCategoryController extends Controller
{
    //

    public function index(Request $request)
    {
        $size = $request->get('size', 10);
        if (Auth::user()->can(PERMISSION_PRODUCT_CATE_VIEW)) {

            $listCate = ProductCategoryModel::paginate($size);

            $data = new ProductCategoryCollection($listCate);
            return response()->json($data);
        } else {
            return response()->json('You are not authorized!', 419);
        }
    }

    public function store(Request $request)
    {
        if (Auth::user()->can(PERMISSION_PRODUCT_CATE_ADD)) {
            $this->validate($request, [
                'name' => 'required',
            ]);

            $id = $request->get('id', null);
            $name = $request->get('name');
            $slug = create_slug($name);
            $status = $request->get('status', 1);

            $image = $request->get('image', '');

            ProductCategoryModel::updateOrCreate([
                'id' => $id
            ], [
                'name' => $name,
                'slug' => $slug,
                'image' => $image,
                'status' => $status
            ]);
            return response()->json(['message' => 'thành công'], 200);
        } else {
            return response()->json(['message' => 'You are not authorized!'], 419);
        }
    }
}
