

<div class="relative max-w-md mx-auto" style="z-index: 100000; margin-left: 25px !important; border-radius: 10px; ">
    <input 
        type="text" 
        wire:model="query" 
        class="form-control w-full" 
        placeholder="Search for products..." 
        wire:keydown="searchProducts" 
        autocomplete="off"
    />

    <div class="absolute top-full left-0 right-0 w-full max-w-md" style="z-index: 100000; position: absolute; width:inherit; max-width: inherit;">
        @if(strlen($query) > 0 && count($products) > 0)
            <ul class="absolute mt-1 bg-white border border-gray-300 rounded shadow-lg z-50">
            @foreach($products as $product)
    <li class="px-4 py-3 hover:bg-gray-50 cursor-pointer dropdown-item w-full transition-all duration-200 ease-in-out border-b border-gray-100 last:border-b-0">
        <a href="{{ route('product.show', $product['slug']) }}" class="flex items-center space-x-3 text-gray-800 hover:text-blue-600">
            <!-- Optional: Thumbnail Image (if available in $product) -->
             <div class="d-flex">
                @if(isset($product['image']) && $product['image'])
                <div>
                    <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}" class="w-12 h-12 rounded-md" style="width:30px;">
                </div>
                @endif
                <!-- Product Details -->
                <div class="flex-1">
                    <span class="block font-medium text-sm">{{ $product['name'] }}</span>
                    <span class="block text-xs text-gray-500">
                        {{ $product['category_name'] ?? 'No Category' }} 
                        @if(isset($product['store']['name']) && $product['store']['name'])
                            ({{ $product['store']['name'] }})
                        @endif
                    </span>
                </div>
            </div> 
        </a>
    </li>
@endforeach
            </ul>
        @elseif(strlen($query) > 0 && count($products) === 0)
            <ul class="absolute mt-1 bg-white border border-gray-300 rounded shadow-lg z-50">
                <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer dropdown-item w-full">
                    No products was found for "{{ $query }}" in any category
                </li>
            </ul>
        @endif
    </div>
</div>

