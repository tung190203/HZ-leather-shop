//Admin ***add product***
function uploadImage() {
    var input = document.querySelector('#imageInput');
    var preview = document.querySelector('#imagePreview');
    preview.style.display = "none";
    var file = input.files[0];
    var reader = new FileReader();

    reader.onload = function () {
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
    inputValue = inputValue.replace(/[^\d]/g, '');
    inputValue = inputValue.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    document.querySelector(inputId).value = inputValue;
}
function deleteItem(endpoint, itemId) {
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
//verify email ***verify***
let inputs = document.querySelectorAll('.verified');
let submitBtn = document.querySelector('#submitBtn');

inputs.forEach((input, index) => {
    input.addEventListener('input', (e) => {
        let inputValue = e.target.value.replace(/[^0-9]/g, '');
        e.target.value = inputValue;
        if (isAllInputsFilled()) {
            submitBtn.disabled = false;
        } else {
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
    return Array.from(inputs).every(input => input.value.trim() !== '');
}
//change image ***product detail***
var currentIndex = 0;
var firstImageSrc = document.getElementById('sync2').querySelector('img').src;
changeImage(firstImageSrc);
function changeImage(src) {
    document.getElementById('mainImage').src = src;
    clearInterval(autoChange);
    //nếu muốn auto chuyển ảnh thì bỏ comment dòng dưới
    //  autoChange = setInterval(autoChangeImage, 5000);
}
function autoChangeImage() {
    currentIndex = (currentIndex + 1) % 4;
    var autoChangeSrc = document.getElementById('sync2').querySelectorAll('img')[currentIndex].src;
    changeImage(autoChangeSrc);
}
var autoChange = setInterval(autoChangeImage, 5000);
// update profile ***profile***
function ChangeImage() {
    var input = document.getElementById('imageChange');
    var imagePre = document.getElementById('imagePre');
    var upContent = document.getElementById('uploadContent');
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            imagePre.src = e.target.result;
        };
        upContent.innerHTML = "Here is your new avatar";
        reader.readAsDataURL(input.files[0]);
    } else {

    }
}
//update product ***product detail***
function previewImage(input) {
    var imagePreviews = document.getElementById('oldPre');
    imagePreviews.innerHTML = '';
    for (var i = 0; i < input.files.length; i++) {
        var reader = new FileReader();
        var img = document.createElement('img');
        (function (currentImg) {
            reader.onload = function (e) {
                currentImg.src = e.target.result;
                currentImg.width = 150;
                currentImg.height = 150;
                currentImg.className = 'imagePrev mb-3 m-1 rounded';
                imagePreviews.appendChild(currentImg);
            };
        })(img);
        reader.readAsDataURL(input.files[i]);
    }
}
var mySwiper = new Swiper('#sync2', {
    slidesPerView: 4,
    spaceBetween: 10,
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
});
//pick color ***product detail***
document.addEventListener("DOMContentLoaded", function () {
    const renColor = document.querySelectorAll('#renColor');
    let colorSelected = document.querySelector('#colorPicker');
    renColor.forEach(function (option) {
        option.addEventListener('click', function () {
            const selectedColor = option.getAttribute('data-color');
            renColor.forEach(function (otherOption) {
                otherOption.classList.remove('selected');
                otherOption.style.border = 'none';
            });
            option.classList.add('selected');
            option.style.border = '1px solid #000';
            colorSelected.value = selectedColor;
            console.log(selectedColor);
        });
    });
});
//truncate text ***product detail***
const truncateText = document.querySelector('.truncateText');
const text = document.querySelector('#toggleButton');
text.addEventListener('click', function () {
    if (text.innerHTML === 'Read more') {
        text.innerHTML = 'Read less';
        truncateText.classList.remove('truncateText');
    } else {
        text.innerHTML = 'Read more';
        truncateText.classList.add('truncateText');
    }
});
// convert number to string ***cart***
function convertNumberToStringWithDot(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}
function convertAndDisplayValue(elementId, number) {
    var convertedValue = convertNumberToStringWithDot(number);
    document.getElementById(elementId).textContent = convertedValue + ' VND';
}
//filter price ***shop***
var timeoutId;
function updatePriceDisplay(value, elementId, filterFormId) {
    var element = document.getElementById(elementId);
    var filterForm = document.getElementById(filterFormId);
    var formattedPrice = formatValue(value) + " VND";
    element.innerHTML = formattedPrice;
    clearTimeout(timeoutId);
    timeoutId = setTimeout(function () {
        filterForm.submit();
    }, 1000);
}
function formatValue(value) {
    return value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}
//step wizard ***checkout***
function nextStep(button) {
    var currentStep = button.closest('.step').getAttribute('data-step');
    if (currentStep < 3) {
        document.querySelector('.step[data-step="' + currentStep + '"]').style.display = "none";
        currentStep++;
        document.querySelector('.step[data-step="' + currentStep + '"]').style.display = "block";
    }
}

function prevStep(button) {
    var currentStep = button.closest('.step').getAttribute('data-step');
    if (currentStep > 1) {
        document.querySelector('.step[data-step="' + currentStep + '"]').style.display = "none";
        currentStep--;
        document.querySelector('.step[data-step="' + currentStep + '"]').style.display = "block";
    }
}
//add to cart ***product detail***
function combineInputs() {
    var address1Value = document.getElementById('address1').value;
    var address2Value = document.getElementById('address2').value;
    // Gộp giá trị
    var combinedResult = address1Value + ',' + address2Value;
    // Đặt giá trị cho ô input thứ 3
    document.getElementById('result').value = combinedResult;
}
function saveInfor() {
    var first_name = document.getElementById('first_name').value;
    var last_name = document.getElementById('last_name').value;
    var phone = document.getElementById('phone').value;
    var address = document.getElementById('result').value;
    var fullName = document.getElementById('fullNameChecker');
    var addressChecker = document.getElementById('addressChecker');
    fullName.innerHTML = first_name + ' ' + last_name;
    addressChecker.innerHTML = address;
    var requestData = {
        first_name: first_name,
        last_name: last_name,
        phone: phone,
        address: address,
    };
    axios.post('/checkout/save-infor', requestData)
        .then(function (response) {
            console.log(response);
        })
        .catch(function (error) {
            console.error(error);
        });
}
function backToHome() {
    window.location.href = '/';
}





