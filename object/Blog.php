<?php
    class Blog {
        private $id;
        private $title;
        private $imgUrl;
        private $summary;
        private $content;

        private const SERVER = "localhost";
        private const USERNAME = "root";
        private const PASSWORD = "";
        private const DATABASE = "museumDB";


        public function __construct($id, $title, $summary, $content, $imgUrl) {
            $this->id = $id;
            $this->title = $title;
            $this->summary = $summary;
            $this->content = $content;
            $this->imgUrl = $imgUrl;
        }

        public function showTag() {
            $conn = new mysqli(self::SERVER, self::USERNAME, self::PASSWORD, self::DATABASE);

            if ($conn->connect_error) {
                die("Connection failed ". $conn->connect_error);
            }
            $stmt = $conn->prepare("SELECT tags.name AS tag_name FROM blog_tags JOIN tags ON tags.id = blog_tags.tag_id WHERE blog_tags.blog_id = ?");
            $id = (string) $this->id;
            $stmt->bind_param("s", $id);

            $stmt->execute();
            $result = $stmt->get_result();

            $isFirst = true;
            $tags = "";

            while($row = $result->fetch_assoc()) {
                if ($isFirst) {
                    $tags .= '<a href="#">'. $row["tag_name"]  .'</a>';
                    $isFirst = false;
                } else {
                    $tags .= ', <a href="#">'. $row["tag_name"]  .'</a>';
                }
            }

            $stmt->close();
            $conn->close();
            return $tags;
        }

        public static function show($limit) {
            $conn = new mysqli(self::SERVER, self::USERNAME, self::PASSWORD, self::DATABASE);

            if ($conn->connect_error) {
                die("Connection failed ". $conn->connect_error);
            }

            $stmt = $conn->prepare("SELECT id, title, summary, content, imgUrl FROM blogs ORDER BY id DESC LIMIT ?");

            $stmt->bind_param("i", $limit);

            $stmt->execute();

            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $blog = new Blog($row['id'], $row['title'], $row['summary'], $row['content'], $row['imgUrl']);

                echo 
                    '<div id="'.$blog->id.'" class="border-0 row">
                        <div class="col-md-4">
                            <div class="thumbnail-container">
                                <img
                                    src="'.$blog->imgUrl.'"
                                    class="thumbnail"
                                    alt="..."
                                />
                            </div>
                        </div>
                        <div class="col-md-8 content">
                            <p>
                                '.$blog->showTag().'
                            </p>
                            <h2>
                                <a href="blog.php?blogId='. $blog->id .'">'.$blog->title.'</a>
                            </h2>
                            <p class="card-text">'.$blog->summary.'</p>
                            <div class="d-flex gap-3">
                                <p>
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="16"
                                        height="16"
                                        fill="currentColor"
                                        class="bi bi-heart"
                                        viewBox="0 0 16 16"
                                    >
                                        <path
                                            d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"
                                        />
                                    </svg>

                                    4 likes
                                </p>
                                <p>
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="16"
                                        height="16"
                                        fill="currentColor"
                                        class="bi bi-chat"
                                        viewBox="0 0 16 16"
                                    >
                                        <path
                                            d="M2.678 11.894a1 1 0 0 1 .287.801 11 11 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8 8 0 0 0 8 14c3.996 0 7-2.807 7-6s-3.004-6-7-6-7 2.808-7 6c0 1.468.617 2.83 1.678 3.894m-.493 3.905a22 22 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a10 10 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9 9 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105"
                                        />
                                    </svg>
                                    06 comments
                                </p>
                            </div>
                        </div>
                    </div>';
            }

            $stmt->close();
            $conn->close();
        }

        public static function show_latest_blog($limit) {
            $conn = new mysqli(self::SERVER, self::USERNAME, self::PASSWORD, self::DATABASE);

            if ($conn->connect_error) {
                die("Connection failed: ". $conn->connect_error);
            }

            
        }
    }
?>