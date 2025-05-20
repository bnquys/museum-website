<?php
    $css = "event_more";
    $title = "<Title of Events> | Museum Event";
    include "components/first.php"; 
    include "components/navbar.php";
?>

<body>
    <!-- Event Header -->
    <div class="event-header">
        <div class="container position-relative z-index-2">
            <div class="row">
                <div class="col-lg-12">
                    <span class="info-badge mb-4 d-inline-block"
                        >Special Exhibition</span
                    >
                    <h1 class="event-title display-3 fw-bold mb-4">
                        Botanical Wonders: The Secret Life of Plants
                    </h1>
                    <p class="text-white lead mb-4">
                        Discover the hidden world of plant communication and
                        intelligence in this groundbreaking exhibition
                    </p>
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
                        <h2 class="section-title">Event Overview</h2>
                        <p class="lead">
                            This immersive exhibition reveals the latest
                            scientific discoveries about plant intelligence,
                            communication, and their complex relationships
                            with other organisms.
                        </p>

                        <div class="my-4">
                            <img
                                src="https://picsum.photos/1920/1000?random=1"
                                alt="Botanical exhibition"
                                class="img-fluid rounded-3 mb-4 shadow"
                            />
                        </div>

                        <h3 class="mt-5 mb-4">Exhibition Highlights</h3>
                        <p>
                            Through interactive displays, living plant
                            installations, and cutting-edge microscopy,
                            visitors will explore:
                        </p>
                        <ul class="list-unstyled">
                            <li class="mb-3 py-2">
                                <i
                                    class="bi bi-check-circle-fill text-success me-3"
                                ></i>
                                How plants communicate through chemical
                                signals
                            </li>
                            <li class="mb-3 py-2">
                                <i
                                    class="bi bi-check-circle-fill text-success me-3"
                                ></i>
                                The sophisticated defense mechanisms of
                                plants
                            </li>
                            <li class="mb-3 py-2">
                                <i
                                    class="bi bi-check-circle-fill text-success me-3"
                                ></i>
                                Mutualistic relationships between plants and
                                fungi
                            </li>
                            <li class="mb-3 py-2">
                                <i
                                    class="bi bi-check-circle-fill text-success me-3"
                                ></i>
                                The latest research on plant memory and
                                learning
                            </li>
                            <li class="mb-3 py-2">
                                <i
                                    class="bi bi-check-circle-fill text-success me-3"
                                ></i>
                                How climate change affects plant
                                communication
                            </li>
                        </ul>

                        <h3 class="mt-5 mb-4">Detailed Description</h3>
                        <p>
                            This exhibition challenges traditional notions
                            of plant life, presenting compelling evidence
                            that plants are far more complex and sentient
                            than previously believed. Visitors will journey
                            through four themed galleries:
                        </p>

                        <h4 class="mt-4 mb-3">
                            <span class="badge bg-accent-cl me-2">1</span>
                            The Language of Plants
                        </h4>
                        <p>
                            Explore how plants communicate with each other
                            and with other organisms through volatile
                            organic compounds, electrical signals, and even
                            sound waves. Interactive displays let you
                            "listen" to plant sounds and observe chemical
                            signaling in real-time.
                        </p>

                        <h4 class="mt-4 mb-3">
                            <span class="badge bg-accent-cl me-2">2</span>
                            Plant Intelligence
                        </h4>
                        <p>
                            Discover how plants solve problems, make
                            decisions, and remember past experiences. See
                            live demonstrations of plant learning behaviors
                            and participate in experiments that reveal their
                            remarkable cognitive abilities.
                        </p>

                        <h4 class="mt-4 mb-3">
                            <span class="badge bg-accent-cl me-2">3</span>
                            The Wood Wide Web
                        </h4>
                        <p>
                            Dive into the underground network of mycorrhizal
                            fungi that connects plants in a vast
                            communication and resource-sharing system. A
                            walk-through installation recreates this hidden
                            world at human scale.
                        </p>

                        <h4 class="mt-4 mb-3">
                            <span class="badge bg-accent-cl me-2">4</span>
                            Plants & The Future
                        </h4>
                        <p>
                            Learn how understanding plant intelligence can
                            help us address global challenges like food
                            security, climate change, and biodiversity loss.
                            See innovative technologies inspired by plant
                            communication systems.
                        </p>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Event Info Card -->
                    <div class="event-card p-4 mb-4">
                        <h3 class="h4 mb-4 fw-bold section-title">
                            Event Information
                        </h3>

                        <div class="d-flex align-items-start mb-4">
                            <i class="bi bi-calendar-event detail-icon"></i>
                            <div>
                                <h5 class="mb-1 fw-bold">Date</h5>
                                <p class="mb-0">
                                    June 15 - September 30, 2023
                                </p>
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
                            <i class="bi bi-geo-alt detail-icon"></i>
                            <div>
                                <h5 class="mb-1 fw-bold">Location</h5>
                                <p class="mb-0">
                                    Green Heritage Museum<br />
                                    Botanical Wing, 2nd Floor<br />
                                    123 Nature Way, Greensville
                                </p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start mb-4">
                            <i
                                class="bi bi-ticket-perforated detail-icon"
                            ></i>
                            <div>
                                <h5 class="mb-1 fw-bold">Admission</h5>
                                <p class="mb-0">
                                    All exhibitions are free with Museum
                                    admission.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Countdown -->
                    <div class="event-card countdown mb-4">
                        <h4 class="mb-4">Exhibition Opens In:</h4>
                        <div class="row text-center">
                            <div class="col-3">
                                <div class="countdown-number" id="days">
                                    00
                                </div>
                                <div class="countdown-label">Days</div>
                            </div>
                            <div class="col-3">
                                <div class="countdown-number" id="hours">
                                    00
                                </div>
                                <div class="countdown-label">Hours</div>
                            </div>
                            <div class="col-3">
                                <div class="countdown-number" id="minutes">
                                    00
                                </div>
                                <div class="countdown-label">Minutes</div>
                            </div>
                            <div class="col-3">
                                <div class="countdown-number" id="seconds">
                                    00
                                </div>
                                <div class="countdown-label">Seconds</div>
                            </div>
                        </div>
                    </div>

                    <!-- Map -->
                    <div class="event-card p-4 mb-4">
                        <h3 class="h4 mb-4 fw-bold section-title">
                            Location Map
                        </h3>
                        <div class="map-container">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.215256627966!2d-73.98784492453812!3d40.74844097138995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c259a9b3117469%3A0xd134e199a405a163!2sEmpire%20State%20Building!5e0!3m2!1sen!2sus!4v1689870033995!5m2!1sen!2sus"
                                width="100%"
                                height="100%"
                                style="border: 0"
                                allowfullscreen=""
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"
                            ></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Events -->
    <section class="related-events">
        <div class="container">
            <h2 class="section-title text-center mb-5">
                You Might Also Like
            </h2>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="event-card h-100">
                        <img
                            src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&q=80"
                            class="event-img w-100"
                            alt="Rainforest event"
                        />
                        <div class="p-4">
                            <span class="info-badge mb-3 d-inline-block"
                                >Lecture Series</span
                            >
                            <h3 class="h4">Rainforest Conservation</h3>
                            <p class="mb-4">
                                Learn about efforts to protect the world's
                                most biodiverse ecosystems.
                            </p>
                            <div
                                class="d-flex justify-content-between align-items-center"
                            >
                                <span class="text-muted"
                                    ><i
                                        class="bi bi-calendar-event me-2"
                                    ></i>
                                    July 10, 2023</span
                                >
                                <a href="#" class="btn btn-sm btn-custom"
                                    >Details
                                    <i class="bi bi-arrow-right ms-1"></i
                                ></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="event-card h-100">
                        <img
                            src="https://images.unsplash.com/photo-1605000797499-95a51c5269ae?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1471&q=80"
                            class="event-img w-100"
                            alt="Herbology event"
                        />
                        <div class="p-4">
                            <span class="info-badge mb-3 d-inline-block"
                                >Workshop</span
                            >
                            <h3 class="h4">Medicinal Herbology</h3>
                            <p class="mb-4">
                                Discover the healing power of plants in this
                                hands-on workshop.
                            </p>
                            <div
                                class="d-flex justify-content-between align-items-center"
                            >
                                <span class="text-muted"
                                    ><i
                                        class="bi bi-calendar-event me-2"
                                    ></i>
                                    August 5, 2023</span
                                >
                                <a href="#" class="btn btn-sm btn-custom"
                                    >Details
                                    <i class="bi bi-arrow-right ms-1"></i
                                ></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="event-card h-100">
                        <img
                            src="https://images.unsplash.com/photo-1531415074968-036ba1b575da?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80"
                            class="event-img w-100"
                            alt="Photography event"
                        />
                        <div class="p-4">
                            <span class="info-badge mb-3 d-inline-block"
                                >Special Event</span
                            >
                            <h3 class="h4">Botanical Photography</h3>
                            <p class="mb-4">
                                Capture the beauty of plants with expert
                                guidance from our resident photographer.
                            </p>
                            <div
                                class="d-flex justify-content-between align-items-center"
                            >
                                <span class="text-muted"
                                    ><i
                                        class="bi bi-calendar-event me-2"
                                    ></i>
                                    September 15, 2023</span
                                >
                                <a href="#" class="btn btn-sm btn-custom"
                                    >Details
                                    <i class="bi bi-arrow-right ms-1"></i
                                ></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Countdown timer
        function updateCountdown() {
            const eventDate = new Date("June 15, 2025 09:00:00").getTime();
            const now = new Date().getTime();
            const distance = eventDate - now;

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor(
                (distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
            );
            const minutes = Math.floor(
                (distance % (1000 * 60 * 60)) / (1000 * 60)
            );
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
</body>


<?php
    include "components/footer.php";
    include "components/last.php";
?>