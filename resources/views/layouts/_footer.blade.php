<footer class="footer footer-dark">
    <div class="footer-middle">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-3">
                    <div class="widget widget-about">
                        <img src="{{ $getSettingsApp->getfooterLogo() }}" class="footer-logo" alt="Footer Logo" width="105" height="25">
                        <p>{{ $getSettingsApp->footer_description }}</p>

                        <div class="social-icons">
                            @if (!empty($getSettingsApp->facebook_link))
                                <a href="{{ $getSettingsApp->facebook_link }}" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                            @endif
                            
                            @if (!empty($getSettingsApp->twitter_link))
                                <a href="{{ $getSettingsApp->twitter_link }}" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                            @endif
                            
                            @if (!empty($getSettingsApp->instagram_link))
                                <a href="{{ $getSettingsApp->instagram_link }}" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                            @endif
                            
                            @if (!empty($getSettingsApp->youtube_link))
                                <a href="{{ $getSettingsApp->youtube_link }}" class="social-icon" title="Youtube" target="_blank"><i class="icon-youtube"></i></a>
                            @endif
                            
                            @if (!empty($getSettingsApp->pinterest_link))
                                <a href="{{ $getSettingsApp->pinterest_link }}" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="widget">
                        <h4 class="widget-title">Useful Links</h4>

                        <ul class="widget-list">
                            <li><a href="{{ url('') }}">Home</a></li>
                            <li><a href="{{ url('about') }}">About Us</a></li>
                            <li><a href="{{ url('faq') }}">FAQ</a></li>
                            <li><a href="{{ url('blog') }}">Blog</a></li>
                            <li><a href="{{ url('contact') }}">Contact us</a></li>
                            <li><a href="#signin-modal" data-toggle="modal">Log in</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="widget">
                        <h4 class="widget-title">Customer Service</h4>

                        <ul class="widget-list">
                            <li><a href="{{ url('payment-methods') }}">Payment Methods</a></li>
                            <li><a href="{{ url('money-back-guarantee') }}">Money-back guarantee!</a></li>
                            <li><a href="{{ url('returns') }}">Returns</a></li>
                            <li><a href="{{ url('shipping') }}">Shipping</a></li>
                            <li><a href="{{ url('terms-conditions') }}">Terms and conditions</a></li>
                            <li><a href="{{ url('privacy-policy') }}">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="widget">
                        <h4 class="widget-title">My Account</h4>

                        <ul class="widget-list">
                            <li><a href="{{ url('cart') }}">View Cart</a></li>
                            <li><a href="{{ url('checkout') }}">Checkout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <p class="footer-copyright">Copyright © {{ date('Y') }} Molla Store. All Rights Reserved.</p>
            <figure class="footer-payments">
                <img src="{{ $getSettingsApp->getfooterPayment() }}" alt="Payment methods" width="272" height="20">
            </figure>
        </div>
    </div>
</footer>