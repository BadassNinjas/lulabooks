<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Base\Controller;
use BadassNinjas\Helpers\Response;
use ShopKit\Product\Models\ProductCategory;

class ProductCategoryController extends Controller
{
    public function getCategories($categoryId = null)
    {
        if (is_null($categoryId)) {
            return Response::build(ProductCategory::where('parent_id', '0')->orderBy('sort_order', 'ASC')->get());
        }

        return Response::build(ProductCategory::find($categoryId));
    }

    public function createOrUpdateCategory($categoryId = null)
    {
        return Response::build(ProductCategory::updateOrCreate(['id' => $categoryId], request()->all()));
    }

    public function deleteCategory($categoryId)
    {
        $category = ProductCategory::find($categoryId);

        $category->delete();

        return Response::build();
    }
}
