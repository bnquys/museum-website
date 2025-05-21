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
                <a
                    href="more.php?type=blog&id=<?= $blog->id?>"
                    class="col-12 d-flex blog-card text-decoration-none text-dark mv-lr"
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
                            <span><i class="fa-solid fa-calendar"></i> <?= $blog->uploadDate?></span>
                            <span><i class="fa-solid fa-pencil"></i> <?= $blog->username?></span>
                        </div>
                    </div>
                </a>
                <?php endforeach;?>
            </div>
        </div>
        <?php 
            include "components/footer.php";
            include "components/last.php";
        ?>
	</body>
</html>
<?php ob_end_flush(); ?>