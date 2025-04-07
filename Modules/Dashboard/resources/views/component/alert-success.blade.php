<div class="alert alert-{{ $type ?? 'primary' }} alert-icon" role="alert">
        <div class="d-flex align-items-center">
            <div class="avatar-sm rounded bg-{{ $bg ?? 'primary' }} d-flex justify-content-center align-items-center fs-18 me-2 flex-shrink-0">
                <i class="bx bx-info-circle text-white"></i>
            </div>
            <div class="flex-grow-1">
                {{ $title ?? 'Success' }}
            </div>
        </div>
</div>
    