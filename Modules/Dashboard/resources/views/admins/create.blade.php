@php
    $title = $admin->id ? 'Edit Admin' : 'Create As Admin';
@endphp

<style>
    .modal {
        --bs-modal-width: 660px !important;
    }
</style>
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">
                {{ $title }}
            </h5>
        </div>
        <div class="modal-body">
            <form class="form" action="{{ $admin->id ?  route('admin.admins.update' , ['admin' =>$admin->id]): route('admin.admins.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @if($admin->id)
                                        @method('PUT')
                                    @endif


                                    <div class="card p-0">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-6">

                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Admin Name</label>
                                                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter name"  value="{{ old('name' , $admin->name) }}">
                                                        @if($errors->has('name'))
                                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                                        @endif
                                                    </div>

                                                </div>
                                                <div class="col-lg-6">

                                                    <div class="mb-3">
                                                        <label for="username-title" class="form-label">Username (Enter unique username)</label>
                                                        <input type="text" name="username" id="username-title" class="form-control" placeholder="Enter Title"  value="{{ old('username' , $admin->username) }}">
                                                        @if($errors->has('username'))
                                                            <span class="text-danger">{{ $errors->first('username') }}</span>
                                                        @endif
                                                    </div>

                                                </div>

                                                <div class="col-lg-6">

                                                    <div class="mb-3">
                                                        <label for="email" class="form-label">Email</label>
                                                        <input type="text" name="email" id="email" class="form-control" placeholder="Enter Title"  value="{{ old('email' , $admin->email) }}">
                                                        @if($errors->has('email'))
                                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                                        @endif
                                                    </div>

                                                </div>

                                                <div class="col-lg-6">

                                                    <label for="parent" class="form-label">Role</label>
                                                    <select class="form-control" name="role_id" id="parent" data-choices data-choices-groups data-placeholder="Select Parent Category">
                                                        <option value="">Select Role</option>
                                                        @foreach ($roles as $role)
                                                            <option value="{{ $role->id }}" @if($admin->id)
                                                                {{ $role->id == $admin->role_id ? 'selected' : '' }} @endif>

                                                                {{ $role->name }}</option>

                                                        @endforeach

                                                    </select>
                                                    @if($errors->has('role_id'))
                                                        <span class="text-danger">{{ $errors->first('role_id') }}</span>
                                                    @endif

                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="phone" class="form-label">Phone</label>
                                                        <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter phone"  value="{{ old('phone' , $admin->phone) }}">
                                                        @if($errors->has('phone'))
                                                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                                                        @endif
                                                    </div>

                                                </div>
                                                <div class="col-lg-6">
                                                    <p>Status</p>
                                                    <div class="d-flex gap-2 align-items-center">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="status" id="flexRadioDefault1" @if($admin->id)
                                                                {{ $admin->status == 'active' ? 'checked' : '' }} @else checked @endif value="active">
                                                            <label class="form-check-label" for="flexRadioDefault1">
                                                                Active
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="status" id="flexRadioDefault2"  value="inactive" @if($admin->id)
                                                                {{ $admin->status == 'inactive' ? 'checked' : '' }} @endif>
                                                            <label class="form-check-label" for="flexRadioDefault2">
                                                                In Active
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                <div class="pt-4 d-flex justify-content-end gap-2">


                    <div class="col-lg-2">
                        <button type="submit" class="btn btn-outline-secondary w-100"> {{$admin->id ? 'Edit' : 'Create' }}</button>
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


