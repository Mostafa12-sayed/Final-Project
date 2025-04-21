

@php
    $title = $contact_us->id ? 'Replay Contact to ' . $contact_us->name : "Send MAIL" ;
@endphp


<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">
                {{ $title }}
            </h5>
        </div>
        <div class="modal-body">
            <form class="form" action="{{ $contact_us->id ? route('admin.contact-us.replay.store', $contact_us->id) : route('admin.contact-us.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="modal-body p-0">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input {{$contact_us->id ? 'disabled' : ''}}  type="text" id="name" name="name" class="form-control" placeholder="Enter name"
                               value="{{ old('name', $contact_us->name) }}" >
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input {{$contact_us->id ? 'disabled' : ''}} type="text" id="email" name="email" class="form-control" placeholder="Enter email"
                               value="{{ old('email', $contact_us->email) }}" >
                    </div>


                    <div class="mb-3">
                        <label for="message" class="form-label">Message </label>
                        <textarea required  type="text" id="message" name="message" class="form-control" placeholder="Enter Message"
                               value="{{ old('message', $contact_us->message) }}" ></textarea>
                    </div>

                </div>
                <div class="pt-4 d-flex justify-content-end gap-2">
                        <div class="col-lg-2">
                            <button type="submit" class="btn btn-outline-secondary w-100">Send</button>
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
