<?php
    $css = "user";
    $title = $name = "<Name> Profile";
    include "components/first.php"; 

    require_once realpath(__DIR__."/vendor/autoload.php");

    if (!isset($accountLogin)) {
        header('Location: portal.php');
        exit;
    }

    use Museum\Object\AccountRole;
    use Museum\Object\Language;
    use Museum\Utils\FileUploader;

    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'log-out':
                unset($_SESSION['login']);
                header("Location: index.php");
                exit;
    
            case 'change-password':
                $_SESSION['change_pass'] = [
                    'username' => $accountLogin->username,
                    'email' => $accountLogin->email,
                    'name' => $accountLogin->getUser()->name,
                    'birthDate' => $accountLogin->getUser()->birthDate,
                    'phoneNumber' => $accountLogin->getUser()->phoneNumber
                ];
    
                header("Location: portal.php?pg=create-account");
                exit;
    
            default:
                break;
        }
    }

    $errors = [];
    $name = $_POST['name'] ?? '';
    $phone = $_POST['phoneNumber'] ?? '';
    $birthDate = $_POST['birthDate'] ?? '';
    $valid = true;
    
    $userLogin = $accountLogin?->getUser();

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['login'])) {
    
        // Validate name
        if (empty($name) || !preg_match("/^[a-zA-ZÀ-ỹ\s]+$/u", $name)) {
            $errors['name'] = "Invalid name. Only letters and spaces are allowed.";
            $valid = false;
        }
    
        // Validate phone number
        if (!preg_match('/^0\d{9}$/', $phone)) {
            $errors['phoneNumber'] = "Phone number must start with 0 and contain exactly 10 digits.";
            $valid = false;
        }
    
        // Validate birthDate
        if (!empty($birthDate)) {
            $date = DateTime::createFromFormat('Y-m-d', $birthDate);
            if (!$date || $date > new DateTime() || $date < new DateTime('-120 years')) {
                $errors['birthDate'] = "Invalid birth date.";
                $valid = false;
            }
        }

        if (isset($_POST['isGuide'])) {
            if (empty($_POST['languages']) || !is_array($_POST['languages']) || count($_POST['languages']) === 0) {
                $errors['languages'] = "Please select at least one language.";
                $valid = false;
            }
        }
    
        if ($valid) {
            $user = $accountLogin->getUser();
            $user->name = $name;
            $user->phoneNumber = $phone;
            $user->birthDate = $birthDate;
    
            if (isset($_POST['reset_avatar']) && $_POST['reset_avatar'] === '1') {
                $user->setAvatar('https://placehold.co/394x394/orange/white?text=Avatar');
            } elseif (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
                $uploader = new FileUploader("assets/uploads/avatar/");
                $path = $uploader->upload($_FILES['avatar']);
                if ($path) {
                    $user->setAvatar($path);
                } else {
                    $errors['avatar'] = $uploader->error ?: "Failed to upload avatar.";
                    $valid = false;
                }
            }

            if (isset($_POST['isGuide'])) {
                $user->saveAsGuide();
            } else {
                $user->removeGuide();
            }
    
            $user::update($user);

            if ($user->isGuide()) {
                $guide = $user->getGuide();
                if ($guide) {
                    $intro = $_POST['intro'] ?? '';
                    $experience = $_POST['experience'] ?? '';
                    $price = isset($_POST['price']) ? floatval($_POST['price']) : 0;
            
                    $guide->setIntroduction($intro);
                    $guide->setExpertise($experience);
                    $guide->setPrice($price);
                }
            } 
            
            if ($valid && isset($_POST['isGuide']) && $user->isGuide()) {
                $guide = $user->getGuide();
                if ($guide && isset($_POST['languages']) && is_array($_POST['languages'])) {
                    $selectedLangs = $_POST['languages'];
                    $currentLangs = $guide->getLanguages(); // Array of Language objects
            
                    $guide->updateLanguages($_POST['languages']);
                }
            }                       
            
            header("Location: user.php");
            exit;
        }
    }
    
?>

<body>
    <!-- Header Section -->
    <header class="profile-header py-5 mb-5">
        <div class="container position-relative">
            <div class="row align-items-center">
                <div class="col-md-2 text-center text-md-start mb-4 mb-md-0">
                    <div class="avatar-container">
                        <?php $avatar = $userLogin->avatar ?? 'https://placehold.co/394x394/green/white?text=Avatar'; ?>
                        <img id="avatar-preview" src="<?= htmlspecialchars($avatar) ?>" alt="Avatar" class="avatar-preview" />
                        <label for="avatar" class="avatar-upload-btn">
                            <i class="bi bi-camera-fill"></i>
                        </label>
                    </div>
                </div>
                <div class="col-md-10 text-center text-md-start">
                    <h1 class="display-4 fw-bold text-white mb-2">
                        <?= htmlspecialchars($userLogin->name ?? '') ?>
                    </h1>
                    <p class="lead text-white mb-3">
                        <?= $userLogin->isGuide() ? 'Museum Guide' : 'Museum Visitor' ?>
                    </p>
                    <div class="d-flex flex-wrap justify-content-center justify-content-md-start gap-2">
                        <span class="badge bg-white bg-opacity-20 px-3 py-2 rounded-pill" style="color: var(--dark-cl)">
                            <i class="bi bi-envelope-fill me-1"></i> <?= htmlspecialchars($userLogin->email ?? '') ?>
                        </span>
                        <?php if (!empty($userLogin->phoneNumber)): ?>
                        <span class="badge bg-white bg-opacity-20 px-3 py-2 rounded-pill" style="color: var(--dark-cl)">
                            <i class="bi bi-telephone-fill me-1"></i> <?= htmlspecialchars($userLogin->phoneNumber) ?>
                        </span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content Section -->
    <main class="container mb-5">
        <div class="row">
            <!-- Sidebar Navigation -->
            <div class="col-lg-3 mb-4 mb-lg-0">
                <div class="profile-card p-3 sticky-top" style="top: 20px;">
                    <h3 class="fw-semibold mb-3">
                        <i class="bi bi-person-lines-fill profile-icon"></i>Navigation
                    </h3>
                    <ul class="nav flex-column">
                        <li class="nav-item active p-2 mb-1">
                            <a class="nav-link d-flex align-items-center" href="#">
                                <i class="bi bi-person-fill me-3"></i>
                                <span>Profile</span>
                            </a>
                        </li>
                        <li class="nav-item p-2 mb-1">
                            <a class="nav-link d-flex align-items-center" href="?action=change-password">
                                <i class="bi bi-key-fill me-3"></i>
                                <span>Change Password</span>
                            </a>
                        </li>
                        <li class="nav-item p-2 mb-1">
                            <a class="nav-link d-flex align-items-center" href="#">
                                <i class="bi bi-calendar-event-fill me-3"></i>
                                <span>Visit History</span>
                            </a>
                        </li>
                        <li class="nav-item p-2 mb-1">
                            <a class="nav-link d-flex align-items-center" href="dashboard.php">
                                <i class="bi bi-speedometer2 me-3"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item p-2 mb-1">
                            <a class="nav-link d-flex align-items-center text-danger" href="#">
                                <i class="bi bi-trash-fill me-3"></i>
                                <span>Delete Account</span>
                            </a>
                        </li>
                        <li class="nav-item p-2">
                            <a class="nav-link d-flex align-items-center text-danger" href="?action=log-out">
                                <i class="bi bi-box-arrow-right me-3"></i>
                                <span>Log Out</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Main Profile Content -->
            <div class="col-lg-9">
                <!-- Profile Update Card -->
                <div class="profile-card p-4 mb-4">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
                        <h3 class="fw-semibold  mb-3 mb-md-0">
                            <i class="bi bi-pencil-square profile-icon"></i>Edit Profile
                        </h3>
                        <?php if ($userLogin->isGuide()): ?>
                        <span class="badge bg-success bg-opacity-10 text-success px-3 py-2">
                            <i class="bi bi-star-fill me-1"></i> Verified Guide
                        </span>
                        <?php endif; ?>
                    </div>

                    <!-- Profile Update Form -->
                    <form id="profileForm" method="POST" enctype="multipart/form-data">
                        <input type="file" class="d-none" id="avatar" name="avatar" accept="image/*" />
                                                
                        <!-- Name Section -->
                        <div class="mb-4">
                            <label for="fullName" class="form-label">
                                <i class="bi bi-person-fill profile-icon"></i>Full Name
                            </label>
                            <input
                                type="text"
                                class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>"
                                id="fullName"
                                name="name"
                                value="<?= htmlspecialchars($_POST['name'] ?? $userLogin->name ?? '') ?>"
                                required
                            />
                            <?php if (!empty($errors['name'])): ?>
                                <div class="invalid-feedback"><?= $errors['name'] ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- Contact Information -->
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label for="email" class="form-label">
                                    <i class="bi bi-envelope-fill profile-icon"></i>Email Address
                                </label>
                                <input
                                    type="email"
                                    class="form-control bg-light"
                                    id="email"
                                    name="email"
                                    value="<?= htmlspecialchars($userLogin->email ?? '') ?>"
                                    required
                                    readonly
                                />
                                <div class="form-text">
                                    We'll never share your email with anyone else.
                                </div>
                            </div>
                                                    
                            <!-- Phone Number -->
                            <div class="col-md-6">
                                <label for="phone" class="form-label">
                                    <i class="bi bi-telephone-fill profile-icon"></i>Phone Number
                                </label>
                                <input
                                    type="tel"
                                    class="form-control <?= isset($errors['phoneNumber']) ? 'is-invalid' : '' ?>"
                                    id="phone"
                                    name="phoneNumber"
                                    value="<?= htmlspecialchars($_POST['phoneNumber'] ?? $userLogin->phoneNumber ?? '') ?>"
                                />
                                <?php if (!empty($errors['phoneNumber'])): ?>
                                    <div class="invalid-feedback"><?= $errors['phoneNumber'] ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Birth Date -->
                        <div class="mb-4">
                            <label for="birthDate" class="form-label">
                                <i class="bi bi-calendar-date-fill profile-icon"></i>Birth Date
                            </label>
                            <input
                                type="date"
                                class="form-control <?= isset($errors['birthDate']) ? 'is-invalid' : '' ?>"
                                id="birthDate"
                                name="birthDate"
                                value="<?= htmlspecialchars($_POST['birthDate'] ?? $userLogin->birthDate ?? '') ?>"
                                min="<?= date('Y-m-d', strtotime('-120 years')) ?>"
                                max="<?= date('Y-m-d') ?>"
                            />
                            <?php if (!empty($errors['birthDate'])): ?>
                                <div class="invalid-feedback"><?= $errors['birthDate'] ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- Guide Section -->
                        <div class="mb-4">
                            <div class="form-check mb-3">
                                <input 
                                    type="checkbox"
                                    id="isGuideCheckbox"
                                    name="isGuide"
                                    class="form-check-input"
                                    <?= $userLogin->isGuide() ? 'checked' : '' ?>
                                >
                                <label for="isGuideCheckbox" class="form-check-label">
                                    I am a Museum Guide
                                </label>
                            </div>

                            <?php
                                $guideData = $userLogin->isGuide() ? $userLogin->getGuide() : null;
                                $introValue = $guideData?->getIntroduction() ?? '';
                                $experienceValue = $guideData?->getExpertise() ?? '';
                            ?>
                                                    
                            <div id="guideFields" class="bg-light p-3 rounded <?= $userLogin->isGuide() ? '' : 'd-none' ?>">
                                <div class="mb-3">
                                    <label for="intro" class="form-label">
                                        Introduction
                                    </label>
                                    <textarea 
                                        id="intro"
                                        name="intro"
                                        class="form-control"
                                        rows="3"
                                        placeholder="Tell visitors about yourself and your guiding style..."
                                    ><?= htmlspecialchars($introValue) ?></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="experience" class="form-label">
                                        Experience & Expertise
                                    </label>
                                    <textarea 
                                        id="experience"
                                        name="experience"
                                        class="form-control"
                                        rows="3"
                                        placeholder="Share your experience and areas of expertise..."
                                    ><?= htmlspecialchars($experienceValue)?></textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3 mb-md-0">
                                        <label for="price" class="form-label">
                                            Hourly Rate (USD)
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input
                                                type="number"
                                                class="form-control"
                                                id="price"
                                                name="price"
                                                min="0"
                                                step="0.01"
                                                value="<?= htmlspecialchars($_POST['price'] ?? $guideData?->getPrice() ?? '') ?>"
                                                placeholder="0.00"
                                            />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">
                                            Languages Spoken
                                        </label>
                                        <div id="languageOptions" class="d-flex flex-wrap gap-2">
                                        <?php
                                            $languages = Language::getAll();
                                            $selectedLangs = $guideData?->getLanguages() ?? [];
                                            $selectedLangIds = array_map(fn($l) => $l->id, $selectedLangs);
                                                                        
                                            foreach ($languages as $lang):
                                                $checked = in_array($lang->id, $selectedLangIds) ? 'checked' : '';
                                        ?>
                                            <div class="form-check form-check-inline">
                                                <input 
                                                    type="checkbox"
                                                    name="languages[]"
                                                    value="<?= htmlspecialchars($lang->id) ?>"
                                                    id="lang-<?= htmlspecialchars($lang->id) ?>"
                                                    class="form-check-input"
                                                    <?= $checked ?>
                                                >
                                                <label
                                                    for="lang-<?= htmlspecialchars($lang->id) ?>"
                                                    class="form-check-label language-tag badge bg-white border border-1 <?= $checked ? 'active' : '' ?>"
                                                >
                                                    <?= htmlspecialchars($lang->name) ?>
                                                </label>
                                            </div>
                                        <?php endforeach; ?>
                                        </div>
                                        <?php if (!empty($errors['languages'])): ?>
                                            <div class="text-danger small mt-2"><?= htmlspecialchars($errors['languages']) ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Buttons -->
                        <div class="d-flex justify-content-end gap-3 mt-4">
                            <button
                                type="button"
                                id="reset-avatar"
                                class="btn btn-outline-secondary"
                            >
                                <i class="bi bi-arrow-counterclockwise me-2"></i>Reset Avatar
                            </button>
                            <button
                                type="submit"
                                class="btn btn-primary"
                            >
                                <i class="bi bi-save me-2"></i>Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>


    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        const defaultAvatar = 'https://placehold.co/394x394/green/white?text=Avatar';
        const avatarInput = document.getElementById('avatar');
        const avatarPreview = document.getElementById('avatar-preview');
        const form = document.getElementById('profileForm');
        const uploadBtn = document.querySelector('.avatar-upload-btn');

        // Handle avatar upload click
        uploadBtn.addEventListener('click', () => {
            avatarInput.click();
        });

        // Preview selected avatar
        avatarInput.addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    avatarPreview.src = e.target.result;
                    avatarPreview.classList.add('border-success');
                };
                reader.readAsDataURL(file);

                // Remove reset flag if user selects new image
                const resetInput = document.getElementById('reset-avatar-flag');
                if (resetInput) {
                    resetInput.remove();
                }
            }
        });

        // Reset to default avatar
        document.getElementById('reset-avatar').addEventListener('click', function () {
            avatarPreview.src = defaultAvatar;
            avatarPreview.classList.remove('border-success');
            avatarInput.value = '';

            // Add hidden flag to form
            if (!document.getElementById('reset-avatar-flag')) {
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'reset_avatar';
                hiddenInput.id = 'reset-avatar-flag';
                hiddenInput.value = '1';
                form.appendChild(hiddenInput);
            }
        });

        // Toggle guide fields
        document.getElementById('isGuideCheckbox').addEventListener('change', function () {
            const guideFields = document.getElementById('guideFields');
            if (this.checked) {
                guideFields.classList.remove('d-none');
            } else {
                guideFields.classList.add('d-none');
            }
        });

        // Language tag selection
        document.querySelectorAll('#languageOptions .form-check-input').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const label = this.nextElementSibling;
                if (this.checked) {
                    label.classList.add('active');
                } else {
                    label.classList.remove('active');
                }
            });
        });
    </script>
</body>



<?php
    include "components/last.php";
?>