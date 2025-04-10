



<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">
                Edit Password
            </h5>
        </div>
        <div class="modal-body">
            <form class="form"
                  action="{{  route('admin.profile.change_password.update')  }}"
                  method="post">
                @csrf


                <div class="modal-body p-0">

                    <div class="mb-3">
                        <label for="code" class="form-label">Current Password</label>
                        <input type="text" id="code" name="current_password" class="form-control" placeholder="Enter current password">
                        <span class="text-danger error-current_password"></span>

                    </div>
                    <div class="mb-3">
                        <label for="new-password" class="form-label">New Password</label>
                        <input type="password" id="new-password" name="password" class="form-control" placeholder="Enter new password"
                                >

                    </div>
                    <div class="mb-3">
                        <label for="password-confirm" class="form-label">Permission Description </label>
                        <input type="password" id="password-confirm" name="password_confirmation" class="form-control" placeholder="Enter password confirmation"
                              >
                    </div>
                </div>
                <div class="pt-4 d-flex justify-content-end gap-2">
                    <div class="col-lg-4 " >
                        <button type="submit" class="btn btn-outline-secondary w-100"> Change Password </button>
                    </div>
                    <div class="col-lg-2 ">
                        <button type="button"  class="btn btn-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                    </div>


                </div>
            </form>

        </div>

    </div>
</div>

<script>
    $(document).ready(function() {
        $('.form').on('submit', function(e) {
            e.preventDefault();
            $('.text-danger').text('');
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').remove();
            var formData = new FormData(this);
            $.ajax({
                url: $(this).attr('action'),
                type: this.method,
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    sessionStorage.setItem('successMessage',response.message);
                    location.reload();

                },
                error: function(xhr) {
                    var errors = xhr.responseJSON.errors;

                    // عرض أخطاء التحقق (validation) مثل password و password_confirmation
                    if (errors) {
                        $.each(errors, function(key, value) {
                            var inputField = $('[name="' + key + '"]');
                            inputField.addClass('is-invalid');
                            inputField.after('<div class="invalid-feedback">' + value[0] + '</div>');
                        });
                    }

                    // ✅ هذا هو التصحيح:
                    if (xhr.status === 400 && xhr.responseJSON.message) {
                        $('.error-current_password').text(xhr.responseJSON.message);
                    }
                }
            });
        });
    });
</script>

{{--@include('dashboard::layouts.includes.formSubmit')--}}
