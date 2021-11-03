<footer class="footer-area footer-three" style="border-top: 5px solid black;">
    <div class="footer-widget pb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6 mt-5 mt-sm-0">
                    <div class="row justify-content-center">
                        <div class="col-6">
                            <div class="footer-logo-support d-md-flex align-items-end justify-content-between">
                                <div class="footer-logo d-flex align-items-end">
                                    <a class="mt-30" href="index.html"><img src="{{ asset('img/logo/omacoin-logo.png') }}" class="img-fluid" alt="Logo"></a>

                                    
                                </div> <!-- footer logo -->
                                
                                <!-- <div class="footer-support ">
                                    <span class="number mt-30">+8801234567890</span>
                                    <span class="mail mt-30">support@uideck.com</span>
                                </div> -->
                            </div> <!-- footer logo support -->
                            <div class="footer-logo-support d-md-flex">
                                <div class="footer-logo w-100">
                                    <ul class="social ml-0 mt-20 d-flex justify-content-between">
                                        <li><a class="whatsapp-chat text-success" href="whatsapp" ><i class="lni-whatsapp"></i></a></li>
                                        <!-- <li><a href="https://facebook.com/uideckHQ"><i class="lni-phone-handset"></i></a></li> -->
                                        <li><a href="#"><i class="lni-facebook-filled"></i></a></li>
                                        <li><a href="#"><i class="lni-twitter-original"></i></a></li>
                                        <li><a href="#"><i class="lni-instagram-original"></i></a></li>
                                        <li class="mr-0"><a href="#"><i class="lni-linkedin-original"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- <span class="number">+8801234567890</span>
                            <span class="mail">xxxx@xxx.xxx</span> -->
                        </div>
                        <div class="col-12 text-center">
                            <div class="footer-newsletter">
                                <h6 class="footer-title" style="font-size:1.2rem;">Newsletter Subscription</h6>
                                <div class="newsletter">
                                    <form action="#">
                                        <input type="text" placeholder="Your Email">
                                        <button disabled type="submit"><i class="lni-angle-double-right font-weight-bold text-blue"></i></button>
                                    </form>
                                </div>
                                <p class="text">Subscribe to our weekly newsletter to get up-to-date rates.</p>
                            </div> <!-- footer newsletter -->
                        </div>
                    </div>
                </div>
                <div class="align-self-center col-lg-2 col-md-6 col-sm-6 text-center mt-5 mt-lg-0">
                    <div class="footer-link">
                        <h6 class="footer-title" style="font-size:1.2rem;">Quick Links</h6>
                        <ul>
                            <li><a href="{{ route('register') }}">Register</a></li>
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <!-- <li><a href="#">Current Rates</a></li> -->
                            <li><a href="https://paxful.com/offer/s2VNohiq7ig">Buy Bitcoin</a></li>
                        </ul>
                    </div> <!-- footer link -->
                </div>
                <div class="align-self-center col-lg-2 col-md-6 col-sm-6 text-center mt-5 mt-lg-0">
                    <div class="footer-link">
                        <h4 class="footer-title" style="font-size:1.2rem;">Legal</h4>
                        <ul>
                            <li><a href="#">AML Policy</a></li>
                            <li><a href="#">Terms & Conditions</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul>
                    </div> <!-- footer link -->
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6" id="contact">
                    <div class="contact-form form-style-two">
                        <form action="{{ route('contact.form') }}" method="POST">
                            @csrf
                            
                            <div class="form-input mt-15">
                                <label>Name</label>
                                <div class="input-items default">
                                    <input name="name" type="text" placeholder="Name">
                                    <i class="lni-user"></i>
                                </div>
                            </div> <!-- form input -->
                            <div class="form-input mt-15">
                                <label>Email</label>
                                <div class="input-items default">
                                    <input name="email" type="text" placeholder="Email">
                                    <i class="lni-envelope"></i>
                                </div>
                            </div> <!-- form input -->
                            <div class="form-input mt-15">
                                <label>Message</label>
                                <div class="input-items default">
                                    <textarea name="message" placeholder="Message"></textarea>
                                    <i class="lni-pencil-alt"></i>
                                </div>
                            </div> <!-- form input -->
                            <div class="form-input standard-buttons mt-20">
                                <button type="submit" class="main-btn standard-two">Submit</button>
                            </div> <!-- form input -->
                        </form>
                    </div> <!-- contact form -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </div> <!-- footer widget -->

    <div class="footer-copyright bg-blue">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="copyright text-center">
                        <p class="text text-white">Copyright © 2021 Omacoin. Powered by <strong>Omacore Global Services</strong>. All Rights Reserved.</p>
                    </div>
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </div> <!-- footer copyright -->
</footer>


<!--====== BACK TOP TOP PART START ======-->

<a href="#" class="back-to-top"><i class="lni-chevron-up"></i></a>

<!--====== BACK TOP TOP PART ENDS ======-->