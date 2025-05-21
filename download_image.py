import argparse
import os
import sys
import requests
import re
from datetime import datetime

# Output directory (change if needed)
# OUTPUT_DIR = "C:\\Users\\admin\\Documents"
OUTPUT_DIR = "/home/quys/Pictures/temp_image"

def log(message, status="INFO"):
    """Log message with status and timestamp."""
    timestamp = datetime.now().strftime("%Y-%m-%d %H:%M:%S")
    print(f"[{status}] [{timestamp}] {message}")

def is_positive_integer(value):
    """Check if the input is a positive integer."""
    try:
        ivalue = int(value)
        if ivalue <= 0:
            raise argparse.ArgumentTypeError(f"{value} is not a positive integer.")
        return ivalue
    except ValueError:
        raise argparse.ArgumentTypeError(f"{value} is not a valid integer.")

def extract_image_id(url):
    """
    Extract image ID from the redirected URL.
    Example: from https://i.picsum.photos/id/398/1080/600.jpg --> returns '398'
    """
    match = re.search(r'/id/(\d+)/', url)
    return match.group(1) if match else None

def download_image(width, height, output_dir):
    """Download an image from Picsum and save it with the format 'id-widthxheight.jpg'."""
    url = f"https://picsum.photos/{width}/{height}"

    try:
        response = requests.get(url, timeout=10, allow_redirects=True)
        response.raise_for_status()
    except requests.exceptions.RequestException as e:
        log(f"Failed to download image: {e}", status="ERROR")
        sys.exit(1)

    final_url = response.url
    image_id = extract_image_id(final_url)

    if image_id is None:
        log("Could not extract image ID from the URL.", status="ERROR")
        sys.exit(1)

    filename = f"{image_id}-{width}x{height}.jpg"
    save_path = os.path.join(output_dir, filename)

    try:
        os.makedirs(output_dir, exist_ok=True)
        with open(save_path, 'wb') as f:
            f.write(response.content)
        log(f"Image downloaded and saved at: {save_path}", status="SUCCESS")
    except IOError as e:
        log(f"Failed to save image: {e}", status="ERROR")
        sys.exit(1)

def main():
    parser = argparse.ArgumentParser(
        description="Download a random image from picsum.photos and save it as 'id-widthxheight.jpg'."
    )
    parser.add_argument("width", type=is_positive_integer, help="Image width (px)")
    parser.add_argument("height", type=is_positive_integer, help="Image height (px)")

    args = parser.parse_args()
    download_image(args.width, args.height, OUTPUT_DIR)

if __name__ == "__main__":
    main()