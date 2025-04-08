<?php

namespace Modules\Website\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Website\app\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $products = Product::where('status', 'active')->paginate(9);
        $products = Product::query()
        ->when(request('search'), function ($query) {
            $query->where('name', 'like', '%' . request('search') . '%');
        })
        ->when(request('sort'), function ($query) {
            switch (request('sort')) {
                case 'latest':
                    $query->latest();
                    break;
                case 'price_low':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_high':
                    $query->orderBy('price', 'desc');
                    break;
            }
        })
        ->paginate(15); // 10 items per page
        return view('website::product.products', compact('products'));
        // return view('website::index');
    }
    public function getProductDetails(Request $request): \Illuminate\Http\JsonResponse
    {
        // Validate the request
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        // Find the product
        $product = Product::findOrFail($request->product_id);

        // Format the response data
        $productData = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'discount' => $product->discount,
            'final_price' => $product->discount ? $product->price - $product->discount : $product->price,
            'rating' => $product->rating,
            'review_count' => rand(1, 30), // This should be replaced with actual review count from your database
            'brand' => $product->brand,
            'category' => $product->category ? $product->category->name : 'Uncategorized',
            'stock' => $product->stock > 0 ? 'Available' : 'Out of Stock',
            'code' => $product->code,
            // 'image' => $product->image,
            'image' => !empty($product->gallery) ? asset($product->gallery[0]) : asset('assets/img/product/01.png'),
        ];

        return response()->json([
            'success' => true,
            'product' => $productData
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('website::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {

    }

    /**
     * Show the specified resource.
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $relatedProducts = Product::where('category_id', $product->category_id)
                                ->where('id', '!=', $product->id)
                                ->limit(4)
                                ->get();
        return view('website::product.productdetailes', compact('product', 'relatedProducts'));
    }

    public function edit($id)
    {
        return view('website::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
