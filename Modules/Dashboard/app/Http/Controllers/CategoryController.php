<?php

namespace Modules\Dashboard\app\Http\Controllers;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Modules\Dashboard\app\Http\Requests\CategoryRequest;
use Modules\Dashboard\app\Models\Category;

// use Flasher\SweetAlert\Prime\SweetAlertInterface;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(5);

        return view('dashboard::category.category-list', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::select('id', 'name')->get();
        $category = new Category;

        return view('dashboard::category.category-add', compact('categories', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        if ($request->hasFile('image')) {
            $imagePath = FileHelper::uploadImage($request->file('image'), 'category');
        }
        $category = Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'slug' => Str::slug($request->name),
            'parent_id' => $request->parent_id ?? null,
            'image' => $imagePath ?? null,
            'code' => $request->code,
            'created_by' => auth()->guard('admin')->user()->name,
        ]);

        if ($category) {
            flash()->success('Category created successfully.');

            return back();
        } else {
            flash()->success('Category Filed Create.');

            return back();
        }

    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $categories = Category::select('id', 'name')->get();
        $category = Category::findOrFail($id);

        return view('dashboard::category.category-add', compact('categories', 'category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $categories = Category::select('id', 'name')->get();
        $category = Category::findOrFail($id);

        return view('dashboard::category.category-add', compact('categories', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = FileHelper::uploadImage($request->file('image'), 'category');
        }
        $category->update([
            'name' => $request->name,
            'description' => $request->description,
            'slug' => Str::slug($request->name),
            'parent_id' => $request->parent_id,
            'image' => $imagePath ? $imagePath : $category->image,
            'code' => $request->code,
        ]);
        if ($category) {
            flash()->success('Category updated successfully.');

            return back();
        } else {
            flash()->success('Category Filed Update.');

            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($category->image) {
            FileHelper::deleteImage($category->image);
        }
        $category->delete();
        flash()->success('Category deleted successfully.');

        return back();
    }
}
