<?php
	use Museum\Utils\JsonDataManager;
	$dataManager = new JsonDataManager(__DIR__ . '/../assets/data/museum_data.json');
	$museum = $dataManager->read('museum_info');
?>

<footer class="container-fluid py-5">
	<div class="container">
		<!-- Stay with email -->
		<div class="row align-items-center mb-5">
			<div class="col-lg-6 mb-4 mb-lg-0">
				<h3 class="footer-heading mv-lr">STAY WITH US</h3>
				<p class="text-white-50">Subscribe to our newsletter for the latest updates and events.</p>
			</div>
			<div class="col-lg-6">
				<form method="POST" action="portal.php?pg=signup" class="d-flex">
					<input 
						type="email" 
						class="form-control email-input me-2" 
						id="InputEmail" 
						name="subscribeEmail"
						placeholder="Your email address"
						required
					/>
					<button type="submit" name="subscribe" class="submit-btn">
						<i class="fas fa-paper-plane me-2"></i> Subscribe
					</button>
				</form>
			</div>
		</div>
		
		<!-- Information -->
		<div class="row mb-5">
			<!-- Left: Navigation Links -->
			<div class="col-lg-3 col-md-6 mb-4 mb-md-0">
				<h4 class="footer-heading mv-lr">Quick Links</h4>
				<ul class="list-unstyled d-flex flex-column justify-content-between h-75">
					<li><a href="#" class="footer-link"><i class="fas fa-chevron-right me-2"></i> Visit</a></li>
					<li><a href="contact.php" class="footer-link"><i class="fas fa-chevron-right me-2"></i> Contact</a></li>
					<li><a href="about.php" class="footer-link"><i class="fas fa-chevron-right me-2"></i> About</a></li>
					<li><a href="ticket.php" class="footer-link"><i class="fas fa-chevron-right me-2"></i> Ticket</a></li>
					<li><a href="blog.php" class="footer-link"><i class="fas fa-chevron-right me-2"></i> Blog</a></li>
					<li><a href="gallery.php" class="footer-link"><i class="fas fa-chevron-right me-2"></i> Gallery</a></li>
				</ul>
			</div>
			
			<!-- Right: Information Sections -->
			<div class="col-lg-9">
				<div class="row">
					<!-- Address -->
					<div class="col-md-4 mb-4 mb-md-0 mv-lr">
						<div class="info-box">
							<h4 class="footer-heading"><i class="fas fa-map-marker-alt me-2"></i> Address</h4>
							<address class="text-white-50"><?= $museum['address']?></address>
							<a href="contact.php" class="btn btn-sm mt-3" style="background-color: var(--normal-cl); color: white;">
								<i class="fas fa-ticket me-2"></i> Buy Ticket
							</a>
						</div>
					</div>
					
					<!-- Contact -->
					<div class="col-md-4 mb-4 mb-md-0 mv-lr">
						<div class="info-box">
							<h4 class="footer-heading"><i class="fas fa-phone-alt me-2"></i> Contact</h4>
							<p class="text-white-50">
								Phone: <?= $museum['phone']?><br>
								Email: <?= $museum['email']?>
							</p>
							<a href="contact.php" class="btn btn-sm mt-3" style="background-color: var(--normal-cl); color: white;">
								<i class="fas fa-envelope me-2"></i> Contact Us
							</a>
						</div>
					</div>
					
					<!-- Hours -->
					<div class="col-md-4 mv-lr">
						<div class="info-box">
							<h4 class="footer-heading"><i class="fas fa-clock me-2"></i> Hours</h4>
							<p class="text-white-50 mb-1"><strong>Museum & Store:</strong></p>
							<p class="text-white-50 small mb-1"><?= str_replace(',', '<br>', $museum['summary'])?></p>
							<a href="contact.php" class="btn btn-sm mt-3" style="background-color: var(--normal-cl); color: white;">
								<i class="fas fa-ticket me-2"></i> Ticket now!
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<!-- Museum Branding and Social -->
		<div class="row align-items-center">
			<div class="col-md-6 mb-4 mb-md-0">
				<div class="d-flex align-items-center">
					<img 
						src="assets/img/earth.png" 
						alt="Museum Logo" 
						class="museum-logo me-3"
						width="120"
					/>
					<div>
						<h3 class="fs-1 mb-0 fw-" style="color: var(--normal-light-cl);">Our</h3>
						<h2 class="fs-1 mb-0 fw-bold" style="letter-spacing: 2px;">MUSEUM</h2>
					</div>
				</div>
			</div>
			
			<div class="col-md-6 text-md-end">
				<h4 class="footer-heading d-inline-block me-3 mv-lr">Follow Us</h4>
				<a href="#" class="social-icon mv-bt"><i class="fab fa-facebook-f"></i></a>
				<a href="#" class="social-icon mv-bt"><i class="fab fa-twitter"></i></a>
				<a href="#" class="social-icon mv-bt"><i class="fab fa-instagram"></i></a>
				<a href="#" class="social-icon mv-bt"><i class="fab fa-youtube"></i></a>
				<a href="#" class="social-icon mv-bt"><i class="fab fa-tiktok"></i></a>
			</div>
		</div>
		
		<hr class="divider">
		
		<!-- Bottom Row -->
		<div class="row align-items-center">
			<div class="col-md-8 mb-3 mb-md-0">
				<a href="#" class="policy-link">Privacy Policy</a>
				<a href="#" class="policy-link">Social Media Policy</a>
				<a href="#" class="policy-link">Terms of Use</a>
				<a href="#" class="policy-link">Accessibility</a>
				<a href="#" class="policy-link">Careers</a>
			</div>
			<div class="col-md-4 text-md-end">
				<p class="text-white-50 mb-0">
					<i class="far fa-copyright me-1"></i> 2025 Our Museum. All Rights Reserved.
				</p>
			</div>
		</div>
	</div>
</footer>

<script>
	// Add animation to elements on scroll
	document.addEventListener('DOMContentLoaded', function() {
		const observer = new IntersectionObserver((entries) => {
			entries.forEach(entry => {
				if (entry.isIntersecting) {
					entry.target.classList.add('animate__animated', 'animate__fadeInUp');
				}
			});
		}, {
			threshold: 0.1
		});
		
		document.querySelectorAll('.info-box, .footer-heading, .museum-logo').forEach(box => {
			observer.observe(box);
		});
	});
</script>
