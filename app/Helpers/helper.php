<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\Page;
function getCategories()
{
    return Category::orderBy('name', 'ASC')
        ->with('sub_category')
        ->orderBy('id','DESC')
        ->where('status', 1)
        ->where('showhome','Yes')
        ->get();
}


function getProductImage($productId) {
    // Example of how you might handle this
    $product = Product::find($productId);
    return $product ? $product : null;
}

function staticPage()
{
    $pages = Page::orderBy('name', 'ASC')->get();
    return $pages;
}
