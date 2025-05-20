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

			const artifactIdInput = document.getElementById('comment-artifact-id');
			if (artifactIdInput) {
				artifactIdInput.value = this.getAttribute('data-id'); // cần thêm data-id vào thẻ img
			}

			const commentContainer = document.getElementById('comment-container');
			const commentsRaw = this.getAttribute('data-comments');
			commentContainer.innerHTML = ''; // clear cũ

			if (commentsRaw) {
				try {
					const comments = JSON.parse(commentsRaw);
					if (comments.length === 0) {
						commentContainer.innerHTML = '<p class="text-white-50">No comments yet.</p>';
					} else {
						comments.forEach(c => {
							const div = document.createElement('div');
							div.className = 'mb-2 p-2 bg-dark text-white rounded';
							div.innerHTML = `<strong>${c.Username}</strong> (${c.CreatedAt}):<br>${c.Text}`;
							commentContainer.appendChild(div);
						});
					}
				} catch (err) {
					commentContainer.innerHTML = '<p class="text-danger">Failed to load comments.</p>';
				}
			}


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