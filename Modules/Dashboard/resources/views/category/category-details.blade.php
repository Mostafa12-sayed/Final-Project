@php
    $title = 'Category Details - ' . $category->name;
@endphp

<style>
    .modal-content {
        overflow-y: auto;
        max-height: 600px;
        overflow-x: hidden;
    }
</style>

<div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">{{ $title }}</h5>
        </div>
        <div class="modal-body p-0">
            <div class="row p-3">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Name: <strong>{{ $category->name }}</strong></label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Slug: <strong>{{ $category->slug }}</strong></label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status: <strong>{{ $category->status ? 'Active' : 'Inactive' }}</strong></label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Parent Category:
                            <strong>{{ optional($category->parent)->name ?? 'N/A' }}</strong>
                        </label>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Created At:
                            <strong>{{ $category->created_at->format('d-m-Y') }}</strong>
                        </label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description:</label>
                        <div class="form-control" style="height: 100px; overflow: auto;">
                            {{ $category->description ?? 'N/A' }}
                        </div>
                    </div>
                    @if ($category->image)
                        <div class="mb-3">
                            <label class="form-label">Image:</label>
                            <div>
                                <img src="{{ asset($category->image) }}" alt="Category Image" class="img-thumbnail" style="width: 80px; height: 80px;">
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="pt-4 d-flex justify-content-end gap-2 px-3 mb-3">
                <button type="button" class="btn btn-primary w-25" data-bs-dismiss="modal" aria-label="Close">Close</button>
            </div>
        </div>
    </div>
</div>
