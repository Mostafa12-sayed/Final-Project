

@php
    $title = $coupon->id ? 'Edit Coupon' : 'Create Coupon';
@endphp


<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">
                {{ $title }}
            </h5>
        </div>
        <div class="modal-body">
            <form class="form"
                  action="{{ $coupon->id ? route('admin.coupons.update', $coupon->id) : route('admin.coupons.store') }}"
                  method="post" enctype="multipart/form-data">
                @csrf
                @if ($coupon->id)
                    @method('PUT')
                @endif
                <div class="modal-body p-0">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter name"
                               value="{{ old('name', $coupon->name) }}" >
                    </div>
                    <div class="mb-3">
                        <label for="code" class="form-label">Code</label>
                        <input type="text" id="code" name="code" class="form-control" placeholder="Enter code"
                               value="{{ old('code', $coupon->code) }}" >
                    </div>
                    <div class="mb-3">
                        <label for="discount" class="form-label">Discount</label>
                        <input type="text" id="discount" name="discount" class="form-control" placeholder="Enter discount"
                               value="{{ old('discount', $coupon->discount) }}" >
                    </div>
                    <div class="mb-3">
                        <label for="limit" class="form-label">Usage Limit</label>
                        <input type="number" id="limit" name="limit" class="form-control" placeholder="Enter usage limit"
                               value="{{ old('limit', $coupon->limit ?? 1) }}" min="1">
                    </div>
                    <div class="mb-3">
                        <label for="expiry_date" class="form-label">Expiry date</label>
                        <input type="date" id="expiry_date" name="expiry_date" class="form-control" placeholder="Enter expiry date"
                               value="{{ old('expiry_date', $coupon->expiry_date) }}" >
                    </div>

                    <div class="mb-3">
                        <label for="display_name" class="form-label">resource Description </label>
                        <input type="text" id="display_name" name="description" class="form-control" placeholder="Enter resource Description"
                               value="{{ old('description', $coupon->description) }}" >
                    </div>
                    <div class="col-lg-6">
                        <p>Status</p>
                        <div class="d-flex gap-2 align-items-center">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_active" id="flexRadioDefault1"
                                @if(old('is_active', $coupon->is_active) == 1) checked @endif value="1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Active
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_active" id="flexRadioDefault2"  @if(old('is_active', $coupon->is_active) == 0) checked @endif value="0">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    In Active
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pt-4 d-flex justify-content-end gap-2">


                        <div class="col-lg-2">
                            <button type="submit" class="btn btn-outline-secondary w-100"> {{$coupon->id ? 'Edit' : 'Create' }}</button>
                        </div>
                        <div class="col-lg-2">
                            <button type="button"  class="btn btn-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                        </div>


                </div>
            </form>

        </div>

    </div>
</div>

@include('dashboard::layouts.includes.formSubmit')
