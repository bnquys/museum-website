<?php 
$data = array();

if (isset($_FILES['upload']['name'])) {
    $file_name = basename($_FILES['upload']['name']);
    $upload_dir = __DIR__ . '/uploads/';
    $file_path = $upload_dir . $file_name;
    $file_url = 'uploads/' . $file_name; // relative path for access via browser
    $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    // Kiểm tra phần mở rộng hợp lệ
    if (in_array($file_extension, ['jpg', 'jpeg', 'png'])) {
        // Tạo thư mục nếu chưa tồn tại
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        if (move_uploaded_file($_FILES['upload']['tmp_name'], $file_path)) {
            $data['file'] = $file_name;
            $data['url'] = $file_url;
            $data['uploaded'] = 1;
        } else {
            $data['uploaded'] = 0;
            $data['error']['message'] = 'Error! File not uploaded';
        }
    } else {
        $data['uploaded'] = 0;
        $data['error']['message'] = 'Invalid extension';
    }
}

echo json_encode($data);
?>
