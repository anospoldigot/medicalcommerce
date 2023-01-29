<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="{{ asset('test/scss/main.css') }}">
<link rel="stylesheet" href="{{ asset('test/scss/style.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
    integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
    integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
    integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
<style>

    .chat-tab{
        position: fixed;
        bottom: 100px;
        right: 10px;
        z-index: 99;
        width: 400px;
    }


    .swiper {
        width: 100%;
    }
    #map { height: 180px; }
    a.blantershow-chat {
    /* background: #009688; */
    background: #fff;
    color: #404040;
    position: fixed;
    display: flex;
    font-weight: 400;
    justify-content: space-between;
    z-index: 98;
    bottom: 25px;
    right: 30px;
    font-size: 15px;
    padding: 10px 20px;
    border-radius: 30px;
    box-shadow: 0 1px 15px rgba(32, 33, 36, 0.28);
    }
    
    a.blantershow-chat svg {
    transform: scale(1.2);
    margin: 0 10px 0 0;
    }
    icon-shape {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    vertical-align: middle;
    }
    
    .icon-sm {
    width: 2rem;
    height: 2rem;
    
    }
    .swiper-button-prev {
    background-image:
    url("data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg'%20viewBox%3D'0%200%2027%2044'%3E%3Cpath%20d%3D'M0%2C22L22%2C0l2.1%2C2.1L4.2%2C22l19.9%2C19.9L22%2C44L0%2C22L0%2C22L0%2C22z'%20fill%3D'%234c71ae'%2F%3E%3C%2Fsvg%3E")
    !important;
    }
    
    .swiper-button-next {
    background-image:
    url("data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg'%20viewBox%3D'0%200%2027%2044'%3E%3Cpath%20d%3D'M27%2C22L27%2C22L5%2C44l-2.1-2.1L22.8%2C22L2.9%2C2.1L5%2C0L27%2C22L27%2C22z'%20fill%3D'%234c71ae'%2F%3E%3C%2Fsvg%3E")
    !important;
    }


    
    a,
    a:hover,
    a:focus,
    a:active {
        text-decoration: none;
        outline: none;
    }

    a,
    a:active,
    a:focus {
        color: #333;
        text-decoration: none;
        transition-timing-function: ease-in-out;
        -ms-transition-timing-function: ease-in-out;
        -moz-transition-timing-function: ease-in-out;
        -webkit-transition-timing-function: ease-in-out;
        -o-transition-timing-function: ease-in-out;
        transition-duration: .2s;
        -ms-transition-duration: .2s;
        -moz-transition-duration: .2s;
        -webkit-transition-duration: .2s;
        -o-transition-duration: .2s;
    }

    .ul {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    img {
        max-width: 100%;
        height: auto;
    }

    section {
        padding: 60px 0;
        /* min-height: 100vh;*/
    }

    .footer {
        background: #fff;
        padding-top: 80px;
        padding-bottom: 40px;
    }

    /*END FOOTER SOCIAL DESIGN*/
    .single_footer {}

    @media only screen and (max-width:768px) {
        .single_footer {
            margin-bottom: 30px;
        }
    }

    .single_footer h4 {
        color: #2D2C4C;
        margin-top: 0;
        margin-bottom: 25px;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 20px;
    }

    .single_footer h4::after {
        content: "";
        display: block;
        height: 2px;
        width: 40px;
        background: #2D2C4C;
        margin-top: 20px;
    }

    .single_footer p {
        color: #2D2C4C;
    }

    .single_footer ul {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .single_footer ul li {}

    .single_footer ul li a {
        color: #2D2C4C;
        -webkit-transition: all 0.3s ease 0s;
        transition: all 0.3s ease 0s;
        line-height: 36px;
        font-size: 15px;
        text-transform: capitalize;
    }

    .single_footer ul li a:hover {
        color: #ff3666;
    }

    .single_footer_address {}

    .single_footer_address ul {}

    .single_footer_address ul li {
        color: #2D2C4C;
    }

    .single_footer_address ul li span {
        font-weight: 400;
        color: #2D2C4C;
        line-height: 28px;
    }

    .contact_social ul {
        list-style: outside none none;
        margin: 0;
        padding: 0;
    }

    /*START NEWSLETTER CSS*/
    .subscribe {
        display: block;
        position: relative;
        margin-top: 15px;
        width: 100%;
    }

    .subscribe__input {
        background-color: #fff;
        border: solid #2D2C4C 1px;
        border-radius: 5px;
        color: #333;
        display: block;
        font-size: 15px;
        font-weight: 500;
        height: 60px;
        letter-spacing: 0.4px;
        margin: 0;
        padding: 0 150px 0 20px;
        text-align: center;
        text-transform: capitalize;
        width: 100%;
    }

    @media only screen and (max-width:768px) {
        .subscribe__input {
            padding: 0 50px 0 20px;
        }
    }

    .subscribe__btn {
        background-color: transparent;
        border-radius: 0 25px 25px 0;
        color: #01c7e9;
        cursor: pointer;
        display: block;
        font-size: 20px;
        height: 60px;
        position: absolute;
        right: 0;
        top: 0;
        width: 60px;
    }

    .subscribe__btn i {
        transition: all 0.3s ease 0s;
    }

    @media only screen and (max-width:768px) {
        .subscribe__btn {
            right: 0px;
        }
    }

    .subscribe__btn:hover i {
        color: #ff3666;
    }

    .button {
        padding: 0;
        border: none;
        background-color: transparent;
        -webkit-border-radius: 0;
        border-radius: 0;
    }

    /*END NEWSLETTER CSS*/

    /*START SOCIAL PROFILE CSS*/
    .social_profile {
        margin-top: 40px;
    }

    .social_profile ul {
        list-style: outside none none;
        margin: 0;
        padding: 0;
    }

    .social_profile ul li {
        float: left;
    }

    .social_profile ul li a {
        text-align: center;
        border: 0px;
        text-transform: uppercase;
        transition: all 0.3s ease 0s;
        margin: 0px 5px;
        font-size: 18px;
        color: #2D2C4C;
        border-radius: 30px;
        width: 50px;
        height: 50px;
        line-height: 50px;
        display: block;
        border: 1px solid #2D2C4C;
    }

    @media only screen and (max-width:768px) {
        .social_profile ul li a {
            margin-right: 10px;
            margin-bottom: 10px;
        }
    }

    @media only screen and (max-width:480px) {
        .social_profile ul li a {
            width: 40px;
            height: 40px;
            line-height: 40px;
        }
    }

    .social_profile ul li a:hover {
        background: #2D2C4C;
        border: 1px solid #2D2C4C;
        color: #fff;
        border: 0px;
    }

    /*END SOCIAL PROFILE CSS*/
    .copyright {
        margin-top: 70px;
        padding-top: 40px;
        color: #2D2C4C;
        font-size: 15px;
        border-top: 1px solid #2D2C4C;
        text-align: center;
    }

    .copyright a {
        color: #01c7e9;
        transition: all 0.2s ease 0s;
    }

    .copyright a:hover {
        color: #ff3666;
    }
</style>