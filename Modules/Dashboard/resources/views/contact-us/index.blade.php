
@extends('dashboard::layouts.master')
@section('title', 'Contact Us List')
@section('content')
          <div class="page-content">
               <!-- Start Container Fluid -->
               <div class="container-xxl">

                    <div class="row">
                         <div class="col-xl-12">
                              <div class="card">
                                   <div class="d-flex card-header justify-content-between align-items-center">
                                        <div class="d-flex align-items-center justify-content-between w-100">
                                             <h4 class="card-title">All Contact Us List</h4>
                                            <button data-href="{{ route('admin.contact-us.send.mail') }}" data-container="#hr-table-modal" type="button" class="btn btn-primary btn-modal" >
                                               New Mail
                                            </button>
                                        </div>
                                   </div>
                                   <div>
                                        <div class="table-responsive">
                                             <table class="table align-middle mb-0 table-hover table-centered">
                                                  <thead class="bg-light-subtle">
                                                       <tr>
                                                           <th>Name</th>
                                                           <th>Email</th>
                                                           <th>Subject</th>
                                                           <th>Message</th>

                                                           <th>Reply</th>
                                                           <th>Sent At</th>
                                                           <th>Action</th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                  @if($contact_us->count() > 0)
                                                       @foreach($contact_us as $contact)
                                                       <tr>
                                                           <td>{{$contact->name}}</td>
                                                           <td>{{$contact->email}}</td>
                                                           <td>{{$contact->subject}}</td>
                                                           <td>{{ \Illuminate\Support\Str::limit($contact->message, 20)}}</td>
                                                           <td>{{$contact->reply ?\Illuminate\Support\Str::limit($contact->reply, 20) : 'No Reply'}}</td>
                                                           <td>{{$contact->created_at->format('d-m-Y h:i A ')}}</td>


                                                            <td>
                                                                 <div class="d-flex gap-2">
                                                                     <button data-href="{{route('admin.contact-us.show' ,['id' => $contact->id])}}" data-container="#hr-table-modal" class="btn btn-soft-primary btn-sm btn-modal"><iconify-icon icon="solar:eye-broken" class="align-middle fs-18"></iconify-icon></button>

                                                                      <button title="Resend Email" data-href="{{route('admin.contact-us.replay.send' ,['id' => $contact->id])}}" data-container="#hr-table-modal" class="btn btn-soft-primary btn-sm btn-modal"><i class="bx bxl-gmail fs-3"></i></button>
{{--                                                                     <form id="delete-form-coupon-{{$coupon->id}}" action="{{route('admin.coupons.destroy',['coupon' => $coupon->id])}}" method="POST" >--}}
{{--                                                                         @csrf--}}
{{--                                                                         @method('DELETE')--}}
{{--                                                                     </form>--}}
{{--                                                                     <button type="submit" class="btn btn-soft-danger btn-sm delete-item" data-form="delete-form-coupon-{{ $coupon->id }}"><iconify-icon icon="solar:trash-bin-minimalistic-2-broken" class="align-middle fs-18"></iconify-icon></button>--}}


                                                                 </div>
                                                            </td>
                                                       </tr>
                                                       @endforeach
                                                  @else
                                                       <tr class="text-center">
                                                            <td colspan="7" class="p-4">No Contact Found</td>
                                                       </tr>
                                                  @endif
                                                  </tbody>
                                             </table>
                                        </div>
                                        <!-- end table-responsive -->
                                   </div>
                                  <x-dashboard::paginate :items="$contact_us" />
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

