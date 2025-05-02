<?php
    $css = "blog";
    $title = $name = "Blog";
    include "components/first.php";
    include "components/navbar.php";
    include "components/banner.php";

    require_once "vendor/autoload.php";
    use Museum\Object\Blog;

    $blogs = Blog::getListBlog(6);
    // var_dump($blogs);
?>
        <div class="container my-5">
            <div class="row g-4">
                <!-- Brief Content 1 -->
                <?php foreach($blogs as $blog) {?>
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
                        <p class="blog-summary text-muted flex-grow-1">
                            <?= $blog->summary?>
                        </p>

                        <div class="d-flex justify-content-between flex-wrap blog-meta">
                            <span>📅 <?= $blog->uploadDate?></span>
                            <span>✍️ <?= $blog->username?></span>
                        </div>
                    </div>
                </div>
                <?php }?>
            </div>
        </div>
        
        <!-- Modal-1 -->
        <?php foreach($blogs as $blog) {?>
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
                        <p class="blog-summary mb-3 text-muted">
                            <?= $blog->summary?>
                        </p>

                        <p class="blog-lorem mb-3">
                            <?= $blog->content?>
                        </p>

                        <div class="d-flex justify-content-between mt-4 flex-wrap blog-meta">
                            <span>📅 <?= $blog->uploadDate?></span>
                            <span>✍️ <?= $blog->username?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php }?>
        <!-- Modal-2 -->
        <div id="modal-2" class="modal">
            <div class="modal-box">
                <div class="row g-0 h-100">
                    <!-- Left Picture -->
                    <div class="col-md-4 modal-img">
                        <img src="assets/img/g2.jpg" alt="pic" class="img-fluid h-100 w-100 object-fit-cover rounded-start">
                    </div>

                    <!-- Full Content -->
                    <div class="col-md-8 p-4 modal-content-scroll blog-full">
                        <h3 class="mb-2 blog-title">The Secrets of Deep Ocean Bioluminescence</h3>
                        <p class="blog-summary mb-3 text-muted">
                            A journey into the dark, illuminating the wonders of nature's light.
                        </p>

                        <p class="blog-lorem mb-3">
                            From the depths of the ocean, bioluminescent organisms create a stunning spectacle. 
                            This article uncovers the science behind these natural lights and their purposes.
                        </p>
                        <p class="blog-lorem mb-3">
                            Discover how these creatures use light to lure prey, communicate, and evade predators.
                            Join us in diving deep into the bioluminescent marvels that inhabit our oceans.
                        </p>
                        <p class="blog-lorem mb-3">
                            Mindful gardening is not just about planting; it’s about connecting with nature.
                            This article explores how gardening can enhance mental well-being and foster creativity.
                        </p>
                        <p class="blog-lorem mb-3">
                            Learn techniques to cultivate your garden mindfully and discover the joy of nurturing life.
                            Transform your outdoor space into a haven for relaxation and reflection.
                        </p>

                        <div class="d-flex justify-content-between mt-4 flex-wrap blog-meta">
                            <span>📅 May 15, 2025</span>
                            <span>✍️ Dr. Ethan Reed, Archaeologist</span>
                        </div>
                    </div>                
                </div>
            </div>
        </div>

        <!-- Modal-3 -->
        <div id="modal-3" class="modal">
            <div class="modal-box">
                <div class="row g-0 h-100">
                    <!-- Left Picture -->
                    <div class="col-md-4 modal-img">
                        <img src="assets/img/g3.jpg" alt="pic" class="img-fluid h-100 w-100 object-fit-cover rounded-start">
                    </div>

                    <!-- Full Content -->
                    <div class="col-md-8 p-4 modal-content-scroll blog-full">
                        <h3 class="mb-2 blog-title">The Art of Mindful Gardening</h3>
                        <p class="blog-summary mb-3 text-muted">
                            Finding tranquility and inspiration in nature’s embrace.
                        </p>

                        <p class="blog-lorem mb-3">
                            Mindful gardening is not just about planting; it’s about connecting with nature.
                            This article explores how gardening can enhance mental well-being and foster creativity.
                            
                        </p>
                        <p class="blog-lorem mb-3">
                            Learn techniques to cultivate your garden mindfully and discover the joy of nurturing life.
                            Transform your outdoor space into a haven for relaxation and reflection.
                        </p>
                        <p class="blog-lorem mb-3">
                            As cities expand, wildlife adapts in surprising ways. 
                            This article examines innovative urban designs that support biodiversity and sustainable living.
                        </p>
                        <p class="blog-lorem mb-3">
                            Explore case studies of cities around the world that have successfully integrated green spaces 
                            and wildlife corridors, making urban life more harmonious with nature.
                        </p>

                        <div class="d-flex justify-content-between mt-4 flex-wrap blog-meta">
                            <span>📅 June 10, 2025</span>
                            <span>✍️ Dr. Mia Chen, Marine Biologist</span>
                        </div>
                    </div>                
                </div>
            </div>
        </div>


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
        ?>
        <script src="./assets/js/dropdown-menu.js"></script>
        <script src="assets/js/bootstrap.bundle.js"></script>
        <script src="assets/js/sip.js"></script>
	</body>
</html>
