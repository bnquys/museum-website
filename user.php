<?php
    $css = "user";
    $title = $name = "User";
    include "components/first.php"; 

    require_once realpath(__DIR__."/vendor/autoload.php");
?>

<body>
        <!-- Header Section -->
        <header class="profile-header py-5 mb-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h1 class="display-4 fw-bold">
                            <i class="bi bi-person-circle me-3"></i>
                            <?= htmlspecialchars($accountLogin?->getUser()->name ?? '') ?> Profile
                        </h1>
                        <p class="lead">
                            Update your personal information and preferences
                        </p>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content Section -->
        <main class="container mb-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <!-- Profile Update Card -->
                    <div class="card profile-card mb-4 border-0 p-2">
                        <div class="card-header bg-white">
                            <h3 class="card-title mb-0">
                                <i class="bi bi-pencil-square me-2"></i>Personal
                                Information
                            </h3>
                        </div>
                        <div class="card-body">
                            <!-- Profile Update Form -->
                            <form id="profileForm">
                                <!-- Name Section -->
                                <div class="mb-4">
                                    <label for="fullName" class="form-label">
                                        <i
                                            class="bi bi-person-fill profile-icon"
                                        ></i
                                        >Full Name
                                    </label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="fullName"
                                        name="name"
                                        value="<?= htmlspecialchars($accountLogin?->getUser()->name ?? '') ?>"
                                        required
                                    />
                                </div>

                                <!-- Contact Information -->
                                <div class="mb-4">
                                    <label for="email" class="form-label">
                                        <i
                                            class="bi bi-envelope-fill profile-icon"
                                        ></i
                                        >Email Address
                                    </label>
                                    <input
                                        type="email"
                                        class="form-control"
                                        id="email"
                                        name="email"
                                        value="<?= htmlspecialchars($accountLogin?->getUser()->email ?? '') ?>"
                                        required
                                    />
                                    <div class="form-text">
                                        We'll never share your email with anyone
                                        else.
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="phone" class="form-label">
                                        <i
                                            class="bi bi-telephone-fill profile-icon"
                                        ></i
                                        >Phone Number
                                    </label>
                                    <input
                                        type="tel"
                                        class="form-control"
                                        id="phone"
                                        name="phoneNumber"
                                        value="<?= htmlspecialchars($accountLogin?->getUser()->phoneNumber ?? '') ?>"
                                    />
                                </div>

                                <!-- Form Buttons -->
                                <div class="d-flex justify-content-center mt-5">
                                    <button
                                        type="submit"
                                        class="btn btn-primary px-4"
                                    >
                                        <i class="bi bi-save me-2"></i>Save
                                        Changes
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Additional Profile Options -->
                    <div class="card profile-card border-0 p-2">
                        <div class="card-header bg-white">
                            <h3 class="card-title mb-0">
                                <i class="bi bi-gear-fill me-2"></i>Account
                                Settings
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="list-group list-group-flush">
                                <a
                                    href="#"
                                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                                >
                                    <span
                                        ><i class="bi bi-key-fill me-2"></i
                                        >Change Password</span
                                    >
                                    <i class="bi bi-chevron-right"></i>
                                </a>
                                <a
                                    href="#"
                                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                                >
                                    <span
                                        ><i
                                            class="bi bi-calendar-event-fill me-2"
                                        ></i
                                        >Visit History</span
                                    >
                                    <i class="bi bi-chevron-right"></i>
                                </a>
                                <a
                                    href="#"
                                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center text-danger"
                                >
                                    <span
                                        ><i class="bi bi-trash-fill me-2"></i
                                        >Delete Account</span
                                    >
                                    <i class="bi bi-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Bootstrap 5 JS Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Custom JavaScript for form handling -->
        <script>
            document
                .getElementById("profileForm")
                .addEventListener("submit", function (e) {
                    e.preventDefault();

                    // In a real application, you would send this data to the server
                    // For this demo, we'll just show an alert
                    alert("Profile updated successfully!");

                    // You could add AJAX here to submit the form data
                    // Example:
                    /*
            fetch('/api/update-profile', {
                method: 'POST',
                body: JSON.stringify({
                    firstName: document.getElementById('firstName').value,
                    lastName: document.getElementById('lastName').value,
                    email: document.getElementById('email').value,
                    // ... other fields
                }),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                // Handle response
            });
            */
                });
        </script>
    </body>


<?php
    include "components/footer.php";
    include "components/last.php";
?>