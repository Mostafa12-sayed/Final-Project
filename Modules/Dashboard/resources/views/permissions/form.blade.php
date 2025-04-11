

@php
    $title = $permission->id ? 'Edit Permission' : 'Create Permission';
@endphp


<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">
                {{ $title }}
            </h5>
        </div>
        <div class="modal-body">
            <form class="form"
                  action="{{ $permission->id ? route('admin.permissions.update', $permission->id) : route('admin.permissions.store') }}"
                  method="post" enctype="multipart/form-data">
                @csrf
                @if ($permission->id)
                    @method('PUT')
                @endif
                <div class="modal-body p-0">

                    <div class="mb-3">
                        <label for="code" class="form-label">Permission code</label>
                        <input type="text" id="code" name="name" class="form-control" placeholder="Enter Permission Name"
                               value="{{ old('name', $permission->name) }}" >
                    </div>
                    <div class="mb-3">
                        <label for="display_name" class="form-label">Permission Display Name</label>
                        <input type="text" id="display_name" name="display_name" class="form-control" placeholder="Enter Permission Display Name"
                               value="{{ old('display_name', $permission->display_name) }}" >
                    </div>
                    <div class="mb-3">
                        <label for="display_name" class="form-label">Permission Description </label>
                        <input type="text" id="display_name" name="description" class="form-control" placeholder="Enter Permission Description"
                               value="{{ old('description', $permission->description) }}" >
                    </div>
                </div>
                <div class="pt-4 d-flex justify-content-end gap-2">


                        <div class="col-lg-2">
                            <button type="submit" class="btn btn-outline-secondary w-100"> {{$permission->id ? 'Edit' : 'Create' }}</button>
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
