		<?php
			$css = "contact";
			$title = $name = "Contact";
			include "components/first.php";
            include "components/navbar.php";
            include "components/banner.php";
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
                        <form>
                            <div class="mb-3">
                                <label for="name" class="form-label fw-bolder"
                                    >Full Name</label
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    id="name"
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
                                                465 Huntington Avenue<br />Boston,
                                                MA 02115
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
                                                +1 (617) 267-9300<br />Mon-Fri,
                                                9am-5pm
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
                                                info@mfa.org<br />visitors@mfa.org
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
                                                Mon-Fri: 10am-5pm<br />Sat-Sun:
                                                9am-6pm
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
                                <iframe
                                    class="map-iframe"
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2948.33369134229!2d-71.0958459241444!3d42.33941597138986!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89e3798a893e1e9f%3A0x4dde05e8a4e3f0a9!2sMuseum%20of%20Fine%20Arts%2C%20Boston!5e0!3m2!1sen!2sus!4v1689872032472!5m2!1sen!2sus"
                                    allowfullscreen=""
                                    loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"
                                ></iframe>
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
                    <div class="accordion-item mb-3 border-0 shadow-sm">
                        <h2 class="accordion-header" id="headingOne">
                            <button
                                class="accordion-button collapsed"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#collapseOne"
                            >
                                What are your current COVID-19 safety measures?
                            </button>
                        </h2>
                        <div
                            id="collapseOne"
                            class="accordion-collapse collapse"
                            data-bs-parent="#faqAccordion"
                        >
                            <div class="accordion-body">
                                We follow all local health guidelines.
                                Currently, masks are optional but recommended in
                                crowded spaces. We've increased cleaning
                                protocols and provide hand sanitizing stations
                                throughout the museum.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item mb-3 border-0 shadow-sm">
                        <h2 class="accordion-header" id="headingTwo">
                            <button
                                class="accordion-button collapsed"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo"
                            >
                                Do you offer discounts for students or seniors?
                            </button>
                        </h2>
                        <div
                            id="collapseTwo"
                            class="accordion-collapse collapse"
                            data-bs-parent="#faqAccordion"
                        >
                            <div class="accordion-body">
                                Yes, we offer discounted admission for students
                                with valid ID and seniors (65+). Children under
                                7 are admitted free. Check our website for
                                current pricing and special discount days.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item mb-3 border-0 shadow-sm">
                        <h2 class="accordion-header" id="headingThree">
                            <button
                                class="accordion-button collapsed"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#collapseThree"
                            >
                                Can I take photos in the museum?
                            </button>
                        </h2>
                        <div
                            id="collapseThree"
                            class="accordion-collapse collapse"
                            data-bs-parent="#faqAccordion"
                        >
                            <div class="accordion-body">
                                Photography without flash is permitted in most
                                permanent collection galleries for personal use
                                only. Some special exhibitions may prohibit
                                photography entirely. No tripods or selfie
                                sticks are allowed.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item mb-3 border-0 shadow-sm">
                        <h2 class="accordion-header" id="headingFour">
                            <button
                                class="accordion-button collapsed"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#collapseFour"
                            >
                                How do I book a guided tour?
                            </button>
                        </h2>
                        <div
                            id="collapseFour"
                            class="accordion-collapse collapse"
                            data-bs-parent="#faqAccordion"
                        >
                            <div class="accordion-body">
                                Guided tours must be booked at least two weeks
                                in advance. Please contact our Group Visits
                                department at groups@mfa.org or call (617)
                                267-9300 ext. 1 for more information and
                                reservations.
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <!-- Bootstrap 5 JS Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            // Form submission handler
            document
                .querySelector("form")
                .addEventListener("submit", function (e) {
                    e.preventDefault();

                    const name = document.getElementById("name").value;
                    const email = document.getElementById("email").value;
                    const message = document.getElementById("message").value;

                    alert(`Thanks ${name}, your message has been received!`);
                    this.reset();
                });
        </script>

		<?php 
            include "components/footer.php";
			include "components/last.php";
        ?>
