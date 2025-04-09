@extends('dashboard::layouts.master')
@php
     $title =   $category->id ? 'Edit' : 'Add' ;
     
@endphp
@section('title', "Category " .$title)
@section('content')

          <div class="page-content">

               <!-- Start Container Fluid -->
               <div class="container-xxl">

                    <div class="row">
                         <div class="col-xl-12 col-lg-12 ">
                              
                              <form action="{{ $category->id ?  route('admin.category.update' , ['category' =>$category->id]): route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                                   @csrf
                                   @if($category->id)
                                        @method('PUT')
                                   @endif
                                   <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Add Thumbnail Photo</h4>
                                        </div>
                                    
                                        <div class="card-body">
                                            <div class="image-upload-area text-center border p-4" style="cursor: pointer;" onclick="document.getElementById('imageInput1').click();">
                                                <i class="bx bx-cloud-upload fs-48 text-primary"></i>
                                                <h3 class="mt-4">Drop your images here, or <span class="text-primary">click to browse</span></h3>
                                                <span class="text-muted fs-13">
                                                    1600 x 1200 (4:3) recommended. PNG, JPG and GIF files are allowed
                                                </span>
                                                <input type="file" name="image" id="imageInput1" accept="image/png, image/jpeg, image/gif" style="display: none;">
                                            </div>
                                    
                                            <div id="imagePreviewContainer1" class="row mt-3">
                                                @if(isset($category) && $category->image)
                                                    <div class="col-md-3 position-relative mb-3" id="oldImagePreview">
                                                        <img src="{{ asset('storage/' . $category->image) }}" class="img-fluid rounded" style="max-height: 200px;">
                                                        <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1" onclick="removeOldImage()">×</button>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    
                              <div class="card">
                                   <div class="card-header">
                                        <h4 class="card-title">General Information</h4>
                                   </div>
                                   <div class="card-body">
                                        <div class="row">
                                             <div class="col-lg-6">
                                                
                                                       <div class="mb-3">
                                                            <label for="category-title" class="form-label">Category Title</label>
                                                            <input type="text" name="name" id="category-title" class="form-control" placeholder="Enter Title" required value="{{ old('name' , $category->name) }}">
                                                            @if($errors->has('name'))
                                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                                            @endif
                                                       </div>
                                                  
                                             </div>

                                             <div class="col-lg-6">
                                               
                                                       <label for="parent" class="form-label">Follow Category Parent (Optional)</label>
                                                       <select class="form-control" name="parent_id" id="parent" data-choices data-choices-groups data-placeholder="Select Parent Category">
                                                            <option value="">Select Category Parent</option>
                                                            @foreach ($categories as $item) 
                                                            <option value="{{ $item->id }}" @if($category->id) 
                                                                 {{ $item->id == $category->parent_id ? 'selected' : '' }} @endif>
                                                                 
                                                                 {{ $item->name }}</option>
                                                                 
                                                            @endforeach
                                                      
                                                       </select>
                                                       @if($errors->has('parent_id'))
                                                            <span class="text-danger">{{ $errors->first('parent_id') }}</span>
                                                       @endif
                                                  
                                             </div>
                                             <div class="col-lg-12">
                                                
                                                  <div class="mb-3">
                                                       <label for="category-code" class="form-label">Category Code</label>
                                                       <input type="text" name="code" id="category-code" class="form-control" placeholder="Enter Code" required value="{{ old('code' , $category->code) }}">
                                                       @if($errors->has('code'))
                                                           <span class="text-danger">{{ $errors->first('code') }}</span>
                                                       @endif
                                                  </div>
                                             
                                              </div>

                                             <div class="col-lg-12">
                                                  <div class="mb-0">
                                                       <label for="description" class="form-label">Description</label>
                                                       <textarea name="description" class="form-control bg-light-subtle" id="description" rows="7" placeholder="Type description">{{old('description' , $category->description)}}</textarea>
                                                       @if($errors->has('description'))
                                                            <span class="text-danger">{{ $errors->first('description') }}</span>
                                                       @endif
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                       
                              <div class="p-3 bg-light mb-3 rounded">
                                   <div class="row justify-content-end g-2">
                                        <div class="col-lg-2">
                                             <button type="submit" class="btn btn-outline-secondary w-100">Save Change</button>
                                        </div>
                                        <div class="col-lg-2">
                                             <a href="{{ route('admin.dashboard') }}" class="btn btn-primary w-100">Cancel</a>
                                        </div>
                                   </div>
                              </div>
                              </form>
                         </div>
                    </div>

               </div>
               <!-- End Container Fluid -->

              

          </div>
@endsection