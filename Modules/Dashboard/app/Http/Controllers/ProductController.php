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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products= Product::with('category:id,name')->paginate(2);
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
        $firstimage =null;
        DB::beginTransaction();
        try{

            if( $request->file('image')) {
                $firstimage = FileHelper::uploadImage($request->file('image'), 'products');
            }
            if( $request->file('images')) {
                foreach ($request->file('images') as $image) {
                    $images[] = FileHelper::uploadImage($image, 'products');
                }
            }
            $product = Product::create([

                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'weight' => $request->wight,
                'tax' => $request->tax,
                'discount' => $request->discount,
                'code'=> $request->code,
                'quantity' => $request->quantity,
                'category_id' => $request->category_id,
                'image' => $firstimage,
                'gallery' => json_encode($images),
                'slug'=> Str::slug($request->name),
            ]);

                if( $product) {
                    DB::commit();
                    flash()->success('Product created successfully.');
                    return back();
                } else {
                    $this->rollbakeImage($firstimage , $images);

                    flash()->error('Product Filed create');
                    return back();
                }
        }catch (\Exception $e) {
            DB::rollback();
            $this->rollbakeImage($firstimage , $images);
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
    public function update(Request $request,Product $product)
    {
         $images = [];
         $firstimage =null;
         DB::beginTransaction();
         try{
             if( $request->file('image')) {
                 $firstimage = FileHelper::uploadImage($request->file('image'), 'products');
             }
             if( $request->file('images')) {
                 foreach ($request->file('images') as $image) {
                     $images[] = FileHelper::uploadImage($image, 'products');
                 }
             }
             $product->name = $request->name;
             $product->description = $request->description;
             $product->price = $request->price;
             $product->weight = $request->weight;
             $product->tax = $request->tax;
             $product->discount = $request->discount;
             $product->code = $request->code;
             $product->quantity = $request->quantity;
             $product->category_id = $request->category_id;
             if( $firstimage) {
                 $product->image = $firstimage;
             }
             if( $images) {
                 $product->gallery = json_encode($images);
             }
             $product->slug = Str::slug($request->name);
             $product->save();
             if( $product) {
                 DB::commit();
                 flash()->success('Product updated successfully.');
                 return back();
             } else {
                 $this->rollbakeImage($firstimage , $images);
                 flash()->error('Product Filed update');
                 return back();
             }
         }catch (\Exception $e) {
             DB::rollback();
             $this->rollbakeImage($firstimage , $images);
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


    public function rollbakeImage($firstimage , $images){
        if (isset($firstimage)) {
            // Delete the main image
            Storage::disk('public')->delete($firstimage);
        }
        foreach ($images as $imagePath) {
            // Delete each gallery image
            Storage::disk('public')->delete($imagePath);
        }
    }
}
