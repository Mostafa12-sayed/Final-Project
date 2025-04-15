<?php

namespace Modules\Website\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Modules\Website\app\Models\Category;
use Modules\Website\app\Models\ContactUs;
use Modules\Website\app\Models\Product;
use Modules\Website\app\Models\Stores;
use App\Mail\ContactMail;


class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::where('status', 'active')
            ->whereHas('products', function ($query) {
                $query->where('status', 'active');
            })->withCount([
                'products' => function ($query) {
                    $query->where('status', 'active');
                }
            ])->orderBy('products_count', 'desc')
            ->get();

        $categories_products = Category::with('products')->where ('status', 'active')->get();
        
        $products = Product::where('status', 'active') ->inRandomOrder()->take(40)->get();

        $top_rated=$products->sortByDesc('rating')->take(3);

        $on_sale_products= Product::where('status', 'active')->where('discount', '>', 0)->inRandomOrder()->take(15)->orderBy('discount', 'desc')->get();

        $top_products = $products->sortByDesc(function ($product) {
            return $product->trending_items;
        })->take(20);

        $products2= Product::where('status', 'active')->inRandomOrder()->take(20)->get();
        $top_products2 = $products2->sortByDesc(function ($product) {
            return $product->trending_items;
        })->take(20);
        $stores=Stores::paginate(6);
        return view('website::index', compact('categories', 'categories_products', 'top_products', 'on_sale_products', 'top_rated', 'stores','top_products2'));
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
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('website::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
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
    public function stores()
    {
        $stores=Stores::where('status', 'active')->where('is_approved','yes')->get();
        return view('website::stores', compact('stores'));
    }

    public function contact_us(){
        return view('website::contact');
    }
    public function contact_store(Request $request){
        $data=$request->validate([
            'name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:600'],
        ]);
        $new_contact=ContactUs::create($request->all());
        if($new_contact){
            Mail::to('your@email.com')->send(new ContactMail($data));
            return redirect()->back()->with('success', 'Contact us has been sent successfully');
        }else{
            return redirect()->back()->with('error', 'Contact us has not been sent successfully');
        }


    }
}
