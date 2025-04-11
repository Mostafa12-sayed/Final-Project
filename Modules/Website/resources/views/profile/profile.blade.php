@extends('website::layouts.userDashboard')
@section('main-content')
<div class="col-lg-9">
    <div class="user-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="user-card">
                    <h4 class="user-card-title">Profile Info</h4>
                    <div class="user-form">
                        <form action="{{ route('profile.update', auth()->user()->id) }}" method="POST">
                            @method('put')
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input name="name" type="text" class="form-control" value="{{Auth::user()->name}}"
                                            placeholder="First Name">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input name="last_name" type="text" class="form-control" value="{{Auth::user()->last_name}}"
                                            placeholder="Last Name">
                                            @error('last_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input name="email" type="text" class="form-control"
                                            value="{{Auth::user()->email}}" placeholder="Email">
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input name="phone" type="text" class="form-control"
                                            value="{{Auth::user()->phone}}" placeholder="Phone">
                                            @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>street</label>
                                        <input name="street" type="text" class="form-control"
                                            @if(isset($address) && $address->street != null)
                                            value="{{$address->street}}" 
                                            @endif
                                            placeholder="Street">
                                            @error('street')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>City</label>
                                        <input name="city" type="text" class="form-control"
                                        @if (isset($address->city) && $address->city !=null)
                                        value="{{ $address->city }}"
                                        @endif
                                        placeholder="City">
                                        @error('city')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Zip Code</label>
                                        <input name="zip_code" type="text" class="form-control"
                                        @if (isset($address->zip_code) && $address->zip_code !=null)
                                        value="{{ $address->zip_code }}" 
                                        @endif
                                            placeholder="Zip Code">
                                            @error('zip_code')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="theme-btn"><span class="far fa-user"></span> Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="user-card">
                    <h4 class="user-card-title">Change Password</h4>
                    <div class="col-lg-12">
                        <div class="user-form">
                            <form action="{{ route('profile.update_password',auth()->user()->id) }}" method="post">
                                @csrf
                                @method('put')
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Old Password</label>
                                            <input name="old_password" type="password" class="form-control"
                                                placeholder="Old Password">
                                                @error('old_password')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>New Password</label>
                                            <input name="new_password" type="password" class="form-control"
                                                placeholder="New Password">
                                                @error('new_password')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Re-Type Password</label>
                                            <input name="confirm_new_password" type="password" class="form-control"
                                                placeholder="Re-Type Password">
                                                @error('confirm_new_password')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="theme-btn"><span class="far fa-key"></span> Change Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection