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
                <p class="text-muted fst-italic">Our Tickets</p>
                <h1>Visit Our Museum <br>to reconect with the <br>wonders of nature</h1>
                <p class="mt-4 mx-auto text-gray" style="max-width: 600px">
                    The Our Museum is an impressive tourist
                    attraction and offers a wealth of authentic artifacts and
                    documentation. Discover our world of historical and
                    international mourning rituals or focus on the more present-day
                    funeral artifacts we have to offer. You can buy tickets online
                    or on-site.
                </p>
            </div>

            <form class="container" id="ticketForm">
                <!-- Choose Date and Time -->
                <div class="section">
                    <div
                        class="row fw-bold border-bottom pb-2 mb-3 mt-5 text-center"
                    >
                        <h2 class="col-12">Choose Date and Time Arrival</h2>
                    </div>
    
                    <div
                        class="row g-3 align-items-center justify-content-center mb-4 text-center"
                    >
                        <div class="col-md-4">
                            <label for="visitDate" class="form-label"
                                >Select Date</label
                            >
                            <input
                                type="date"
                                id="visitDate"
                                class="form-control mx-auto"
                            />
                        </div>
                        <div class="col-md-4">
                            <label for="visitTime" class="form-label"
                                >Select Time Slot</label
                            >
                            <select id="visitTime" class="form-select mx-auto">
                                <option value="">-- Select a date first --</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Choose Participants -->
                <div class="section">
                    <div
                        class="row fw-bold border-bottom pb-2 mb-3 mt-5 text-center"
                    >
                        <h2 class="col-12">Choose your participants</h2>
                    </div>
    
                    <!-- Children 5 and under -->
                    <div class="row align-items-center mt-4 mb-4">
                        <div class="col-6 col-md-6">
                            <p class="ticket-type">Children (5 and under)</p>
                            <p class="ticket-desc">Children under 5 are <strong>FREE</strong>.</p>
                        </div>
                        <div class="col-2 col-md-2 price text-center">$0</div>
                        <div class="col-2 col-md-2">
                            <input
                                type="number"
                                class="form-control"
                                min="0"
                                value="0"
                                data-price="0"
                            />
                        </div>
                        <div class="col-2 col-md-2 text-center">
                            <span class="row-total">$0.00</span>
                        </div>
                    </div>
    
                    <!-- Children 6-11 -->
                    <div class="row align-items-center mb-4">
                        <div class="col-6 col-md-6">
                            <p class="ticket-type">Children (6-11)</p>
                            <p class="ticket-desc">Ages 6 - 11</p>
                        </div>
                        <div class="col-2 col-md-2 price text-center">$7</div>
                        <div class="col-2 col-md-2">
                            <input
                                type="number"
                                class="form-control"
                                min="0"
                                value="0"
                                data-price="7"
                            />
                        </div>
                        <div class="col-2 col-md-2 text-center">
                            <span class="row-total">$0.00</span>
                        </div>
                    </div>
    
                    <!-- Adult -->
                    <div class="row align-items-center mb-4">
                        <div class="col-6 col-md-6">
                            <p class="ticket-type">Adult</p>
                            <p class="ticket-desc">Day-pass</p>
                        </div>
                        <div class="col-2 col-md-2 price text-center">$15</div>
                        <div class="col-2 col-md-2">
                            <input
                                type="number"
                                class="form-control"
                                min="0"
                                value="0"
                                data-price="15"
                            />
                        </div>
                        <div class="col-2 col-md-2 text-center">
                            <span class="row-total">$0.00</span>
                        </div>
                    </div>
    
                    <!-- Seniors & Veterans -->
                    <div class="row align-items-center mb-4">
                        <div class="col-6 col-md-6">
                            <p class="ticket-type">Seniors & Veterans</p>
                            <p class="ticket-desc">55+ and Veterans</p>
                        </div>
                        <div class="col-2 col-md-2 price text-center">$12</div>
                        <div class="col-2 col-md-2">
                            <input
                                type="number"
                                class="form-control"
                                min="0"
                                value="0"
                                data-price="12"
                            />
                        </div>
                        <div class="col-2 col-md-2 text-center">
                            <span class="row-total">$0.00</span>
                        </div>
                    </div>
    
                    <!-- SCI Employee -->
                    <div class="row align-items-center mb-4">
                        <div class="col-6 col-md-6">
                            <p class="ticket-type">SCI Employee</p>
                            <p class="ticket-desc">Day-pass</p>
                        </div>
                        <div class="col-2 col-md-2 price text-center">$10</div>
                        <div class="col-2 col-md-2">
                            <input
                                type="number"
                                class="form-control"
                                min="0"
                                value="0"
                                data-price="10"
                            />
                        </div>
                        <div class="col-2 col-md-2 text-center">
                            <span class="row-total">$0.00</span>
                        </div>
                    </div>
    
                    <!-- Group -->
                    <div class="row align-items-center mb-4">
                        <div class="col-6 col-md-6">
                            <p class="ticket-type">Group</p>
                            <p class="ticket-desc">Minimum 25 guests</p>
                        </div>
                        <div class="col-2 col-md-2 price text-center">$10</div>
                        <div class="col-2 col-md-2">
                            <input
                                type="number"
                                class="form-control"
                                min="0"
                                value="0"
                                data-price="10"
                            />
                        </div>
                        <div class="col-2 col-md-2 text-center">
                            <span class="row-total">$0.00</span>
                        </div>
                    </div>
                </div>

                <!-- Tour Guide Selection -->
                <div class="section">
                    <div
                        class="row fw-bold border-bottom pb-2 mb-3 mt-5 text-center"
                    >
                        <h2 class="col-12">Choose Your Tour Guide</h2>
                    </div>
    
                    <div class="row row-cols-1 row-cols-md-4 g-4 mt-2">
                        <!-- Guide 1 -->
                        <div class="col">
                            <div
                                class="card h-100 p-2 guide-card"
                                data-price="30"
                                data-guide="alex"
                            >
                                <img
                                    src="https://i.imgur.com/OKjR72P.jpg"
                                    class="card-img-top"
                                    alt="Alex"
                                />
                                <div class="card-body">
                                    <h5 class="card-title">Alex</h5>
                                    <p>
                                        <strong>Expertise:</strong> History,
                                        Architecture
                                    </p>
                                    <p>
                                        <strong>Languages:</strong> English, Spanish
                                    </p>
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
                        <div class="col">
                            <div
                                class="card h-100 p-2 guide-card"
                                data-price="35"
                                data-guide="bella"
                            >
                                <img
                                    src="https://i.imgur.com/EqvEBQn.jpg"
                                    class="card-img-top"
                                    alt="Bella"
                                />
                                <div class="card-body">
                                    <h5 class="card-title">Bella</h5>
                                    <p>
                                        <strong>Expertise:</strong> Nature, Wildlife
                                    </p>
                                    <p>
                                        <strong>Languages:</strong> English, French
                                    </p>
                                    <p>
                                        <strong>Intro:</strong> Forest queen 🌿
                                        talks to animals (low-key)
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
                        <div class="col">
                            <div
                                class="card h-100 p-2 guide-card"
                                data-price="25"
                                data-guide="chris"
                            >
                                <img
                                    src="https://i.imgur.com/AdK0r9v.jpg"
                                    class="card-img-top"
                                    alt="Chris"
                                />
                                <div class="card-body">
                                    <h5 class="card-title">Chris</h5>
                                    <p><strong>Expertise:</strong> Food Tours</p>
                                    <p>
                                        <strong>Languages:</strong> English, Korean
                                    </p>
                                    <p>
                                        <strong>Intro:</strong> Will make you eat
                                        things you didn’t know existed 🍜
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
                        <div class="col">
                            <div
                                class="card h-100 p-2 guide-card"
                                data-price="40"
                                data-guide="dana"
                            >
                                <img
                                    src="https://i.imgur.com/g4qftFJ.jpg"
                                    class="card-img-top"
                                    alt="Dana"
                                />
                                <div class="card-body">
                                    <h5 class="card-title">Dana</h5>
                                    <p><strong>Expertise:</strong> Art, Museums</p>
                                    <p>
                                        <strong>Languages:</strong> English, Italian
                                    </p>
                                    <p>
                                        <strong>Intro:</strong> Walking encyclopedia
                                        of painting memes 🖼️
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
                    <div class="mb-2">
                        <h5>Total: >>><span id="totalPrice">$0.00</span></h5>
                    </div>
                    <button class="btn btn-warning">Checkout</button>
                </div>
            </form>
        </section>
        <script>
            const inputs = document.querySelectorAll('input[type="number"]');
            const totalDisplay = document.getElementById("totalPrice");
            const guideCards = document.querySelectorAll(".guide-card");

            function calculateTotal() {
                let total = 0;

                inputs.forEach((input) => {
                    const qty = parseInt(input.value) || 0;
                    const price = parseFloat(input.dataset.price);
                    const rowTotal = qty * price;
                    total += rowTotal;

                    // Update the row total
                    const row = input.closest(".row");
                    const rowTotalSpan = row.querySelector(".row-total");
                    if (rowTotalSpan) {
                        rowTotalSpan.textContent = `$${rowTotal.toFixed(2)}`;
                    }
                });

                const selectedCard = document.querySelector(
                    ".guide-card.selected"
                );
                if (selectedCard) {
                    const guidePrice = parseFloat(selectedCard.dataset.price);
                    total += guidePrice;
                }

                totalDisplay.textContent = `$${total.toFixed(2)}`;
            }

            inputs.forEach((input) =>
                input.addEventListener("input", calculateTotal)
            );

            guideCards.forEach((card) => {
                card.addEventListener("click", () => {
                    guideCards.forEach((c) => c.classList.remove("selected"));
                    card.classList.add("selected");

                    const radio = card.querySelector(".guide-radio");
                    if (radio) radio.checked = true;

                    calculateTotal();
                });
            });
        </script>
        <script>
            const visitDate = document.getElementById("visitDate");
            const visitTime = document.getElementById("visitTime");

            const availability = {
                "2025-04-16": ["09:00 AM", "10:30 AM", "01:00 PM", "03:00 PM"],
                "2025-04-17": ["10:00 AM", "12:00 PM", "02:00 PM"],
                "2025-04-18": ["08:30 AM", "11:00 AM", "01:30 PM", "04:00 PM"],
                // Default fallback
                default: ["09:00 AM", "11:00 AM", "02:00 PM"],
            };

            visitDate.addEventListener("change", () => {
                const selected = visitDate.value;
                const times = availability[selected] || availability["default"];

                visitTime.innerHTML = "";
                times.forEach((time) => {
                    const opt = document.createElement("option");
                    opt.value = time;
                    opt.textContent = time;
                    visitTime.appendChild(opt);
                });
            });
        </script>

        <?php 
            include "components/footer.php";
        ?>
        <script src="./assets/js/dropdown-menu.js"></script>
        <script src="assets/js/bootstrap.bundle.js"></script>
        <script src="assets/js/sip.js"></script>
	</body>
</html>
