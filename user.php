<?php
    $css = "user";
    $title = $name = "User";
    include "components/first.php"; 

    require_once realpath(__DIR__."/vendor/autoload.php");
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
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['login'])) {
    
        // Validate name
        if (empty($name) || !preg_match("/^[a-zA-ZÀ-ỹ\s]+$/u", $name)) {
            $errors['name'] = "Tên không hợp lệ. Chỉ cho phép chữ cái và khoảng trắng.";
            $valid = false;
        }
    
        // Validate phone number
        if (!preg_match('/^0\d{9}$/', $phone)) {
            $errors['phoneNumber'] = "Số điện thoại phải bắt đầu bằng 0 và có 10 chữ số.";
            $valid = false;
        }
    
        // Validate birthDate
        if (!empty($birthDate)) {
            $date = DateTime::createFromFormat('Y-m-d', $birthDate);
            if (!$date || $date > new DateTime() || $date < new DateTime('-120 years')) {
                $errors['birthDate'] = "Ngày sinh không hợp lệ.";
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
                }
            }
    
            $user::update($user);
            header("Location: user.php");
            exit;
        }
    }
    
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
                            <?php $avatar = $accountLogin?->getUser()->avatar ?? 'https://placehold.co/394x394/orange/white?text=Avatar'; ?>
                            <div class="text-center mb-4">
                                <img id="avatar-preview" src="<?= htmlspecialchars($avatar) ?>" alt="Avatar" class="rounded-circle" width="120" height="120" />
                            </div>

                            <!-- Profile Update Form -->
                            <form id="profileForm" method="POST" enctype="multipart/form-data">
                                <!-- Avatar Upload -->
                                <div class="mb-4">
                                    <label for="avatar" class="form-label">
                                        <i class="bi bi-image-fill profile-icon"></i>Avatar Image
                                    </label>
                                    <input
                                        type="file"
                                        class="form-control"
                                        id="avatar"
                                        name="avatar"
                                        accept="image/*"
                                    />
                                    <div class="mt-2">
                                        <button type="button" class="btn btn-outline-secondary btn-sm" id="reset-avatar">
                                            <i class="bi bi-arrow-counterclockwise me-1"></i> Reset to Default Avatar
                                        </button>
                                    </div>
                                </div>

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
                                        value="<?= htmlspecialchars($_POST['name'] ?? $accountLogin?->getUser()->name ?? '') ?>"
                                        required
                                    />
                                    <?php if (!empty($errors['name'])): ?>
                                        <div class="invalid-feedback"><?= $errors['name'] ?></div>
                                    <?php endif; ?>
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
                                        readonly
                                    />
                                    <div class="form-text">
                                        We'll never share your email with anyone
                                        else.
                                    </div>
                                </div>
                                
                                <!-- Phone Number -->
                                <div class="mb-4">
                                    <label for="phone" class="form-label">
                                        <i class="bi bi-telephone-fill profile-icon"></i>Phone Number
                                    </label>
                                    <input
                                        type="tel"
                                        class="form-control <?= isset($errors['phoneNumber']) ? 'is-invalid' : '' ?>"
                                        id="phone"
                                        name="phoneNumber"
                                        value="<?= htmlspecialchars($_POST['phoneNumber'] ?? $accountLogin?->getUser()->phoneNumber ?? '') ?>"
                                    />
                                    <?php if (!empty($errors['phoneNumber'])): ?>
                                        <div class="invalid-feedback"><?= $errors['phoneNumber'] ?></div>
                                    <?php endif; ?>
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
                                        value="<?= htmlspecialchars($_POST['birthDate'] ?? $accountLogin?->getUser()->birthDate ?? '') ?>"
                                        min="<?= date('Y-m-d', strtotime('-120 years')) ?>"
                                        max="<?= date('Y-m-d') ?>"
                                    />
                                    <?php if (!empty($errors['birthDate'])): ?>
                                        <div class="invalid-feedback"><?= $errors['birthDate'] ?></div>
                                    <?php endif; ?>
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
                                    href="?action=change-password"
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
                                <a
                                    href="dashboard.php"
                                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                                >
                                    <span><i class="bi bi-speedometer2 me-2"></i>Go to Dashboard</span>
                                    <i class="bi bi-chevron-right"></i>
                                </a>
                                <a
                                    href="?action=log-out"
                                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center text-danger"
                                >
                                    <span><i class="bi bi-box-arrow-right me-2"></i>Log Out</span>
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

        <script>
            const defaultAvatar = 'https://placehold.co/394x394/orange/white?text=Avatar';
            const avatarInput = document.getElementById('avatar');
            const avatarPreview = document.getElementById('avatar-preview');
            const form = document.getElementById('profileForm');

            // Xem trước khi chọn file
            avatarInput.addEventListener('change', function (event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        avatarPreview.src = e.target.result;
                    };
                    reader.readAsDataURL(file);

                    // Xóa cờ reset nếu người dùng chọn ảnh mới
                    const resetInput = document.getElementById('reset-avatar-flag');
                    if (resetInput) {
                        resetInput.remove();
                    }
                }
            });

            // Xử lý đặt lại ảnh mặc định
            document.getElementById('reset-avatar').addEventListener('click', function () {
                avatarPreview.src = defaultAvatar;
                avatarInput.value = '';

                // Thêm cờ ẩn vào form
                if (!document.getElementById('reset-avatar-flag')) {
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'reset_avatar';
                    hiddenInput.id = 'reset-avatar-flag';
                    hiddenInput.value = '1';
                    form.appendChild(hiddenInput);
                }
            });
        </script>



    </body>


<?php
    include "components/footer.php";
    include "components/last.php";
?>