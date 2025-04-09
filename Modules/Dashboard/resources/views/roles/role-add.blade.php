@extends('dashboard::layouts.master')
@section('title', 'Roles Add')
@section('content')
<div class="page-content">

     <!-- Start Container Fluid -->
     <div class="container-xxl">

          <div class="row">
               <div class="col-lg-12">
                    <div class="card ">
                         <div class="card-header">
                              <h4 class="card-title">Roles Information</h4>
                         </div>
                         <form class="form" action="{{ $resource->id?route('admin.roles.update',$resource->id):route('admin.roles.store') }}" method="post" enctype="multipart/form-data">
                              @csrf
                              @if ($resource->id)
                                  @method('PUT')
                              @endif
                         <div class="card-body">
                              <div class="row">
                                   <div class="col-lg-6">
                                        
                                             <div class="mb-3">
                                                  <label for="roles-name" class="form-label">Roles Name</label>
                                                  <input type="text" id="roles-name" class="form-control" placeholder="Role name" name="name" required
                                                  value="{{ old('name', $resource->name ?? '') }}">
                                             </div>
                                        
                                   </div>
                                   <div class="col-lg-6">
                              

                                        <div class="mb-3">
                                             <label for="display_name" class="form-label">Roles Name</label>
                                             <input type="text" id="display_name" class="form-control" placeholder="Role display name"  name="display_name" required
                                                value="{{ old('display_name', $resource->display_name ?? '') }}">
                                        </div>
                                    </div>
                
                                    <div class="col-md-12 ">
                                        <div class="mb-3">
                                            <label>Description</label>
                                            <input type="text" class="form-control" name="description"
                                                value="{{ old('description', $resource->description ?? '') }}">
                                        </div>
                                    </div>
                              
                                  
                                   <div class="col-lg-6">
                                        <p>Status</p>
                                        <div class="d-flex gap-2 align-items-center">
                                             <div class="form-check">
                                                  <input class="form-check-input" type="radio" name="role_status" id="flexRadioDefault1" checked="">
                                                  <label class="form-check-label" for="flexRadioDefault1">
                                                       Active
                                                  </label>
                                             </div>
                                             <div class="form-check">
                                                  <input class="form-check-input" type="radio" name="role_status" id="flexRadioDefault2">
                                                  <label class="form-check-label" for="flexRadioDefault2">
                                                       In Active
                                                  </label>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="row">
                            <div class="" style="margin-top: 20px!important">
                                <div class="card-header d-flex align-items-center justify-content-between" style="padding: 15px!important">
                                    <h3>Permisions</h3>
                                    <label class="d-block form-check form-switch py-2" for="CheckAllPerm">
                                        <input type="checkbox" class="form-check-input" id="CheckAllPerm "> Select All
                                    </label>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        @foreach ($permissions as $category => $listPermissions)
                                        <div class="col-md-4 " >
                                            <div class="card">
                                                <div class="card-header bg-secondary text-white p-1">
                                                    <div class="d-flex justify-content-between">
                                                        <b class="d-flex align-items-center justify-content-between">{{$category  }}</b>
                                                        <label for="" class="form-check form-switch py-2">
                                                            <input type="checkbox" class="me-2 ms-2 form-check-input selectedBoxPerm" onchange="checkAll(this )" data-category="{{ $category }}" id="{{ $category }}">
            
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <ul class="w3-ul sub-list">
                                                        @foreach($listPermissions as $permission)
                                                        <li style="border-bottom: 0px "  >
                                                            <label class="d-block"></label>
                                                                @php $old = old('permissions') @endphp
                                                                <label class="d-flex align-items-center justify-content-between flex-row- form-check form-switch py-1 flex-row-reverse" for="chk-ani-{{ $permission->id }}">
                                                              
                                                                
                                                                    <input class="form-check-input selectedBoxPerm {{ $category }} checkbox w3-check"
                                                                           id="chk-ani-{{ $permission->id }}"
                                                                           type="checkbox"
                                                                           name="permissions[]"
                                                                           value="{{ $permission->id }}"
                                                                           {{ isset($old) ? (in_array($permission->id , old('permissions')) ? 'checked' : '') : '' }}
                                                                           {{ isset($rolePermissions) ? (in_array($permission->id , $rolePermissions) ? 'checked' : '') : '' }}
                                                                           data-bs-original-title=""
                                                                           title="">
                                                                           <b>{{ app()->getLocale() == 'ar' ? $permission->description : $permission->display_name }}</b>
                                                                </label>
                                                                
                                                            </label>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
            
                                        </div>
                                        @endforeach
                                    </div>
            
            
                                </div>
                            </div>
            
            
                        </div>
                   
                        <div class="card-footer border-top">
                             <button type="submit" class="btn btn-primary">{{$resource->id ? 'Edit' : 'Create'}} Role</button>
                        </div>
                    </div>
               </form>
                </div>
      
          </div>

          
     </div>



 
 

</div>

@endsection

@section('script')
<script>
     // if all inputs of checkbox is checked make select all checkbox checked
     $('#CheckAllPerm').on('click', function() {
         if($(this).prop('checked') === true) {
             $('.selectedBoxPerm').prop('checked', true);
 
         }else {
             $('.selectedBoxPerm').prop('checked', false);
         }
     });
 
     function checkAll(el ){
         var category = $(el).data('category');
         if($(el).prop('checked') === true) {
             $('.'+category).prop('checked', true);
         }else {
             $('.'+category).prop('checked', false);
         }
     }
 </script>
 @endsection