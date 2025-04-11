
@extends('dashboard::layouts.master')
@section('title', 'Permisions')
@section('content')
          <div class="page-content">
               <!-- Start Container Fluid -->
               <div class="container-xxl">

                    <div class="row">
                         <div class="col-xl-12">
                              <div class="card">
                                   <div class="d-flex card-header justify-content-between align-items-center">
                                        <div class="d-flex align-items-center justify-content-between w-100">
                                             <h4 class="card-title">All Permissions List</h4>
                                            <button data-href="{{ route('admin.permissions.create') }}" data-container="#hr-table-modal" type="button" class="btn btn-primary btn-modal" >
                                               Create Permission
                                            </button>
                                        </div>
                                   </div>
                                   <div>
                                        <div class="table-responsive">
                                             <table class="table align-middle mb-0 table-hover table-centered">
                                                  <thead class="bg-light-subtle">
                                                       <tr>

                                                           <th>Display Name</th>
                                                           <th>Permission Name</th>
                                                           <th>Description</th>
                                                           <th>Action</th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                  @if($permissions->count() > 0)
                                                       @foreach($permissions as $permission)
                                                       <tr>
                                                           <td><p class="fs-15 mb-0">{{$permission->display_name}}</p></td>

                                                            <td><span class="badge bg-primary-subtle text-primary py-1 px-2 fs-11">{{$permission->name}}</span></td>

                                                           <td>{{$permission->description}}</td>
                                                            <td>
                                                                 <div class="d-flex gap-2">
                                                                      <button data-href="{{route('admin.permissions.edit' ,['permission' => $permission->id])}}" data-container="#hr-table-modal" class="btn btn-soft-primary btn-sm btn-modal"><iconify-icon icon="solar:pen-2-broken" class="align-middle fs-18"></iconify-icon></button>
                                                                     <form action="{{route('admin.permissions.destroy',['permission' => $permission->id])}}" method="POST" >
                                                                         @csrf
                                                                         @method('DELETE')
                                                                     <button type="submit" class="btn btn-soft-danger btn-sm"><iconify-icon icon="solar:trash-bin-minimalistic-2-broken" class="align-middle fs-18"></iconify-icon></button>
                                                                     </form>

                                                                 </div>
                                                            </td>
                                                       </tr>
                                                       @endforeach
                                                  @else
                                                       <tr>
                                                            <td colspan="4">No Permission Found</td>
                                                       </tr>
                                                  @endif
                                                  </tbody>
                                             </table>
                                        </div>
                                        <!-- end table-responsive -->
                                   </div>
                                  <x-dashboard::paginate :items="$permissions" />
                              </div>
                         </div>

                    </div>

               </div>
               <!-- End Container Fluid -->



          </div>
@endsection

