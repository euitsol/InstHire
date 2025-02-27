<footer class="footer bg-dark text-light">
    <div class="footer-top py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="footer-widget">
                        <a class="footer-brand d-inline-block mb-4" href="{{ route('home') }}">
                            <span class="brand-text">Inst<span class="text-primary">Hire</span></span>
                        </a>
                        <p class="mb-4">Connecting talent with opportunity through a comprehensive job portal that brings together job seekers, educational institutes, and employers.</p>
                        <div class="social-links">
                            <a href="#" class="social-link" title="Follow us on LinkedIn">
                                <i class="bi bi-linkedin"></i>
                            </a>
                            <a href="#" class="social-link" title="Follow us on Twitter">
                                <i class="bi bi-twitter"></i>
                            </a>
                            <a href="#" class="social-link" title="Follow us on Facebook">
                                <i class="bi bi-facebook"></i>
                            </a>
                            <a href="#" class="social-link" title="Follow us on Instagram">
                                <i class="bi bi-instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <div class="footer-widget">
                        <h5 class="widget-title">Quick Links</h5>
                        <ul class="footer-links">
                            <li>
                                <i class="bi bi-chevron-right"></i>
                                <a href="#">Browse Jobs</a>
                            </li>
                            <li>
                                <i class="bi bi-chevron-right"></i>
                                <a href="#">Job Fairs</a>
                            </li>
                            <li>
                                <i class="bi bi-chevron-right"></i>
                                <a href="{{ route('institute.login') }}">For Institutes</a>
                            </li>
                            <li>
                                <i class="bi bi-chevron-right"></i>
                                <a href="#">For Employers</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <h5 class="widget-title">Contact Info</h5>
                        <ul class="footer-contact">
                            <li>
                                <i class="bi bi-envelope"></i>
                                <div>
                                    <span>Email Address:</span>
                                    <a href="mailto:contact@insthire.com">contact@insthire.com</a>
                                </div>
                            </li>
                            <li>
                                <i class="bi bi-telephone"></i>
                                <div>
                                    <span>Phone Number:</span>
                                    <a href="tel:+15551234567">+1 (555) 123-4567</a>
                                </div>
                            </li>
                            <li>
                                <i class="bi bi-geo-alt"></i>
                                <div>
                                    <span>Location:</span>
                                    <p class="mb-0">123 Business Avenue, Suite 100<br>Silicon Valley, CA 94000</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <h5 class="widget-title">Newsletter</h5>
                        <p class="mb-4">Subscribe to our newsletter for the latest job opportunities and career insights.</p>
                        <form class="footer-newsletter">
                            <div class="input-group">
                                <input type="email" class="form-control" placeholder="Your email address">
                                <button class="btn btn-primary" type="submit">
                                    <i class="bi bi-send"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom py-3">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0">&copy; {{ date('Y') }} InstHire. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <ul class="footer-bottom-links">
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms of Service</a></li>
                        <li><a href="#">Cookie Policy</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
