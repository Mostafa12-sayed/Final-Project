<?php

namespace Modules\Website\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Website\app\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Modules\Website\app\Models\Product;
use App\Models\User;

class WishlistController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth'); // Ensure only authenticated users can access these methods
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::find(Auth::id());
        // $wishlistItems = $user->wishlist()->get();
        $wishlistItems = $user->wishlist()->with('product')->get();
        // dd($wishlistItems->toArray());
        return view('website::product.wishlist', compact('wishlistItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('website::create');
    }

    public function add(Request $request, $productId)
    {
        // $user = Auth::user();
        $user = User::find(Auth::id());
        $product = Product::findOrFail($productId);

        if ($user->wishlist()->where('product_id', $product->id)->exists()){
            return redirect()->back()->with('error', 'Product already in wishlist');
        }
        $wishlist = new Wishlist();
        $wishlist->user_id = $user->id;
        $wishlist->product_id = $product->id;
        $wishlist->save();
        return redirect()->back()->with('success', 'Product added to wishlist');
    }

    public function add_ajax(Request $request, $productId)
    {
        // $user = Auth::user();
        $user = User::find(Auth::id());
        $product = Product::findOrFail($productId);

        if ($user->wishlist()->where('product_id', $product->id)->exists()){
            return redirect()->back();
        }
        $wishlist = new Wishlist();
        $wishlist->user_id = $user->id;
        $wishlist->product_id = $product->id;
        $wishlist->save();
        return redirect()->back();
    }

    public function remove($productId){
        $user = User::find(Auth::id());
        $wishlistItem = $user->wishlist()->where('product_id', $productId)->first();

        if ($wishlistItem) {
            $wishlistItem->delete();
            return redirect()->back()->with('success', 'Product removed from wishlist.');
        }

        return redirect()->back()->with('error', 'Product not found in your wishlist.');
    }


    public function remove_ajax($productId){
        $user = User::find(Auth::id());
        $wishlistItem = $user->wishlist()->where('product_id', $productId)->first();

        if ($wishlistItem) {
            $wishlistItem->delete();
            return redirect()->back();
        }

        return redirect()->back();
    }
}
