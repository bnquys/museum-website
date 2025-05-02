import random
import datetime
import os
import sys

# Cấu hình ID
ID_PREFIX = "A"
ID_LENGTH = 4  # VD: BL001, BL002 ...

# Danh sách độ phân giải từ HD đến FullHD
IMAGE_SIZES = [
    (1280, 720),   # HD
    (1366, 768),
    (1600, 900),
    (1920, 1080),  # FullHD
]

def generate_lorem_ipsum(word_count):
    lorem_words = (
        "lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor "
        "incididunt ut labore et dolore magna aliqua ut enim ad minim veniam quis nostrud "
        "exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat duis aute "
        "irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla "
        "pariatur excepteur sint occaecat cupidatat non proident sunt in culpa qui officia "
        "deserunt mollit anim id est laborum"
    ).split()
    return ' '.join(random.choices(lorem_words, k=word_count)).capitalize()

def generate_insert_blog(id, username, used_random_ids):
    title = generate_lorem_ipsum(12)
    summary = generate_lorem_ipsum(50)
    content = generate_lorem_ipsum(200)
    date = datetime.datetime.now().strftime('%Y-%m-%d %H:%M:%S')

    # Random image size
    width, height = random.choice(IMAGE_SIZES)

    # Random không trùng lặp cho ?random=
    while True:
        rand_id = random.randint(1, 10000)
        if rand_id not in used_random_ids:
            used_random_ids.add(rand_id)
            break

    image_url = f"https://picsum.photos/{width}/{height}?random={rand_id}"
    is_show = '1'

    insert_query = f"""INSERT INTO `About` (`AboutId`, `Email`, `ImgUrl`, `DateUpload`, `Content`, `IsShow`) VALUES ('{id}', '{username}', '{image_url}', '{date}', '{content}', '{is_show}');"""
    return insert_query

def generate_id(index):
    number = str(index).zfill(ID_LENGTH - len(ID_PREFIX))
    return f"{ID_PREFIX}{number}"

if __name__ == "__main__":
    if len(sys.argv) != 2:
        print("Cách dùng: python generate_insert.py <số_lượng_bản_ghi>")
        sys.exit(1)

    try:
        count = int(sys.argv[1])
        if count <= 0:
            raise ValueError
    except ValueError:
        print("Vui lòng nhập một số nguyên dương hợp lệ.")
        sys.exit(1)

    username = "anna.nguyen@email.com"
    insert_queries = ["DELETE FROM Blog;"]
    used_random_ids = set()

    for i in range(1, count + 1):
        blog_id = generate_id(i)
        query = generate_insert_blog(blog_id, username, used_random_ids)
        insert_queries.append(query)

    output_file = os.path.join(os.getcwd(), "blogs.txt")
    with open(output_file, "w", encoding="utf-8") as f:
        f.write('\n'.join(insert_queries))

    print(f"Đã tạo {count} câu lệnh INSERT (kèm DELETE) và lưu vào {output_file}")
