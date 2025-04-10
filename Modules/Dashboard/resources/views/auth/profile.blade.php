@extends('dashboard::layouts.master')
@section('title', 'Profile')
@section('content')
    <style>
        .student-image{

            border-radius: 50%;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-color: #2b2f32;
        }

        .student_image img , .border_image img{
            width: 150px;
            height: 150px;
            border: 3px dashed #df5c11;
            border-radius: 50%;
        }
    </style>
    <div class="page-content">

        <!-- Start Container Fluid -->
        <div class="container-xxl">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card ">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Profile Information</h4>

                            <button data-href="{{ route('admin.profile.changePassword') }}" data-container="#hr-table-modal" type="button" class="btn btn-primary btn-modal" >
                                Change Password
                            </button>
                        </div>
                        <div class="row pt-2 d-flex flex-column align-items-center">

                            <div class="col-md-4">
                                <form action="{{route('admin.profile.update')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                <div class="col-12 pt-3 text-center" >


                                    <div class="student_image position-relative" >
                                        <img class="image-preview-image "    src="{{ asset('storage/'.$resource->profile_picture ?? 'dashboard/assets/images/users/dummy-avatar.jpg' ) }}">
                                        <label for="image" class="btn btn-primary text-white p-1 px-2 " style="top: 130px;position: absolute; left: 44%  ;  min-height: 5px; ">
                                            <i class="ti ti-cloud-upload fs-6 cursor-pointer"></i>
                                        </label>
                                    </div>
                                    <br>
                                    <input type="file" onchange="changeImage(this, 'image')" id="image" class="d-none form-control mt-3" name="image" >
                                    @if($errors->has('image'))
                                            <span class="text-danger">{{ $errors->first('image') }}</span>
                                    @endif
                                </div>

                            </div>
                            <div class="col-md-8">


                                            <div class="row">
                                                <div class="col-md-6 pt-2">
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input type="text" name="name" class="form-control" id="name" value="{{ $resource->name }}" >
                                                        @if($errors->has('name'))
                                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6 pt-2">
                                                    <div class="form-group">
                                                        <label for="username">Username</label>
                                                        <input type="text" name="username" class="form-control" id="username" value="{{ $resource->username }}" >
                                                        @if($errors->has('username'))
                                                            <span class="text-danger">{{ $errors->first('username') }}</span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-md-6 pt-2">
                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input type="email" name="email" class="form-control" id="email" value="{{ $resource->email }}" >
                                                        @if($errors->has('email'))
                                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6 pt-2">
                                                    <div class="form-group">
                                                        <label for="phone">Phone</label>
                                                        <input type="text" name="phone" class="form-control" id="phone" value="{{ $resource->phone }}">
                                                        @if($errors->has('phone'))
                                                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-12 pt-2">
                                                    <div class="form-group">
                                                        <label for="address">Address</label>
                                                        <input type="text" name="address" class="form-control" id="address" value="{{ $resource->address }}">
                                                        @if($errors->has('address'))
                                                            <span class="text-danger">{{ $errors->first('address') }}</span>
                                                        @endif
                                                    </div>
                                                </div>






                                                <div class="col-md-12  pt-3 text-center mb-3">
                                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                                </div>

                                            </div>

                            </div>
                            </form>

                        </div>


                </div>

            </div>


        </div>






    </div>

@endsection
@section('script')
            <script>
                function previewImage(input) {
                    const file = input.files[0];
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const imagePreview = document.getElementById('image-preview');
                        imagePreview.style.display = 'block';
                        imagePreview.src = e.target.result;
                    };
                    if (file) {
                        reader.readAsDataURL(file);
                    }
                }
                function changeImage(element, id) {
                    if (element.files && element.files[0]) {
                        var reader = new FileReader();
                        console.log(id);
                        reader.onload = function (e) {
                            $('.image-preview-' + id).attr('src', e.target.result);
                        }

                        reader.readAsDataURL(element.files[0]);
                    }
                }
            </script>

@endsection
