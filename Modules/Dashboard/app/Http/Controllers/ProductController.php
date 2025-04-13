<?php

namespace Modules\Dashboard\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Dashboard\app\Models\Category;
use Modules\Website\app\Models\Product;
use Modules\Dashboard\app\Http\Requests\ProductRequest;
use App\Helpers\FileHelper;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
//        $this->middleware('permission:read-products')->only('index');
        $this->middleware('permission:read-products')->only('index');
        $this->middleware('permission:create-products')->only(['create','store']);
        $this->middleware('permission:update-products')->only(['edit', 'update']);
        $this->middleware('permission:delete-products')->only(['destroy']);



    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products= Product::with('category:id,name')->paginate(10);
        return view('dashboard::product.product-list' ,compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::select('id', 'name')->get();
        $product = new Product();
        return view('dashboard::product.product-add' , compact('categories', 'product'));
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
            // ✅ رفع صورة رئيسية إن وجدت
            if ($request->hasFile('image')) {
                $firstImage = FileHelper::uploadImage($request->file('image'), 'products');
            }

            // ✅ رفع صور المعرض إن وجدت
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $images[] = FileHelper::uploadImage($image, 'products');
                }
            }

            // ✅ إنشاء المنتج
            $product = Product::create([
                'name'         => $request->name,
                'description'  => $request->description,
                'price'        => $request->price,
                'weight'       => $request->weight,
                'tax'          => $request->tax,
                'discount'     => $request->discount,
                'code'         => $request->code,
                'quantity'     => $request->quantity,
                'category_id'  => $request->category_id,
                'image'        => $firstImage,
                'gallery'      => json_encode($images),
                'slug'         => Str::slug($request->name),
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
            flash()->error('Error: ' . $e->getMessage());
            return back();
        }


    }

    /**
     * Show the specified resource.
     */
    public function show(Product $product)
    {
        $categories = Category::select('id', 'name')->get();

        return view('dashboard::product.product-add' , compact('categories', 'product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
      $categories = Category::select('id', 'name')->get();

        return view('dashboard::product.product-add' , compact('categories', 'product'));    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request,Product $product)
    {
        $images = [];
        $firstImage = null;

        DB::beginTransaction();

        try {

            if ($request->hasFile('image')) {
                // حذف الصورة القديمة إذا كانت موجودة
                if ($product->image) {
                    FileHelper::deleteImage($product->image); // تأكد من وجود دالة لحذف الصورة القديمة
                }

                // رفع الصورة الجديدة
                $firstImage = FileHelper::uploadImage($request->file('image'), 'products');
            } else {
                // إذا لم تكن هناك صورة جديدة، استخدم الصورة القديمة
                $firstImage = $product->image;
            }

            // ✅ تحديث صور المعرض إن وجدت
            if ($request->hasFile('images')) {
                // حذف الصور القديمة إذا كانت موجودة
                $oldImages = json_decode($product->gallery, true);
                foreach ($oldImages as $oldImage) {
                    FileHelper::deleteImage($oldImage); // تأكد من وجود دالة لحذف الصور القديمة
                }

                // رفع الصور الجديدة
                foreach ($request->file('images') as $image) {
                    $images[] = FileHelper::uploadImage($image, 'products');
                }
            } else {
                // إذا لم تكن هناك صور جديدة، استخدم الصور القديمة
                $images = json_decode($product->gallery, true);
            }

            // ✅ تحديث المنتج
            $product->update([
                'name'         => $request->name,
                'description'  => $request->description,
                'price'        => $request->price,
                'weight'       => $request->weight,
                'tax'          => $request->tax,
                'discount'     => $request->discount,
                'code'         => $request->code,
                'quantity'     => $request->quantity,
                'category_id'  => $request->category_id,
                'image'        => $firstImage,
                'gallery'      => json_encode($images),
                'slug'         => Str::slug($request->name),
            ]);

            DB::commit();
            flash()->success('Product updated successfully.');

            return back();

        } catch (\Exception $e) {
            DB::rollBack();
            $this->rollbackImage($firstImage, $images);
            flash()->error('Error: ' . $e->getMessage());
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


    public function rollbackImage($firstimage , $images){
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
        if (!$product) {
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
