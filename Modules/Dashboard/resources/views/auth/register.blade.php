@extends('dashboard::auth.layouts.master')
@section('title', 'Register')
@section('content')
     <div class="d-flex flex-column h-100 p-3">
          <div class="d-flex flex-column flex-grow-1">
               <div class="row h-100">
                    <div class="col-xxl-12">
                         <div class="row justify-content-center h-100">
                              <div class="col-lg-6 py-lg-5">
                                   @if(session()->has('error'))

                                        @component('dashboard::component.alert-success')
                                             @slot('type', 'danger ')
                                             @slot('bg', 'danger ')
                                             @slot('title', session('error'))
                                        @endcomponent
                                   @endif
                                   <div class="d-flex flex-column h-100 justify-content-center">

                                        <h2 class="fw-bold fs-24">Sign Up</h2>

                                        <p class="text-muted mt-1 mb-4">New to our platform? Sign up now! It only takes a minute</p>

                                        <div>
                                             <form action="{{ route('admin.register.store') }}" class="authentication-form" method="POST">
                                                  @csrf
                                                  <div class="row">
                                                  <div class="mb-3 col-md-6">
                                                       <label class="form-label" for="example-name">Name</label>
                                                       <input type="name" id="example-name" value="{{ old('name') }}" name="name" class="form-control" placeholder="Enter your name">
                                                       @if($errors->has('name'))
                                                       <span class="text-danger">{{ $errors->first('name') }}</span>
                                                       @endif
                                                  </div>
                                                  <div class="mb-3 col-md-6">
                                                       <label class="form-label" for="example-email">Email</label>
                                                       <input type="email" id="example-email" value="{{ old('email') }}" name="email" class="form-control bg-" placeholder="Enter your email">
                                                       @if($errors->has('email'))
                                                       <span class="text-danger">{{ $errors->first('email') }}</span>
                                                       @endif
                                                  </div>
                                             </div>
                                             <div class="row">

                                                  <div class="mb-3 col-md-6">
                                                       <label class="form-label" for="phone">Phone</label>
                                                       <input type="text" id="phone" name="phone" value="{{ old('phone') }}" class="form-control bg-" placeholder="Enter your phone">
                                                       @if($errors->has('phone'))
                                                       <span class="text-danger">{{ $errors->first('phone') }}</span>
                                                       @endif
                                                  </div>
                                                  <div class="mb-3 col-md-6">
                                                       <label class="form-label" for="address">Address</label>
                                                       <input type="text" id="address" name="address" value="{{ old('address') }}" class="form-control bg-" placeholder="Enter your Address">
                                                       @if($errors->has('address'))
                                                       <span class="text-danger">{{ $errors->first('address') }}</span>
                                                       @endif
                                                  </div>
                                             </div>
                                             <div class="mb-3 ">
                                                  <label class="form-label" for="store">Store Name</label>
                                                  <input type="text" id="store" name="store_name" value="{{ old('store_name') }}"
                                                  class="form-control" placeholder="Enter your Store Name">
                                                  @if($errors->has('store_name'))
                                                  <span class="text-danger">{{ $errors->first('store_name') }}</span>
                                                  @endif
                                             </div>
                                                  <div class="mb-3">
                                                       <label class="form-label" for="store">Store Description</label>
                                                       <textarea type="text" id="store"
                                                       name="description"
                                                       class="form-control" placeholder="Enter your Store Description"> {{old('description')}}</textarea>
                                                       @if($errors->has('description'))
                                                       <span class="text-danger">{{ $errors->first('description') }}</span>
                                                       @endif
                                                  </div>
                                                  <div class="mb-3">
                                                       <label class="form-label" for="example-email">Password</label>
                                                       <input type="password" id="example-email" name="password" class="form-control bg-" placeholder="Enter your password">
                                                       @if($errors->has('password'))
                                                       <span class="text-danger">{{ $errors->first('password') }}</span>
                                                       @endif
                                                  </div>
                                                  <div class="mb-3">
                                                       <label class="form-label" for="password-confirm">Password Confirmtion</label>
                                                       <input type="text" id="password-confirm" class="form-control"
                                                       name="password_confirmation"  autocomplete="new-password"
                                                       placeholder="Enter your password Confirmtion">
                                                  </div>
                                                  <div class="mb-3">
                                                       <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="checkbox-signin" required>
                                                            <label class="form-check-label" for="checkbox-signin">I accept Terms and Condition</label>
                                                       </div>
                                                  </div>

                                                  <div class="mb-1 text-center d-grid">
                                                       <button class="btn btn-soft-primary" type="submit">Sign Up</button>
                                                  </div>
                                             </form>

                                        </div>

                                        <p class="mt-auto text-danger text-center">I already have an account  <a href="{{ route('admin.login') }}" class="text-dark fw-bold ms-1">Sign In</a></p>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
@endsection
