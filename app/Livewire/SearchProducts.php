<?php

namespace App\Livewire;

use Livewire\Component;
use Meilisearch\Client;
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
    
        // Make a search query to Meilisearch
        $client = new \MeiliSearch\Client('http://127.0.0.1:7700', 'j5p2QgHby2qvJztjeoCNyjl4kifyGwvSzexrTQsCio0');
        $index = $client->index('products'); // Make sure 'products' is the index name
        $results = $index->search($this->query, [
            'limit' => 4, // Limit the number of results to 10
        ]);
    
        // Accessing the 'hits' property from the search result
        $this->products = $results->getHits(); // Correct way to get the hits
    }

    public function render()
    {
        return view('livewire.product-search');
    }
}
