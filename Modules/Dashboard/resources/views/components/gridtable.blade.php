{{-- <div id="table-{{ $id = uniqid('grid_') }}"></div> --}}

{{-- <div id="table-gridjs"></div> --}}



<table class="table table-striped table-borderless table-centered">
    <thead class="table-light">
         <tr style="text-align: center !important;" >
            
              @if (isset($headers))
                    {!! $headers !!}
              @endif
             
         </tr>
    </thead>
    <tbody>

        @if (isset($data))
            {!! $data !!}
        @endif
    </tbody>
</table>



@push('styles')
<link href="{{asset('dashboard/assets/vendor/gridjs/theme/mermaid.min.css')}}" rel="stylesheet" type="text/css" />
  
@endpush
@push('scripts')
<script src="{{asset('dashboard/assets/vendor/gridjs/gridjs.umd.js')}}"></script>

<!-- Gridjs Demo js -->
<script src="{{asset('dashboard/assets/js/components/table-gridjs.js')}}"></script>
{{-- 
<script>
    document.addEventListener("DOMContentLoaded", function () {
      const table = document.getElementById("table-{{ $id }}");
        if (table) {
            new gridjs.Grid({
                columns: {!! json_encode($columns) !!},
                data: {!! json_encode($data) !!},
                pagination: {
                    limit: 1
                },
                
                search: true,
                sort: true
            }).render(table);
        }
    });
  
</script> --}}
@endpush