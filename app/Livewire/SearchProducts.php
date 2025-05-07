<?php

namespace App\Livewire;

use Livewire\Component;
use Modules\Website\app\Models\Product;

class SearchProducts extends Component
{
    public $query = ''; // The search query

    public $products = []; // The search results

    protected $listeners = ['searchUpdated' => 'updateSearchResults'];

    public function updateSearchResults($query)
    {
        $this->query = $query;
        $this->searchProducts();
    }

    public function searchProducts()
    {
        if (empty($this->query)) {
            $this->products = [];

            return;
        }

        // Step 1: Search using Scout
        $scoutResults = Product::search($this->query)->get();

        // Step 2: Get active products with relationships
        $productsWithRelations = Product::with(['store', 'category'])
            ->whereIn('id', $scoutResults->pluck('id'))
            ->where('status', 'active')->limit(6)
            ->get()
            ->keyBy('id');

        // Convert to array format
        $this->products = $productsWithRelations->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'image' => $product->image,
                'category_name' => $product->category ? $product->category->name : null,
                'store' => $product->store ? [
                    'store_id' => $product->store->id,
                    'name' => $product->store->name,
                ] : null,
            ];
        })->values()->toArray();
    }

    public function render()
    {
        return view('livewire.product-search');
    }
}
