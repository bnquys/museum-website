<?php
    $css = "contact";
    $title = $banner = "Contact";
    include "components/first.php";
    include "components/navbar.php";
    include "components/banner.php";

    require_once "vendor/autoload.php";
    use Museum\Object\ContactForm;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $message = trim($_POST['message'] ?? '');
    
        $nameValue = htmlspecialchars($name);
        $emailValue = htmlspecialchars($email);
        $messageValue = htmlspecialchars($message);
    
        $id = ContactForm::getNextId();
        $createdAt = date("Y-m-d H:i:s");
        $contactForm = new ContactForm($id, $email, $name, $message, $createdAt, false);

        ContactForm::add($contactForm);

        $successMessage = '<div class="alert alert-success text-center mt-4">Your message has been sent successfully!</div>';

        $nameValue = $emailValue = $messageValue = "";
        
    }
    
?>

<!-- Main Content -->
<main class="container my-5 fade-in">
    <div class="row g-4">
        <!-- Contact Form Column -->
        <div class="col-lg-6">
            <div class="card shadow-sm border-0 p-4">
                <h2 class="mb-4">
                    <i class="fas fa-envelope me-2"></i>
                    Send Us a Message
                </h2>
                <form method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bolder"
                            >Full Name</label
                        >
                        <input
                            type="text"
                            class="form-control"
                            id="name"
                            name="name"
                            value="<?php if (isset($accountLogin)) {echo $accountLogin->getUser()->name;}?>"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label fw-bolder"
                            >Email Address</label
                        >
                        <input
                            type="email"
                            class="form-control"
                            id="email"
                            name="email"
                            value="<?php if (isset($accountLogin)) {echo $accountLogin->getUser()->email;}?>"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label fw-bolder"
                            >Your Message</label
                        >
                        <textarea
                            class="form-control"
                            id="message"
                            name="message"
                            rows="5"
                            required
                        ></textarea>
                    </div>
                    <button
                        type="submit"
                        class="btn btn-primary px-4 py-2"
                    >
                        Send Message
                    </button>
                </form>
            </div>
        </div>

        <!-- Contact Info Column -->
        <?php 	$museum = $dataManager->read('museum_info');?>
        <div class="col-lg-6">
            <!-- Contact Cards -->
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <div class="card contact-card h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-start">
                                <div
                                    class="bg-primary bg-opacity-10 p-3 rounded-circle me-3"
                                >
                                    <i
                                        class="fas fa-map-marker-alt fs-4"
                                    ></i>
                                </div>
                                <div>
                                    <h5 class="card-title mb-2">
                                        Address
                                    </h5>
                                    <p
                                        class="card-text text-muted mb-0"
                                    >
                                        <?= $museum['address']?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card contact-card h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-start">
                                <div
                                    class="bg-primary bg-opacity-10 p-3 rounded-circle me-3"
                                >
                                    <i
                                        class="fas fa-phone-alt fs-4"
                                    ></i>
                                </div>
                                <div>
                                    <h5 class="card-title mb-2">
                                        Phone
                                    </h5>
                                    <p
                                        class="card-text text-muted mb-0"
                                    >
                                        <?= $museum['phone']?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card contact-card h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-start">
                                <div
                                    class="bg-primary bg-opacity-10 p-3 rounded-circle me-3"
                                >
                                    <i
                                        class="fas fa-envelope fs-4"
                                    ></i>
                                </div>
                                <div>
                                    <h5 class="card-title mb-2">
                                        Email
                                    </h5>
                                    <p
                                        class="card-text text-muted mb-0"
                                    >
                                        <?= $museum['email']?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card contact-card h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-start">
                                <div
                                    class="bg-primary bg-opacity-10 p-3 rounded-circle me-3"
                                >
                                    <i
                                        class="fas fa-clock fs-4"
                                    ></i>
                                </div>
                                <div>
                                    <h5 class="card-title mb-2">
                                        Hours
                                    </h5>
                                    <p
                                        class="card-text text-muted mb-0"
                                    >
                                        <?= str_replace(',', '<br>', $museum['summary'])?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Map -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    <h5 class="card-title mb-3">
                        <i
                            class="fas fa-map-marked-alt me-2"
                        ></i>
                        Find Us on the Map
                    </h5>
                    <div class="map-container">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d62720.52997299296!2d106.65814220387907!3d10.731928689916376!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317528b2747a81a3%3A0x33c1813055acb613!2sTon%20Duc%20Thang%20University!5e0!3m2!1sen!2sus!4v1747726435851!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ Section -->
    <section class="mt-5 p-5 rounded-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold fs-1">Frequently Asked Questions</h2>
            <p class="text-muted">
                Find quick answers to common questions
            </p>
        </div>

        <div class="accordion" id="faqAccordion">
            <?php
                use Museum\Utils\JsonDataManager;
                $faqManager = new JsonDataManager('assets/data/common_question.json');
                $faqs = $faqManager->readAll();

                foreach($faqs as $faq):
            ?>
            <div class="accordion-item mb-3 border-0 shadow-sm">
                <h2 class="accordion-header" id="heading<?= htmlspecialchars($faq['id'])?>">
                    <button
                        class="accordion-button collapsed"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapse<?= htmlspecialchars($faq['id'])?>"
                    >
                        <?= htmlspecialchars($faq['question'])?>
                    </button>
                </h2>
                <div
                    id="collapse<?= htmlspecialchars($faq['id'])?>"
                    class="accordion-collapse collapse"
                    data-bs-parent="#faqAccordion"
                >
                    <div class="accordion-body">
                        <?= htmlspecialchars($faq['answer'])?>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
        </div>
    </section>
</main>

<!-- Bootstrap 5 JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?php 
    include "components/footer.php";
    include "components/last.php";
?>
