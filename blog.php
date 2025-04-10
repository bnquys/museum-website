<?php
    $css = "blog";
    $title = $name = "Blog";
    include "components/first.php";
    include "components/navbar.php";
    include "components/banner.php";
    require_once "object/Blog.php";
?>

<section class="container d-flex flex-column gap-4 mb-5">
    <?php
        Blog::show(10);
    ?>
</section>

<?php 
    include "components/footer.php";
    include "components/last.php";
?>