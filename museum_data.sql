-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2025 at 07:51 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `museum`
--

-- --------------------------------------------------------

--
-- Table structure for table `academy`
--

CREATE TABLE `academy` (
  `Id` varchar(20) NOT NULL,
  `Price` float DEFAULT 0,
  `Speaker` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `academy`
--

INSERT INTO `academy` (`Id`, `Price`, `Speaker`) VALUES
('EV001', 0, ''),
('EV002', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `Username` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Id` varchar(20) DEFAULT NULL,
  `Password` text DEFAULT NULL,
  `ActivateCode` varchar(20) DEFAULT NULL,
  `IsActive` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`Username`, `Email`, `Id`, `Password`, `ActivateCode`, `IsActive`) VALUES
('user1', 'client1@example.com', 'root', '123', NULL, 1),
('user2', 'client2@example.com', 'admin', '123', NULL, 1),
('user3', 'client3@example.com', NULL, '123', NULL, 1),
('user4', 'client4@example.com', NULL, '123', NULL, 1),
('user5', 'client5@example.com', NULL, '123', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `artifact`
--

CREATE TABLE `artifact` (
  `Id` varchar(20) NOT NULL,
  `Title` text DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `History` text DEFAULT NULL,
  `ImageUrl` text DEFAULT NULL,
  `IsShow` tinyint(1) DEFAULT 1,
  `DisplayOrder` bigint(20) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `artifact`
--

INSERT INTO `artifact` (`Id`, `Title`, `Description`, `History`, `ImageUrl`, `IsShow`, `DisplayOrder`) VALUES
('AF001', 'The Eye of Eternity', '<p>A finely cast bronze mirror from the Han dynasty, featuring intricate animal motifs on the reverse.</p>', '<p>hihi</p>', 'assets/uploads/artifact/g1.jpg', 1, 0),
('AF002', 'The Shard of the Moon', '<p>A delicately crafted porcelain water dropper used by scholars for ink preparation during the Joseon era.</p>', '', 'assets/uploads/artifact/g2.jpg', 1, 2),
('AF003', 'The Heart of the Phoenix', '<p>A serene sandstone Buddha head fragment from the 10th century, reflecting early Khmer spiritual art.</p>', '', 'assets/uploads/artifact/g3.jpg', 1, 1),
('AF004', 'The Crown of Forgotten Kings', '<p>A tall blue-and-white porcelain vase adorned with dragon and cloud motifs, symbolizing imperial power.</p>', '', 'assets/uploads/artifact/g4.jpg', 1, 3),
('AF005', 'The Blade of Whispering Shadows', '<p>A terracotta oil lamp with dual nozzles, commonly used in domestic Roman life during the 1st century AD.</p>', '', 'assets/uploads/artifact/g5.jpg', 1, 4),
('AF006', 'The Chalice of Endless Echoes', '<p>A single-edged iron blade with a simple guard, once wielded by a European knight in the 13th century.</p>', '', 'assets/uploads/artifact/g6.jpg', 1, 5),
('AF007', 'The Orb of the Fallen Star', '<p>A small funerary figurine placed in tombs to serve the deceased in the afterlife, crafted in faience glaze.</p>', '', 'assets/uploads/artifact/g7.jpg', 1, 6),
('AF008', 'The Seal of the Void', '<p>A flat stone palette used by scholars to grind ink, engraved with poetic inscriptions from the Ming era.</p>', '', 'assets/uploads/artifact/g8.jpg', 1, 7),
('AF009', 'The Scroll of Forgotten Truths', '<p>A gold figure pendant from the Tairona culture, featuring stylized wings and expressive facial details.</p>', '', 'assets/uploads/artifact/g9.jpg', 1, 8),
('AF010', 'The Mask of the Hollow King', '<p>A two-handled storage jar decorated with black-figure artwork depicting a mythological scene.</p>', '', 'assets/uploads/artifact/g10.jpg', 1, 9),
('AF011', 'The Tears of the Forest', '<p>A brass scientific instrument used to calculate time and celestial positions, inscribed in elegant Kufic script.</p>', '', 'assets/uploads/artifact/g11.jpg', 1, 10),
('AF012', 'The Timeweaver’s Hourglass', '<p>A 19th-century mechanical pocket watch encased in engraved silver, once carried by a gentleman traveler.</p>', '', 'assets/uploads/artifact/g12.jpg', 1, 11);

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `Id` varchar(20) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Title` text DEFAULT NULL,
  `UploadDate` datetime DEFAULT current_timestamp(),
  `Summary` text DEFAULT NULL,
  `Content` text DEFAULT NULL,
  `ImageUrl` text DEFAULT '',
  `IsShow` tinyint(1) DEFAULT 1,
  `DisplayOrder` bigint(20) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`Id`, `Username`, `Title`, `UploadDate`, `Summary`, `Content`, `ImageUrl`, `IsShow`, `DisplayOrder`) VALUES
('BL001', 'user1', 'The Digital Detox: Why Unplugging Might Be the Best Thing You Do This Year', '2025-05-18 12:16:24', '<p>In a hyper-connected world, the pressure to be constantly online can quietly erode our well-being, relationships, and productivity. This blog explores the importance of taking a digital detox, offers practical steps to disconnect mindfully, and explains how even short periods offline can refresh your mind, improve focus, and reconnect you with what truly matters.</p>', '<p><strong>The Digital Overload</strong></p><p>We live in an age where our phones wake us up, tell us the weather, remind us to hydrate, and lull us to sleep with meditation apps. But with all the convenience comes a quiet cost: our attention spans are shrinking, our anxiety is spiking, and genuine human connection is becoming increasingly rare.</p><p>A 2023 survey by the American Psychological Association found that 76% of U.S. adults reported increased stress levels linked to technology use. While tech has its undeniable benefits, the constant barrage of notifications, emails, and social media can leave us mentally drained and emotionally distracted.</p><p>So, what’s the solution? Enter: <strong>the digital detox</strong>.</p><p><strong>What is a Digital Detox?</strong></p><p>A digital detox is a conscious decision to reduce or eliminate time spent on digital devices—particularly smartphones, social media, and computers—for a specific period. This break gives your mind space to reset and recalibrate, promoting clarity and mindfulness.</p><p><strong>It’s not about demonizing technology</strong>. Instead, it’s about creating healthier boundaries so technology serves you, rather than the other way around.</p><figure class=\"image\"><img src=\"assets/uploads/blog/55-1080x720.jpg\"></figure><p>&nbsp;</p><p><strong>Signs You Might Need a Digital Detox</strong></p><p>You don’t have to be glued to your screen 24/7 to benefit from a digital break. Here are a few signs it might be time to unplug:</p><ul><li>You check your phone first thing in the morning… and last thing at night.</li><li>Notifications interrupt your daily flow every few minutes.</li><li>Social media scrolling leaves you feeling anxious, inadequate, or numb.</li><li>You find it difficult to focus on one task for an extended period.</li><li>You feel “phantom” vibrations even when your phone isn\'t in your pocket.</li></ul><p>If any of these sound familiar, you’re not alone—and you’re likely overdue for a reset.</p><p><strong>The Benefits of Going Offline</strong></p><p>A digital detox can feel uncomfortable at first, but the rewards are well worth it. Here are just a few benefits:</p><p>1. <strong>Improved Focus and Productivity</strong></p><p>Digital distractions are the nemesis of deep work. A detox can help you reclaim your attention and train your brain to focus for longer stretches.</p><p>2. <strong>Better Sleep</strong></p><p>Blue light from screens disrupts melatonin production, making it harder to fall asleep. Ditching screens at night improves both sleep quality and duration.</p><p>3. <strong>Reduced Stress and Anxiety</strong></p><p>Taking a break from the constant comparison and bad news cycles on social media can dramatically lower stress levels.</p><p>4. <strong>Enhanced Relationships</strong></p><p>Being present with friends and family—without screens—deepens your connections and improves communication.</p><figure class=\"image\"><img src=\"assets/uploads/blog/183-1080x720.jpg\"></figure><p><strong>How to Do a Digital Detox (Without Going Crazy)</strong></p><p>You don’t have to move to a cabin in the woods and throw your phone in a lake. Start small and make it sustainable. Here are some practical steps:</p><p><strong>Step 1: Set Your Intentions</strong></p><p>Decide why you’re doing the detox. Is it to focus more at work? Sleep better? Reconnect with loved ones? Knowing your \"why\" will help you stick with it.</p><p><strong>Step 2: Choose Your Duration</strong></p><p>Start with a weekend, or even a single day. You can scale up once you’re comfortable.</p><p><strong>Step 3: Define Your Rules</strong></p><p>Be specific about what you\'re avoiding. No social media? No screens after 8 PM? Choose rules that align with your goals.</p><p><strong>Step 4: Communicate with Others</strong></p><p>Let friends, family, or coworkers know you’re going offline. Set up an autoresponder if needed. This reduces anxiety and sets expectations.</p><p><strong>Step 5: Fill the Space</strong></p><p>Plan non-digital activities—read a physical book, go for a hike, cook a new recipe, journal, or spend time with loved ones.</p><p><strong>Final Thoughts: Reclaiming Your Time and Attention</strong></p><p>In a culture that glorifies hustle and connectivity, stepping back can feel rebellious. But it’s also healing. The moments of clarity, creativity, and calm that arise during a digital detox often become catalysts for deeper change in our lives.</p><p>So, the next time you feel overwhelmed by the digital noise, remember: <strong>unplugging isn’t an escape—it’s a return</strong>. A return to presence, intention, and the parts of life that truly matter.</p>', 'assets/uploads/blog/581-1080x720.jpg', 1, 0),
('BL002', 'user1', 'The Rise of Slow Living: Why Less Really Is More', '2025-05-18 11:46:27', '<p>In an age of instant gratification and constant hustle, the slow living movement is gaining momentum. This blog explores what slow living truly means, why it’s not just a trend but a mindset shift, and how you can incorporate its principles to lead a more intentional, fulfilling life.</p>', '<p><strong>What is Slow Living?</strong></p><p>Slow living is about consciously choosing quality over quantity in all aspects of life. It’s the opposite of rushing through your days just to check things off a list. Instead, it encourages you to live in alignment with your values, savor the present moment, and make space for what matters most.</p><p>While often associated with minimalist aesthetics, homemade sourdough, and scenic countryside retreats, slow living isn’t about where you live or how much you own—it’s about how you live.</p><figure class=\"image\"><img src=\"assets/uploads/blog/1072-1080x720.jpg\"></figure><p><strong>The Problem with “Busy”</strong></p><p>Somewhere along the way, being busy became a badge of honor. We wear our full calendars and overbooked schedules like trophies, even if they leave us feeling drained and disconnected.</p><p>The glorification of hustle culture—“rise and grind,” “sleep is for the weak”—has created an environment where burnout is the norm. According to a 2022 Gallup report, over 40% of U.S. workers reported feeling burnt out on the job.</p><p>Slow living isn’t about doing nothing. It’s about doing <strong>less of what doesn’t matter</strong> so you have more time and energy for what does.</p><p><strong>Final Thoughts: A Life You Don’t Need a Vacation From</strong></p><p>Slow living isn’t about rejecting ambition or productivity—it’s about redefining success. It asks: What are you rushing toward? And at what cost?</p><p>When you live slowly, you begin to notice the small joys—the sound of birds, the feel of fresh sheets, the taste of a homemade meal. You stop surviving your days and start experiencing them.</p>', 'assets/uploads/blog/1082-1080x720.jpg', 1, 1),
('BL003', 'user1', 'Green Living Made Easy: Simple Swaps for a More Sustainable Life', '2025-05-18 12:21:11', '<p>Going green doesn’t have to mean going off-grid. In this blog, we explore practical, everyday changes that make sustainable living simple and achievable. From eco-friendly product swaps to mindful consumption habits, these tips help reduce your footprint—without overwhelming your lifestyle.</p>', '<p><strong>Why Sustainable Living Matters</strong></p><p>The environmental challenges we face today—from climate change to plastic pollution—can feel massive and out of reach. But individual actions do add up. Shifting toward a more sustainable lifestyle is not about perfection—it\'s about making better choices, one step at a time.</p><p>Living more sustainably isn’t just about saving the planet. It’s about enhancing your health, simplifying your home, and often saving money in the long run.</p><figure class=\"image\"><img src=\"assets/uploads/blog/401-1080x720.jpg\"></figure><p><strong>Why Sustainable Living Matters</strong></p><p>The environmental challenges we face today—from climate change to plastic pollution—can feel massive and out of reach. But individual actions do add up. Shifting toward a more sustainable lifestyle is not about perfection—it\'s about making better choices, one step at a time.</p><p>Living more sustainably isn’t just about saving the planet. It’s about enhancing your health, simplifying your home, and often saving money in the long run.</p><figure class=\"image\"><img src=\"assets/uploads/blog/688-1920x1080.jpg\"></figure><p><strong>Start with the Basics: 3 Simple Swaps</strong></p><p>You don’t need to change your entire lifestyle overnight. Begin with a few easy switches that make a big impact over time.</p><p>1. <strong>Say Goodbye to Single-Use Plastics</strong></p><p>Swap out plastic water bottles, straws, and bags for reusable alternatives.</p><p><strong>Instead of</strong>: Plastic water bottles</p><p><strong>Try</strong>: Stainless steel or BPA-free reusable bottles</p><p><strong>Impact</strong>: Reduces landfill waste and microplastic pollution in oceans</p><p>2. <strong>Opt for Reusable Shopping Bags</strong></p><p>Keep cloth or canvas bags in your car or by your front door so you never forget them.</p><p>3. <strong>Replace Paper Towels with Cloth Rags</strong></p><p>An average American household uses over 100 rolls of paper towels annually. Cloth rags or microfiber towels are washable, reusable, and much more eco-friendly.</p><figure class=\"image\"><img src=\"assets/uploads/blog/764-1080x720.jpg\"></figure><p><strong>Greener in the Kitchen: Cook Smarter, Waste Less</strong></p><p>Food waste is one of the biggest contributors to greenhouse gases—and it\'s completely avoidable.</p><p><strong>Plan Your Meals</strong></p><p>Meal planning helps reduce impulse purchases and ensures you use what you buy. It also saves time and money.</p><p><strong>Compost Food Scraps</strong></p><p>Instead of throwing away coffee grounds, eggshells, or veggie peels, consider composting. Even if you live in an apartment, countertop compost bins or city compost programs make it easy.</p><p><strong>Use Glass Storage Containers</strong></p><p>Ditch the disposable plastic wrap and invest in glass containers or beeswax wraps. They\'re better for both your health and the environment.</p><p><strong>Final Thoughts: Living with Intention</strong></p><p>Sustainable living is less about sacrifice and more about mindfulness. It’s about making intentional choices that are better for you, your community, and the world around you.</p><p>And the best part? You don’t need to be an environmental expert or live in a tiny house to do it. You just need to begin—with small, conscious steps in the right direction.</p>', 'assets/uploads/blog/633-1920x1080.jpg', 1, 2),
('BL004', 'user1', 'Mastering the Art of Time Management: How to Get More Done Without Burning Out', '2025-05-18 12:22:45', '<p>Feeling overwhelmed by your to-do list? You’re not alone. In this blog post, we explore practical, proven time management techniques to help you boost productivity, set better priorities, and reclaim your time—without sacrificing your sanity.</p>', '<p><strong>Why Time Management Matters More Than Ever</strong></p><p>In a world that never stops, time feels like our most limited—and most valuable—resource. Between work, family, personal goals, and the digital distractions that follow us everywhere, managing our time effectively is no longer just a skill—it’s a survival tactic.</p><p>Whether you\'re a student, a full-time professional, or juggling multiple roles, better time management means less stress, more focus, and a greater sense of control.</p><figure class=\"image\"><img src=\"assets/uploads/blog/652-1080x720.jpg\"></figure><p><strong>Common Time Management Pitfalls</strong></p><p>Before we dive into solutions, let’s recognize some habits that sabotage our productivity:</p><ul><li><strong>Multitasking</strong>: Often praised, but in reality, it splits focus and increases mental fatigue.</li><li><strong>Procrastination</strong>: Delaying hard tasks leads to last-minute panic and subpar results.</li><li><strong>No boundaries</strong>: Saying \"yes\" too often can fill your schedule with things that don’t serve your goals.</li><li><strong>Poor prioritization</strong>: Spending hours on low-impact tasks while ignoring what truly moves the needle.</li></ul><p>Awareness is the first step toward change.</p>', 'assets/uploads/blog/1036-1080x720.jpg', 1, 4),
('BL005', 'user1', 'The Joy of Journaling: How Writing Every Day Can Transform Your Life', '2025-05-18 12:28:27', '<p>Journaling isn’t just for writers or teenagers with secret diaries. It\'s a powerful tool for mental clarity, emotional health, creativity, and personal growth. In this blog, we explore the science-backed benefits of daily journaling, different styles you can try, and how to build a habit that sticks.</p>', '<p><strong>Why Journaling Works</strong></p><p>In an increasingly noisy world, journaling offers a rare pause—a moment to process thoughts, track patterns, and connect with yourself. Unlike a to-do list or a social media post, your journal is a judgment-free zone. It’s just you, your thoughts, and a blank page.</p><p>Scientific studies have shown that regular journaling can improve your mood, reduce stress, and even boost your immune system. It gives structure to mental chaos and helps untangle the worries of the day.</p><figure class=\"image\"><img src=\"assets/uploads/blog/855-1080x720.jpg\"></figure><h2>Journaling Tools and Resources</h2><p>Want to elevate your journaling game? Try these helpful tools:</p><ul><li><strong>Apps</strong>: Day One, Journey, and Reflectly are excellent digital journaling apps.</li><li><strong>Notebooks</strong>: Moleskine, Leuchtturm1917, or any notebook that feels good in your hands.</li><li><strong>Pens</strong>: Invest in a pen you enjoy using—it makes a surprising difference!</li><li><strong>Prompt Books</strong>: Try <i>The 5-Minute Journal</i>, <i>Burn After Writing</i>, or <i>Start Where You Are</i> for guided inspiration.</li></ul>', 'assets/uploads/blog/755-1080x720.jpg', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `Email` varchar(50) NOT NULL,
  `Username` varchar(50) DEFAULT NULL,
  `Name` text DEFAULT NULL,
  `PhoneNumber` varchar(255) DEFAULT NULL,
  `BirthDate` date DEFAULT NULL,
  `Avatar` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`Email`, `Username`, `Name`, `PhoneNumber`, `BirthDate`, `Avatar`) VALUES
('client1@example.com', 'user1', 'Nguyen Van A', '0901234567', '1990-01-01', 'assets/uploads/avatar/female2.jpg'),
('client2@example.com', 'user2', 'Tran Thi B', '0902345678', '1992-02-02', NULL),
('client3@example.com', 'user3', 'Le Van C', '0903456789', '1994-03-03', NULL),
('client4@example.com', 'user4', 'Pham Thi D', '0904567890', '1996-04-04', NULL),
('client5@example.com', 'user5', 'Hoang Van E', '0905678901', '1998-05-05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `Username` varchar(50) NOT NULL,
  `Id` varchar(20) NOT NULL,
  `Content` text NOT NULL,
  `CreatedAt` datetime DEFAULT current_timestamp(),
  `IsShow` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`Username`, `Id`, `Content`, `CreatedAt`, `IsShow`) VALUES
('user1', 'BL001', '5241343', '2025-05-19 00:50:34', 1),
('user1', 'BL002', 'hehhuidfasdgasd', '2025-05-19 00:45:21', 1),
('user1', 'BL003', 'holl ly shit', '2025-05-19 00:46:27', 1),
('user1', 'BL005', 'ubala', '2025-05-19 00:49:34', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contactforms`
--

CREATE TABLE `contactforms` (
  `Id` varchar(20) NOT NULL,
  `Email` text DEFAULT NULL,
  `Name` text DEFAULT NULL,
  `Message` text DEFAULT NULL,
  `CreatedAt` datetime DEFAULT current_timestamp(),
  `IsSeen` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `contactforms`
--

INSERT INTO `contactforms` (`Id`, `Email`, `Name`, `Message`, `CreatedAt`, `IsSeen`) VALUES
('CF001', 'alice@example.com', 'Alice Nguyen', 'I would like to know more about the current exhibition.', '2025-05-01 10:30:00', 0),
('CF002', 'bob@example.com', 'Bob Tran', 'The website has an error when booking tickets.', '2025-05-03 14:15:00', 0),
('CF003', 'carol@example.com', 'Carol Le', 'I want to book a private guide.', '2025-05-05 09:00:00', 1),
('CF004', 'david@example.com', 'David Pham', 'How much is the ticket for children?', '2025-05-07 17:45:00', 0),
('CF005', 'eva@example.com', 'Eva Do', 'How can I participate in the upcoming event?', '2025-05-10 11:20:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contain`
--

CREATE TABLE `contain` (
  `TicId` varchar(20) NOT NULL,
  `Id` varchar(20) NOT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Quantity` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `contain`
--

INSERT INTO `contain` (`TicId`, `Id`, `Email`, `Quantity`) VALUES
('TK003', 'ORD01', NULL, 4),
('TK005', 'ORD01', NULL, 4),
('TK006', 'ORD01', NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `display`
--

CREATE TABLE `display` (
  `Id` varchar(20) NOT NULL,
  `ExhId` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `display`
--

INSERT INTO `display` (`Id`, `ExhId`) VALUES
('AF002', 'EV004'),
('AF003', 'EV004'),
('AF004', 'EV004'),
('AF010', 'EV003'),
('AF011', 'EV003'),
('AF012', 'EV003');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `Id` varchar(20) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Title` text DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `TimeStart` datetime DEFAULT current_timestamp(),
  `TimeEnd` datetime DEFAULT current_timestamp(),
  `Location` text DEFAULT NULL,
  `DisplayOrder` bigint(20) DEFAULT 0,
  `IsShow` tinyint(1) DEFAULT 1,
  `Summary` text DEFAULT NULL,
  `ImageUrl` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`Id`, `Username`, `Title`, `Description`, `TimeStart`, `TimeEnd`, `Location`, `DisplayOrder`, `IsShow`, `Summary`, `ImageUrl`) VALUES
('EV001', 'user1', 'fdsagdsafdsafasdf', '<p>dsafdsagsafdsafsagasdf</p>', '2027-02-02 14:01:00', '2027-03-03 13:00:00', '0', 0, 1, '<p>dsafgsadgsafsadfasdfsa</p>', 'assets/uploads/event/581-1080x720.jpg'),
('EV002', 'user1', 'fasdfwefsadfsadfas', '<p>dsafgwaefaw</p>', '2026-03-03 14:01:00', '2026-03-03 14:01:00', '0', 0, 1, 'fewgfsadfasdfasdf', 'assets/uploads/event/418-1080x720.jpg'),
('EV003', 'user1', 'dsagsdafdsafdfa', '<p>dsgadsafdsafsadfasdf<img src=\"assets/uploads/event/879-1920x1080.jpg\"></p>', '2027-02-03 15:02:00', '2026-03-03 02:01:00', 'dfdsafasdfsadf', 0, 1, 'dsafsadfasdgasdfsadfas', 'assets/uploads/event/475-1920x1080.jpg'),
('EV004', 'user1', 'dsfsadfasdf', '<p>sdfsadf</p>', '2026-02-02 14:01:00', '2026-02-02 14:01:00', 'fsafdsaf', 0, 1, 'dsafsadf', '');

-- --------------------------------------------------------

--
-- Table structure for table `exhibitions`
--

CREATE TABLE `exhibitions` (
  `Id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `exhibitions`
--

INSERT INTO `exhibitions` (`Id`) VALUES
('EV003'),
('EV004');

-- --------------------------------------------------------

--
-- Table structure for table `guides`
--

CREATE TABLE `guides` (
  `Email` varchar(50) NOT NULL,
  `Expertise` text DEFAULT NULL,
  `Introduction` text DEFAULT NULL,
  `IsWorking` tinyint(1) DEFAULT 1,
  `Price` float DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `Id` varchar(20) NOT NULL,
  `Name` text DEFAULT NULL,
  `IsShow` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`Id`, `Name`, `IsShow`) VALUES
('AR', 'Arabic', 1),
('DE', 'German', 1),
('EN', 'English', 1),
('ES', 'Spanish', 1),
('FR', 'French', 1),
('IT', 'Italian', 1),
('JA', 'Japanese', 1),
('RU', 'Russian', 1),
('VI', 'Vietnamese', 1),
('ZH', 'Chinese', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `Id` varchar(20) NOT NULL,
  `VouId` varchar(20) DEFAULT NULL,
  `PayId` varchar(20) DEFAULT NULL,
  `Username` varchar(50) DEFAULT NULL,
  `VisitDate` datetime DEFAULT current_timestamp(),
  `CreatedDate` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`Id`, `VouId`, `PayId`, `Username`, `VisitDate`, `CreatedDate`) VALUES
('ORD01', NULL, 'PAY01', 'user1', '2029-03-03 03:02:00', '2025-05-18 12:30:31');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `Id` varchar(20) NOT NULL,
  `OrdId` varchar(20) NOT NULL,
  `PayDate` datetime DEFAULT current_timestamp(),
  `TotalCost` float DEFAULT 0,
  `IsPaid` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`Id`, `OrdId`, `PayDate`, `TotalCost`, `IsPaid`) VALUES
('PAY01', 'ORD01', '2025-05-18 12:30:31', 147, 0);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `Username` varchar(50) NOT NULL,
  `Id` varchar(20) NOT NULL,
  `Comment` text DEFAULT NULL,
  `CreatedAt` datetime DEFAULT current_timestamp(),
  `IsShow` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `Id` varchar(20) NOT NULL,
  `Name` text DEFAULT NULL,
  `IsShow` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`Id`, `Name`, `IsShow`) VALUES
('admin', 'Administrator', 1),
('root', 'Root Administrator', 1),
('user', 'Standard User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `speak`
--

CREATE TABLE `speak` (
  `Email` varchar(50) NOT NULL,
  `Id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `Id` varchar(20) NOT NULL,
  `Name` text DEFAULT NULL,
  `IsShow` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`Id`, `Name`, `IsShow`) VALUES
('TAG06', 'Technology', 1),
('TAG07', 'Photography', 1),
('TAG08', 'Nature', 1),
('TAG09', 'Education', 1),
('TAG10', 'Innovation', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `Id` varchar(20) NOT NULL,
  `Name` text DEFAULT NULL,
  `Price` float DEFAULT 0,
  `Description` text DEFAULT NULL,
  `IsShow` tinyint(1) DEFAULT 1,
  `DisplayOrder` bigint(20) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`Id`, `Name`, `Price`, `Description`, `IsShow`, `DisplayOrder`) VALUES
('TK001', 'Standard Adult Ticket', 12, 'Valid for adults aged 18 and above.', 1, 0),
('TK002', 'Child Ticket', 6, 'Valid for children aged 6 to 17.', 1, 1),
('TK003', 'Senior Ticket', 8, 'Valid for seniors aged 60 and above.', 1, 2),
('TK004', 'Student Ticket', 7, 'Valid with a student ID.', 1, 3),
('TK005', 'Group Ticket', 10, 'For groups of 10 or more visitors.', 1, 4),
('TK006', 'VIP Ticket', 25, 'Includes full access and priority services.', 1, 5),
('TK007', 'Weekend Promo Ticket', 9, 'Discounted rate for weekends only.', 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `totag`
--

CREATE TABLE `totag` (
  `Id` varchar(20) NOT NULL,
  `BloId` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE `voucher` (
  `Id` varchar(20) NOT NULL,
  `Price` float DEFAULT 0,
  `Percent` double DEFAULT 0,
  `DateStart` datetime DEFAULT current_timestamp(),
  `DateEnd` datetime DEFAULT current_timestamp(),
  `Description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academy`
--
ALTER TABLE `academy`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`Username`),
  ADD KEY `FK_ACCOUNT_DECENTRAL_ROLE` (`Id`),
  ADD KEY `FK_ACCOUNT_HAS_CLIENT` (`Email`);

--
-- Indexes for table `artifact`
--
ALTER TABLE `artifact`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FK_BLOG_POST_ACCOUNT` (`Username`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`Email`),
  ADD KEY `FK_CLIENT_HAS_ACCOUNT` (`Username`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`Username`,`Id`),
  ADD KEY `FK_COMMENT_COMMENT_BLOG` (`Id`);

--
-- Indexes for table `contactforms`
--
ALTER TABLE `contactforms`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `contain`
--
ALTER TABLE `contain`
  ADD PRIMARY KEY (`TicId`,`Id`),
  ADD KEY `FK_CONTAIN_CONTAIN_GUIDES` (`Email`),
  ADD KEY `FK_CONTAIN_CONTAIN_ORDERS` (`Id`);

--
-- Indexes for table `display`
--
ALTER TABLE `display`
  ADD PRIMARY KEY (`Id`,`ExhId`),
  ADD KEY `FK_DISPLAY_DISPLAY_EXHIBITI` (`ExhId`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FK_EVENTS_NOTIFY_ACCOUNT` (`Username`);

--
-- Indexes for table `exhibitions`
--
ALTER TABLE `exhibitions`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `guides`
--
ALTER TABLE `guides`
  ADD PRIMARY KEY (`Email`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FK_ORDERS_APPLY_VOUCHER` (`VouId`),
  ADD KEY `FK_ORDERS_MAKE_ACCOUNT` (`Username`),
  ADD KEY `FK_ORDERS_PAY_PAYMENT` (`PayId`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FK_PAYMENT_PAY_ORDERS` (`OrdId`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`Username`,`Id`),
  ADD KEY `FK_REVIEW_REVIEW_ARTIFACT` (`Id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `speak`
--
ALTER TABLE `speak`
  ADD PRIMARY KEY (`Email`,`Id`),
  ADD KEY `FK_SPEAK_SPEAK_LANGUAGE` (`Id`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `totag`
--
ALTER TABLE `totag`
  ADD PRIMARY KEY (`Id`,`BloId`),
  ADD KEY `FK_TOTAG_TOTAG_BLOG` (`BloId`);

--
-- Indexes for table `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`Id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `academy`
--
ALTER TABLE `academy`
  ADD CONSTRAINT `FK_ACADEMY_TYPE_EVENTS` FOREIGN KEY (`Id`) REFERENCES `events` (`Id`);

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `FK_ACCOUNT_DECENTRAL_ROLE` FOREIGN KEY (`Id`) REFERENCES `role` (`Id`),
  ADD CONSTRAINT `FK_ACCOUNT_HAS_CLIENT` FOREIGN KEY (`Email`) REFERENCES `client` (`Email`);

--
-- Constraints for table `blog`
--
ALTER TABLE `blog`
  ADD CONSTRAINT `FK_BLOG_POST_ACCOUNT` FOREIGN KEY (`Username`) REFERENCES `account` (`Username`);

--
-- Constraints for table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `FK_CLIENT_HAS_ACCOUNT` FOREIGN KEY (`Username`) REFERENCES `account` (`Username`);

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_COMMENT_COMMENT_ACCOUNT` FOREIGN KEY (`Username`) REFERENCES `account` (`Username`),
  ADD CONSTRAINT `FK_COMMENT_COMMENT_BLOG` FOREIGN KEY (`Id`) REFERENCES `blog` (`Id`);

--
-- Constraints for table `contain`
--
ALTER TABLE `contain`
  ADD CONSTRAINT `FK_CONTAIN_CONTAIN_GUIDES` FOREIGN KEY (`Email`) REFERENCES `guides` (`Email`),
  ADD CONSTRAINT `FK_CONTAIN_CONTAIN_ORDERS` FOREIGN KEY (`Id`) REFERENCES `orders` (`Id`),
  ADD CONSTRAINT `FK_CONTAIN_CONTAIN_TICKET` FOREIGN KEY (`TicId`) REFERENCES `ticket` (`Id`);

--
-- Constraints for table `display`
--
ALTER TABLE `display`
  ADD CONSTRAINT `FK_DISPLAY_DISPLAY_ARTIFACT` FOREIGN KEY (`Id`) REFERENCES `artifact` (`Id`),
  ADD CONSTRAINT `FK_DISPLAY_DISPLAY_EXHIBITI` FOREIGN KEY (`ExhId`) REFERENCES `exhibitions` (`Id`);

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `FK_EVENTS_NOTIFY_ACCOUNT` FOREIGN KEY (`Username`) REFERENCES `account` (`Username`);

--
-- Constraints for table `exhibitions`
--
ALTER TABLE `exhibitions`
  ADD CONSTRAINT `FK_EXHIBITI_TYPE_EVENTS` FOREIGN KEY (`Id`) REFERENCES `events` (`Id`);

--
-- Constraints for table `guides`
--
ALTER TABLE `guides`
  ADD CONSTRAINT `FK_GUIDES_INHERITAN_CLIENT` FOREIGN KEY (`Email`) REFERENCES `client` (`Email`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_ORDERS_APPLY_VOUCHER` FOREIGN KEY (`VouId`) REFERENCES `voucher` (`Id`),
  ADD CONSTRAINT `FK_ORDERS_MAKE_ACCOUNT` FOREIGN KEY (`Username`) REFERENCES `account` (`Username`),
  ADD CONSTRAINT `FK_ORDERS_PAY_PAYMENT` FOREIGN KEY (`PayId`) REFERENCES `payment` (`Id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `FK_PAYMENT_PAY_ORDERS` FOREIGN KEY (`OrdId`) REFERENCES `orders` (`Id`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `FK_REVIEW_REVIEW_ACCOUNT` FOREIGN KEY (`Username`) REFERENCES `account` (`Username`),
  ADD CONSTRAINT `FK_REVIEW_REVIEW_ARTIFACT` FOREIGN KEY (`Id`) REFERENCES `artifact` (`Id`);

--
-- Constraints for table `speak`
--
ALTER TABLE `speak`
  ADD CONSTRAINT `FK_SPEAK_SPEAK_GUIDES` FOREIGN KEY (`Email`) REFERENCES `guides` (`Email`),
  ADD CONSTRAINT `FK_SPEAK_SPEAK_LANGUAGE` FOREIGN KEY (`Id`) REFERENCES `language` (`Id`);

--
-- Constraints for table `totag`
--
ALTER TABLE `totag`
  ADD CONSTRAINT `FK_TOTAG_TOTAG_BLOG` FOREIGN KEY (`BloId`) REFERENCES `blog` (`Id`),
  ADD CONSTRAINT `FK_TOTAG_TOTAG_TAG` FOREIGN KEY (`Id`) REFERENCES `tag` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
