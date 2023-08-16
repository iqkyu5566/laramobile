<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\ProductCategories;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;

class ProductCategoryController extends Controller
{
    public function all(Request $request)
    {
        $id          = $request->input('id');
        $limit       = $request->input('limit');
        $name        = $request->input('id');
        $show_product = $request->input('show_product');

        if ($id) {
            $product = ProductCategories::with('product')->find($id);

            if ($product) {
                return ResponseFormatter::success($product, 'Data produk berhasil diambil');
            } else {
                return ResponseFormatter::error(null, 'Data produk tidak ada', 404);
            }
        }

        $categories = ProductCategories::query();

        if ($name) {
            $categories->where('name', 'like', '%' . $name . '%');
        }

        if ($show_product) {
            $categories->with('product');
        }

        return ResponseFormatter::success(
            $categories->paginate($limit),
            'Data Kategori berhasil diambil'
        );
    }
}
