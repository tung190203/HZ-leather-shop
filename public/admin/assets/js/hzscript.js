function uploadImage() {
    var input = document.querySelector('#imageInput');
    var preview = document.querySelector('#imagePreview');
    preview.style.display = "none";
    var file = input.files[0];
    var reader = new FileReader();

    reader.onload = function() {
        preview.src = reader.result;
    };
    if (file) {
        reader.readAsDataURL(file);
        preview.style.display = "block";
        preview.style.width = "150px";
        preview.style.height = "150px";
        preview.style.borderRadius = "5px";
    }
}
function formatNumb(inputId) {
   let inputValue = document.querySelector(inputId).value;
   // Loại bỏ các ký tự không phải là số
   inputValue = inputValue.replace(/[^\d]/g, '');
   inputValue = inputValue.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
   document.querySelector(inputId).value = inputValue;
}
function deleteItem(endpoint,itemId) {
   if (confirm('Are you sure you want to delete this ?')) {
       fetch(`/admin/${endpoint}/delete/${itemId}`, {
           method: 'DELETE',
           headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
       })
       .then(response => {
           if (!response.ok) {
               throw new Error('Network response was not ok');
           }
           window.location.reload(); 
       })
       .catch(error => console.error('There was a problem with the fetch operation:', error));
   }
}

