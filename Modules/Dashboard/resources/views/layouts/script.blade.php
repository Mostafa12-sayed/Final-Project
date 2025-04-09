<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script src="{{ asset('vendor/flasher/flasher.min.js') }}"></script>

<script>
//  function setupImageUpload(inputId, previewContainerId) {
//         const input = document.getElementById(inputId);
//         const previewContainer = document.getElementById(previewContainerId);

//         input.addEventListener('change', function (event) {
//             const files = event.target.files;

//             // Remove old preview if exists
//             previewContainer.innerHTML = '';

//             Array.from(files).forEach((file) => {
//                 const reader = new FileReader();
//                 reader.onload = function (e) {
//                     const colDiv = document.createElement('div');
//                     colDiv.className = "col-md-3 position-relative mb-3";

//                     const imgElement = document.createElement('img');
//                     imgElement.src = e.target.result;
//                     imgElement.className = "img-fluid rounded";
//                     imgElement.style.maxHeight = "200px";

//                     const removeBtn = document.createElement('button');
//                     removeBtn.className = "btn btn-sm btn-danger position-absolute top-0 end-0 m-1";
//                     removeBtn.innerHTML = "&times;";
//                     removeBtn.onclick = () => {
//                         input.value = '';
//                         colDiv.remove();
//                     };

//                     colDiv.appendChild(imgElement);
//                     colDiv.appendChild(removeBtn);
//                     previewContainer.appendChild(colDiv);
//                 };
//                 reader.readAsDataURL(file);
//             });
//         });
//     }


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

    // setupImageUpload('imageInput1', 'imagePreviewContainer1');
</script>


