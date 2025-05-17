import os
import sys
from datetime import datetime

# Fixed output directory for converted .txt files
OUTPUT_DIR = "C:\\Users\\admin\\Documents" 
# OUTPUT_DIR = "/home/quys/Documents/convert_txt"

def log(message, status="INFO"):
    """Log message with status and timestamp."""
    timestamp = datetime.now().strftime("%Y-%m-%d %H:%M:%S")
    print(f"[{status}] [{timestamp}] {message}")

def convert_to_txt(input_file_path):
    try:
        # Check if file exists
        if not os.path.isfile(input_file_path):
            log(f"File '{input_file_path}' does not exist.", status="ERROR")
            return

        # Only support .php or .sql files
        valid_extensions = ['.php', '.sql']
        _, ext = os.path.splitext(input_file_path)
        if ext.lower() not in valid_extensions:
            log(f"Only files with extensions {valid_extensions} are supported.", status="ERROR")
            return

        # Create output directory if it doesn't exist
        os.makedirs(OUTPUT_DIR, exist_ok=True)

        # Generate output file path
        base_name = os.path.basename(input_file_path)
        file_name_without_ext = os.path.splitext(base_name)[0]
        output_file_path = os.path.join(OUTPUT_DIR, f"{file_name_without_ext}.txt")

        # Read original file content
        with open(input_file_path, 'r', encoding='utf-8') as infile:
            content = infile.read()

        # Write to .txt with original path as a comment
        with open(output_file_path, 'w', encoding='utf-8') as outfile:
            abs_input_path = os.path.abspath(input_file_path)
            outfile.write(f"/* Original file path: {abs_input_path} */\n\n")
            outfile.write(content)

        log(f"File '{input_file_path}' has been converted to '{output_file_path}' with path comment added.", status="SUCCESS")

    except PermissionError:
        log("Permission denied. Cannot access the file or directory.", status="ERROR")
    except Exception as e:
        log(f"Unexpected error: {e}", status="ERROR")

def main():
    if len(sys.argv) != 2:
        log("Usage: python convert_to_txt.py <source_file_path>", status="ERROR")
    else:
        input_path = sys.argv[1]
        convert_to_txt(input_path)
        
if __name__ == "__main__":
    main()
