import os
import shutil
import fnmatch

# 🔧 CONFIGURE YOUR PATHS HERE
SOURCE_DIR = '/opt/lampp/htdocs/museum-website'             # Path to source directory
DESTINATION_DIR = '/home/quys/source-code/web/museum-text'   # Path to destination directory
IGNORE_FILE = 'ignore.txt'            # Path to ignore.txt file

def load_ignore_patterns(ignore_file_path):
    """
    Load ignore patterns from a file, ignoring empty lines and comments.
    """
    patterns = []
    try:
        with open(ignore_file_path, 'r') as f:
            for line in f:
                line = line.strip()
                if line and not line.startswith('#'):
                    patterns.append(line)
    except FileNotFoundError:
        print(f"[INFO] Ignore file not found at {ignore_file_path}, proceeding without exclusions.")
    return patterns

def should_ignore(path, ignore_patterns):
    """
    Check if a file or directory matches any ignore pattern.
    """
    for pattern in ignore_patterns:
        if pattern.endswith('/'):
            if os.path.isdir(path) and os.path.basename(path) == pattern.rstrip('/'):
                return True
        elif fnmatch.fnmatch(os.path.basename(path), pattern):
            return True
    return False

def convert_and_copy_file(src_path, dest_path):
    """
    Copy a file from source to destination, changing its extension to .txt.
    """
    base, _ = os.path.splitext(dest_path)
    dest_txt_path = base + '.txt'
    try:
        with open(src_path, 'rb') as src_file, open(dest_txt_path, 'wb') as dest_file:
            shutil.copyfileobj(src_file, dest_file)
        print(f"[COPIED] {src_path} -> {dest_txt_path}")
    except Exception as e:
        print(f"[ERROR] Failed to copy {src_path} to {dest_txt_path}: {e}")

def copy_directory_with_conversion(source_dir, destination_dir, ignore_file):
    """
    Copy a directory tree from source to destination, converting all files to .txt
    and ignoring files/directories listed in the ignore file.
    """
    if not os.path.exists(source_dir):
        print(f"[ERROR] Source directory '{source_dir}' does not exist.")
        return

    if not os.path.isdir(source_dir):
        print(f"[ERROR] '{source_dir}' is not a directory.")
        return

    ignore_patterns = load_ignore_patterns(ignore_file)

    for root, dirs, files in os.walk(source_dir):
        rel_path = os.path.relpath(root, source_dir)
        dest_root = os.path.join(destination_dir, rel_path)

        # Modify dirs list in-place to skip ignored directories
        dirs[:] = [d for d in dirs if not should_ignore(os.path.join(root, d), ignore_patterns)]

        try:
            os.makedirs(dest_root, exist_ok=True)
        except Exception as e:
            print(f"[ERROR] Failed to create directory '{dest_root}': {e}")
            continue

        for file in files:
            src_file_path = os.path.join(root, file)
            if should_ignore(src_file_path, ignore_patterns):
                print(f"[SKIPPED] Ignored {src_file_path}")
                continue

            dest_file_path = os.path.join(dest_root, file)
            convert_and_copy_file(src_file_path, dest_file_path)

if __name__ == "__main__":
    copy_directory_with_conversion(SOURCE_DIR, DESTINATION_DIR, IGNORE_FILE)
