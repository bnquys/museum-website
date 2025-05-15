import os
import sys

# Fixed output directory for converted .txt files
OUTPUT_DIR = "C:\\Users\\admin\\Documents"  # Bạn có thể đổi lại nếu muốn

def convert_to_txt(input_file_path):
    try:
        # Kiểm tra file tồn tại hay không
        if not os.path.isfile(input_file_path):
            print(f"Error: File '{input_file_path}' does not exist.")
            return

        # Chỉ hỗ trợ file .php hoặc .sql
        valid_extensions = ['.php', '.sql']
        _, ext = os.path.splitext(input_file_path)
        if ext.lower() not in valid_extensions:
            print(f"Error: Only files with extensions {valid_extensions} are supported.")
            return

        # Tạo thư mục output nếu chưa tồn tại
        os.makedirs(OUTPUT_DIR, exist_ok=True)

        # Tạo đường dẫn file output
        base_name = os.path.basename(input_file_path)
        file_name_without_ext = os.path.splitext(base_name)[0]
        output_file_path = os.path.join(OUTPUT_DIR, f"{file_name_without_ext}.txt")

        # Đọc nội dung file gốc
        with open(input_file_path, 'r', encoding='utf-8') as infile:
            content = infile.read()

        # Ghi nội dung sang file .txt với comment đường dẫn đầy đủ ở đầu
        with open(output_file_path, 'w', encoding='utf-8') as outfile:
            abs_input_path = os.path.abspath(input_file_path)
            outfile.write(f"/* Original file path: {abs_input_path} */\n\n")  # Comment dòng đầu tiên
            outfile.write(content)

        print(f"File '{input_file_path}' has been converted to '{output_file_path}' with path comment added.")

    except PermissionError:
        print("Error: Permission denied. Cannot access the file or directory.")
    except Exception as e:
        print(f"Unexpected error: {e}")

if __name__ == "__main__":
    if len(sys.argv) != 2:
        print("Usage: python convert_to_txt.py <source_file_path>")
    else:
        input_path = sys.argv[1]
        convert_to_txt(input_path)
