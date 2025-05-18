<?php
    $css = "blog_gallery";
    $title = $banner = "Gallery";
    include "components/first.php"; 
    include "components/navbar.php";
    include "components/banner.php";
    include "components/gallery.php";
?>


<script>
	document.querySelectorAll('.gallery-img').forEach(img => {
		img.addEventListener('click', function() {
			const modal = document.getElementById('gallery-modal');
			const modalImage = document.getElementById('modal-image');
			const modalTitle = document.getElementById('modal-title');
			const modalDescription = document.getElementById('modal-description');
			const modalHistory = document.getElementById('modal-history');
			const modalMeta = document.querySelector('.blog-meta');

			modalImage.src = this.src;
			modalTitle.textContent = this.getAttribute('data-title');

			modalDescription.innerHTML = this.getAttribute('data-description');
			modalHistory.innerHTML = this.getAttribute('data-history');
			
			const modalDate = this.getAttribute('data-date');
			const modalAuthor = this.getAttribute('data-author');
			modalMeta.innerHTML = `
				<span>📅 ${modalDate}</span>
				<span>✍️ ${modalAuthor}</span>
			`;

			modal.style.display = 'flex';
			document.body.style.overflow = 'hidden';

			modal.addEventListener('click', function handler(e) {
				if (e.target === modal) {
					closeModal();
					modal.removeEventListener('click', handler);
				}
			});
		});
	});

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