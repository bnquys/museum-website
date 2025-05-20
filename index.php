<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
    
    $title = "Home";
	include "components/first.php";
    include "components/navbar.php";
    include "components/carousel-slide.php";
	include "components/function-quote.php";
?>

<!-- Stats Section -->
<section class="stats-section">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-6 mv-rl">
                <div class="stat-item">
                    <div class="stat-number">38</div>
                    <div class="stat-label">Years Established</div>
                </div>
            </div>
            <div class="col-md-3 col-6 mv-rl">
                <div class="stat-item">
                    <div class="stat-number">1.2M</div>
                    <div class="stat-label">Annual Visitors</div>
                </div>
            </div>
            <div class="col-md-3 col-6 mv-rl">
                <div class="stat-item">
                    <div class="stat-number">500+</div>
                    <div class="stat-label">Species Exhibited</div>
                </div>
            </div>
            <div class="col-md-3 col-6 mv-rl">
                <div class="stat-item">
                    <div class="stat-number">15</div>
                    <div class="stat-label">Conservation Projects</div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
    include "components/upcoming-events.php";
    include "components/ongoing-exhibitions-cards.php";
?>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="mb-4 mv-rl">Ready to Explore Nature's Wonders?</h2>
                <p class="lead mb-5 mv-rl">Plan your visit today and immerse yourself in the beauty of our natural world.</p>
                <a href="ticket.php" class="btn btn-cta btn-lg mv-rl">Book Tickets Now</a>
            </div>
        </div>
    </div>
</section>

<?php
    include "components/latest-blog.php";
    include "components/gallery.php";
?>

<!-- Testimonials Section -->
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <h2 name="title" class="mv-bt section-title">Our Visitor Experiences</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mv-tb">
                <div class="testimonial-card text-center">
                    <img src="https://randomuser.me/api/portraits/women/32.jpg" class="testimonial-img" alt="Visitor">
                    <h4>Sarah Johnson</h4>
                    <p class="text-muted">"The rainforest exhibit took my breath away. It felt like being transported to the Amazon!"</p>
                    <div class="text-warning">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mv-tb">
                <div class="testimonial-card text-center">
                    <img src="https://randomuser.me/api/portraits/men/75.jpg" class="testimonial-img" alt="Visitor">
                    <h4>Michael Chen</h4>
                    <p class="text-muted">"My kids loved the interactive displays. We spent the whole day exploring and learning."</p>
                    <div class="text-warning">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-half"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mv-tb">
                <div class="testimonial-card text-center">
                    <img src="https://randomuser.me/api/portraits/women/63.jpg" class="testimonial-img" alt="Visitor">
                    <h4>Emma Rodriguez</h4>
                    <p class="text-muted">"The conservation programs are inspiring. It's wonderful to see a museum making real impact."</p>
                    <div class="text-warning">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
    include "components/footer.php";
	include "components/last.php";
?>