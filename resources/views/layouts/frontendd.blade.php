<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.frontend.head')
    <style>
        * {
            font-family: 'Roboto', sans-serif;
        }

        .search-input {
            position: relative;
            padding: 15px 40px 15px 20px;
            width: 0;
            text-transform: uppercase;
            font-size: 16px;
            font-weight: 100;
            letter-spacing: 2px;
            border: none;
            border-radius: 5px;
            transition: all 0.4s ease;
            outline: none;
        }

        .search-input:focus {
            color: #525252;
            background: #f1f4f8;
            width: 300px;
        }

        .search-icon {
            position: relative;
            left: -37px;
            color: #8233c5;
        }

        .social {
            position: absolute;
            right: 35px;
            bottom: 35px;
        }

        .social img {
            display: block;
            width: 32px;
        }

        .cart {
            position: relative;
            display: flex;
            align-items: center;
            width: 28px;
            height: 28px;
            height: auto;
            overflow: hidden;
        }

        .cart .cart-icons {
            position: relative;
            top: 0;
            color: #8233c5;
            z-index: 1;
            /* font-size: 24px; */
            color: white;
        }

        .cart .count {
            position: absolute;
            top: 0;
            right: 0;
            z-index: 2;
            font-size: 11px;
            border-radius: 50%;
            background: #05c46b;
            width: 16px;
            height: 16px;
            line-height: 16px;
            display: block;
            text-align: center;
            color: white;
            font-family: "Roboto", sans-serif;
            font-weight: bold;
        }
    </style>
    @stack('styles')
</head>

<body>
    @include('partials.frontend.nav')


    @yield('content')


    <!-- Footer Start -->
    <div class="container-fluid bg-light mt-5 py-5">
        <div class="container pt-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-uppercase border-start border-5 border-primary ps-3 mb-4">Get In Touch</h5>
                    <p class="mb-4">No dolore ipsum accusam no lorem. Invidunt sed clita kasd clita et et dolor sed
                        dolor</p>
                    <p class="mb-2"><i class="bi bi-geo-alt text-primary me-2"></i>123 Street, New York, USA</p>
                    <p class="mb-2"><i class="bi bi-envelope-open text-primary me-2"></i>info@example.com</p>
                    <p class="mb-0"><i class="bi bi-telephone text-primary me-2"></i>+012 345 67890</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-uppercase border-start border-5 border-primary ps-3 mb-4">Quick Links</h5>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-body mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Home</a>
                        <a class="text-body mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>About
                            Us</a>
                        <a class="text-body mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Our
                            Services</a>
                        <a class="text-body mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Meet The
                            Team</a>
                        <a class="text-body mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Latest
                            Blog</a>
                        <a class="text-body" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Contact Us</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-uppercase border-start border-5 border-primary ps-3 mb-4">Popular Links</h5>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-body mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Home</a>
                        <a class="text-body mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>About
                            Us</a>
                        <a class="text-body mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Our
                            Services</a>
                        <a class="text-body mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Meet The
                            Team</a>
                        <a class="text-body mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Latest
                            Blog</a>
                        <a class="text-body" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Contact Us</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-uppercase border-start border-5 border-primary ps-3 mb-4">Newsletter</h5>
                    <form action="">
                        <div class="input-group">
                            <input type="text" class="form-control p-3" placeholder="Your Email">
                            <button class="btn btn-primary">Sign Up</button>
                        </div>
                    </form>
                    <h6 class="text-uppercase mt-4 mb-3">Follow Us</h6>
                    <div class="d-flex">
                        <a class="btn btn-outline-primary btn-square me-2" href="#"><i class="bi bi-twitter"></i></a>
                        <a class="btn btn-outline-primary btn-square me-2" href="#"><i class="bi bi-facebook"></i></a>
                        <a class="btn btn-outline-primary btn-square me-2" href="#"><i class="bi bi-linkedin"></i></a>
                        <a class="btn btn-outline-primary btn-square" href="#"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>
                <div class="col-12 text-center text-body">
                    <a class="text-body" href="">Terms & Conditions</a>
                    <span class="mx-1">|</span>
                    <a class="text-body" href="">Privacy Policy</a>
                    <span class="mx-1">|</span>
                    <a class="text-body" href="">Customer Support</a>
                    <span class="mx-1">|</span>
                    <a class="text-body" href="">Payments</a>
                    <span class="mx-1">|</span>
                    <a class="text-body" href="">Help</a>
                    <span class="mx-1">|</span>
                    <a class="text-body" href="">FAQs</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark text-white-50 py-4">
        <div class="container">
            <div class="row g-5">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-md-0">&copy; <a class="text-white" href="#">Your Site Name</a>. All Rights Reserved.
                    </p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="mb-0">Designed by <a class="text-white" href="https://htmlcodex.com">HTML Codex</a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary py-3 fs-4 back-to-top"><i class="bi bi-arrow-up"></i></a>


    @include('partials.frontend.script')

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        const toggleSearch = function(){
            if($('.js-search').is(':focus')){
                $('.js-search').blur()
            }else{
                $('.js-search').focus()
            }

            console.log($('.js-search').is(':focus'));
        }
    </script>
    @stack('scripts')
</body>

</html>