<?php

namespace Modules\Website\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Website\app\Models\Product;
use Modules\Website\app\Models\Category;
use Modules\Website\app\Models\Review;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Product::query();

        // Search Filter
        $query->when(request('search'), function ($q) {
            $q->where('name', 'like', '%' . request('search') . '%');
        });

        // Category Filter
        $query->when(request('category'), function ($q) {
            $category = Category::where('slug', request('category'))->first();
            if ($category) {
                $q->where('category_id', $category->id);
            }
        });

        // Price Range Filter
        $query->when(request('price_min') || request('price_max'), function ($q) {
            $min = request('price_min', 0);
            $max = request('price_max', 1000);
            $q->whereBetween('price', [$min, $max]);
        });

        // Sales Filters
        $query->when(request('on_sale'), function ($q) {
            $q->where('discount', '>', 0); // Assuming 'on sale' means discounted
        });
        $query->when(request('in_stock'), function ($q) {
            $q->where('stock', '>', 0);
        });
        $query->when(request('out_of_stock'), function ($q) {
            $q->where('stock', 0);
        });
        $query->when(request('discount'), function ($q) {
            $q->where('discount', '>', 0);
        });

        // Ratings Filter
        $query->when(request('rating'), function ($q) {
            $ratings = request('rating', []);
            $q->whereIn('rating', $ratings);
        });

        // Sorting
        $query->when(request('sort'), function ($q) {
            switch (request('sort')) {
                case 'latest':
                    $q->latest();
                    break;
                case 'price_low':
                    $q->orderBy('price', 'asc');
                    break;
                case 'price_high':
                    $q->orderBy('price', 'desc');
                    break;
            }
        });

        // $products = $query->paginate(15);
        $products = $query->paginate(15)->appends(request()->query());
        $categories = Category::where('status', 'active')->get(); // Fetch categories for the sidebar

        return view('website::product.products', compact('products', 'categories'));
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

    public function show($slug)
    {
        $product = Product::with('reviews.user')->where('slug', $slug)->firstOrFail();
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();
        return view('website::product.productdetailes', compact('product', 'relatedProducts'));
    }

    public function storeReview(Request $request, $slug): RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to submit a review.');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $product = Product::where('slug', $slug)->firstOrFail();

        $existingReview = Review::where('user_id', Auth::id())
                           ->where('product_id', $product->id)
                           ->first();

        if ($existingReview) {
            return redirect()->back()->with('error', 'You have already submitted a review for this product.');
        }

        Review::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Review submitted successfully!');
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

    public function showProduct(Product $product)
    {

       return view('website::product.modal', compact('product'));
    }
}
