<?php

namespace Modules\Dashboard\app\Http\Controllers;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Modules\Dashboard\app\Http\Requests\ProductRequest;
use Modules\Dashboard\app\Models\Category;
use Modules\Website\app\Models\Product;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        //        $this->middleware('permission:read-products')->only('index');
        $this->middleware('permission:read-products')->only('index');
        $this->middleware('permission:create-products')->only(['create', 'store']);
        $this->middleware('permission:update-products')->only(['edit', 'update']);
        $this->middleware('permission:delete-products')->only(['destroy']);

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        dd(auth('admin')->user()->hasRole('admin'));
        // Start by checking if the user is a seller
        $query = Product::with('category:id,name');

        if (auth('admin')->user() && auth('admin')->user()->hasRole('Seller')) {
            // Filter products based on store_id if the user is a seller
            $query->where('store_id', auth('admin')->user()->store_id);
        }
        // Now paginate the query
        $products = $query->paginate(10);

        // Return the view with the paginated products
        return view('dashboard::product.product-list', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::select('id', 'name')->get();
        $product = new Product;

        return view('dashboard::product.product-add', compact('categories', 'product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $images = [];
        $firstImage = null;

        DB::beginTransaction();

        try {
            if ($request->hasFile('image')) {
                $firstImage = FileHelper::uploadImage($request->file('image'), 'products');
            }
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $images[] = FileHelper::uploadImage($image, 'products');
                }
            }

            $product = Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'weight' => $request->weight,
                'tax' => $request->tax,
                'discount' => $request->discount,
                'code' => $request->code,
                'stock' => $request->quantity,
                'category_id' => $request->category_id,
                'image' => $firstImage,
                'gallery' => $images,
                'slug' => Str::slug($request->name),
                'store_id' => auth('admin')->user()->hasRole('admin') ? null : auth('admin')->user()->store_id,
                'expiry_date'=> $request->expiry_date,
            ]);

            if ($product) {
                DB::commit();
                flash()->success('Product created successfully.');
            } else {
                $this->rollbackImage($firstImage, $images);
                flash()->error('Failed to create product.');
            }

            return back();

        } catch (\Exception $e) {
            DB::rollBack();
            $this->rollbackImage($firstImage, $images);
            flash()->error('Error: '.$e->getMessage());

            return back();
        }

    }

    /**
     * Show the specified resource.
     */
    public function show(Product $product)
    {
//        $categories = Category::select('id', 'name')->get();

        return view('dashboard::product.product-details', compact( 'product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::select('id', 'name')->get();

        return view('dashboard::product.product-add', compact('categories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $images = [];
        $firstImage = null;

        DB::beginTransaction();

        try {

            if ($request->hasFile('image')) {
                if ($product->image) {
                    FileHelper::deleteImage($product->image);
                }
                $firstImage = FileHelper::uploadImage($request->file('image'), 'products');
            } else {
                $firstImage = $product->image;
            }

            if ($request->hasFile('images')) {
                $oldImages = $product->gallery;
                foreach ($oldImages as $oldImage) {
                    FileHelper::deleteImage($oldImage);
                }

                foreach ($request->file('images') as $image) {
                    $images[] = FileHelper::uploadImage($image, 'products');
                }
            } elseif($product->gallery) {
                $images = $product->gallery;
            }

            $product->update([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'weight' => $request->weight,
                'tax' => $request->tax,
                'discount' => $request->discount,
                'code' => $request->code,
                'stock' => $request->quantity,
                'category_id' => $request->category_id,
                'image' => $firstImage,
                'gallery' => $images,
                'slug' => Str::slug($request->name),
                'expiry_date'=> $request->expiry_date,

            ]);

            DB::commit();
            flash()->success('Product updated successfully.');

            return back();

        } catch (\Exception $e) {
            DB::rollBack();
            $this->rollbackImage($firstImage, $images);
            flash()->error('Error: '.$e->getMessage());

            return back();
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        flash()->success('Product deleted successfully.');

        return back();
    }

    public function rollbackImage($firstimage, $images)
    {
        if (isset($firstimage)) {
            // Delete the main image
            Storage::disk('public')->delete($firstimage);
        }
        foreach ($images as $imagePath) {
            // Delete each gallery image
            Storage::disk('public')->delete($imagePath);
        }
    }

    public function deleteImage(Request $request)
    {

        $productId = $request->input('product_id');
        $imagePath = $request->input('image_path');
        $product = Product::find($productId);
        if (! $product) {
            return response()->json(['success' => false, 'message' => 'Product not found!']);
        }
        $images = json_decode($product->gallery, true);
        if (($key = array_search($imagePath, $images)) !== false) {
            if (Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }
            unset($images[$key]);
            $product->gallery = json_encode(array_values($images));  // تحديث القيمة
            $product->save();

            return response()->json(['success' => true, 'image_id' => $productId]);
        }

        return response()->json(['success' => false, 'message' => 'Image not found in product!']);
    }
}
