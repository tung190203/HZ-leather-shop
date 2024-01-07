//Admin
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
//Client
//verify email
let inputs = document.querySelectorAll('.verified');
let submitBtn = document.querySelector('#submitBtn');

inputs.forEach((input, index) => {
    input.addEventListener('input', (e) => {
        // Chỉ giữ lại ký tự số
        let inputValue = e.target.value.replace(/[^0-9]/g, '');
        e.target.value = inputValue;
        if(isAllInputsFilled()){
            submitBtn.disabled = false;
        }else{
            submitBtn.disabled = true;
        }
    });
    input.addEventListener('keyup', (e) => {
        if (e.keyCode === 8 && index !== 0 && e.target.value === '') {
            inputs[index - 1].focus();
        } else if (e.keyCode >= 48 && e.keyCode <= 57 && index !== inputs.length - 1) {
            inputs[index + 1].focus();
        }
    });
});
function isAllInputsFilled() {
    // Kiểm tra xem tất cả các ô đều có giá trị hay không
    return Array.from(inputs).every(input => input.value.trim() !== '');
}




