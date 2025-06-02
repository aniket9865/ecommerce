<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductRating;
use App\Models\SubCategory;
use Dotenv\Validator;
use Illuminate\Http\Request;

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
        $product = Product::where('slug', $slug)->with('image')->first();

        // Fetch related products or whatever logic you use to get products
        $products = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4) // Limit number of related products
            ->get();

        // Return the view with both the product and the related products
        return view('front.product', compact('product', 'products'));
    }

//
//
//    public function saveRating(Request $request, $productId)
//    {
//        // Validate the form data
//        $validated = $request->validate([
//            'username' => 'required|string|max:255',
//            'email' => 'required|email',
//            'rating' => 'required|numeric|min:1|max:5',
//            'comment' => 'nullable|string|max:1000',
//        ]);
//
//        // Log to check if validation passes
//        \Log::info('Validation passed', $validated);
//
//        // Save the rating
//        ProductRating::create([
//            'product_id' => $productId,
//            'username' => $request->input('username'),
//            'email' => $request->input('email'),
//            'rating' => $request->input('rating'),
//            'comment' => $request->input('comment'),
//            'status' => 0, // Default status for review, can be moderated later
//        ]);
//
//        return response()->json(['success' => 'Thank you for your feedback!']);
//    }
//
//    public function showProduct($id)
//    {
//        // Find the product by its ID
//        $product = Product::findOrFail($id);
//
//        // Retrieve ratings for the product
//        $ratings = ProductRating::where('product_id', $id)->get();
//
//        // Calculate the average rating, default to 0 if there are no ratings
//        $averageRating = $ratings->isEmpty() ? 0 : $ratings->avg('rating');
//
//        // Log the values to ensure they're correct
//        \Log::info('Product:', ['id' => $id, 'averageRating' => $averageRating, 'ratingsCount' => $ratings->count()]);
//
//        // Return the view with the product and its ratings
//        return view('product.show', compact('product', 'ratings', 'averageRating'));
//    }



}
