@extends('dashboard::layouts.master')
@section('title', 'Admins List')
@section('content')

    <div class="page-content">

        <!-- Start Container Fluid -->
        <div class="container-xxl">



            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center gap-1">
                            <h4 class="card-title flex-grow-1">All Admins List</h4>

                            <button data-href="{{ route('admin.admins.create') }}" data-container="#hr-table-modal" type="button" class="btn btn-primary btn-modal" >
                                Create Admins
                            </button>
                        </div>
                        <div>
                            <div class="table-responsive">
                                <table class="table align-middle mb-0 table-hover table-centered">
                                    <thead class="bg-light-subtle">
                                    <tr>
                                        <th>ID</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <td>Status</td>
                                        <th>Create by</th>
                                        <th>Updated by</th>

                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($admins->count()>0)
                                        @foreach ($admins as $admin )
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                                                            @if($admin->profile_picture)
                                                                <img src="{{ asset('storage/'. $admin->profile_picture) }}" alt="" class="avatar-md">
                                                            @endif
                                                        </div>
                                                        <p class="text-dark fw-medium fs-15 mb-0">{{ $admin->name }}</p>
                                                    </div>
                                                </td>
                                                <td>{{ $admin->email }}</td>
                                                <td>{{ optional($admin->role)->name  ?? 'N/A' }}</td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input change-admin-status" type="checkbox" role="switch" id="adminstatus{{ $admin->id }}" {{ $admin->status=="active" ? 'checked' : '' }} data-id="{{ $admin->id }}">
                                                    </div>
                                                </td>
                                                <td>{{ $admin->created_by ?? 'N/A' }}</td>
                                                <td>{{ $admin->updated_by ?? 'N/A' }}</td>

                                                <td>
                                                    <div class="d-flex gap-2">

                                                        <a data-href="{{ route('admin.admins.edit' , ['admin'=>$admin->id]) }}" data-container="#hr-table-modal" class="btn btn-soft-primary btn-sm btn-modal"><iconify-icon icon="solar:pen-2-broken" class="align-middle fs-18 "></iconify-icon></a>
                                                        <form id="delete-form-category-{{ $admin->id }}" action="{{ route('admin.category.destroy' ,['category'=>$admin->id]) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                        <button type="submit" class="btn btn-soft-danger btn-sm delete-item" data-form="delete-form-category-{{ $admin->id }}"><iconify-icon icon="solar:trash-bin-minimalistic-2-broken" class="align-middle fs-18"></iconify-icon></button>


                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7" class="text-center">No Category Found</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <!-- end table-responsive -->
                        </div>
                        <x-dashboard::paginate :items="$admins" />

                    </div>
                </div>
            </div>

        </div>
        <!-- End Container Fluid -->



    </div>
@endsection

@section('script')
<script>

    $(document).on('change', '.change-admin-status', function () {
        let adminId = $(this).data('id');
        let status = $(this).is(':checked') ? 'active' : 'inactive';

        $.ajax({
            url: '/admin/admins/update-status', // غيّر هذا حسب المسار في Laravel
            type: 'POST',
            data: {
                id: adminId,
                status: status,
                _token: $('meta[name="csrf-token"]').attr('content') // مهم
            },
            success: function (response) {
                console.log('Status updated successfully', response);
                // Optional: show a toast or alert
            },
            error: function (xhr) {
                console.error('Error updating status', xhr.responseText);
                // Optional: handle error, revert checkbox
            }
        });
    });

</script>


@endsection
