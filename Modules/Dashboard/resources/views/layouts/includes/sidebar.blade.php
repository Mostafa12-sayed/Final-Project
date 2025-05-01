
          <!-- ========== App Menu Start ========== -->
          <div class="main-nav">
            <!-- Sidebar Logo -->
            <div class="logo-box">
{{--                 <a href="{{route('admin.dashboard')}}" class="logo-dark">--}}
{{--                     <h2 class="text-white text-center p-2 pt-3 pb-3">Medion</h2>--}}

{{--                     --}}{{--                            <h1>dashboard</h1>--}}
{{--                      <img src="{{asset('dashboard/assets/images/logo-sm.png')}}" class="logo-sm" alt="logo sm">--}}
{{--                      <img src="{{asset('dashboard/assets/images/logo-dark.png')}}" class="logo-lg" alt="logo dark">--}}
{{--                 </a>--}}

                 <a href="{{route('admin.dashboard')}}" class="logo-light">
{{--                      <img src="{{asset('dashboard/assets/images/logo-sm.png')}}" class="logo-sm" alt="logo sm">--}}
{{--                      <img src="{{asset('dashboard/assets/images/logo-light.png')}}" class="logo-lg" alt="logo light">--}}
                     <h2 class="text-white text-center p-2 pt-3 pb-3">
                         <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 64 64" style=" enable-background:new 0 0 24 24" xml:space="preserve"><style>.st0{display:none}.st1{display:inline}.st2{fill:#f1f2f2}.st3{fill:#36d7b7}.st4{fill:none;stroke:#414042;stroke-miterlimit:10}.st5,.st6,.st7{display:inline;fill:#d1d3d4}.st6,.st7{fill:#414042}.st7{fill:none;stroke:#414042;stroke-miterlimit:10}.st8{fill:#fff}.st9{fill:#f5ab35}.st10{fill:#f9cd86}.st11,.st12{display:inline;fill:#36d7b7}.st12{fill:#fff}.st13,.st14,.st16{display:inline;fill:#e6e7e8}.st14,.st16{fill:#5edfc5}.st16{fill:#f7bc5d}.st17,.st18,.st19{display:inline;fill:#f5ab35}.st18,.st19{fill:#b88028}.st19{fill:#29a189}.st20{fill:#e6e7e8}.st21{fill:#bcbec0}.st22{fill:#58595b}.st23{fill:#29a189}.st24{fill:#414042}.st25{fill:#d1d3d4}.st26{display:inline;fill:#bcbec0}.st27{fill:#f1f2f2}.st27,.st28,.st34{display:inline}.st28{fill:none;stroke:#414042;stroke-linecap:round;stroke-miterlimit:10}.st34{fill:#afefe2}</style><g id="icons"><g id="XMLID_803_"><path id="XMLID_785_" class="st3" d="M53.4 22.1H21.7L26 36.4h24.9z"/><path id="XMLID_793_" class="st4" d="m13.2 20.5 7.8.6 6.8 21.1h21.7"/><path id="XMLID_791_" class="st4" d="M24.5 25.2h27.4"/><path id="XMLID_795_" class="st4" d="M25.6 28.5h25.5"/><path id="XMLID_796_" class="st4" d="M26.7 31.8h23.8"/><path id="XMLID_790_" class="st4" d="M26 36.4h24.9"/><circle id="XMLID_794_" class="st9" cx="32.7" cy="42.2" r="2.6"/><circle id="XMLID_792_" class="st24" cx="32.7" cy="42.2" r="1"/><circle id="XMLID_788_" class="st4" cx="32.7" cy="42.2" r="2.6"/><circle id="XMLID_787_" class="st9" cx="45.2" cy="42.2" r="2.6"/><circle id="XMLID_786_" class="st24" cx="45.2" cy="42.2" r="1"/><circle id="XMLID_784_" class="st4" cx="45.2" cy="42.2" r="2.6"/><path id="XMLID_789_" transform="matrix(.9972 .07536 -.07536 .9972 1.597 -1.083)" class="st9" d="M11.2 19.5h7.9v2.3h-7.9z"/><path id="XMLID_801_" class="st4" d="M20.7 27.2H10.6"/><path id="XMLID_800_" class="st4" d="M21.8 30.9h-8.4"/><path id="XMLID_802_" class="st4" d="M23.1 34.6h-5.7"/></g></g></svg>
                         Medion
                     </h2>
                 </a>
            </div>

            <!-- Menu Toggle Button (sm-hover) -->
            <button type="button" class="button-sm-hover" aria-label="Show Full Sidebar">
                 <iconify-icon icon="solar:double-alt-arrow-right-bold-duotone" class="button-sm-hover-icon"></iconify-icon>
            </button>

            <div class="scrollbar" data-simplebar>
                 <ul class="navbar-nav" id="navbar-nav">

                      <li class="menu-title">General</li>
                     @if(auth()->guard('admin')->user()->hasPermission('view-dashboard'))

                      <li class="nav-item">
                           <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                <span class="nav-icon">
                                     <iconify-icon icon="solar:widget-5-bold-duotone"></iconify-icon>
                                </span>
                                <span class="nav-text"> Dashboard </span>
                           </a>
                      </li>
                      @endif
                      {{-- products --}}
                      <li class="nav-item">
                           <a class="nav-link menu-arrow" href="#sidebarProducts" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarProducts">
                                <span class="nav-icon">
                                     <iconify-icon icon="solar:t-shirt-bold-duotone"></iconify-icon>
                                </span>
                                <span class="nav-text"> Products </span>
                           </a>
                           <div class="collapse" id="sidebarProducts">
                                <ul class="nav sub-navbar-nav">
                                    @if(auth()->guard('admin')->user()->hasPermission('read-products'))

                                    <li class="sub-nav-item">
                                          <a class="sub-nav-link" href="{{ route('admin.products.index') }}">List</a>
                                     </li>
                                    @endif

                                    @if(auth()->guard('admin')->user()->hasPermission('create-products'))
                                     <li class="sub-nav-item">
                                          <a class="sub-nav-link" href="{{ route('admin.products.create') }}">Create</a>
                                     </li>
                                        @endif
                                </ul>
                           </div>
                      </li>
                      {{-- category --}}
                     @if(auth()->guard('admin')->user()->hasPermission('read-categories'))
                      <li class="nav-item">
                           <a class="nav-link menu-arrow" href="#sidebarCategory" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarCategory">
                                <span class="nav-icon">
                                     <iconify-icon icon="solar:clipboard-list-bold-duotone"></iconify-icon>
                                </span>
                                <span class="nav-text"> Category </span>
                           </a>
                          <div class="collapse" id="sidebarCategory">
                                <ul class="nav sub-navbar-nav">
                                     <li class="sub-nav-item">
                                          <a class="sub-nav-link" href="{{ route('admin.category.index') }}">List</a>
                                     </li>
                                    @if(auth()->guard('admin')->user()->hasPermission('create-categories'))
                                     <li class="sub-nav-item">
                                          <a class="sub-nav-link" href="{{ route('admin.category.create') }}">Create</a>
                                     </li>
                                    @endif
                                </ul>
                           </div>
                      </li>
                     @endif

{{--                      <li class="nav-item">--}}
{{--                           <a class="nav-link menu-arrow" href="#sidebarInventory" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarInventory">--}}
{{--                                <span class="nav-icon">--}}
{{--                                     <iconify-icon icon="solar:box-bold-duotone"></iconify-icon>--}}
{{--                                </span>--}}
{{--                                <span class="nav-text"> Inventory </span>--}}
{{--                           </a>--}}
{{--                           <div class="collapse" id="sidebarInventory">--}}
{{--                                <ul class="nav sub-navbar-nav">--}}

{{--                                     <li class="sub-nav-item">--}}
{{--                                          <a class="sub-nav-link" href="inventory-warehouse.html">Warehouse</a>--}}
{{--                                     </li>--}}
{{--                                     <li class="sub-nav-item">--}}
{{--                                          <a class="sub-nav-link" href="inventory-received-orders.html">Received Orders</a>--}}
{{--                                     </li>--}}
{{--                                </ul>--}}
{{--                           </div>--}}
{{--                      </li>--}}

                      <li class="nav-item">
                           <a class="nav-link menu-arrow" href="#sidebarOrders" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarOrders">
                                <span class="nav-icon">
                                     <iconify-icon icon="solar:bag-smile-bold-duotone"></iconify-icon>
                                </span>
                                <span class="nav-text"> Orders </span>
                           </a>
                           <div class="collapse" id="sidebarOrders">
                                <ul class="nav sub-navbar-nav">
                                     <li class="sub-nav-item">
                                          <a class="sub-nav-link" href="{{route('admin.orders.index')}}">List</a>
                                     </li>
                                     <li class="sub-nav-item">
                                          <a class="sub-nav-link" href="{{route('admin.orders.index' , ['status' => 'approved'])}}">Orders Accepted</a>
                                     </li>
                                    <li class="sub-nav-item">
                                        <a class="sub-nav-link" href="{{route('admin.orders.index' , ['status' => 'rejected'])}}">Orders Rejected</a>
                                    </li>
                                </ul>
                           </div>
                      </li>

{{--                      <li class="nav-item">--}}
{{--                           <a class="nav-link menu-arrow" href="#sidebarPurchases" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarPurchases">--}}
{{--                                <span class="nav-icon">--}}
{{--                                     <iconify-icon icon="solar:card-send-bold-duotone"></iconify-icon>--}}
{{--                                </span>--}}
{{--                                <span class="nav-text"> Purchases </span>--}}
{{--                           </a>--}}
{{--                           <div class="collapse" id="sidebarPurchases">--}}
{{--                                <ul class="nav sub-navbar-nav">--}}
{{--                                     <li class="sub-nav-item">--}}
{{--                                          <a class="sub-nav-link" href="purchase-list.html">List</a>--}}
{{--                                     </li>--}}
{{--                                     <li class="sub-nav-item">--}}
{{--                                          <a class="sub-nav-link" href="purchase-order.html">Order</a>--}}
{{--                                     </li>--}}
{{--                                     <li class="sub-nav-item">--}}
{{--                                          <a class="sub-nav-link" href="purchase-returns.html">Return</a>--}}
{{--                                     </li>--}}
{{--                                </ul>--}}
{{--                           </div>--}}
{{--                      </li>--}}

{{--                      <li class="nav-item">--}}
{{--                           <a class="nav-link menu-arrow" href="#sidebarAttributes" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAttributes">--}}
{{--                                <span class="nav-icon">--}}
{{--                                     <iconify-icon icon="solar:confetti-minimalistic-bold-duotone"></iconify-icon>--}}
{{--                                </span>--}}
{{--                                <span class="nav-text"> Attributes </span>--}}
{{--                           </a>--}}
{{--                           <div class="collapse" id="sidebarAttributes">--}}
{{--                                <ul class="nav sub-navbar-nav">--}}
{{--                                     <li class="sub-nav-item">--}}
{{--                                          <a class="sub-nav-link" href="attributes-list.html">List</a>--}}
{{--                                     </li>--}}
{{--                                     <li class="sub-nav-item">--}}
{{--                                          <a class="sub-nav-link" href="attributes-edit.html">Edit</a>--}}
{{--                                     </li>--}}
{{--                                     <li class="sub-nav-item">--}}
{{--                                          <a class="sub-nav-link" href="attributes-add.html">Create</a>--}}
{{--                                     </li>--}}
{{--                                </ul>--}}
{{--                           </div>--}}
{{--                      </li>--}}

{{--                      <li class="nav-item">--}}
{{--                           <a class="nav-link menu-arrow" href="#sidebarInvoice" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarInvoice">--}}
{{--                                <span class="nav-icon">--}}
{{--                                     <iconify-icon icon="solar:bill-list-bold-duotone"></iconify-icon>--}}
{{--                                </span>--}}
{{--                                <span class="nav-text"> Invoices </span>--}}
{{--                           </a>--}}
{{--                           <div class="collapse" id="sidebarInvoice">--}}
{{--                                <ul class="nav sub-navbar-nav">--}}
{{--                                     <li class="sub-nav-item">--}}
{{--                                          <a class="sub-nav-link" href="invoice-list.html">List</a>--}}
{{--                                     </li>--}}
{{--                                     <li class="sub-nav-item">--}}
{{--                                          <a class="sub-nav-link" href="invoice-details.html">Details</a>--}}
{{--                                     </li>--}}
{{--                                     <li class="sub-nav-item">--}}
{{--                                          <a class="sub-nav-link" href="invoice-add.html">Create</a>--}}
{{--                                     </li>--}}
{{--                                </ul>--}}
{{--                           </div>--}}
{{--                      </li>--}}
                    @if(auth()->guard('admin')->user()->hasPermission('read-settings'))
                      <li class="nav-item">
                           <a class="nav-link" href="settings.html">
                                <span class="nav-icon">
                                     <iconify-icon icon="solar:settings-bold-duotone"></iconify-icon>
                                </span>
                                <span class="nav-text"> Settings </span>
                           </a>
                      </li>
                         @endif

                      <li class="menu-title mt-2">Users</li>

                      <li class="nav-item">
                           <a class="nav-link" href="{{route('admin.profile.edit')}}">
                                <span class="nav-icon">
                                     <iconify-icon icon="solar:chat-square-like-bold-duotone"></iconify-icon>
                                </span>
                                <span class="nav-text"> Profile </span>
                           </a>
                      </li>
                         @if(auth()->guard('admin')->user()->hasPermission('read-roles'))

                      <li class="nav-item">
                           <a class="nav-link menu-arrow" href="#sidebarRoles" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarRoles">
                                <span class="nav-icon">
                                     <iconify-icon icon="solar:user-speak-rounded-bold-duotone"></iconify-icon>
                                </span>
                                <span class="nav-text"> Roles </span>
                           </a>
                           <div class="collapse" id="sidebarRoles">
                                <ul class="nav sub-navbar-nav">
                                     <ul class="nav sub-navbar-nav">
                                         @if(auth()->guard('admin')->user()->hasPermission('read-roles'))
                                          <li class="sub-nav-item">
                                               <a class="sub-nav-link" href="{{ route('admin.roles.index') }}">List</a>
                                          </li>
                                         @endif
                                             @if(auth()->guard('admin')->user()->hasPermission('create-roles'))
                                          <li class="sub-nav-item">
                                               <a class="sub-nav-link" href="{{ route('admin.roles.create') }}">Create</a>
                                          </li>
                                         @endif
                                     </ul>
                                </ul>
                           </div>
                      </li>
                         @endif
                     @if(auth()->guard('admin')->user()->hasPermission('read-roles'))
                      <li class="nav-item">
                           <a class="nav-link" href="{{ route('admin.permissions.index') }}">
                                <span class="nav-icon">
                                     <iconify-icon icon="solar:checklist-minimalistic-bold-duotone"></iconify-icon>
                                </span>
                                <span class="nav-text"> Permissions </span>
                           </a>
                      </li>
                         @endif

                         @if(auth()->guard('admin')->user()->hasPermission('read-admins'))

                         <li class="nav-item">
                           <a class="nav-link menu-arrow" href="#sidebarAdmins" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarCustomers">
                                <span class="nav-icon">
                                     <iconify-icon icon="solar:users-group-two-rounded-bold-duotone"></iconify-icon>
                                </span>
                                <span class="nav-text"> Admins </span>
                           </a>
                           <div class="collapse" id="sidebarAdmins">
                                <ul class="nav sub-navbar-nav">
                                     <li class="sub-nav-item">
                                          <a class="sub-nav-link" href="{{ route('admin.admins.index') }}">List</a>
                                     </li>
                                    @if(auth()->guard('admin')->user()->hasPermission('create-admins'))
                                    <li class="sub-nav-item">
                                         <a data-href="{{ route('admin.admins.create') }}" data-container="#hr-table-modal" type="button" class="sub-nav-link btn-modal" >
                                             Create
                                         </a>
                                     </li>
                                    @endif
                                </ul>
                           </div>
                      </li>
                      @endif

                     @if(auth()->guard('admin')->user()->hasPermission('read-customers'))

                     <li class="nav-item">
                         <a class="nav-link" href="{{route('admin.customers.index')}}">
                                <span class="nav-icon">
                                     <iconify-icon icon="solar:chat-square-like-bold-duotone"></iconify-icon>
                                </span>
                             <span class="nav-text"> Customers </span>
                         </a>
                     </li>
                    @endif
                 @if(auth()->guard('admin')->user()->hasPermission('read-sellers'))
                      <li class="nav-item">
                           <a class="nav-link menu-arrow" href="#sidebarSellers" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarSellers">
                                <span class="nav-icon">
                                     <iconify-icon icon="solar:shop-bold-duotone"></iconify-icon>
                                </span>
                                <span class="nav-text"> Sellers </span>
                           </a>
                           <div class="collapse" id="sidebarSellers">
                                <ul class="nav sub-navbar-nav">
                                    @if(auth()->guard('admin')->user()->hasPermission('read-sellers'))
                                     <li class="sub-nav-item">
                                          <a class="sub-nav-link" href="{{ route('admin.sellers.index') }}">List</a>
                                     </li>
                                    @endif
                                     @if(auth()->guard('admin')->user()->hasPermission('read-orders-sellers'))
                                         <li class="sub-nav-item">
                                            <a class="sub-nav-link" href="{{ route('admin.sellers.orders') }}">orders</a>
                                            </li>
                                        @endif

                                </ul>
                           </div>
                      </li>
                     @endif
                      <li class="menu-title mt-2">Other</li>
                       @if(auth()->guard('admin')->user()->hasPermission('read-coupons'))
                      <li class="nav-item">
                           <a class="nav-link menu-arrow" href="#sidebarCoupons" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarCoupons">
                                <span class="nav-icon">
                                     <iconify-icon icon="solar:leaf-bold-duotone"></iconify-icon>
                                </span>
                                <span class="nav-text"> Coupons </span>
                           </a>
                           <div class="collapse" id="sidebarCoupons">
                                <ul class="nav sub-navbar-nav">
                                    @if(auth()->guard('admin')->user()->hasPermission('read-coupons'))

                                    <li class="sub-nav-item">
                                          <a class="sub-nav-link" href="{{route('admin.coupons.index')}}">List</a>
                                     </li>
                                    @endif
                                        @if(auth()->guard('admin')->user()->hasPermission('create-coupons'))

                                            <li class="sub-nav-item">
                                             <a data-href="{{ route('admin.coupons.create') }}" data-container="#hr-table-modal" type="button" class="sub-nav-link btn-modal" >
                                                 Create
                                             </a>
                                            </li>
                                        @endif
                                </ul>
                           </div>
                      </li>
                      @endif
                     @if(auth()->guard('admin')->user()->hasPermission('read-contact-us'))
                         <li class="nav-item">
                             <a class="nav-link" href="{{route('admin.contact-us.index')}}">
                                <span class="nav-icon">
                                     <iconify-icon icon="solar:help-bold-duotone"></iconify-icon>
                                </span>
                                 <span class="nav-text"> Contact Us List </span>
                             </a>
                         </li>
                     @endif





                 </ul>
            </div>
       </div>
       <!-- ========== App Menu End ========== -->
