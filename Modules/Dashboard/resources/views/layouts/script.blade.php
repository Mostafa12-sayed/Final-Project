<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script src="{{ asset('vendor/flasher/flasher.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>


function setupImageUpload(inputId, previewContainerId) {
    const input = document.getElementById(inputId);
    const previewContainer = document.getElementById(previewContainerId);

    input.addEventListener('change', function (event) {
        const files = event.target.files;

        // Remove old preview if exists
        previewContainer.innerHTML = '';

        Array.from(files).forEach((file) => {
            const reader = new FileReader();
            reader.onload = function (e) {
                const colDiv = document.createElement('div');
                colDiv.className = "col-md-3 position-relative mb-3";

                const imgElement = document.createElement('img');
                imgElement.src = e.target.result;
                imgElement.className = "img-fluid rounded";
                imgElement.style.maxHeight = "200px";

                const removeBtn = document.createElement('button');
                removeBtn.className = "btn btn-sm btn-danger position-absolute top-0 end-0 m-1";
                removeBtn.innerHTML = "&times;";
                removeBtn.onclick = () => {
                    colDiv.remove();
                    // Optionally, handle file removal from input here as well
                };

                colDiv.appendChild(imgElement);
                colDiv.appendChild(removeBtn);
                previewContainer.appendChild(colDiv);
            };
            reader.readAsDataURL(file);
        });
    });
}
$(document).on('click', '.btn-modal', function (e) {
    console.log($(this).data('href'));
    e.preventDefault();
    console.log("done");

    var container = $(this).data('container');
    console.log(container);

    $.ajax({
        url: $(this).data('href'),
        dataType: 'html',
        success: function (result) {
            $(container)
                .html(result)
                .modal('show');
        },
    });
});

$('.delete-item').on('click', function(e) {
    e.preventDefault();
    var url = $(this).data('url');
    var id = $(this).data('id');
    const formId = $(this).data('form');

    const form = document.getElementById(formId);
    if (!form) {
        alert("Error: A form with ID '" + formId + "' was not found.")
        console.error('Form with ID "' + formId + '" not found!');
        return;
    }
    Swal.fire({
        title: "Delete Confirmation",
        text: "Are you sure you want to delete this item?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: "Delete",
        cancelButtonText: "Cancel"
    }).then((result) => {
        if (result.isConfirmed) {
            // window.location.href = url;
            form.submit();
        }
    });
});



    // setupImageUpload('imageInput1', 'imagePreviewContainer1');
</script>


