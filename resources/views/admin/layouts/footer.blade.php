<script src="{{asset('admin/assets/libs/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('admin/assets/js/sidebarmenu.js')}}"></script>
<script src="{{asset('admin/assets/js/app.min.js')}}"></script>
<script src="{{asset('admin/assets/libs/apexcharts/dist/apexcharts.min.js')}}"></script>
<script src="{{asset('admin/assets/libs/simplebar/dist/simplebar.js')}}"></script>
<script src="{{asset('admin/assets/js/dashboard.js')}}"></script>
<script src="{{asset('admin/assets/libs/dropzone/dist/min/dropzone.min.js')}}"></script>  
<script>
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
 </script>