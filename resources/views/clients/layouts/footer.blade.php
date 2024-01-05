
<div class="container">
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-7">
            <div class="footer__about">
                <div class="footer__logo">
                    <a href=""><img src="./assets/img/logo.png" alt="" style="max-width:40%"></a>
                </div>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                cilisis.</p>
                <div class="footer__payment">
                    <a href="#"><img src="./assets/img/payment/payment-1.png" alt=""></a>
                    <a href="#"><img src="./assets/img/payment/payment-2.png" alt=""></a>
                    <a href="#"><img src="./assets/img/payment/payment-3.png" alt=""></a>
                    <a href="#"><img src="./assets/img/payment/payment-4.png" alt=""></a>
                    <a href="#"><img src="./assets/img/payment/payment-5.png" alt=""></a>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-5">
            <div class="footer__widget">
                <h6>Quick links</h6>
                <ul>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Blogs</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">FAQ</a></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-4">
            <div class="footer__widget">
                <h6>Account</h6>
                <ul>
                    <li><a href="#">My Account</a></li>
                    <li><a href="#">Orders Tracking</a></li>
                    <li><a href="#">Checkout</a></li>
                    <li><a href="#">Wishlist</a></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-4 col-md-8 col-sm-8">
            <div class="footer__newslatter">
                <h6>NEWSLETTER</h6>
                <form action="#">
                    <input type="text" placeholder="Email">
                    <button type="submit" class="site-btn">Subscribe</button>
                </form>
                <div class="footer__social">
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-youtube-play"></i></a>
                    <a href="#"><i class="fa fa-instagram"></i></a>
                    <a href="#"><i class="fa fa-pinterest"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Search Begin -->
<div class="search-model">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="search-close-switch">+</div>
        <form class="search-model-form">
            <input type="text" id="search-input" placeholder="Search here.....">
        </form>
    </div>
</div>
<!-- Search End -->

<!-- Js Plugins -->
<script src="{{asset('assets/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('assets/js/jquery-ui.min.js')}}"></script>
<script src="{{asset('assets/js/mixitup.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.countdown.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.slicknav.js')}}"></script>
<script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.nicescroll.min.js')}}"></script>
<script src="{{asset('assets/js/main.js')}}"></script>
<script>
     $(document).ready(function(){
        setInterval(function(){
            $("#carouselExample").carousel("next");
        }, 5000);
    });
</script>