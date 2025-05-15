<?php
namespace Museum\Utils;

class JsonDataManager {
    private $filePath;

    public function __construct(string $filePath) {
        $this->filePath = $filePath;

        if (!file_exists($this->filePath)) {
            $this->writeData([]);
        }
    }

    /**
     * Đọc toàn bộ dữ liệu
     */
    public function readAll(): array {
        $data = file_get_contents($this->filePath);
        return json_decode($data, true) ?? [];
    }

    /**
     * Đọc bản ghi theo ID
     */
    public function read(string $id): ?array {
        foreach ($this->readAll() as $record) {
            if ($record['id'] === $id) {
                return $record;
            }
        }
        return null;
    }

    /**
     * Tạo bản ghi mới
     * Nếu ID đã tồn tại => trả về null
     */
    public function create(array $record): ?array {
        $data = $this->readAll();

        if (!isset($record['id']) || empty($record['id'])) {
            $record['id'] = uniqid('id_', true);
        } else {
            if ($this->read($record['id']) !== null) {
                return null; // ID bị trùng
            }
        }

        $data[] = $record;
        $this->writeData($data);
        return $record;
    }

    /**
     * Cập nhật bản ghi theo ID
     * Nếu không tìm thấy => trả về null
     */
    public function update(string $id, array $newData): ?array {
        $data = $this->readAll();
        $found = false;

        foreach ($data as &$record) {
            if ($record['id'] === $id) {
                $record = array_merge($record, $newData);
                $record['id'] = $id; // Giữ nguyên ID
                $found = true;
                break;
            }
        }

        if ($found) {
            $this->writeData($data);
            return $this->read($id);
        }

        return null;
    }

    /**
     * Xoá bản ghi theo ID
     * Trả về true nếu xóa thành công, false nếu không tìm thấy
     */
    public function delete(string $id): bool {
        $data = $this->readAll();
        $newData = array_filter($data, fn($record) => (string)$record['id'] !== (string)$id);
    
        if (count($newData) === count($data)) {
            return false; // Không tìm thấy ID
        }
    
        $this->writeData(array_values($newData));
        return true;
    }
    

    /**
     * Ghi dữ liệu ra file JSON
     */
    private function writeData(array $data): void {
        file_put_contents($this->filePath, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    public function swap($id1, $id2): void {
        $data = $this->readAll();
    
        $index1 = $index2 = null;
        foreach ($data as $i => $item) {
            if ((string)$item['id'] === (string)$id1) $index1 = $i;
            if ((string)$item['id'] === (string)$id2) $index2 = $i;
        }
    
        if ($index1 !== null && $index2 !== null) {
            $tmp = $data[$index1];
            $data[$index1] = $data[$index2];
            $data[$index2] = $tmp;
    
            // Reassign sequential IDs
            foreach ($data as $i => &$item) {
                $item['id'] = $i + 1;
            }
    
            $this->writeData($data);
        }
    }

    
}
