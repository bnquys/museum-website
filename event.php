<?php
    $css = "event";
    $title = $banner = "Event";
    include "components/first.php";
    include "components/navbar.php";
    include "components/banner.php";
    include "components/upcoming-events.php";

    use Museum\Object\Event;
    $upcomingEvents = Event::getUpcomingEvents(100);
?>

<div class="row events">
    <?php if (empty($upcomingEvents)): ?>
        <p class="text-center text-muted fst-italic">
            There are no upcoming events at the moment.
        </p>
    <?php else: ?>
        <?php foreach ($upcomingEvents as $event): ?>
            <?php
                $time = strtotime($event->timeStart);
                $day = date('d', $time);
                $month = date('M', $time);
                $year = date('Y', $time);
            ?>
            <div class="example-2 card border-0 mb-5">
                <div class="wrapper"
                    style="background: url('<?= $event->imgUrl ?>') center / cover no-repeat;">
                    <div class="header">
                        <div class="date">
                            <span class="day"><?= $day ?></span>
                            <span class="month"><?= $month ?></span>
                            <span class="year"><?= $year ?></span>
                        </div>
                    </div>
                    <div class="data">
                        <div class="content">
                            <h1 class="title">
                                <a href="more.php?type=<?= str_replace('museum\\object\\', '', strtolower(get_class($event->getType()))) ?>&id=<?= $event->id ?>">
                                    <?= htmlspecialchars($event->title) ?>
                                </a>
                            </h1>
                            <p class="text">
                                <?= htmlspecialchars($event->summary) ?>
                            </p>
                            <a href="more.php?type=<?= str_replace('museum\\object\\', '', strtolower(get_class($event->getType()))) ?>&id=<?= $event->id ?>" class="button text-white fs-6 mt-0 mb-1">
                                Read more <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php
    include "components/latest-blog.php";
    include "components/footer.php";
    include "components/last.php";
?>
