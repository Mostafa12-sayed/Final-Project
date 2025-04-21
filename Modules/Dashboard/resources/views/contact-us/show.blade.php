

@php
    $title = 'Contact Us ' . $contact_us->name;
@endphp


<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">
                {{ $title }}
            </h5>
        </div>
        <div class="modal-body">

                <div class="modal-body p-0">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name : <strong>{{ $contact_us->name }}</strong></label>

                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Send Date : <strong>{{ $contact_us->created_at->format('d-m-Y') }}</strong></label>

                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Email : <strong>{{ $contact_us->email }}</strong></label>

                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Subject : <strong>{{ $contact_us->subject }}</strong></label>

                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Message : </label>
                        <div class="form-control" style="height: 100px; overflow: auto;">   {{ $contact_us->message }} </div>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Reply : </label>
                        <div class="form-control" style="height: 100px; overflow: auto;">   {{ $contact_us->reply }} </div>
                    </div>



                </div>
                <div class="pt-4 d-flex justify-content-end gap-2">

                        <div class="col-lg-2">
                            <button type="button"  class="btn btn-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                        </div>


                </div>

        </div>

    </div>
</div>

@include('dashboard::layouts.includes.formSubmit')
