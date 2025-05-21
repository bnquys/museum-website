<?php
    ob_start();
    $css = "event_more";
    $title = "<Title of Events>| Museum Event"; 
    include "components/first.php"; 
    include "components/navbar.php"; 
    
    use Museum\Object\Blog;
    use Museum\Object\Event;
    use Museum\Object\Academy;
    use Museum\Object\Comment;
use Museum\Object\Exhibition;
use Museum\Utils\HtmlManipulator;

    $type = $_GET['type'] ?? '';
    $id = $_GET['id'] ?? null;
    $content = null;

    switch ($type) {
        case 'blog':
            $content = Blog::getById($id);
            $detail = $content->content;
            break;
        case 'exhibition':
            $content = Event::getById($id)->getType();
            $detail = $content->description;
            break;
        case 'academy':
            $content = Event::getById($id)->getType();
            $detail = $content->description;
            break;
        default:
            // Redirect or show error if type is invalid
            header("Location: notfound404.html");
            exit;
    }

    $commentMessage = "";
    $hasCommented = false;
    $existingComment = "";

    // Nếu là blog, xử lý comment
    if ($type === "blog" && isset($id)) {
        if (isset($accountLogin)) {
            $username = $accountLogin->username;

            $hasCommented = Comment::hasUserCommented($id, $username);

            if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["comment"])) {
                $comment = new Comment($username, $id);
                $comment->save($_POST["comment"]);
                header("Location: more.php?type=blog&id=$id#comment-section");
                exit;
            }

            if ($hasCommented) {
                $allComments = Comment::getAllById($id);
                foreach ($allComments as $cmt) {
                    if ($cmt["Username"] === $username) {
                        $existingComment = $cmt["Text"];
                        break;
                    }
                }
            }
        }
    }

    if (!isset($content)) {
        header("Location: notfound404.html");
        exit;
    } 

?>
<!-- Event Header -->
<div class="event-header" style="background-image: linear-gradient(135deg, var(--dark-cl-rgba), var(--normal-cl-rgba)), url('<?= $content->imgUrl?>'); background-size: cover; background-position: center; background-attachment: fixed;">
	<div class="container position-relative z-index-2">
		<div class="row">
			<div class="col-lg-12">
				<span class="info-badge mb-4 d-inline-block" style="text-transform:capitalize;"><?= $type?></span>
				<h1 class="event-title display-3 fw-bold mb-4">
					<?= htmlspecialchars($content->title)?>
				</h1>
				<?php
                    $html = new HtmlManipulator($content->summary);
				$html->addClass('p', "text-white lead mb-4"); $html->print(); ?>
			</div>
		</div>
	</div>
</div>

<!-- Main Content -->
<section class="py-5 eventt">
	<div class="container">
		<div class="row g-4">
			<!-- Event Details -->
			<div class="col-lg-8">
				<div class="event-details-card mb-4">
					<?php
                        $html = new HtmlManipulator($detail);
                        $html->addClass('img', "img-fluid rounded-3 mb-4 shadow"); $html->addClass('h3', "mt-5 mb-4");
                        $html->addClass('ul','list-unstyled'); $html->addClass('li', "mb-3 py-2"); 
                        $html->addClass('h4', 'mt-4 mb-3');
                        $html->print(); ?>
				</div>
			</div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="event-card p-4 mb-4">
                    <h3 class="h4 mb-4 fw-bold section-title" style="text-transform:capitalize;">
                        <?= htmlspecialchars($type) ?> Information
                    </h3>

                    <!-- Author -->
                    <div class="d-flex align-items-start mb-4">
                        <i class="bi bi-person-square detail-icon"></i>
                        <div>
                            <h5 class="mb-1 fw-bold">Author</h5>
                            <p class="mb-0"><?= htmlspecialchars($content->username) ?></p>
                        </div>
                    </div>

                    <!-- Blog Specific Info -->
                    <?php if ($type === "blog"): ?>
                        <div class="d-flex align-items-start mb-4">
                            <i class="bi bi-calendar2-date detail-icon"></i>
                            <div>
                                <h5 class="mb-1 fw-bold">Published On</h5>
                                <p class="mb-0"><?= date("F j, Y", strtotime($content->uploadDate)) ?></p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start mb-4">
                            <i class="bi bi-file-earmark-text detail-icon"></i>
                            <div>
                                <h5 class="mb-1 fw-bold">Type</h5>
                                <p class="mb-0">Editorial Blog</p>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Academy Specific Info -->
                    <?php if ($type === "academy" && $content instanceof Academy): ?>
                        <div class="d-flex align-items-start mb-4">
                            <i class="bi bi-mic detail-icon"></i>
                            <div>
                                <h5 class="mb-1 fw-bold">Speaker</h5>
                                <p class="mb-0"><?= htmlspecialchars($content->getSpeaker() ?? 'Not available') ?></p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start mb-4">
                            <i class="bi bi-currency-dollar detail-icon"></i>
                            <div>
                                <h5 class="mb-1 fw-bold">Price</h5>
                                <p class="mb-0"><?= number_format($content->getPrice(), 2) ?> USD</p>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Shared Info for Academy & Exhibition -->
                    <?php if ($type !== "blog"): ?>
                        <div class="d-flex align-items-start mb-4">
                            <i class="bi bi-calendar-event detail-icon"></i>
                            <div>
                                <h5 class="mb-1 fw-bold">Start - End</h5>
                                <p class="mb-0">
                                    <?= date("F j, Y, g:i A", strtotime($content->timeStart)) ?>
                                    <br/>
                                    to
                                    <br/>
                                    <?= date("F j, Y, g:i A", strtotime($content->timeEnd)) ?>
                                </p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start mb-4">
                            <i class="bi bi-geo-alt detail-icon"></i>
                            <div>
                                <h5 class="mb-1 fw-bold">Location</h5>
                                <p class="mb-0"><?= htmlspecialchars($content->location) ?></p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start mb-4">
                            <i class="bi bi-clock detail-icon"></i>
                            <div>
                                <h5 class="mb-1 fw-bold">Opening Hours</h5>
                                <p class="mb-0">
                                    Monday - Friday: 9:00 AM - 6:00 PM<br />
                                    Saturday - Sunday: 10:00 AM - 8:00 PM
                                </p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start mb-4">
                            <i class="bi bi-ticket-perforated detail-icon"></i>
                            <div>
                                <h5 class="mb-1 fw-bold">Admission</h5>
                                <p class="mb-0">
                                    All exhibitions are free with Museum admission.
                                </p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Countdown & Map -->
                <?php if ($type !== "blog"): ?>
                    <div class="event-card countdown mb-4">
                        <h4 class="mb-4 text-white"><?= ucfirst($type) ?> Opens In:</h4>
                        <div class="row text-center">
                            <div class="col-3">
                                <div class="countdown-number" id="days">00</div>
                                <div class="countdown-label">Days</div>
                            </div>
                            <div class="col-3">
                                <div class="countdown-number" id="hours">00</div>
                                <div class="countdown-label">Hours</div>
                            </div>
                            <div class="col-3">
                                <div class="countdown-number" id="minutes">00</div>
                                <div class="countdown-label">Minutes</div>
                            </div>
                            <div class="col-3">
                                <div class="countdown-number" id="seconds">00</div>
                                <div class="countdown-label">Seconds</div>
                            </div>
                        </div>
                    </div>

                    <div class="event-card p-4 mb-4">
                        <h3 class="h4 mb-4 fw-bold section-title">Location Map</h3>
                        <div class="map-container">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.215256627966!2d-73.98784492453812!3d40.74844097138995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c259a9b3117469%3A0xd134e199a405a163!2sEmpire%20State%20Building!5e0!3m2!1sen!2sus!4v1689870033995!5m2!1sen!2sus"
                                width="100%" height="100%" style="border: 0" allowfullscreen=""
                                loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if ($type === 'exhibition' && $content instanceof Exhibition):?>
                    <!-- Included Artifacts Section -->
                    <div class="event-card p-4 mb-4">
                        <h3 class="h4 mb-4 fw-bold section-title">Included Artifacts</h3>
                        <p class="mb-4">
                            Explore these rare botanical artifacts featured in our
                            exhibition:
                        </p>

                        <div class="row g-3">
                            <?php 
                                $artifactsInExhibition = $content->getArtifacts();
                                foreach ($artifactsInExhibition as $artifact): ?>
                                <div class="col-12 col-md-6">
                                    <div class="artifact-container position-relative">
                                        <img
                                            src="<?= htmlspecialchars($artifact->imageUrl) ?>"
                                            alt="<?= htmlspecialchars($artifact->title) ?>"
                                            class="img-fluid artifact-image"
                                        />
                                        <a href="gallery.php" class="artifact-overlay">
                                            <div class="artifact-name"><?= htmlspecialchars($artifact->title) ?></div>
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                    </div>
                <?php endif;?>
            </div>

		</div>
        <?php if ($type === "blog"): ?>
        <div class="mt-5" id="comment-section">
            <h3 class="h4 fw-bold mb-3">Comments</h3>

            <!-- Danh sách bình luận -->
            <?php
                $comments = Comment::getAllById($id);
                if ($comments):
                    foreach ($comments as $cmt):
            ?>
                <div class="mb-3 p-3 border rounded">
                    <strong><?= htmlspecialchars($cmt['Username']) ?></strong>
                    <small class="text-muted"><?= date("F j, Y H:i", strtotime($cmt['CreatedAt'])) ?></small>
                    <p class="mb-0"><?= nl2br(htmlspecialchars($cmt['Text'])) ?></p>
                </div>
            <?php endforeach; else: ?>
                <p class="text-muted">No comments yet. Be the first to comment!</p>
            <?php endif; ?>

            <hr class="my-4">

            <!-- Form bình luận -->
            <?php if (!isset($accountLogin)): ?>
                <p class="text-danger">You must be logged in to comment.</p>
            <?php else: ?>
                <form method="POST" class="mt-4">
                    <div class="mb-3">
                        <label for="comment" class="form-label fw-semibold">
                            <?= $hasCommented ? "Edit your comment" : "Leave a comment" ?>
                        </label>
                        <textarea name="comment" id="comment" rows="4" class="form-control" required><?= htmlspecialchars($existingComment) ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <?= $hasCommented ? "Update Comment" : "Post Comment" ?>
                    </button>
                </form>
            <?php endif; ?>
        </div>
        <?php endif; ?>

	</div>
</section>

<!-- Related Events -->
<section class="related-events">
    <div class="container">
        <h2 class="section-title text-center mb-5">You Might Also Like</h2>
        <div class="row g-4">
            <?php
                $relatedEvents = array_filter(
                    Event::getRandomEvents(3),
                    fn($e) => $e->id !== $content->id // loại bỏ chính sự kiện đang xem
                );             
                foreach ($relatedEvents as $event): 
            ?>
                <div class="col-md-4">
                    <div class="event-card h-100">
                        <img
                            src="<?= htmlspecialchars($event->imgUrl) ?>"
                            class="event-img w-100"
                            alt="<?= htmlspecialchars($event->title) ?>"
                        />
                        <div class="p-4">
                            <span class="info-badge mb-3 d-inline-block"><?= str_replace('museum\\object\\', '', strtolower(get_class($event->getType()))) ?></span>
                            <h3 class="h4"><?= htmlspecialchars($event->title) ?></h3>
                            <p class="mb-4"><?= htmlspecialchars(strip_tags($event->summary)) ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted">
                                    <i class="bi bi-calendar-event me-2"></i>
                                    <?= date("F j, Y", strtotime($event->timeStart)) ?>
                                </span>
                                <a href="more.php?type=<?= $type ?>&id=<?= $event->id ?>" class="btn btn-sm btn-custom">
                                    Details <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    
	// Countdown timer
	function updateCountdown() {
        const eventDate = new Date("<?= date("Y-m-d\TH:i:s", strtotime($content->timeStart)) ?>").getTime();
		const now = new Date().getTime();
		const distance = eventDate - now;

		const days = Math.floor(distance / (1000 * 60 * 60 * 24));
		const hours = Math.floor(
			(distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
		);
		const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		const seconds = Math.floor((distance % (1000 * 60)) / 1000);

		document.getElementById("days").innerHTML = days
			.toString()
			.padStart(2, "0");
		document.getElementById("hours").innerHTML = hours
			.toString()
			.padStart(2, "0");
		document.getElementById("minutes").innerHTML = minutes
			.toString()
			.padStart(2, "0");
		document.getElementById("seconds").innerHTML = seconds
			.toString()
			.padStart(2, "0");

		if (distance < 0) {
			clearInterval(countdownInterval);
			document.getElementById("days").innerHTML = "00";
			document.getElementById("hours").innerHTML = "00";
			document.getElementById("minutes").innerHTML = "00";
			document.getElementById("seconds").innerHTML = "00";
		}
	}

	// Initialize countdown
	updateCountdown();
	const countdownInterval = setInterval(updateCountdown, 1000);

	// Add animation to cards when they come into view
	const observerOptions = {
		threshold: 0.1,
	};

	const observer = new IntersectionObserver((entries) => {
		entries.forEach((entry) => {
			if (entry.isIntersecting) {
				entry.target.classList.add(
					"animate__animated",
					"animate__fadeInUp"
				);
				observer.unobserve(entry.target);
			}
		});
	}, observerOptions);

	document.querySelectorAll(".event-card").forEach((card) => {
		observer.observe(card);
	});
</script>
<script>
    $(document).ready(function () {
        $('title').text('<?= $content->title?> | Museum');
    });
</script>
<?php
    include "components/footer.php";
    include "components/last.php";
    ob_end_flush();
?>
