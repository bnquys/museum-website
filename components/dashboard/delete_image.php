<?php
require_once realpath(__DIR__."/../../vendor/autoload.php");
use Museum\Object\Blog;

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Lấy blog từ ID
    $blog = Blog::getById($id);
    
    if ($blog && $blog->imgUrl) {
        // Kiểm tra đường dẫn file ảnh
        $imagePath = $_SERVER['DOCUMENT_ROOT'] . $blog->imgUrl;  // Đảm bảo đường dẫn tuyệt đối
        echo "Image Path: " . $imagePath; // In đường dẫn ảnh để kiểm tra

        if (file_exists($imagePath)) {
            // Xóa ảnh trên server
            if (unlink($imagePath)) {
                // Cập nhật cơ sở dữ liệu để xóa ảnh
                $blog->imgUrl = null; // Hoặc update trường ảnh thành null
                Blog::add($blog);
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to delete image from server.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Image does not exist on the server.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Blog not found or no image to delete.']);
    }
}
?>
