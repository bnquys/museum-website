import os
import sys

# List of folder names to ignore their inner contents
IGNORE_DIRS = {'.vscode', '.git', 'vendor', 'assets'}

# Fixed output path (you can change this)
# OUTPUT_DIR = "C:\\Users\\admin\\Documents"
OUTPUT_DIR = "/home/quys/Documents/convert_txt"
OUTPUT_FILENAME = "directory_tree.txt"

def write_tree(root_path, output_file):
    """
    Recursively traverses the directory tree and writes absolute paths to a text file.
    Certain folders are excluded from being expanded.
    """
    try:
        for dirpath, dirnames, filenames in os.walk(root_path):
            # Write the directory itself
            output_file.write(f"{os.path.abspath(dirpath)}\n")

            # Handle ignore directories: remove from dirnames to prevent os.walk recursion
            dirnames[:] = [d for d in dirnames if d not in IGNORE_DIRS]

            # For ignored directories, still print their path with [Skipped]
            for d in IGNORE_DIRS:
                ignored_path = os.path.join(dirpath, d)
                if os.path.isdir(ignored_path):
                    output_file.write(f"{os.path.abspath(ignored_path)} [Skipped contents]\n")

            # Write all files in the current directory
            for filename in filenames:
                file_path = os.path.join(dirpath, filename)
                output_file.write(f"{os.path.abspath(file_path)}\n")

    except Exception as e:
        output_file.write(f"[Error] while processing {root_path} - {e}\n")

def main():
    """
    Main function to execute the directory tree export.
    """
    # Get directory path from command line arguments, default to current directory
    if len(sys.argv) >= 2:
        root_path = sys.argv[1]
    else:
        root_path = os.getcwd()  # Get current working directory

    if not os.path.isdir(root_path):
        print(f"Error: The path '{root_path}' does not exist or is not a directory.")
        sys.exit(1)

    # Ensure the output directory exists
    os.makedirs(OUTPUT_DIR, exist_ok=True)
    output_path = os.path.join(OUTPUT_DIR, OUTPUT_FILENAME)

    try:
        with open(output_path, "w", encoding="utf-8") as f:
            f.write(f"Directory tree for: {os.path.abspath(root_path)}\n\n")
            write_tree(root_path, f)
        print(f"Directory tree successfully exported to '{output_path}'.")
    except Exception as e:
        print(f"Error while writing to the file: {e}")
        sys.exit(1)

if __name__ == "__main__":
    main()