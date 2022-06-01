<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductCollection;
use App\Models\ProductsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    //

    public function index(Request $request)
    {
        $size = $request->get('size', 10);
        if (Auth::user()->can(PERMISSION_PRODUCT_VIEW)) {

            $listCate = ProductsModel::paginate($size);

            $data = new ProductCollection($listCate);
            return response()->json($data);
        } else {
            return response()->json(['message' => 'You are not authorized!'], 419);
        }
    }

    public function store(Request $request)
    {
        if (Auth::user()->can(PERMISSION_PRODUCT_CATE_ADD)) {
            $this->validate($request, [
                'name' => 'required',
                'categoryId' => 'required',
            ]);

            $id = $request->get('id', null);
            $name = $request->get('name');
            $categoryId = $request->get('categoryId');
            $slug = $request->get('slug', create_slug($name));
            $status = $request->get('status', 1);

            $image = $request->get('image', '');
            $imageDetail = $request->get('imageDetail', '');
            $describe = $request->get('describe', '');

            ProductsModel::updateOrCreate([
                'id' => $id
            ], [
                'category_id' => $categoryId,
                'name' => $name,
                'slug' => $slug,
                'image' => $image,
                'image_details' => $imageDetail,
                'describe' => $describe,
                'status' => $status
            ]);
            return response()->json(['message' => 'thành công'], 200);
        } else {
            return response()->json(['message' => 'You are not authorized!'], 419);
        }
    }
}
