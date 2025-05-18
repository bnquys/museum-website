<?php
$css = "blog_gallery";
$title = $banner = "Blog";
include "components/first.php";
include "components/navbar.php";
include "components/banner.php";
use Museum\Object\Blog;
use Museum\Utils\HtmlManipulator;

?>

        <?php
            $blogs = Blog::getListBlog();
        ?>
        <div class="container my-5">
            <div class="row g-4">
                <?php foreach($blogs as $blog):?>
                <div
                    class="col-12 d-flex blog-card"
                    onclick="openModal('<?= $blog->id?>')"
                >
                    <img
                        src="<?= $blog->imgUrl?>"
                        class="img-fluid rounded"
                        alt="Blog Pic"
                        style="width: 150px; height: 150px; object-fit: cover"
                    />

                    <div class="ms-3 flex-grow-1 blog-brief d-flex flex-column rounded-end">
                        <h5 class="blog-title"><?= $blog->title?></h5>
                        <?php
                            $htmlSummary = new HtmlManipulator($blog->summary);
                            $htmlSummary->addClass('p', 'blog-summary text-muted flex-grow-1');
                            echo $htmlSummary->getHtml();
                        ?>
                        <div class="d-flex justify-content-between flex-wrap blog-meta">
                            <span>📅 <?= $blog->uploadDate?></span>
                            <span>✍️ <?= $blog->username?></span>
                        </div>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
        </div>
        
        <?php foreach($blogs as $blog):?>
        <div id="<?= $blog->id?>" class="modal">
            <div class="modal-box">
                <div class="row g-0 h-100">
                    <!-- Left Picture -->
                    <div class="col-xl-4 col-12 modal-img">
                        <img src="<?= $blog->imgUrl?>" alt="pic" class="img-fluid h-100 w-100 object-fit-cover rounded-start">
                    </div>

                    <!-- Full Content -->
                    <div class="col-xl-8 col-12 p-4 modal-content-scroll blog-full">
                        <h3 class="mb-2 blog-title"><?= $blog->title?></h3>
                        <?php
                            $htmlSummary = new HtmlManipulator($blog->summary);
                            $htmlSummary->addClass('p', 'blog-summary mb-3 text-muted');
                            echo $htmlSummary->getHtml();

                            $htmlContent = new HtmlManipulator($blog->content);
                            $htmlContent->addClass('p', 'blog-lorem mb-3');
                            $htmlContent->addClass('img', 'w-100');
                            echo $htmlContent->getHtml();
                        ?>

                        <div class="d-flex justify-content-between mt-4 flex-wrap blog-meta">
                            <span>📅 <?= $blog->uploadDate?></span>
                            <span>✍️ <?= $blog->username?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach;?>
        <script>
            // Open a specific modal by ID
            function openModal(modalId) {
                const modal = document.getElementById(modalId);
                if (!modal) return;
                modal.style.display = 'flex';
                document.body.style.overflow = 'hidden';

                // Auto-close when clicking outside modal-box
                modal.addEventListener('click', function handler(e) {
                    if (e.target === modal) {
                        closeModal(modalId);
                        modal.removeEventListener('click', handler);
                    }
                });
            }

            function closeModal(modalId) {
                const modal = document.getElementById(modalId);
                if (!modal) return;
                modal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        </script>
        

        <?php 
            include "components/footer.php";
            include "components/last.php";
        ?>
	</body>
</html>
