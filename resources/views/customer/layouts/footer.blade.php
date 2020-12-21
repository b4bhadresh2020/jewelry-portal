<footer>
    <div class="footer-newsletter-wrapper">
        <div class="container">
            @if (session('subscribe_success'))
            <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>{{ session('subscribe_success') }}</strong>
            </div>
            @endif
            <form id="newsletter-form">
                @csrf
                <div class="footer-newsletter">
                    <div class="footer-newsletter-title">
                        <h4>NEWSLETTER SIGN-UP</h4>
                    </div>
                    <div class="newsletter-input">
                        <div class="input-group">
                            <input required type="email" name="email_subscribe" value="{{ old('email_subscribe') }}" class="form-control" placeholder="Enter your email">

                            <span class="input-group-btn">
                                <button id="newsletter-submit-button" class="btn" type="submit">Subscribe Now</button>
                            </span>
                        </div>
                        @error('email_subscribe')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="footer-secondblock">
        <div class="container">
            <div class="footer-wrapper">
                <div class="footer-inner">
                    <div class="row">
                        <div class="col-lg-3 footer-left-col">
                            <div class="footer-logo">
                                <img src="{{asset('assets')}}/img/footer-logo.png">
                                <p>Sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. labo dolore magna aliqua.</p>
                            </div>
                            <div class="footer-follow-us">
                                <div class="footer-title">
                                    <h4>Follow Us</h4>
                                </div>
                                <div class="footer-social">
                                    <ul>
                                        <li class="facebook"><a href="#" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                        <li class="twitter"><a href="#" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                        <li class="rss"><a href="#" target="_blank"><i class="fa fa-rss" aria-hidden="true"></i></a></li>
                                        <li class="youtube"><a href="#" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                                        <li class="googleplus"><a href="#" target="_blank"><i class="fa fa-google" aria-hidden="true"></i></a></li>
                                        <li class="pinterest"><a href="#" target="_blank"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 footerlinks_inner information">
                            <div class="information-inner">
                                <div class="footer-title">
                                    <h4>INFORMATION</h4>
                                </div>
                                <div class="footerlinks_ul">
                                    <ul>
                                        <li><a href="#">Specials</a></li>
                                        <li><a href="#">New products</a></li>
                                        <li><a href="#">Best sellers</a></li>
                                        <li><a href="#">Our stores</a></li>
                                        <li><a href="#">Contact us</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 footerlinks_inner account">
                            <div class="account-inner">
                                <div class="footer-title">
                                    <h4>YOUR ACCOUNT</h4>
                                </div>
                                <div class="footerlinks_ul">
                                    <ul>
                                        <li><a href="#">Personal info</a></li>
                                        <li><a href="#">Orders</a></li>
                                        <li><a href="#">Credit slips</a></li>
                                        <li><a href="#">Addresses</a></li>
                                        <li><a href="#">Vouchers</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 footerlinks_inner store">
                            <div class="store-inner">
                                <div class="footer-title">
                                    <h4>STORE INFORMATION</h4>
                                </div>
                                <div class="footerlinks_store">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i><span>Demo Shop United States</span></a></li>
                                        <li><a href="#"><i class="fa fa-phone" aria-hidden="true"></i><span>+91 123456789</span></a></li>
                                        <li><a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i><span>admin@gmail.com</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="footer-bottom-copy-right">
                        <a href="#">© 2020 - Ecommerce software by jewelry™</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="footer-bottom-payment-icon">
                        <img src="{{asset('assets')}}/img/visa.png">
                        <img src="{{asset('assets')}}/img/paypal.png">
                        <img src="{{asset('assets')}}/img/mastercard.png">
                        <img src="{{asset('assets')}}/img/jcb.png">
                        <img src="{{asset('assets')}}/img/americanexpress.png">
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="top-bottom">
    <button class="btn-unstyle top-bottom-inner" title="Bottom to Top">
    <i class="fa fa-angle-double-up" aria-hidden="true"></i>
    </button>
</div>
{{-- <div class="icon-right">
    <div class="icon-instagram">
        <div class="icon-text">
            <a href="#">
            <i class="fa fa-instagram" aria-hidden="true"></i>
            <span>Instagram</span>
            </a>
        </div>
    </div>
    <div class="icon-facebook">
        <div class="icon-text">
            <a href="#">
            <i class="fa fa-facebook" aria-hidden="true"></i>
            <span>Facebook</span>
            </a>
        </div>
    </div>
    <div class="icon-twitter">
        <div class="icon-text">
            <a href="#">
            <i class="fa fa-twitter" aria-hidden="true"></i>
            <span>Twitter</span>
            </a>
        </div>
    </div>
    <div class="icon-linkedin">
        <div class="icon-text">
            <a href="#">
            <i class="fa fa-linkedin" aria-hidden="true"></i>
            <span>LinkedIn</span>
            </a>
        </div>
    </div>
    <div class="icon-book">
        <div class="icon-text">
            <a href="#">
            <i class="fa fa-book" aria-hidden="true"></i>
            <span>BOOK APPOINTMENT</span>
            </a>
        </div>
    </div>
    <div class="icon-comments">
        <div class="icon-text">
            <a href="#">
            <i class="fa fa-comments-o" aria-hidden="true"></i>
            <span>Happy to Help</span>
            </a>
        </div>
    </div>
</div> --}}
