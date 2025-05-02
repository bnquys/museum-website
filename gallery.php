<?php
    $css = "blog_gallery";
    $title = $name = "Gallery";
    include "components/first.php"; 
    include "components/navbar.php";
    include "components/banner.php";
    include "components/gallery.php";
?>


<script>
	// Open the modal with dynamic content
	document.querySelectorAll('.gallery-img').forEach(img => {
		img.addEventListener('click', function() {
			const modal = document.getElementById('gallery-modal');
			const modalImage = document.getElementById('modal-image');
			const modalTitle = document.getElementById('modal-title');
			const modalDescription = document.getElementById('modal-description');
			const modalHistory = document.getElementById('modal-history');
			const modalMeta = document.querySelector('.blog-meta');

			// Set modal content from clicked image's data attributes
			modalImage.src = this.src;
			modalTitle.textContent = this.getAttribute('data-title');
			modalDescription.textContent = this.getAttribute('data-description');
			modalHistory.textContent = this.getAttribute('data-history');
			
			// Update modal metadata with date and author
			const modalDate = this.getAttribute('data-date');
			const modalAuthor = this.getAttribute('data-author');
			modalMeta.innerHTML = `
				<span>📅 ${modalDate}</span>
				<span>✍️ ${modalAuthor}</span>
			`;

			// Show modal
			modal.style.display = 'flex';
			document.body.style.overflow = 'hidden';

			// Close modal when clicking outside
			modal.addEventListener('click', function handler(e) {
				if (e.target === modal) {
					closeModal();
					modal.removeEventListener('click', handler);
				}
			});
		});
	});

	// Close the modal
	function closeModal() {
		const modal = document.getElementById('gallery-modal');
		if (!modal) return;
		modal.style.display = 'none';
		document.body.style.overflow = 'auto';
	}
</script>
<?php
    include "components/latest-blog.php";
    include "components/footer.php";
    include "components/last.php";
?>