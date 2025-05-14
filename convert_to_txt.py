import os
import sys

# Fixed output directory for converted .txt files
OUTPUT_DIR = "/home/quys/Documents/convert_txt"  # Replace with your actual username or desired path

def convert_to_txt(input_file_path):
    try:
        # Check if the file exists
        if not os.path.isfile(input_file_path):
            print(f"Error: File '{input_file_path}' does not exist.")
            return

        # Check if the file extension is valid
        valid_extensions = ['.php', '.sql']
        _, ext = os.path.splitext(input_file_path)
        if ext.lower() not in valid_extensions:
            print(f"Error: Only files with extensions {valid_extensions} are supported.")
            return

        # Create the output directory if it does not exist
        os.makedirs(OUTPUT_DIR, exist_ok=True)

        # Prepare the output file path
        base_name = os.path.basename(input_file_path)
        file_name_without_ext = os.path.splitext(base_name)[0]
        output_file_path = os.path.join(OUTPUT_DIR, f"{file_name_without_ext}.txt")

        # Read from source and write to target file
        with open(input_file_path, 'r', encoding='utf-8') as infile:
            content = infile.read()

        with open(output_file_path, 'w', encoding='utf-8') as outfile:
            outfile.write(content)

        print(f"File '{input_file_path}' has been converted to '{output_file_path}'.")

    except PermissionError:
        print("Error: Permission denied. Cannot access the file or directory.")
    except Exception as e:
        print(f"Unexpected error: {e}")


if __name__ == "__main__":
    if len(sys.argv) != 2:
        print("Usage: python3 convert_to_txt.py <source_file_path>")
    else:
        input_path = sys.argv[1]
        convert_to_txt(input_path)
