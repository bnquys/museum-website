<section id="blog" class="container-fluid py-6 ">
	<div class="container">
		<div class="mb-6">
			<h2 name="title" class="text-center mv-bt">Latest From Our Blog</h2>
			<p class="text-center text-gray fw-light mv-bt">
				Lorem ipsum dolor sit amet, consectetur adipisicing
				elit, sed do eiusmod tempor incididunt ut labore et
				dolore magna aliqua.
			</p>
		</div>
		<div id="blog-content" class="row">
			<?php
				use Museum\Object\Blog;

				$blogs = Blog::getListBlog(4);
				foreach($blogs as $blog):
			?>
			<div class="col-md-3 mv-tb">
				<a href="#">
					<div
						class="card border-0 rounded-0 bg-transparent"
					>
						<div class="blog-img-container">
							<img
								src="<?= $blog->imgUrl?>"
								class="card-img-top rounded-0"
								alt="..."
							/>
						</div>
						<div class="card-body pb-0 px-0 rounded-0">
							<p
								name="date"
								class="d-inline p-1 text-white fw-light pe-2 ps-2"
							>
								<?= $blog->uploadDate?>
							</>
							<h5 class=" mt-3">
								<?= $blog->title?>
							</h5>
							<p class="text-end text-gray fst-italic me-1 mt-3">
								— By <?= $blog->username?>
							<i class="fas fa-feather-alt"></i></p>
						</div>
					</div>
				</a>
			</div>
			<?php endforeach;?>
		</div>
	</div>
</section>