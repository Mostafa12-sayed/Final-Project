@extends('dashboard::layouts.master')
@section('title', 'Sellers Orders')
@section('content')
<div class="page-content">

    <div class="container-xxl">
    {{-- <x-grid-table :columns="$columns" :data="$data" /> --}}

     @component('dashboard::components.gridtable')
          @slot('headers')
               <th style="width: 15%">Selller Name</th>
               <th style="width: 30%">Store Name</th>
               <th style="width: 35%">Store Description</th>
               <th style="text-align: center !important;width: 30%;">Actions</th>
          @endslot

          @slot('data')
               @if (count($sellers)>0)
                    @foreach ($sellers as $item)
                         <tr style="text-align: center !important;">
                              <td style="text-align: right !important;">{{ $item->name }}</td>
                              <td>{{ $item->stores->name }}</td>
                              <td>{{ $item->stores->description }}</td>
                              <td style="text-align: center !important;">
                                   <a href={{ route('admin.sellers.accept' , ['seller'=>$item->id]) }} type="button" class="btn btn-primary">Accept</a>
                                   <a  href={{ route('admin.sellers.reject' ,['seller'=>$item->id]) }} type="button" class="btn btn-danger">Reject</a>
                              </td>
                         </tr>

                         @endforeach

                         @else
                         <tr style="text-align: center !important;">
                              <td colspan="4" class="text-center">No data available</td>
                         </tr>

                         @endif
          @endslot
     @endcomponent
    </div>

     @if ($sellers->hasPages())
    <nav aria-label="Page navigation example" class="mt-3 text-center d-flex justify-content-center">
        <ul class="pagination pagination-rounded">

            {{-- Previous Page Link --}}
            @if ($sellers->onFirstPage())
                <li class="page-item disabled"><span class="page-link">Previous</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $sellers->previousPageUrl() }}">Previous</a></li>
            @endif

            @foreach ($sellers->links()->elements as $element)
                @if (is_string($element))
                    <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                @endif
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $sellers->currentPage())
                            <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach
            @if ($sellers->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $sellers->nextPageUrl() }}">Next</a></li>
            @else
                <li class="page-item disabled"><span class="page-link">Next</span></li>
            @endif

        </ul>
    </nav>
@endif

</div>
@endsection