<?php
ob_start();
$css = "blog_gallery";
$title = $banner = "Blog";
include "components/first.php";
include "components/navbar.php";
include "components/banner.php";
use Museum\Object\Blog;
use Museum\Object\Comment;
use Museum\Utils\HtmlManipulator;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $blogId = $_POST['blog_id'] ?? '';
    $username = trim($_SESSION['login']);
    $content = trim($_POST['comment']);

    if (!empty($blogId) && !empty($username) && !empty($content)) {
        $comment = new Comment($username, $blogId);

        if (isset($_POST['submit_new'])) {
            $comment->save($content); 

        } elseif (isset($_POST['submit_edit'])) {
            $comment->save($content);
        }
    }

    header("Location: blog.php?id=" . urlencode($blogId) . "&scrolldown=1");
    exit();      
}
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
                        style="width: 300px; height: 200px; object-fit: cover"
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
                        <!-- Comments Section -->
                        <div class="blog-comments mt-5">
                            <h5 class="mb-3">💬 Comment</h5>
                            
                            <?php
                                $comments = Comment::getAllById($blog->id);

                                if ($comments && count($comments) > 0):
                                    foreach ($comments as $cmt):
                                        $uid = $blog->id . '-' . $cmt["Username"];
                            ?>
                                <div class="comment mb-3">
                                    <strong><?= htmlspecialchars($cmt["Username"]) ?></strong>
                                    <?php if ($_SESSION['login'] === $cmt["Username"]): ?>
                                        <div class="user-comment-block" id="comment-block-<?= $uid ?>">
                                            <p class="mb-1"><?= nl2br(htmlspecialchars($cmt["Text"])) ?></p>
                                            <small class="text-muted">
                                                <?= date("d/m/Y H:i", strtotime($cmt["CreatedAt"])) ?>
                                                &nbsp;|&nbsp;
                                                <button type="button" class="btn btn-sm btn-link p-0 align-baseline" onclick="toggleEdit('<?= $uid ?>')">Edit</button>
                                            </small>
                                        </div>

                                        <form method="post" class="edit-comment-form mb-3 d-none" id="edit-form-<?= $uid ?>">
                                            <input type="hidden" name="blog_id" value="<?= $blog->id ?>">
                                            <div class="mb-2">
                                                <textarea class="form-control" name="comment" rows="3"><?= htmlspecialchars($cmt["Text"]) ?></textarea>
                                            </div>
                                            <button type="submit" name="submit_edit" class="btn btn-sm btn-success">Update</button>
                                            <button type="button" class="btn btn-sm btn-secondary" onclick="toggleEdit('<?= $uid ?>')">Cancel</button>
                                        </form>
                                    <?php else: ?>
                                        <p class="mb-1"><?= nl2br(htmlspecialchars($cmt["Text"])) ?></p>
                                    <?php endif; ?>
                                </div>
                            <?php
                                    endforeach;
                                else:
                            ?>
                                <p class="text-muted">No comments yet.</p>
                            <?php endif; ?>

                            <!-- Form bình luận -->
                            <?php if (!Comment::hasUserCommented($blog->id, $_SESSION['login'])): ?>
                                <form method="post" class="mt-4" id="create-form-<?= $blog->id ?>">
                                    <input type="hidden" name="blog_id" value="<?= $blog->id ?>">
                                    <div class="mb-3">
                                        <label for="comment_<?= $blog->id ?>" class="form-label">Comment</label>
                                        <textarea class="form-control" id="comment_<?= $blog->id ?>" name="comment" rows="3" required></textarea>
                                    </div>
                                    <button type="submit" name="submit_new" class="btn btn-primary">Send</button>
                                </form>
                            <?php endif;?>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <?php endforeach;?>
        <script>
            // Open a specific modal by ID
            function openModal(modalId, scrollToComment = false) {
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

                // Nếu có yêu cầu thì cuộn xuống phần comment
                if (scrollToComment) {
                    setTimeout(() => {
                        const commentSection = modal.querySelector(".blog-comments");
                        if (commentSection) {
                            commentSection.scrollIntoView({ behavior: "smooth" });
                        }
                    }, 300);
                }
            }

            function closeModal(modalId) {
                const modal = document.getElementById(modalId);
                if (!modal) return;
                modal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        </script>
        <script>
            function toggleEdit(commentId) {
                const block = document.getElementById(`comment-block-${commentId}`);
                const form = document.getElementById(`edit-form-${commentId}`);

                if (block && form) {
                    block.classList.toggle('d-none');
                    form.classList.toggle('d-none');
                }
            }
        </script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const urlParams = new URLSearchParams(window.location.search);
                const blogId = urlParams.get("id");
                const shouldScroll = urlParams.get("scrolldown") === "1";

                if (blogId) {
                    openModal(blogId, shouldScroll);

                    // Xóa tham số khỏi URL sau khi xử lý xong
                    window.history.replaceState({}, document.title, window.location.pathname);
                }
            });
        </script>

        <?php 
            include "components/footer.php";
            include "components/last.php";
        ?>
	</body>
</html>
<?php ob_end_flush(); ?>