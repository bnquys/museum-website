<?php
require_once realpath(__DIR__ . "/../../vendor/autoload.php");

use Museum\Utils\FileUploader;
use Museum\Utils\JsonDataManager;

$dataManager = new JsonDataManager(__DIR__ . '/../../assets/data/museum_data.json');
$museum = $dataManager->read('museum_info');
$about = $dataManager->read('museum_about');

$faqManager = new JsonDataManager(__DIR__ . '/../../assets/data/common_question.json');
$faqs = $faqManager->readAll();

if ($_SERVER["REQUEST_METHOD"] === 'GET') {
    if (isset($_GET['delete_faq_id'])) {
        $faqManager->delete($_GET['delete_faq_id']);
        header("Location: dashboard.php?page=museum#faq-section");
        exit;
    }

    if (isset($_GET['move_up_id'])) {
        $currentId = $_GET['move_up_id'];
        $faqs = $faqManager->readAll();
        foreach ($faqs as $index => $item) {
            if ((string)$item['id'] === (string)$currentId && $index > 0) {
                $prevId = $faqs[$index - 1]['id'];
                $faqManager->swap($currentId, $prevId);
                break;
            }
        }
        header("Location: dashboard.php?page=museum#faq-section");
        exit;
    }

    if (isset($_GET['move_down_id'])) {
        $currentId = $_GET['move_down_id'];
        $faqs = $faqManager->readAll();
        foreach ($faqs as $index => $item) {
            if ((string)$item['id'] === (string)$currentId && $index < count($faqs) - 1) {
                $nextId = $faqs[$index + 1]['id'];
                $faqManager->swap($currentId, $nextId);
                break;
            }
        }
        header("Location: dashboard.php?page=museum#faq-section");
        exit;
    }

}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['update_museum_info'])) {
        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
        $opening_hours = [];

        foreach ($days as $day) {
            $opening_hours[$day] = [
                'opening' => $_POST["{$day}_opening"],
                'closing' => $_POST["{$day}_closing"],
                'closed' => isset($_POST["{$day}_closed"])
            ];        
        }

        $updateData = [
            'name' => $_POST['name'],
            'address' => $_POST['address'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'summary' => $_POST['summary'] ?? '',
            'opening_hours' => $opening_hours
        ];
        

        $dataManager->update('museum_info', $updateData);
        header("Location: dashboard.php?page=museum");
        exit;
    }

    if (isset($_POST['update_about'])) {
        $imagePath = $about['image'] ?? '';
    
        if (!empty($_FILES['about_image']['name'])) {
            $uploader = new FileUploader('assets/img/');
            $imagePath = $uploader->upload($_FILES['about_image']);
        }
    
        $aboutUpdate = [
            'id' => 'museum_about',
            'image' => $imagePath,
            'introduction' => [
                'title' => $_POST['about_title'],
                'content' => $_POST['about_content']
            ]
        ];
    
        if ($about) {
            $dataManager->update('museum_about', $aboutUpdate);
        } else {
            $dataManager->create($aboutUpdate);
        }
    
        header("Location: dashboard.php?page=museum");
        exit;
    }

    if (isset($_POST['add_faq'])) {
        $question = trim($_POST['faq_question']);
        $answer = trim($_POST['faq_answer']);
        $id = md5($question); 
    
        $faq = [
            'id' => $id,
            'question' => $question,
            'answer' => $answer
        ];
    
        if ($faqManager->read($id)) {
            $faqManager->update($id, $faq);
        } else {
            $faqManager->create($faq);
        }
    
        header("Location: dashboard.php?page=museum#faq-section");
        exit;
    }   
    
    if (isset($_POST['update_faq'])) {
        $id = $_POST['edit_faq_id'];
        $question = trim($_POST['faq_question']);
        $answer = trim($_POST['faq_answer']);
    
        $faq = [
            'id' => $id,
            'question' => $question,
            'answer' => $answer
        ];
    
        $faqManager->update($id, $faq);
        header("Location: dashboard.php?page=museum#faq-section");
        exit;
    }    
}
?>

<div class="container mt-4">
    <section>
        <h2 class="text-center">Museum Info Manager</h2>
    
        <form method="POST">
            <div class="mb-3">
                <label for="name">Museum Name</label>
                <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($museum['name']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="address">Address</label>
                <input type="text" name="address" class="form-control" value="<?= htmlspecialchars($museum['address']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($museum['email']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="phone">Phone</label>
                <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($museum['phone']) ?>" required>
            </div>
    
            <h4>Opening Hours</h4>
            <?php
            $days = [
                'monday' => 'Monday',
                'tuesday' => 'Tuesday',
                'wednesday' => 'Wednesday',
                'thursday' => 'Thursday',
                'friday' => 'Friday',
                'saturday' => 'Saturday',
                'sunday' => 'Sunday'
            ];
    
            foreach ($days as $key => $label) {
                $opening = $museum['opening_hours'][$key]['opening'] ?? '';
                $closing = $museum['opening_hours'][$key]['closing'] ?? '';
                $closed = $museum['opening_hours'][$key]['closed'] ?? false;
                $checked = $closed ? 'checked' : '';
                
                echo "
                <div class='mb-3'>
                    <label>{$label}</label>
                    <div class='d-flex align-items-center'>
                        <input type='time' name='{$key}_opening' class='form-control' value='{$opening}'>
                        <span class='mx-2'>to</span>
                        <input type='time' name='{$key}_closing' class='form-control' value='{$closing}'>
                        <div class='form-check ms-3'>
                            <input class='form-check-input' type='checkbox' name='{$key}_closed' value='1' {$checked}>
                            <label class='form-check-label'>Closed</label>
                        </div>
                    </div>
                </div>";
            }
            ?>
            
            <div class="mb-3">
                <label for="summary">Opening Hours Summary</label>
                <textarea name="summary" class="form-control" rows="3"><?= htmlspecialchars($museum['summary'] ?? '') ?></textarea>
            </div>
    
            <button type="submit" name="update_museum_info" class="btn btn-success mt-3">Update Info</button>
        </form>
    </section>

    <section>
        <h2 class="mt-5">About Introduction Editor</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="row">
                <!-- Cột trái: Upload ảnh -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="about_image">Introduction Image</label>
                        <input type="file" class="form-control" name="about_image">
                        <?php if (!empty($about['image'])): ?>
                            <div class="mt-2">
                                <img src="<?= htmlspecialchars($about['image']) ?>" alt="Intro Image" class="img-fluid" style="max-height: 200px;">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
    
                <!-- Cột phải: Title và Content -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="about_title">Introduction Title</label>
                        <textarea id="about_title" class="form-control" name="about_title" rows="2"><?= htmlspecialchars($about['introduction']['title'] ?? '') ?></textarea>
                    </div>
    
                    <div class="mb-3">
                        <label for="about_content">Introduction Content</label>
                        <textarea id="about_content" class="form-control" name="about_content" rows="6"><?= htmlspecialchars($about['introduction']['content'] ?? '') ?></textarea>
                    </div>
                </div>
                <script>
                    ClassicEditor
                        .create(document.querySelector('#about_title'), {
                            removePlugins: ['ImageUpload', 'EasyImage', 'MediaEmbed'],
                            toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'undo', 'redo']
                        })
                        .catch(error => {
                            console.error(error);
                        });
                    ClassicEditor
                        .create(document.querySelector('#about_content'), {
                            removePlugins: ['ImageUpload', 'EasyImage', 'MediaEmbed'],
                            toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'undo', 'redo']
                        })
                        .catch(error => {
                            console.error(error);
                        });
                </script>
    
            </div>
    
            <button type="submit" name="update_about" class="btn btn-primary mt-3">Update About Info</button>
        </form>
    </section>

    <section id="faq-section">
        <h2 class="mt-5">FAQ Manager</h2>

        <form method="POST" class="mt-4">
            <div class="mb-3">
                <label for="faq_question" class="form-label">Question</label>
                <input type="text" name="faq_question" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="faq_answer" class="form-label">Answer</label>
                <textarea name="faq_answer" class="form-control" rows="3" required></textarea>
            </div>
            <button type="submit" name="add_faq" class="btn btn-info">
                Add question
            </button>
        </form>


        <div class="mt-4">
            <h4>List of Frequently Asked Questions</h4>
            <?php if (!empty($faqs)): ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-primary">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col" style="width: 5%;">#</th>
                                <th scope="col" style="width: 30%;">Question</th>
                                <th scope="col">Answer</th>
                                <th scope="col" style="width: 25%;">Actions</th>
                            </tr>
                        </thead>

                        </thead>
                        <tbody>
                            <?php foreach ($faqs as $index => $faq): ?>
                                <form method="POST">
                                    <tr data-faq-id="<?= $faq['id'] ?>">
                                        <input type="hidden" name="edit_faq_id" value="<?= $faq['id'] ?>">
                                        <td><?= $index + 1 ?></td>

                                        <!-- Question -->
                                        <td>
                                            <span class="faq-question-text"><?= htmlspecialchars($faq['question']) ?></span>
                                            <input type="text" class="form-control d-none faq-question-input" name="faq_question" value="<?= htmlspecialchars($faq['question']) ?>">
                                        </td>

                                        <!-- Answer -->
                                        <td>
                                            <span class="faq-answer-text"><?= htmlspecialchars($faq['answer']) ?></span>
                                            <textarea class="form-control d-none faq-answer-input" name="faq_answer"><?= htmlspecialchars($faq['answer']) ?></textarea>
                                        </td>

                                        <!-- Actions -->
                                        <td>
                                            <div class="btn-group" role="group">
                                                <!-- Edit -->
                                                <a href="#" class="btn btn-sm btn-warning btn-edit" title="Edit">✏️</a>

                                                <!-- Save / Cancel -->
                                                <div class="btn-save-cancel d-none">
                                                    <button type="submit" name="update_faq" class="btn btn-sm btn-primary" title="Save">💾</button>
                                                    <button type="button" class="btn btn-sm btn-secondary btn-cancel" title="Cancel">❌</button>
                                                </div>

                                                <!-- Other actions -->
                                                <a href="?page=museum&delete_faq_id=<?= $faq['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this question?')" title="Delete">🗑</a>
                                                <a href="?page=museum&move_up_id=<?= $faq['id'] ?>" class="btn btn-sm btn-secondary" <?= $index === 0 ? 'disabled' : '' ?> title="Move Up">↑</a>
                                                <a href="?page=museum&move_down_id=<?= $faq['id'] ?>" class="btn btn-sm btn-secondary" <?= $index === count($faqs) - 1 ? 'disabled' : '' ?> title="Move Down">↓</a>
                                            </div>
                                        </td>
                                    </tr>
                                </form>

                            <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>
            <?php else: ?>
                <p class="text-muted">No questions added yet.</p>
            <?php endif; ?>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                document.querySelectorAll(".btn-edit").forEach(btn => {
                    btn.addEventListener("click", function (e) {
                        e.preventDefault();
                        const row = this.closest("tr");
                        row.querySelector(".faq-question-text").classList.add("d-none");
                        row.querySelector(".faq-answer-text").classList.add("d-none");
                        row.querySelector(".faq-question-input").classList.remove("d-none");
                        row.querySelector(".faq-answer-input").classList.remove("d-none");
                        row.querySelector(".btn-save-cancel").classList.remove("d-none");
                        this.classList.add("d-none");
                    });
                });

                document.querySelectorAll(".btn-cancel").forEach(btn => {
                    btn.addEventListener("click", function () {
                        const row = this.closest("tr");
                        row.querySelector(".faq-question-text").classList.remove("d-none");
                        row.querySelector(".faq-answer-text").classList.remove("d-none");
                        row.querySelector(".faq-question-input").classList.add("d-none");
                        row.querySelector(".faq-answer-input").classList.add("d-none");
                        row.querySelector(".btn-save-cancel").classList.add("d-none");
                        row.querySelector(".btn-edit").classList.remove("d-none");
                    });
                });
            });
        </script>

    </section>

</div>