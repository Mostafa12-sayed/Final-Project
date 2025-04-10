@extends('dashboard::layouts.master')
@section('title', 'Roles List')
@section('content')
          <div class="page-content">

               <!-- Start Container Fluid -->
               <div class="container-xxl">

                    <div class="card overflow-hiddenCoupons">
                         <div class="card-body p-0">
                              <div class="card">
                                   <div class="card-header d-flex justify-content-between align-items-center gap-1">
                                        <h4 class="card-title flex-grow-1">All Roles List</h4>
          
                                        <a href="{{route('admin.roles.create')}}" class="btn btn-sm btn-primary">
                                             Add Role
                                        </a>
          
                                   </div>
                              <div class="table-responsive">
                                   <table class="table align-middle mb-0 table-hover table-centered">
                                        <thead class="bg-light-subtle">
                                             <tr>
                                                  <th>Role</th>
                                                  <th>Description</th>
                                                  <th>Status</th>
                                                  <th>Action</th>
                                             </tr>
                                        </thead>
                                        <tbody>
                                             @if($data->count()>0)
                                             @foreach ($data as  $item)
                                                  
                                             <tr>
                                                  <td style="width:30%" >{{ $item->name }}</td>
                                                
                                                       
                                                  <td style="width:50%">{{$item->description}}</td>
                                                  <td>
                                                       <div class="form-check form-switch">
                                                            <input class="form-check-input change-role-status" type="checkbox" role="switch" id="roleStatue{{ $item->id }}" {{ $item->role_status=="on" ? 'checked' : '' }} data-id="{{ $item->id }}">
                                                       </div>
                                                  </td>
                                                  <td>
                                                       <div class="d-flex gap-2">
                                                            <a href="{{ route('admin.roles.edit',['role'=>$item->id]) }}" class="btn btn-light btn-sm"><iconify-icon icon="solar:eye-broken" class="align-middle fs-18"></iconify-icon></a>
                                                            <a href="{{ route('admin.roles.edit',['role'=>$item->id]) }}" class="btn btn-soft-primary btn-sm"><iconify-icon icon="solar:pen-2-broken" class="align-middle fs-18"></iconify-icon></a>
                                                            <form action="{{ route('admin.roles.destroy',['role'=>$item->id]) }}" method="post">
                                                                 @csrf
                                                                 @method('delete')
                                                            <button type="submit" class="btn btn-soft-danger btn-sm"><iconify-icon icon="solar:trash-bin-minimalistic-2-broken" class="align-middle fs-18"></iconify-icon></button>
                                                            </form>
                                                       </div>
                                                  </td>
                                             </tr>
                                             @endforeach
                                             @else
                                             <tr>
                                                  <td colspan="7" class="text-center">No Roles Found</td>
                                             </tr>
                                             @endif
                             
                                        </tbody>
                                   </table>
                              </div>
                              <!-- end table-responsive -->
                         </div>
                         <x-dashboard::paginate :items="$data" />

                    </div> <!-- end card -->

               </div>
               <!-- End Container Fluid -->

              

          </div>
        
@endsection

@section('script')

<script>

$(document).on('change', '.change-role-status', function () {
    let roleId = $(this).data('id');
    let status = $(this).is(':checked') ? 'on' : 'of';

    $.ajax({
        url: '/admin/roles/update-status', // غيّر هذا حسب المسار في Laravel
        type: 'POST',
        data: {
            id: roleId,
            status: status,
            _token: $('meta[name="csrf-token"]').attr('content') // مهم
        },
        success: function (response) {
            console.log('Status updated successfully', response);
            // Optional: show a toast or alert
        },
        error: function (xhr) {
            console.error('Error updating status', xhr.responseText);
            // Optional: handle error, revert checkbox
        }
    });
});

</script>


@endsection