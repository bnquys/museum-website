<?php
$css = "ticket";
$title = "Ticket";
$name = "In Person Tickets";
include "components/first.php";
include "components/navbar.php";
include "components/banner.php";
?>
<!-- Ticket Pricing Section -->
<section class="container-fluid">
    <!-- Intro Section -->
    <div id="intro" class="container text-center">
        <p class="text-muted fst-italic fs-4 mb-2 mv-tb">Our Tickets</p>
        <h1 class="mv-tb">
            Visit Our Museum <br class="mv-tb" />to reconect with the
            <br class="mv-tb" />wonders of nature
        </h1>
        <p class="mt-4 mx-auto text-gray fs-5 mv-tb" style="max-width: 400px">
            The Our Museum is an impressive tourist attraction and offers a
            wealth of authentic artifacts and documentation. Discover our world
            of historical and international mourning rituals or focus on the
            more present-day funeral artifacts we have to offer. You can buy
            tickets online or on-site.
        </p>
    </div>

    <form class="container" id="ticketForm">
        <!-- Choose Date and Time -->
        <div class="section">
            <div class="row fw-bold border-bottom pb-2 mb-3 mt-5 text-center">
                <h2 class="col-12 mv-lr">Choose Your Date and Time Arrival</h2>
            </div>

            <div
                class="row g-3 align-items-center justify-content-center mb-4 text-center"
            >
                <div class="col-md-4">
                    <label for="visitDate" class="form-label fs-5"
                        >Select Date</label
                    >
                    <input
                        type="date"
                        id="visitDate"
                        class="form-control mx-auto"
                    />
                </div>
                <div class="col-md-4">
                    <label for="visitTime" class="form-label fs-5">Select Time</label>
                    <input
                        type="time"
                        id="visitTime"
                        class="form-control mx-auto"
                    />
                </div>
            </div>
        </div>

        <!-- Choose Participants -->
        <div class="section">
            <div class="row fw-bold border-bottom pb-2 mb-3 mt-5 text-center">
                <h2 class="col-12 mv-lr">Choose your participants</h2>
            </div>

            <!-- Children 5 and under -->
            <div class="row align-items-center mt-4 mb-4">
                <div class="col-12 col-md-6">
                    <p class="ticket-type mv-lr">Children (5 and under)</p>
                    <p class="ticket-desc">
                        Children under 5 are <strong>FREE</strong>.
                    </p>
                </div>
                <div class="col-4 col-md-2 price text-center">$0</div>
                <div class="col-4 col-md-2">
                    <input
                        type="number"
                        class="form-control"
                        min="0"
                        value="0"
                        data-price="0"
                    />
                </div>
                <div class="col-4 col-md-2 text-center">
                    <span class="fs-3">FREE</span>
                </div>
            </div>

            <!-- Children 6-11 -->
            <div class="row align-items-center mb-4">
                <div class="col-12 col-md-6">
                    <p class="ticket-type mv-lr">Children (6-11)</p>
                    <p class="ticket-desc">Ages 6 - 11</p>
                </div>
                <div class="col-4 col-md-2 price text-center">$7</div>
                <div class="col-4 col-md-2">
                    <input
                        type="number"
                        class="form-control"
                        min="0"
                        value="0"
                        data-price="7"
                    />
                </div>
                <div class="col-4 col-md-2 text-center">
                    <span class="row-total">$0.00</span>
                </div>
            </div>

            <!-- Adult -->
            <div class="row align-items-center mb-4">
                <div class="col-12 col-md-6">
                    <p class="ticket-type mv-lr">Adult</p>
                    <p class="ticket-desc">Day-pass</p>
                </div>
                <div class="col-4 col-md-2 price text-center">$15</div>
                <div class="col-4 col-md-2">
                    <input
                        type="number"
                        class="form-control"
                        min="0"
                        value="0"
                        data-price="15"
                    />
                </div>
                <div class="col-4 col-md-2 text-center">
                    <span class="row-total">$0.00</span>
                </div>
            </div>

            <!-- Seniors & Veterans -->
            <div class="row align-items-center mb-4">
                <div class="col-12 col-md-6">
                    <p class="ticket-type mv-lr">Seniors & Veterans</p>
                    <p class="ticket-desc">55+ and Veterans</p>
                </div>
                <div class="col-4 col-md-2 price text-center">$12</div>
                <div class="col-4 col-md-2">
                    <input
                        type="number"
                        class="form-control"
                        min="0"
                        value="0"
                        data-price="12"
                    />
                </div>
                <div class="col-4 col-md-2 text-center">
                    <span class="row-total">$0.00</span>
                </div>
            </div>

            <!-- SCI Employee -->
            <div class="row align-items-center mb-4">
                <div class="col-12 col-md-6">
                    <p class="ticket-type mv-lr">SCI Employee</p>
                    <p class="ticket-desc">Day-pass</p>
                </div>
                <div class="col-4 col-md-2 price text-center">$10</div>
                <div class="col-4 col-md-2">
                    <input
                        type="number"
                        class="form-control"
                        min="0"
                        value="0"
                        data-price="10"
                    />
                </div>
                <div class="col-4 col-md-2 text-center">
                    <span class="row-total">$0.00</span>
                </div>
            </div>
        </div>

        <!-- Tour Guide Selection -->
        <div class="section">
            <div
                class="d-flex justify-content-center fw-bold border-bottom pb-2 mb-3 mt-5 text-center"
            >
                <h2 class="mv-lr">Want a tour guide ?</h2>
                <!-- Yes/No -->
                <div class="checkbox-wrapper-10 ms-3">
                    <input class="tgl tgl-flip" id="cb5" type="checkbox" />
                    <label
                        class="tgl-btn"
                        data-tg-off="Nope"
                        data-tg-on="Yeah!"
                        for="cb5"
                    ></label>
                </div>
            </div>

            <!-- List Guiders -->
            <div class="row row-cols-1 row-cols-md-4 g-4 mt-2 guide-list">
                <!-- Guide 1 -->
                <div class="col mv-scale">
                    <div
                        class="card h-100 p-2 guide-card"
                        data-price="30"
                        data-guide="alex"
                    >
                        <img
                            src="assets/img/male1.jpg"
                            class="card-img-top"
                            alt="Alex"
                        />
                        <div class="card-body">
                            <h5 class="card-title">Alex</h5>
                            <p>
                                <strong>Expertise:</strong> History,
                                Architecture
                            </p>
                            <p><strong>Languages:</strong> English, Spanish</p>
                            <p>
                                <strong>Intro:</strong> Loves storytelling &
                                spicy fun facts 🌶️
                            </p>
                            <p><strong>Price:</strong> $30</p>
                            <input
                                type="radio"
                                name="guide"
                                class="form-check-input guide-radio d-none"
                                value="alex"
                            />
                        </div>
                    </div>
                </div>

                <!-- Guide 2 -->
                <div class="col mv-scale">
                    <div
                        class="card h-100 p-2 guide-card"
                        data-price="35"
                        data-guide="bella"
                    >
                        <img
                            src="assets/img/female1.jpg"
                            class="card-img-top"
                            alt="Bella"
                        />
                        <div class="card-body">
                            <h5 class="card-title">Bella</h5>
                            <p><strong>Expertise:</strong> Nature, Wildlife</p>
                            <p><strong>Languages:</strong> English, French</p>
                            <p>
                                <strong>Intro:</strong> Forest queen 🌿 talks to
                                animals (low-key)
                            </p>
                            <p><strong>Price:</strong> $35</p>
                            <input
                                type="radio"
                                name="guide"
                                class="form-check-input guide-radio d-none"
                                value="bella"
                            />
                        </div>
                    </div>
                </div>

                <!-- Guide 3 -->
                <div class="col mv-scale">
                    <div
                        class="card h-100 p-2 guide-card"
                        data-price="25"
                        data-guide="chris"
                    >
                        <img
                            src="assets/img/male2.jpg"
                            class="card-img-top"
                            alt="Chris"
                        />
                        <div class="card-body">
                            <h5 class="card-title">Chris</h5>
                            <p><strong>Expertise:</strong> Food Tours</p>
                            <p><strong>Languages:</strong> English, Korean</p>
                            <p>
                                <strong>Intro:</strong> Will make you eat things
                                you didn’t know existed 🍜
                            </p>
                            <p><strong>Price:</strong> $25</p>
                            <input
                                type="radio"
                                name="guide"
                                class="form-check-input guide-radio d-none"
                                value="chris"
                            />
                        </div>
                    </div>
                </div>

                <!-- Guide 4 -->
                <div class="col mv-scale">
                    <div
                        class="card h-100 p-2 guide-card"
                        data-price="40"
                        data-guide="dana"
                    >
                        <img
                            src="assets/img/female2.jpg"
                            class="card-img-top"
                            alt="Dana"
                        />
                        <div class="card-body">
                            <h5 class="card-title">Dana</h5>
                            <p><strong>Expertise:</strong> Art, Museums</p>
                            <p><strong>Languages:</strong> English, Italian</p>
                            <p>
                                <strong>Intro:</strong> Walking encyclopedia of
                                painting memes 🖼️
                            </p>
                            <p><strong>Price:</strong> $40</p>
                            <input
                                type="radio"
                                name="guide"
                                class="form-check-input guide-radio d-none"
                                value="dana"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total and Add to Cart Section -->
        <div
            class="d-flex justify-content-end align-items-end flex-column text-end mt-4"
        >
            <div class="mini-bill my-3">
                <div class="container p-0">
                    <div class="box">
                        <span class="title fw-bold">MINI BILL</span>
                        <div>
                            <strong>YOUR BRIEF BILL</strong>
                            <div id="miniBillDetails"></div>
                        </div>
                    </div>
                </div>
            </div>
            <p
                id="checkoutError"
                style="color: red; display: none; margin-bottom: 10px; max-width: 20vw;"
                class="fw-bold"
            ></p>
            <div class="button-92" role="button">Checkout now !</div>
        </div>
    </form>

    <!-- Checkout Overlay -->
    <div id="checkoutOverlay" style="display: none">
        <div class="overlay-bg"></div>
        <div class="overlay-content text-center">
            <h4>Scan to Complete Your Purchase</h4>
            <img
                src="https://api.qrserver.com/v1/create-qr-code/?data=SamplePaymentLink123&size=200x200"
                alt="QR Code"
            />
            <p class="mt-3">
                Please scan this QR code to finalize your booking.
            </p>
        </div>
    </div>
</section>
<script>
    $(document).ready(function () {
        const visitDate = document.getElementById("visitDate");
        const visitTime = document.getElementById("visitTime");

        // const availability = {
        //     "2025-04-16": ["09:00 AM", "10:30 AM", "01:00 PM", "03:00 PM"],
        //     "2025-04-17": ["10:00 AM", "12:00 PM", "02:00 PM"],
        //     "2025-04-18": ["08:30 AM", "11:00 AM", "01:30 PM", "04:00 PM"],
        //     // Default fallback
        //     default: ["09:00 AM", "11:00 AM", "02:00 PM"],
        // };

        // visitDate.addEventListener("change", () => {
        //     const selected = visitDate.value;
        //     const times = availability[selected] || availability["default"];

        //     visitTime.innerHTML = "";
        //     times.forEach((time) => {
        //         const opt = document.createElement("option");
        //         opt.value = time;
        //         opt.textContent = time;
        //         visitTime.appendChild(opt);
        //     });
        // });

        // Initially hide the guide list
        $(".guide-list").hide();

        // When the checkbox is clicked (Yeah/Nope)
        $("#cb5").change(function () {
            if (this.checked) {
                // Show the guide list with animation
                $(".guide-list").stop(true, true).slideDown(700);
            } else {
                // Hide the guide list with animation and unselect all guides
                $(".guide-list").stop(true, true).slideUp(700);
                // Unselect all guides
                $(".guide-card").removeClass("selected");
                $('input[name="guide"]:checked').prop("checked", false);
                calculateTotal();
            }
        });

        const guideCards = document.querySelectorAll(".guide-card");

        guideCards.forEach((card) => {
            card.addEventListener("click", () => {
                // Toggle the selection state of the clicked guide
                if (card.classList.contains("selected")) {
                    card.classList.remove("selected");
                    const radio = card.querySelector(".guide-radio");
                    if (radio) radio.checked = false; // Uncheck the radio
                } else {
                    // Deselect any previously selected guide
                    guideCards.forEach((c) => c.classList.remove("selected"));
                    card.classList.add("selected");

                    const radio = card.querySelector(".guide-radio");
                    if (radio) radio.checked = true;
                }

                // Recalculate total price
                calculateTotal();
            });
        });

        // Function to calculate the total price
        function calculateTotal() {
            let total = 0;
            let participants = [];

            const miniBill = document.getElementById("miniBillDetails");
            miniBill.innerHTML = "";

            // Get selected date and time
            const selectedDate = visitDate.value;
            const selectedTime = visitTime.value;

            // Process ticket selections
            inputs.forEach((input) => {
                const qty = parseInt(input.value) || 0;
                const price = parseFloat(input.dataset.price);
                const row = input.closest(".row");
                const typeEl = row.querySelector(".ticket-type");
                const type = typeEl ? typeEl.textContent.trim() : "Ticket";

                const rowTotal = qty * price;
                total += rowTotal;

                // Update row total display
                const rowTotalSpan = row.querySelector(".row-total");
                if (rowTotalSpan) {
                    rowTotalSpan.textContent = `$${rowTotal.toFixed(2)}`;
                }

                if (qty > 0) {
                    participants.push(
                        `${qty} × ${type} - $${rowTotal.toFixed(2)}`
                    );
                }
            });

            // Build Date and Time section
            let dateTimeHTML = "";
            if (selectedDate || selectedTime) {
                dateTimeHTML += `<h6 class="fw-bold mb-2">Date and Time (*)</h6><ul class="list-unstyled">`;
                if (selectedDate) {
                    const formattedDate = new Date(
                        selectedDate
                    ).toLocaleDateString(undefined, {
                        weekday: "long",
                        year: "numeric",
                        month: "long",
                        day: "numeric",
                    });
                    dateTimeHTML += `<li>${formattedDate}</li>`;
                }
                if (selectedTime) {
                    dateTimeHTML += `<li>Time: ${selectedTime}</li>`;
                }
                dateTimeHTML += `</ul><hr>`;
            }

            // Build Participants section
            let participantsHTML = "";
            if (participants.length > 0) {
                participantsHTML += `<h6 class="fw-bold mb-2">Participants (*)</h6><ul class="list-unstyled">`;
                participantsHTML += participants
                    .map((item) => `<li>${item}</li>`)
                    .join("");
                participantsHTML += `</ul><hr>`;
            }

            // Build Tour Guide section
            let guideHTML = `<h6 class="fw-bold mb-2">Tour Guide</h6><ul class="list-unstyled">`;
            const selectedGuide = document.querySelector(
                ".guide-card.selected"
            );
            if (selectedGuide) {
                const guideName = selectedGuide
                    .querySelector(".card-title")
                    .textContent.trim();
                const guidePrice = parseFloat(selectedGuide.dataset.price);
                total += guidePrice;
                guideHTML += `<li>${guideName} - $${guidePrice.toFixed(
                    2
                )}</li>`;
            } else {
                guideHTML += `<li>No tour guider</li>`;
            }
            guideHTML += `</ul><hr>`;

            // Final Mini Bill render
            const hasAnyData =
                selectedDate ||
                selectedTime ||
                participants.length > 0 ||
                selectedGuide;

            if (hasAnyData) {
                miniBill.innerHTML = `
            ${dateTimeHTML}
            ${participantsHTML}
            ${guideHTML}
            <p class="fw-bold fs-5 mt-1">Total: $${total.toFixed(2)}</p>
        `;
            } else {
                miniBill.innerHTML = "<p>No items selected.</p>";
            }
        }

        const inputs = document.querySelectorAll('input[type="number"]');

        inputs.forEach((input) =>
            input.addEventListener("input", calculateTotal)
        );

        // Add these to update bill when date/time changes
        visitDate.addEventListener("change", calculateTotal);
        visitTime.addEventListener("change", calculateTotal);

        // 👇 This runs calculateTotal() immediately on page load
        calculateTotal();
    });

    document.querySelector(".button-92").addEventListener("click", function () {
        const visitDate = document.getElementById("visitDate").value;
        const visitTime = document.getElementById("visitTime").value;
        const inputs = document.querySelectorAll('input[type="number"]');
        const errorMsg = document.getElementById("checkoutError");

        let hasParticipant = false;
        inputs.forEach((input) => {
            if (parseInt(input.value) > 0) {
                hasParticipant = true;
            }
        });

        // Validation check
        if (!visitDate || !visitTime || !hasParticipant) {
            errorMsg.textContent =
                "Please select Date, Time, and at least one participant before checking out.";
            errorMsg.style.display = "block";
            return;
        }

        // Clear error and proceed
        errorMsg.style.display = "none";
        document.getElementById("checkoutOverlay").style.display = "block";
        document.body.style.overflow = "hidden";
    });

    document
        .getElementById("checkoutOverlay")
        .addEventListener("click", function (e) {
            if (e.target.classList.contains("overlay-bg")) {
                document.getElementById("checkoutOverlay").style.display =
                    "none";
                document.body.style.overflow = "auto";
            }
        });
</script>
<?php 
include "components/footer.php";
include "components/last.php";
?>
