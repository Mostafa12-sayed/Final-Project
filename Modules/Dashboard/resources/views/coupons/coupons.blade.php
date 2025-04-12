
@extends('dashboard::layouts.master')
@section('title', 'Coupon')
@section('content')
          <div class="page-content">
               <!-- Start Container Fluid -->
               <div class="container-xxl">

                    <div class="row">
                         <div class="col-xl-12">
                              <div class="card">
                                   <div class="d-flex card-header justify-content-between align-items-center">
                                        <div class="d-flex align-items-center justify-content-between w-100">
                                             <h4 class="card-title">All Coupons List</h4>
                                            <button data-href="{{ route('admin.coupons.create') }}" data-container="#hr-table-modal" type="button" class="btn btn-primary btn-modal" >
                                               Create Coupon
                                            </button>
                                        </div>
                                   </div>
                                   <div>
                                        <div class="table-responsive">
                                             <table class="table align-middle mb-0 table-hover table-centered">
                                                  <thead class="bg-light-subtle">
                                                       <tr>

                                                           <th>Name</th>
                                                           <th>Description</th>
                                                           <th>Discount</th>
                                                           <th>Code</th>
                                                           <th>Expiry Date</th>
                                                           <th>Status</th>

                                                           <th>Action</th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                  @if($coupons->count() > 0)
                                                       @foreach($coupons as $coupon)
                                                       <tr>
                                                           <td>{{$coupon->name}}</td>
                                                           <td>{{$coupon->description}}</td>
                                                           <td>{{$coupon->discount}}</td>
                                                           <td>{{$coupon->code}}</td>
                                                           <td>{{$coupon->expiry_date}}</td>

                                                           <td>
                                                               <div class="form-check form-switch">
                                                                   <input class="form-check-input change-coupon-status" type="checkbox" role="switch" id="roleStatue{{ $coupon->id }}" {{ $coupon->is_active==1 ? 'checked' : '' }} data-id="{{ $coupon->id }}">
                                                               </div>
                                                           </td>
                                                            <td>
                                                                 <div class="d-flex gap-2">
                                                                      <button data-href="{{route('admin.coupons.edit' ,['coupon' => $coupon->id])}}" data-container="#hr-table-modal" class="btn btn-soft-primary btn-sm btn-modal"><iconify-icon icon="solar:pen-2-broken" class="align-middle fs-18"></iconify-icon></button>
                                                                     <form id="delete-form-coupon-{{$coupon->id}}" action="{{route('admin.coupons.destroy',['coupon' => $coupon->id])}}" method="POST" >
                                                                         @csrf
                                                                         @method('DELETE')
                                                                     </form>
                                                                     <button type="submit" class="btn btn-soft-danger btn-sm delete-item" data-form="delete-form-coupon-{{ $coupon->id }}"><iconify-icon icon="solar:trash-bin-minimalistic-2-broken" class="align-middle fs-18"></iconify-icon></button>


                                                                 </div>
                                                            </td>
                                                       </tr>
                                                       @endforeach
                                                  @else
                                                       <tr class="text-center">
                                                            <td colspan="7" class="p-4">No Coupons Found</td>
                                                       </tr>
                                                  @endif
                                                  </tbody>
                                             </table>
                                        </div>
                                        <!-- end table-responsive -->
                                   </div>
                                  <x-dashboard::paginate :items="$coupons" />
                              </div>
                         </div>

                    </div>

               </div>
               <!-- End Container Fluid -->



          </div>
@endsection

@section('script')

    <script>

        $(document).on('change', '.change-coupon-status', function () {
            let couponId = $(this).data('id');
            let status = $(this).is(':checked') ? 1 : 0;

            $.ajax({
                url: '/admin/coupons/update-status', // غيّر هذا حسب المسار في Laravel
                type: 'POST',
                data: {
                    id: couponId,
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

