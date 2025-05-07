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

                                       <h1 class="text-black text-center p-2 pt-3 pb-3">
                                           <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 64 64" style=" enable-background:new 0 0 24 24" xml:space="preserve"><style>.st0{display:none}.st1{display:inline}.st2{fill:#f1f2f2}.st3{fill:#36d7b7}.st4{fill:none;stroke:#414042;stroke-miterlimit:10}.st5,.st6,.st7{display:inline;fill:#d1d3d4}.st6,.st7{fill:#414042}.st7{fill:none;stroke:#414042;stroke-miterlimit:10}.st8{fill:#fff}.st9{fill:#f5ab35}.st10{fill:#f9cd86}.st11,.st12{display:inline;fill:#36d7b7}.st12{fill:#fff}.st13,.st14,.st16{display:inline;fill:#e6e7e8}.st14,.st16{fill:#5edfc5}.st16{fill:#f7bc5d}.st17,.st18,.st19{display:inline;fill:#f5ab35}.st18,.st19{fill:#b88028}.st19{fill:#29a189}.st20{fill:#e6e7e8}.st21{fill:#bcbec0}.st22{fill:#58595b}.st23{fill:#29a189}.st24{fill:#414042}.st25{fill:#d1d3d4}.st26{display:inline;fill:#bcbec0}.st27{fill:#f1f2f2}.st27,.st28,.st34{display:inline}.st28{fill:none;stroke:#414042;stroke-linecap:round;stroke-miterlimit:10}.st34{fill:#afefe2}</style><g id="icons"><g id="XMLID_803_"><path id="XMLID_785_" class="st3" d="M53.4 22.1H21.7L26 36.4h24.9z"/><path id="XMLID_793_" class="st4" d="m13.2 20.5 7.8.6 6.8 21.1h21.7"/><path id="XMLID_791_" class="st4" d="M24.5 25.2h27.4"/><path id="XMLID_795_" class="st4" d="M25.6 28.5h25.5"/><path id="XMLID_796_" class="st4" d="M26.7 31.8h23.8"/><path id="XMLID_790_" class="st4" d="M26 36.4h24.9"/><circle id="XMLID_794_" class="st9" cx="32.7" cy="42.2" r="2.6"/><circle id="XMLID_792_" class="st24" cx="32.7" cy="42.2" r="1"/><circle id="XMLID_788_" class="st4" cx="32.7" cy="42.2" r="2.6"/><circle id="XMLID_787_" class="st9" cx="45.2" cy="42.2" r="2.6"/><circle id="XMLID_786_" class="st24" cx="45.2" cy="42.2" r="1"/><circle id="XMLID_784_" class="st4" cx="45.2" cy="42.2" r="2.6"/><path id="XMLID_789_" transform="matrix(.9972 .07536 -.07536 .9972 1.597 -1.083)" class="st9" d="M11.2 19.5h7.9v2.3h-7.9z"/><path id="XMLID_801_" class="st4" d="M20.7 27.2H10.6"/><path id="XMLID_800_" class="st4" d="M21.8 30.9h-8.4"/><path id="XMLID_802_" class="st4" d="M23.1 34.6h-5.7"/></g></g></svg>
                                           Medion
                                       </h1>
                                   </div>

                                        <h2 class="fw-bold fs-24">Sign In</h2>

                                        <p class="text-muted mt-1 mb-4">Enter your email address and password to access admin panel.</p>

                                        <div class="mb-5">
                                             <form action="{{ route('admin.login') }}" class="authentication-form" method="POST">
                                                  @csrf
                                                  <div class="mb-3">
                                                       <label class="form-label" for="example-email">Email</label>
                                                       <input type="text" id="example-email" name="login" class="form-control bg- transparent {{$errors->has('login') ?"border-danger border-2":'' }} " placeholder="Enter your email" value="{{ old('login') }}">
                                                       @if($errors->has('login'))
                                                            <span class="text-danger">{{ $errors->first('login') }}</span>
                                                       @endif
                                                  </div>
                                                  <div class="mb-3">
                                                       <a href="{{route('admin.reset-password')}}" class="float-end text-muted text-unline-dashed ms-1">Reset password</a>
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
