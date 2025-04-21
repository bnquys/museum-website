import random
import sys
import os

def generate_lorem_ipsum(word_count):
    lorem_words = (
        "lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor "
        "incididunt ut labore et dolore magna aliqua ut enim ad minim veniam quis nostrud "
        "exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat duis aute "
        "irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla "
        "pariatur excepteur sint occaecat cupidatat non proident sunt in culpa qui officia "
        "deserunt mollit anim id est laborum"
    ).split()

    result = [random.choice(lorem_words) for _ in range(word_count)]
    return ' '.join(result).capitalize() + '.'

if __name__ == "__main__":
    if len(sys.argv) != 2:
        print("Cách dùng: python lorem_gen.py <số_lượng_từ>")
        sys.exit(1)

    try:
        word_count = int(sys.argv[1])
        if word_count <= 0:
            raise ValueError
    except ValueError:
        print("Vui lòng nhập một số nguyên dương.")
        sys.exit(1)

    # Tạo nội dung lorem ipsum
    content = generate_lorem_ipsum(word_count)

    # Đường dẫn file lorem.txt cùng folder
    output_file = os.path.join(os.getcwd(), "lorem.txt")

    # Ghi vào file
    with open(output_file, "w", encoding="utf-8") as f:
        f.write(content)

    print(f"Đã tạo lorem.txt với {word_count} từ tại: {output_file}")