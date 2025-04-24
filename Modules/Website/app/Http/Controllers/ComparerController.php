<?php

namespace Modules\Website\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Website\app\Models\Product;

class ComparerController extends Controller
{
    public function add(Request $request, Product $product)
    {
        $compare = session()->get('compare', []);

        // Check if product already exists in compare
        if (! in_array($product->id, $compare)) {
            // Limit to 4 products max
            if (count($compare) >= 3) {
                return response()->json([
                    'success' => false,
                    'message' => 'You can compare maximum 3 products',
                ]);
            }

            $compare[] = $product->id;
            session()->put('compare', $compare);

            return response()->json([
                'success' => true,
                'message' => 'Product added to compare',
                'compare_count' => count($compare),
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Product already in compare list',
        ]);
    }

    public function index()
    {
        $compareIds = session()->get('compare', []);
        $products = Product::whereIn('id', $compareIds)->get();

        return view('website::compare', compact('products'));
    }

    public function remove(Product $product)
    {
        $compare = session()->get('compare', []);

        if (($key = array_search($product->id, $compare)) !== false) {
            unset($compare[$key]);
            session()->put('compare', $compare);

            return response()->json([
                'success' => true,
                'message' => 'Product removed from compare',
                'compare_count' => count($compare),
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Product not found in compare list',
        ]);
    }
}
