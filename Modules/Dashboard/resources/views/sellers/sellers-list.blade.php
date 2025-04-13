@extends('dashboard::layouts.master')
@section('title', 'Sellers List')
@section('content')
<div class="page-content">

        <div class="container-xxl">

             <div class="row">
               @if($sellers->count()>0)
               @foreach ($sellers as $seller )

               <div class="col-xl-3 col-md-6">
                    <div class="card">
                         <div class="card-body">
                              <div class="position-relative bg-light p-2 rounded text-center">
                                  @if(optional($seller->admin)->logo_image)
                                   <img src="{{asset('storage/'.$seller->admin->logo_image)}}" alt="" class="avatar-xxl">
                                  @else
                                   <img src="{{asset('dashboard/assets/images/default-store.png')}}" alt="" class="avatar-xxl">
                                  @endif
                                   <div class="position-absolute top-0 end-0 m-1">

                                   </div>
                              </div>
                              <div class="d-flex flex-wrap justify-content-between my-3">
                                   <div>
                                        <h4 class="mb-1">{{$seller->name}}<span class="text-muted fs-13 ms-1"></span></h4>

                                   </div>
{{--                                   <div>--}}
{{--                                        <p class="mb-0"><span class="badge bg-light text-dark fs-12 me-1"><i class="bx bxs-star align-text-top fs-14 text-warning me-1"></i> 4.5</span>3.5k</p>--}}
{{--                                   </div>--}}
                              </div>
                              <div class="">
                                   <p class="d-flex align-items-center gap-2 mb-1"><iconify-icon icon="solar:point-on-map-bold-duotone" class="fs-18 text-primary"></iconify-icon>
                                       {{$seller->admin->address}}</p>
                                   <p class="d-flex align-items-center gap-2 mb-1"><iconify-icon icon="solar:letter-bold-duotone" class="fs-18 text-primary"></iconify-icon>
                                       {{$seller->admin->email}}</p>
                                   <p class="d-flex align-items-center gap-2 mb-0"><iconify-icon icon="solar:outgoing-call-rounded-bold-duotone" class="fs-20 text-primary"></iconify-icon>+243 812-801-9335</p>
                              </div>
                              <div class="d-flex align-items-center justify-content-between mt-3 mb-1">
                                   <p class="mb-0 fs-15 fw-medium text-dark">Fashion</p>
                                   <div>
                                        <p class="mb-0 fs-15 fw-medium text-dark">$200k <span class="ms-1"><iconify-icon icon="solar:course-up-outline" class="text-success"></iconify-icon></span></p>
                                   </div>
                              </div>
                              <div class="progress progress-soft progress-md">
                                   <div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" role="progressbar" style="width: 20%" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                              <div class="p-2 pb-0 mx-n3 mt-2">
                                   <div class="row text-center g-2">
                                        <div class="col-lg-6 col-6 border-end">
                                             <h5 class="mb-1">{{$seller->products->count()}}</h5>
                                             <p class="text-muted mb-0">Item Stock</p>
                                        </div>
                                        <div class="col-lg-6 col-6 ">
                                             <h5 class="mb-1">+4.5k</h5>
                                             <p class="text-muted mb-0">Sells</p>
                                        </div>
{{--                                        <div class="col-lg-4 col-4">--}}
{{--                                             <h5 class="mb-1">+2k</h5>--}}
{{--                                             <p class="text-muted mb-0">Happy Client</p>--}}
{{--                                        </div>--}}
                                   </div>
                              </div>
                         </div>

                         <div class="card-footer border-top  hstack " data-admin-id="{{ $seller->admin->id }}">
                             <div class="d-flex align-items-center px-3">
                                 <p class="mb-0 fs-15 fw-medium text-dark p-2"> <strong>Role: </strong></p>
                                 <select class="form-select form-select-sm role-select"  >
                                     <option selected>Select Role</option>
                                     @foreach ($roles as $role)
                                         <option value="{{ $role->id }}" @if($seller->admin->role_id == $role->id) selected @endif>{{ $role->name }}</option>
                                     @endforeach

                                 </select>
                             </div>
                             <div class="d-flex align-items-center px-3">
                             <p class="mb-0 fs-15 fw-medium text-dark p-2"> <strong>Status: </strong></p>

                             <select class="form-select form-select-sm status-select">
                                  <option selected>Select Status</option>
                                  <option value="active" @if($seller->admin->status == 'active') selected @endif>Active</option>
                                  <option value="inactive" @if($seller->admin->status == 'inactive') selected @endif>Inactive</option>
                             </select>
                             </div>

                         </div>
                    </div>
               </div>
               @endforeach
               @else
               <div>
                    <td colspan="7" class="text-center">No Sellers Found</td>
               </div>
                 @endif
             </div>


        </div>

   </div>
@endsection


@section('script')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.role-select, .status-select').on('change', function () {
                let cardFooter = $(this).closest('.card-footer');
                let adminId = cardFooter.data('admin-id');
                let roleId = cardFooter.find('.role-select').val();
                let status = cardFooter.find('.status-select').val();

                $.ajax({
                    url: `/admin/sellers/update-status-role/${adminId}`,
                    method: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        role_id: roleId,
                        status: status,
                    },
                    success: function (response) {
                        toastr.success('Updated successfully!');
                    },
                    error: function (xhr) {
                        toastr.error('Something went wrong!');
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>

@endsection
