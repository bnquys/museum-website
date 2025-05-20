<?php
namespace Museum\Object;
use Museum\Utils\Database;

class Event {
    public const PREFIX = "EV";
    public const CODE_LENGTH = 5;

    public $id;
    public $username;
    public $title;
    public $summary;
    public $description;
    public $imgUrl;
    public $timeStart;
    public $timeEnd;
    public $location;
    public $displayOrder;
    public $isShow;

    public function __construct($id, $username, $title, $summary, $description, $imgUrl, $timeStart, $timeEnd, $location, $displayOrder = 0, $isShow = true) {
        $this->id = $id;
        $this->username = $username;
        $this->title = $title;
        $this->summary = $summary;
        $this->description = $description;
        $this->imgUrl = $imgUrl;
        $this->timeStart = $timeStart;
        $this->timeEnd = $timeEnd;
        $this->location = $location;
        $this->displayOrder = $displayOrder;
        $this->isShow = $isShow;
    }

    public static function getListEvent($limit = 100000) {
        $conn = Database::Connect();

        $stmt = $conn->prepare("SELECT * FROM Events WHERE IsShow = TRUE ORDER BY DisplayOrder DESC LIMIT ?");
        if (!$stmt) die("Prepare failed: " . $conn->error);

        $stmt->bind_param("i", $limit);
        if (!$stmt->execute()) die("Execute failed: " . $stmt->error);

        $result = $stmt->get_result();
        $list = [];

        while ($row = $result->fetch_assoc()) {
            $list[] = new Event(
                $row["Id"],
                $row["Username"],
                $row["Title"],
                $row["Summary"],
                $row["Description"],
                $row["ImageUrl"],
                $row["TimeStart"],
                $row["TimeEnd"],
                $row["Location"],
                $row["DisplayOrder"],
                $row["IsShow"]
            );
        }

        $stmt->close();
        $conn->close();
        return $list;
    }

    public static function getUpcomingEvents($limit = 6) {
        $conn = Database::Connect();
    
        $stmt = $conn->prepare("
            SELECT * FROM Events 
            WHERE IsShow = TRUE AND TimeStart > NOW() 
            ORDER BY TimeStart DESC 
            LIMIT ?
        ");
        if (!$stmt) die("Prepare failed: " . $conn->error);
    
        $stmt->bind_param("i", $limit);
        if (!$stmt->execute()) die("Execute failed: " . $stmt->error);
    
        $result = $stmt->get_result();
        $list = [];
    
        while ($row = $result->fetch_assoc()) {
            $list[] = new Event(
                $row["Id"],
                $row["Username"],
                $row["Title"],
                $row["Summary"],
                $row["Description"],
                $row["ImageUrl"],
                $row["TimeStart"],
                $row["TimeEnd"],
                $row["Location"],
                $row["DisplayOrder"],
                $row["IsShow"]
            );
        }
    
        $stmt->close();
        $conn->close();
        return $list;
    } 
    
    public static function getOngoingExhibitions($limit = 6) {
        $conn = Database::Connect();
    
        $stmt = $conn->prepare("
            SELECT E.* FROM Events E
            JOIN Exhibitions EX ON EX.Id = E.Id
            WHERE E.IsShow = TRUE AND E.TimeStart <= NOW() AND E.TimeEnd >= NOW()
            ORDER BY E.TimeStart ASC
            LIMIT ?
        ");
        if (!$stmt) die("Prepare failed: " . $conn->error);
    
        $stmt->bind_param("i", $limit);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $list = [];
        while ($row = $result->fetch_assoc()) {
            $list[] = new Event(
                $row["Id"],
                $row["Username"],
                $row["Title"],
                $row["Summary"],
                $row["Description"],
                $row["ImageUrl"],
                $row["TimeStart"],
                $row["TimeEnd"],
                $row["Location"],
                $row["DisplayOrder"],
                $row["IsShow"]
            );
        }
    
        $stmt->close();
        $conn->close();
    
        return $list;
    }    

    public static function getById($id) {
        $conn = Database::Connect();

        $stmt = $conn->prepare("SELECT * FROM Events WHERE Id = ?");
        if (!$stmt) die("Prepare failed: " . $conn->error);

        $stmt->bind_param("s", $id);
        if (!$stmt->execute()) die("Execute failed: " . $stmt->error);

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $stmt->close();
        $conn->close();

        if (!$row) return null;

        return new Event(
            $row["Id"],
            $row["Username"],
            $row["Title"],
            $row["Summary"],
            $row["Description"],
            $row["ImageUrl"],
            $row["TimeStart"],
            $row["TimeEnd"],
            $row["Location"],
            $row["DisplayOrder"],
            $row["IsShow"]
        );
    }

    public static function delete($id) {
        $conn = Database::Connect();

        $stmt = $conn->prepare("UPDATE Events SET IsShow = FALSE WHERE Id = ?");
        if (!$stmt) die("Prepare failed: " . $conn->error);

        $stmt->bind_param("s", $id);
        if (!$stmt->execute()) die("Execute failed: " . $stmt->error);

        $stmt->close();
        $conn->close();
    }

    public static function add($event) {
        $conn = Database::Connect();

        $stmt = $conn->prepare("SELECT COUNT(*) AS count FROM Events WHERE Id = ?");
        $stmt->bind_param("s", $event->id);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        $isInsert = ($row["count"] == 0);
        $stmt->close();

        if ($isInsert && $event->displayOrder == 0) {
            $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM Events");
            $stmt->execute();
            $row = $stmt->get_result()->fetch_assoc();
            $event->displayOrder = $row["total"];
            $stmt->close();
        }

        $stmt = $conn->prepare("
            INSERT INTO Events (Id, Username, Title, Summary, Description, ImageUrl, TimeStart, TimeEnd, Location, DisplayOrder, IsShow)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE
                Username = VALUES(Username),
                Title = VALUES(Title),
                Summary = VALUES(Summary),
                Description = VALUES(Description),
                ImageUrl = VALUES(ImageUrl),
                TimeStart = VALUES(TimeStart),
                TimeEnd = VALUES(TimeEnd),
                Location = VALUES(Location),
                DisplayOrder = VALUES(DisplayOrder),
                IsShow = VALUES(IsShow)
        ");
        if (!$stmt) die("Prepare failed: " . $conn->error);

        $stmt->bind_param(
            "ssssssssssi",
            $event->id,
            $event->username,
            $event->title,
            $event->summary,
            $event->description,
            $event->imgUrl,
            $event->timeStart,
            $event->timeEnd,
            $event->location,
            $event->displayOrder,
            $event->isShow
        );
        if (!$stmt->execute()) die("Execute failed: " . $stmt->error);

        $stmt->close();
        $conn->close();
    }

    public static function getNextId() {
        $conn = Database::Connect();

        $stmt = $conn->prepare("SELECT MAX(Id) AS maxId FROM Events");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $maxId = ($row["maxId"] == NULL) ? 0 : (int)substr($row["maxId"], strlen(self::PREFIX));
        $nextId = $maxId + 1;
        $numberLength = self::CODE_LENGTH - strlen(self::PREFIX);
        $nextIdFormatted = self::PREFIX . str_pad($nextId, $numberLength, "0", STR_PAD_LEFT);

        $stmt->close();
        $conn->close();

        return $nextIdFormatted;
    }

    public static function moveOrder($id, $direction) {
        $conn = Database::Connect();

        $stmt = $conn->prepare("SELECT Id, DisplayOrder FROM Events WHERE Id = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $current = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        if (!$current) return;

        $op = ($direction === 'up') ? '>' : '<';
        $orderBy = ($direction === 'up') ? 'ASC' : 'DESC';

        $stmt = $conn->prepare("
            SELECT Id, DisplayOrder FROM Events
            WHERE DisplayOrder $op ?
            ORDER BY DisplayOrder $orderBy
            LIMIT 1
        ");
        $stmt->bind_param("i", $current['DisplayOrder']);
        $stmt->execute();
        $neighbor = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        if (!$neighbor) return;

        $stmt = $conn->prepare("UPDATE Events SET DisplayOrder = ? WHERE Id = ?");
        $stmt->bind_param("is", $neighbor['DisplayOrder'], $current['Id']);
        $stmt->execute();

        $stmt->bind_param("is", $current['DisplayOrder'], $neighbor['Id']);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }

    public function saveAsAcademy($price = 0.0, $speaker = "") {
        self::add($this); // Save to Events table
    
        $conn = Database::Connect();
        $stmt = $conn->prepare("
            INSERT INTO Academy (Id, Price, Speaker)
            VALUES (?, ?, ?)
            ON DUPLICATE KEY UPDATE
                Price = VALUES(Price),
                Speaker = VALUES(Speaker)
        ");
        if (!$stmt) die("Prepare failed: " . $conn->error);
    
        $stmt->bind_param("sds", $this->id, $price, $speaker);
        if (!$stmt->execute()) die("Execute failed: " . $stmt->error);
    
        $stmt->close();
        $conn->close();
    }

    public function saveAsExhibition() {
        self::add($this); // Save to Events table
    
        $conn = Database::Connect();
        $stmt = $conn->prepare("
            INSERT INTO Exhibitions (Id)
            VALUES (?)
            ON DUPLICATE KEY UPDATE
                Id = VALUES(Id) -- Dummy update to avoid error
        ");
        if (!$stmt) die("Prepare failed: " . $conn->error);
    
        $stmt->bind_param("s", $this->id);
        if (!$stmt->execute()) die("Execute failed: " . $stmt->error);
    
        $stmt->close();
        $conn->close();
    }
    
    /**
     * Returns the specific subclass of this event if applicable.
     *
     * This method checks if the current event is categorized as an Academy or Exhibition
     * by querying the corresponding tables in the database. If it is, it returns an instance
     * of the corresponding subclass (`Academy` or `Exhibition`). Otherwise, it returns the
     * base `Event` instance.
     *
     * @return Event|Academy|Exhibition
     */
    public function getType(): Event {
        $conn = Database::Connect();
    
        // Check if the event is an Academy
        $stmt = $conn->prepare("SELECT 1 FROM Academy WHERE Id = ?");
        $stmt->bind_param("s", $this->id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $stmt->close();
            $conn->close();
            return new Academy(
                $this->id,
                $this->username,
                $this->title,
                $this->summary,
                $this->description,
                $this->imgUrl,
                $this->timeStart,
                $this->timeEnd,
                $this->location,
                $this->displayOrder,
                $this->isShow
            );
        }
        $stmt->close();
        
        // Check if the event is an Exhibition
        $stmt = $conn->prepare("SELECT 1 FROM Exhibitions WHERE Id = ?");
        $stmt->bind_param("s", $this->id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $stmt->close();
            $conn->close();
            return new Exhibition(
                $this->id,
                $this->username,
                $this->title,
                $this->summary,
                $this->description,
                $this->imgUrl,
                $this->timeStart,
                $this->timeEnd,
                $this->location,
                $this->displayOrder,
                $this->isShow
            );
        }
    
        $stmt->close();
        $conn->close();
    
        // Return base Event if no specific type found
        return $this;
    }    

    public static function getRandomEvents($limit = 3) {
        $conn = Database::Connect();
    
        $stmt = $conn->prepare("
            SELECT * FROM Events
            WHERE IsShow = TRUE
            ORDER BY RAND()
            LIMIT ?
        ");
        if (!$stmt) die("Prepare failed: " . $conn->error);
    
        $stmt->bind_param("i", $limit);
        if (!$stmt->execute()) die("Execute failed: " . $stmt->error);
    
        $result = $stmt->get_result();
        $list = [];
    
        while ($row = $result->fetch_assoc()) {
            $list[] = new Event(
                $row["Id"],
                $row["Username"],
                $row["Title"],
                $row["Summary"],
                $row["Description"],
                $row["ImageUrl"],
                $row["TimeStart"],
                $row["TimeEnd"],
                $row["Location"],
                $row["DisplayOrder"],
                $row["IsShow"]
            );
        }
    
        $stmt->close();
        $conn->close();
    
        return $list;
    }    

    public static function countThisWeekEvents() {
        $conn = Database::Connect();
    
        // Tính ngày đầu tuần (Monday) và cuối tuần (Sunday)
        $stmt = $conn->prepare("
            SELECT COUNT(*) as total FROM Events
            WHERE IsShow = TRUE AND (
                (TimeStart >= DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) DAY)
                 AND TimeStart <= DATE_ADD(CURDATE(), INTERVAL (6 - WEEKDAY(CURDATE())) DAY))
                OR
                (TimeEnd >= DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) DAY)
                 AND TimeEnd <= DATE_ADD(CURDATE(), INTERVAL (6 - WEEKDAY(CURDATE())) DAY))
            )
        ");
    
        if (!$stmt) die("Prepare failed: " . $conn->error);
        if (!$stmt->execute()) die("Execute failed: " . $stmt->error);
    
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
    
        $stmt->close();
        $conn->close();
    
        return $row ? (int)$row['total'] : 0;
    }    
}
?>
