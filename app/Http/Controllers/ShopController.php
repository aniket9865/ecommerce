<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductRating;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ShopController extends Controller
{

    public function index(Request $request, $categorySlug = null, $subCategorySlug = null)
    {
        $selectedCategorySlug = $categorySlug;
        $selectedSubCategorySlug = $subCategorySlug;
        $brandsArray = [];

        // Retrieve categories with subcategories and brands
        $categories = Category::orderBy('name', 'ASC')->with('sub_category')->where('status', 1)->get();
        $brands = Brand::orderBy('name', 'ASC')->where('status', 1)->get();

        // Initialize products query
        $productsQuery = Product::where('status', 1);

        // Apply category filter
        if (!empty($selectedCategorySlug)) {
            $category = Category::where('slug', $selectedCategorySlug)->first();
            if ($category) {
                $productsQuery->where('category_id', $category->id);
            }
        }

        // Apply subcategory filter
        if (!empty($selectedSubCategorySlug)) {
            $subCategory = SubCategory::where('slug', $selectedSubCategorySlug)->first();
            if ($subCategory) {
                $productsQuery->where('sub_category_id', $subCategory->id);
            }
        }

        // Apply brand filters
        if (!empty($request->get('brand'))) {
            $brandsArray = explode(',', $request->get('brand'));
            $productsQuery->whereIn('brand_id', $brandsArray);
        }

        // Apply search filter
        if (!empty($request->get('search'))) {
            $search = $request->get('search');
            $productsQuery->where('title', 'like', "%{$search}%");
        }

        // Retrieve products with pagination
        $products = $productsQuery->orderBy('id', 'DESC')->paginate(12); // Adjust the number of items per page as needed

        // Pass data to the view
        $data = [
            'categories' => $categories,
            'brands' => $brands,
            'products' => $products,
            'categorySelected' => $selectedCategorySlug,
            'subCategorySelected' => $selectedSubCategorySlug,
            'brandsArray' => $brandsArray,
        ];

        return view('front.shop', $data);
    }


    public function product($slug)
    {
        // Fetch the product using the slug
        $product = Product::where('slug', $slug)
            ->withCount('product_ratings')
            ->withSum('product_ratings','rating')
            ->with('image','product_ratings')->first();


 if($product == null){
     abort(404);
 }

        // Fetch related products or whatever logic you use to get products
        $products = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4) // Limit number of related products
            ->get();

        // Return the view with both the product and the related products
        return view('front.product', compact('product', 'products'));
    }

    public function saveRating($id, Request $request)
    {
        if (!auth()->check()) {
            return response()->json([
                'status' => false,
                'message' => 'You must be logged in to submit a review.'
            ], 403);
        }

        $validate = Validator::make($request->all(), [
            'name' => 'required|min:5',
            'email' => 'required|email',
            'comment' => 'required|min:6',
            'rating' => 'required'
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validate->errors()
            ]);
        }

        $alreadyRated = ProductRating::where('email', $request->email)
            ->where('product_id', $id)
            ->count();

        if ($alreadyRated > 2) {
            return response()->json([
                'status' => true,
                'message' => 'You already rated this product.'
            ]);
        }

        ProductRating::create([
            'product_id' => $id,
            'username'   => $request->name,
            'email'      => $request->email,
            'comment'    => $request->comment,
            'rating'     => $request->rating,
            'status'     => 0
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Thank you for your review!'
        ]);
    }
    public function getProductRatings($id)
    {
        $ratings = ProductRating::where('product_id', $id)
            ->orderBy('created_at', 'desc')
            ->paginate(5); // pagination

        $average = ProductRating::where('product_id', $id)->avg('rating');
        $total = ProductRating::where('product_id', $id)->count();

        $distribution = ProductRating::where('product_id', $id)
            ->selectRaw('rating, COUNT(*) as count')
            ->groupBy('rating')
            ->pluck('count', 'rating');

        return response()->json([
            'ratings' => $ratings,
            'average' => round($average, 1),
            'total' => $total,
            'distribution' => $distribution
        ]);
    }



}
