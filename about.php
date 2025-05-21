<?php
	$css = "about";
	$title = $banner = "About Us";
	include "components/first.php";
	include "components/navbar.php";
	include "components/banner.php";

	use Museum\Utils\HtmlManipulator;
	use Museum\Utils\JsonDataManager;
	
	$dataManager = new JsonDataManager('assets/data/museum_data.json');
	$about = $dataManager->read('museum_about');
?>

	<section class="container-fluid py-5 mb-5 bg-green-light">
		<div class="text-center">
			<h2 name="title" class="mv-bt section-title">Few words about our Museum</h2>
			<p class="text-gray mv-bt">Who are in extremely love with eco friendly system.</p>
		</div>
		<div
			class="d-flex flex-column flex-xl-row justify-content-center mt-5 mb-5"
		>
			<div id="frame" class="mb-5">
				<img
					src="<?= htmlspecialchars($about['image'])?>"
					alt=""
					class="shadow-lg mv-rl"
					id="banner-img"
				/>
			</div>
			<div
				class="shadow-lg img-responsive mt-5 mt-xl-0 mv-lr"
				style="padding: 6rem; color: var(--dark-cl)"
			>
				<?= $about['introduction']['title']?>
				<?php 
					$html = new HtmlManipulator($about['introduction']['content']);
					$html->addClass('p', 'mt-4');
					echo $html->getHtml();
				?>
			</div>
		</div>
	</section>

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

    <!-- About Section -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 name="title" class="mv-bt section-title">About History</h2>
                    <p class="lead mv-bt">Founded in 1985, Nature's Wonders Museum is dedicated to preserving and showcasing the incredible diversity of our planet's ecosystems. Our interactive exhibits bring you face-to-face with nature's marvels.</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mv-tb">
                    <div class="about-card">
                        <img src="assets/img/1039-5000x3337.jpg" alt="Rainforest Exhibit">
                        <div class="icon-box">
                            <i class="bi bi-tree"></i>
                        </div>
                        <div class="about-card-body text-center">
                            <h3>Rainforest Experience</h3>
                            <p>Walk through our immersive rainforest exhibit featuring live plants and animals from tropical ecosystems.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mv-tb">
                    <div class="about-card">
                        <img src="assets/img/599-2509x1673.jpg" alt="Rainforest Exhibit">
                        <div class="icon-box">
                            <i class="bi bi-water"></i>
                        </div>
                        <div class="about-card-body text-center">
                            <h3>Ocean Exploration</h3>
                            <p>Dive into our marine life exhibits featuring coral reefs, deep sea creatures, and interactive displays.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mv-tb">
                    <div class="about-card">
                        <img src="https://images.unsplash.com/photo-1585409677983-0f6c41ca9c3b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1469&q=80" alt="Conservation Center">
                        <div class="icon-box">
                            <i class="bi bi-recycle"></i>
                        </div>
                        <div class="about-card-body text-center">
                            <h3>Conservation Center</h3>
                            <p>Learn about our conservation efforts and how you can help protect endangered species and habitats.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 name="title" class="mv-bt section-title">Visitor Experiences</h2>
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
		include "components/footer.php";
	?>
	<script src="./assets/js/dropdown-menu.js"></script>
	<script src="assets/js/bootstrap.bundle.js"></script>
	<script src="assets/js/sip.js"></script>
</>
</html>
