<?php
    $css = "blog";
    $title = $name = "Blog";
    include "components/first.php";
    include "components/navbar.php";
    include "components/banner.php";
    // require_once "object/Blog.php";
?>

        <?php
            // Blog::show(10);
            
        ?>
        <div class="container my-5">
            <div class="row g-4">
                <!-- Brief Content -->
                <div
                    class="col-12 d-flex blog-card"
                    onclick="openModal('🔥 Blog content here 🔥')"
                >
                    <img
                        src="assets/img/banner.jpg"
                        class="img-fluid rounded"
                        alt="Blog Pic"
                        style="width: 150px; height: 150px; object-fit: cover"
                    />

                    <div class="ms-3 flex-grow-1 blog-brief">
                        <h5 class="mb-1 blog-title">The Rise of Leaf-Based Algorithms</h5>
                        <p class="blog-summary mb-1 text-muted">
                            A glimpse into how plants might've invented machine learning way before us.
                        </p>

                        <div class="d-flex justify-content-between text-secondary mt-3 flex-wrap blog-meta">
                            <span>April 21, 2025</span>
                            <span>🌿 3 Reacts</span>
                            <span>💬 5 Comments</span>
                        </div>
                    </div>
                </div>

                <div
                    class="col-12 d-flex blog-card"
                    onclick="openModal('🔥 Blog content here 🔥')"
                >
                    <img
                        src="assets/img/banner.jpg"
                        class="img-fluid rounded"
                        alt="Blog Pic"
                        style="width: 150px; height: 150px; object-fit: cover"
                    />

                    <div class="ms-3 flex-grow-1 blog-brief">
                        <h5 class="mb-1 blog-title">The Rise of Leaf-Based Algorithms</h5>
                        <p class="blog-summary mb-1 text-muted">
                            A glimpse into how plants might've invented machine learning way before us.
                        </p>

                        <div class="d-flex justify-content-between text-secondary mt-3 flex-wrap blog-meta">
                            <span>April 21, 2025</span>
                            <span>🌿 3 Reacts</span>
                            <span>💬 5 Comments</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        
        <!-- Modal -->
        <div id="modal" class="modal" onclick="closeModal(event)">
            <div class="modal-box" onclick="event.stopPropagation()">
                <div class="row g-0 h-100">
                <!-- Left Picture -->
                    <div class="col-md-4 modal-img">
                        <img src="assets/img/banner.jpg" alt="pic" class="img-fluid h-100 w-100 object-fit-cover rounded-start">
                    </div>

                    <!-- Full Content -->
                    <div class="col-md-8 p-4 modal-content-scroll blog-full">
                        <h3 class="mb-2 blog-title">The Rise of Leaf-Based Algorithms</h3>
                        <p class="blog-summary mb-3 text-muted">
                            Nature's neural networks — real roots of intelligence?
                        </p>

                        <p class="blog-lorem mb-3">
                            While researchers race to develop intelligent machines, the forest has
                            quietly run decentralized systems for millions of years. 
                            Trees communicate, adapt, and respond to environmental data — and maybe even gossip 👀.
                        </p>

                        <p class="blog-lorem mb-3">
                            This article dives deep into the patterns of fungal networks, leaf response
                            systems, and how these can inspire next-gen bio-AI hybrid models. Prepare for
                            a wild trip down Motherboard Nature 🌱🤖.
                        </p>

                        <p class="blog-lorem mb-3">
                            While researchers race to develop intelligent machines, the forest has
                            quietly run decentralized systems for millions of years. 
                            Trees communicate, adapt, and respond to environmental data — and maybe even gossip 👀.
                        </p>

                        <p class="blog-lorem mb-3">
                            While researchers race to develop intelligent machines, the forest has
                            quietly run decentralized systems for millions of years. 
                            Trees communicate, adapt, and respond to environmental data — and maybe even gossip 👀.
                        </p>

                        <div class="d-flex justify-content-between text-secondary mt-4 flex-wrap blog-meta">
                            <span>April 21, 2025</span>
                            <span>🧠 3 Reacts</span>
                            <span>💬 5 Comments</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script>
            function openModal(content = '') {
            document.getElementById('modal').style.display = 'flex';
            document.body.style.overflow = 'hidden';
            }

            function closeModal(event) {
            document.getElementById('modal').style.display = 'none';
            document.body.style.overflow = 'auto';
            }        

            function react(el) {
                el.classList.add("reacted");
                setTimeout(() => el.classList.remove("reacted"), 500);
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
