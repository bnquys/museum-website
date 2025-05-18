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
			<?php
				use Museum\Object\Artifact;
				use Museum\Utils\HtmlManipulator;

				$artifacts = Artifact::getList();
				foreach($artifacts as $artifact):
			?>
			<img class="hover-link mv-scale gallery-img"
				src="<?= $artifact->imageUrl?>"
				alt="<?= $artifact->title?>"
				data-title="<?= $artifact->title?>"
				data-description="<?php
					$html = new HtmlManipulator($artifact->description);
					// $html->removeTag('p:first-of-type');
					echo htmlspecialchars($html->getHtml());
				?>"
				data-history="<?php
					$html = new HtmlManipulator($artifact->history);
					// $html->removeTag('p:first-of-type');
					echo htmlspecialchars($html->getHtml());
				?>"
				data-date="April 11, 2025"
				data-author="Dr. Hello, Superhuman"
			/>
			<?php endforeach; ?>
		</div>
	</div>

	<!-- Modal Template -->
	<div id="gallery-modal" class="modal">
		<div class="modal-box">
			<div class="row g-0 h-100">
				<!-- Left Picture -->
				<div class="col-md-8 modal-img">
					<img id="modal-image" src="" alt="pic" class="img-fluid h-100 w-100 object-fit-cover rounded-start">
				</div>

				<!-- Full Content -->
				<div class="col-md-4 p-4 modal-content-scroll">
					<h3 id="modal-title" class="mb-2 blog-title"></h3>
					<p id="modal-description" class="mb-3 text-muted"></p>
					<p id="modal-history" class="blog-lorem mb-3"></p>

					<div class="d-flex justify-content-between mt-4 flex-wrap blog-meta">
						<span>📅 April 21, 2025</span>
						<span>✍️ Dr. Liana Moss, Botanical Archivist</span>
					</div>
				</div>
			</div>
		</div>
	</div>

</section>

