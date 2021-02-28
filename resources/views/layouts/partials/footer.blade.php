<footer id="footer">
    <div class="footer-content">
        <div class="container">
            <div class="row">
                <!-- <div class="col-lg-5">
                    <div class="widget">

                        <div class="widget-title">Tutoya e-Commerce</div>
                        <p class="mb-5">Built with love in Surabaya, Indonesia<br>
                            All rights reserved. Copyright © 2019. TUTOYA.</p>
                        <a href="https://themeforest.net/item/polo-responsive-multipurpose-html5-template/13708923" class="btn btn-inverted" target="_blank">Purchase Now</a>
                    </div>
                </div> -->
                @isset($footer)
                <div class="{{ $footer->newsletter || array_key_exists('newsletter', $footer->contents) ? 'col-lg-8' : 'col-lg-12'}}">
                    <div class="row">
                        @php $count = count($footer->contents['default']) @endphp
                        @foreach($footer->contents['default'] as $content)
                            <div class="col-lg-{{ floor(12/$count) }}">
                                <div class="widget">
                                    <div class="widget-title">{{ $content['title'] }}</div>
                                    {!! $content['description'] !!}
                                </div>
                            </div>
                        @endforeach
                        <!-- <div class="col-lg-3">
                            <div class="widget">
                                <div class="widget-title">Company</div>
                                <ul class="list">
                                    <li><a href="#">About Us</a></li>
                                    <li><a href="#">Tutoya Update</a></li>
                                    <li><a href="#">Tutoya Gift</a></li>
                                    <li><a href="#">Newest Promo</a></li>
                                    <li><a href="#">Distributor List</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="widget">
                                <div class="widget-title">Support</div>
                                <ul class="list">
                                    <li><a href="#">Payment</a></li>
                                    <li><a href="#">Payment Confirmation</a></li>
                                    <li><a href="#">Order Status</a></li>
                                    <li><a href="#">Tracking</a></li>
                                    <li><a href="#">How To</a></li>
                                    <li><a href="#">Contact Us</a></li>
                                    <li><a href="#">FAQ</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-4">
                            <div class="widget">
                                <div class="widget-title">Customer Care</div>
                                Buka Setiap Hari<br />Jam: 8.00 - 17.30<br />Telp: +62 123456<br />Email: cs@domain.com
                                <ul class="list-icon">
                                    <li><i class="fa fa-map-marker-alt"></i> Buka Setiap Hari</li>
                                    <li><i class="fa fa-clock"></i> Jam: 8.00 - 17.30</li>
                                    <li><i class="fa fa-phone"></i> Telp: +62 123456</li>
                                    <li><i class="fa fa-envelope"></i> Email: cs@domain.com</li>
                                </ul>
                                <ul class="list-icon">
                                    <li><i class="fa fa-map-marker-alt"></i> Surabaya, Indonesia </li>
                                    <li><i class="fa fa-phone"></i> (123) 456-7890 </li>
                                    <li><i class="fa fa-envelope"></i> <a href="mailto:cs@tutoya.com">cs@tutoya.com</a> </li>
                                    <li><i class="fa fa-clock"></i> Every Day: <strong>08:00 - 22:00</strong> </li>
                                </ul>
                            </div>
                        </div> -->
                    </div>
                </div>
                @if($footer->newsletter || array_key_exists('newsletter', $footer->contents))
                    @foreach($footer->contents['newsletter'] as $content)
                    <div class="col-lg-4">
                        <div class="widget clearfix widget-newsletter">
                            <h4 class="widget-title"><i class="fa fa-envelope"></i> {{ $content['title'] }}</h4>
                            {!! $content['description'] !!}
                            <form class="widget-subscribe-form p-r-40" action="include/subscribe-form.php" role="form" method="post" novalidate="novalidate">

                            <div class="input-group">
                                <input aria-required="true" name="widget-subscribe-form-email" class="form-control required email" placeholder="Enter your Email" type="email">
                                <span class="input-group-btn">
                                <button type="submit" id="widget-subscribe-submit-button" class="btn"><i class="fa fa-paper-plane"></i></button>
                                </span> </div>
                            </form>
                        </div>
                    </div>
                    @endforeach
                @endif
                @endisset
            </div>
            <!-- <div class="row">
                <div class="col-xl-4 col-lg-6 col-md-12">
                    <div class="widget clearfix widget-newsletter">
                        <h4 class="widget-title"><i class="fa fa-envelope"></i> Sign Up For a Newsletter</h4>
                        <p>Weekly breaking news, analysis and cutting edge advices on job searching.</p>
                        <form class="widget-subscribe-form p-r-40" action="include/subscribe-form.php" role="form" method="post" novalidate="novalidate">

                        <div class="input-group">
                            <input aria-required="true" name="widget-subscribe-form-email" class="form-control required email" placeholder="Enter your Email" type="email">
                            <span class="input-group-btn">
                            <button type="submit" id="widget-subscribe-submit-button" class="btn"><i class="fa fa-paper-plane"></i></button>
                            </span> </div>
                        </form>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
    <div class="copyright-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <!-- Social icons -->
                    <div class="social-icons social-icons">
                        @isset($footer)
                        <ul>
                            <li class="social-facebook"><a href="{{ $footer->facebook }}" target="_BLANK"><i class="fab fa-facebook-f"></i></a></li>
                            <li class="social-instagram"><a href="{{ $footer->instagram }}" target="_BLANK"><i class="fab fa-instagram"></i></a></li>
                            <li class="social-twitter"><a href="{{ $footer->twitter }}" target="_BLANK"><i class="fab fa-twitter"></i></a></li>
                            <li class="social-youtube"><a href="{{ $footer->youtube }}" target="_BLANK"><i class="fab fa-youtube"></i></a></li>
                            <!-- <li class="social-whatsapp"><a href="{{ $footer->whatsapp }}" target="_BLANK"><i class="fab fa-whatsapp"></i></a></li> -->
                            <!-- <li class="social-rss"><a href="#" target="_BLANK"><i class="fa fa-rss"></i></a></li> -->
                            <!-- <li class="social-vimeo"><a href="#" target="_BLANK"><i class="fab fa-vimeo"></i></a></li> -->
                            <!-- <li class="social-pinterest"><a href="#" target="_BLANK"><i class="fab fa-pinterest"></i></a></li> -->
                            <!-- <li class="social-gplus"><a href="#" target="_BLANK"><i class="fab fa-google-plus-g"></i></a></li> -->
                        </ul>
                        @endisset
                    </div>
                    <!-- end: Social icons -->
                </div>

                <div class="col-lg-6 text-right">
                    <div class="copyright-text">
                        @isset($footer) {{ $footer->copyright }} @endisset
                        COPYRIGHT ©️ 2021 Pasarama , All rights Reserved
                        <!-- &copy; 2019 Today's Modern e-Commerce. All Rights Reserved. -->
                        <!-- <a href="//www.inspiro-media.com" target="_blank" rel="noopener"> TUTOYA</a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>