<section
	class="container-fluid border-0 py-6"
	style="background-color: rgb(5, 30, 4)"
>
	<div class="container pt-1">
		<h2 name="title" class="text-center text-white mv-bt">
			Our Exhibition Gallery
		</h2>
		<p class="text-center text-gray fw-light mv-bt pb-5">
			Lorem ipsum dolor sit amet, consectetur adipisicing elit,
			sed do eiusmod tempor incididunt ut labore et dolore magna
			aliqua.
		</p>

		<div class="img-gallery">
			<img class="hover-link mv-scale gallery-img"
				src="assets/img/g1.jpg"
				alt="The Rosetta Stone"
				data-title="The Rosetta Stone"
				data-description="A granodiorite stele inscribed with a decree issued at Memphis, Egypt in 196 BC."
				data-history="Discovered in 1799 by French soldiers during Napoleon's campaign in Egypt. Ceded to Britain in 1801 after the British defeated the French. Has been housed in the British Museum since 1802. Key to deciphering Egyptian hieroglyphs."
			/>
			<!-- repeat for other imgs -->
			<img
				class="hover-link mv-scale gallery-img"
				src="assets/img/g2.jpg"
				alt=""
			/>
			<img
				class="hover-link mv-scale gallery-img"
				src="assets/img/g3.jpg"
				alt=""
			/>
			<img
				class="hover-link mv-scale gallery-img"
				src="assets/img/g4.jpg"
				alt=""
			/>
			<img
				class="hover-link mv-scale gallery-img"
				src="assets/img/g5.jpg"
				alt=""
			/>
			<img
				class="hover-link mv-scale gallery-img"
				src="assets/img/g6.jpg"
				alt=""
			/>
			<img
				class="hover-link mv-scale gallery-img"
				src="assets/img/g7.jpg"
				alt=""
			/>
			<img
				class="hover-link mv-scale gallery-img"
				src="assets/img/g8.jpg"
				alt=""
			/>
			<img
				class="hover-link mv-scale gallery-img"
				src="assets/img/g9.jpg"
				alt=""
			/>
			<img
				class="hover-link mv-scale gallery-img"
				src="assets/img/g10.jpg"
				alt=""
			/>
			<img
				class="hover-link mv-scale gallery-img"
				src="assets/img/g11.jpg"
				alt=""
			/>
			<img
				class="hover-link mv-scale gallery-img"
				src="assets/img/g12.jpg"
				alt=""
			/>
		</div>
	</div>

	<div id="galleryModal" class="gallery-modal">
		<!-- <div class="gallery-modal-box"> -->
			<div class="img-wrapper pb-5 pt-5">
				<img id="modalImg" src="assets/img/g5.jpg" alt="" />
				<div class="img-title">
					<span id="modalTitle"></span>
				</div>
			</div>
			<div class="tag-left" id="descTag">Description</div>
			<div class="tag-right" id="histTag">History</div>
			<div class="info-box" id="infoBox"></div>
			<span class="close-modal" onclick="closeGalleryModal()">✖</span>
		<!-- </div> -->
	</div>

</section>

<script>
	const galleryImgs = document.querySelectorAll('.gallery-img');
	const modal = document.getElementById('galleryModal');
	const modalImg = document.getElementById('modalImg');
	const modalTitle = document.getElementById('modalTitle');
	const infoBox = document.getElementById('infoBox');
	const descTag = document.getElementById('descTag');
	const histTag = document.getElementById('histTag');

	galleryImgs.forEach(img => {
		img.addEventListener('click', () => {
			modalImg.src = img.src;
			modalTitle.textContent = img.dataset.title;
			modalImg.dataset.description = img.dataset.description || '';
			modalImg.dataset.history = img.dataset.history || '';
			infoBox.style.display = 'none';
			modal.style.display = 'flex';
			document.body.style.overflow = 'hidden';
		});
	});

	descTag.addEventListener('mouseenter', () => {
		infoBox.textContent = modalImg.dataset.description;
		infoBox.style.display = 'block';
	});

	histTag.addEventListener('mouseenter', () => {
		infoBox.textContent = modalImg.dataset.history;
		infoBox.style.display = 'block';
	});

	[descTag, histTag].forEach(tag => {
		tag.addEventListener('mouseleave', () => {
			infoBox.style.display = 'none';
		});
	});

	function closeGalleryModal() {
		modal.style.display = 'none';
		document.body.style.overflow = 'auto';
	}
</script>