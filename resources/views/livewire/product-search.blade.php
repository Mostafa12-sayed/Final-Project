<div class="relative max-w-md mx-auto" style="z-index: 100000; margin-left: 25px !important; border-radius: 10px; ">
    <!-- Search input field -->
    <input 
        type="text" 
        wire:model="query" 
        class="form-control w-full" 
        placeholder="Search for products..." 
        wire:keydown="searchProducts" 
        autocomplete="off"
    />

    <!-- Dropdown list of search results -->
    
    <div class="absolute top-full left-0 right-0 w-full max-w-md" style="z-index: 100000;   position: absolute; width:inherit; max-width: inherit;">
    @if(strlen($query) > 0 && count($products) > 0)
         <ul class="absolute  mt-1 bg-white border border-gray-300 rounded shadow-lg z-50">
             @foreach($products as $product)
             <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer dropdown-item w-full">
                 <a href="{{ route('product.show', $product['slug']) }}">
                     {{ $product['name'] }} -> {{ $product['category_name'] }}
                    </a>
                </li>
                @endforeach
            </ul>
            @elseif(strlen($query) > 0 && count($products) === 0)
            <ul class="absolute  mt-1 bg-white border border-gray-300 rounded shadow-lg z-50">
             <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer dropdown-item w-full">
                 No products was found for "{{ $query }}" in any category
                </li>
            </ul>
             
            @endif
    </div>
</div>
