@extends('dashboard::auth.layouts.master')
@section('title', 'Login')
@section('content')
     <div class="d-flex flex-column h-100 p-3">
          <div class="d-flex flex-column flex-grow-1">
               <div class="row h-100">
          
                    <div class="col-xxl-12">
             
                         <div class="row justify-content-center h-100">
                              
                              <div class="col-lg-6 py-lg-5">
                                               @if(session()->has('success'))
                                   @component('dashboard::component.alert-success')
                                        @slot('type', 'success')
                                        @slot('bg', 'success ')
                                        @slot('title',session('success'))
                    
                                   @endcomponent
                              @endif
                                   <div class="d-flex flex-column h-100 justify-content-center">
                                   <div class="auth-logo mb-4">
                                             <a href="index.html" class="logo-dark">
                                                  <img src="{{asset('dashboard/assets/images/logo-dark.png')}}" height="24" alt="logo dark">
                                             </a>

                                             <a href="index.html" class="logo-light">
                                                  <img src="{{asset('dashboard/assets/images/logo-light.png')}}" height="24" alt="logo light">
                                             </a>
                                        </div>

                                        <h2 class="fw-bold fs-24">Sign In</h2>

                                        <p class="text-muted mt-1 mb-4">Enter your email address and password to access admin panel.</p>

                                        <div class="mb-5">
                                             <form action="{{ route('admin.login') }}" class="authentication-form" method="POST">
                                                  @csrf
                                                  <div class="mb-3">
                                                       <label class="form-label" for="example-email">Email</label>
                                                       <input type="email" id="example-email" name="email" class="form-control bg-" placeholder="Enter your email">
                                                       @if($errors->has('email'))
                                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                                       @endif
                                                  </div>
                                                  <div class="mb-3">
                                                       <a href="auth-password.html" class="float-end text-muted text-unline-dashed ms-1">Reset password</a>
                                                       <label class="form-label" for="example-password">Password</label>
                                                       <input type="password" id="example-password" name="password" class="form-control" placeholder="Enter your password">
                                                       @if($errors->has('password'))
                                                       <span class="text-danger">{{ $errors->first('password') }}</span>
                                                  @endif
                                                  </div>
                                                  <div class="mb-3">
                                                       <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="checkbox-signin">
                                                            <label class="form-check-label" name="remember" for="checkbox-signin">Remember me</label>
                                                       </div>
                                                  </div>

                                                  <div class=" text-center d-grid">
                                                       <button class="btn btn-soft-primary" type="submit">Sign In</button>
                                                  </div>
                                             </form>

                                        
                                        </div>

                                        <p class="text-danger text-center">Don't have an account? <a href="{{ route('admin.register') }}" class="text-dark fw-bold ms-1">Sign Up</a></p>
                                   </div>
                              </div>
                         </div>
                    </div>  
               </div>
          </div>
     </div>
@endsection