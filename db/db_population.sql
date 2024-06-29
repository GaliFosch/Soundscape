-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Giu 29, 2024 alle 10:04
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `soundscapedb`
--

--
-- Dump dei dati per la tabella `belonging`
--

INSERT INTO `belonging` (`GenreTag`, `TrackID`) VALUES
('Classic', 22),
('Classic', 23),
('Classic', 24),
('Classic', 25),
('Classic', 26),
('Country', 18),
('Country', 19),
('Country', 20),
('Country', 21),
('Futuristic', 9),
('Futuristic', 11),
('Futuristic', 12),
('Instrumental', 1),
('Instrumental', 2),
('Instrumental', 6),
('Instrumental', 7),
('Instrumental', 8),
('Instrumental', 9),
('Instrumental', 10),
('Instrumental', 11),
('Instrumental', 12),
('kpop', 13),
('kpop', 14),
('kpop', 15),
('kpop', 16),
('kpop', 17),
('Lofi', 1),
('Lofi', 8),
('Pop', 3),
('Pop', 4),
('Pop', 5),
('Pop', 13),
('Pop', 14),
('Pop', 15),
('Pop', 16),
('Pop', 17),
('Pop', 19),
('Pop', 20),
('Rock', 18),
('Sad', 4),
('Sad', 21),
('Sad', 26),
('Techno', 11),
('Techno', 12),
('Upbeat', 2),
('Upbeat', 6),
('Upbeat', 7),
('Upbeat', 23);

--
-- Dump dei dati per la tabella `comment`
--

INSERT INTO `comment` (`CommentID`, `CommentText`, `CommentTimestamp`, `Parent`, `Username`, `PostID`) VALUES
(1, 'I always wanted to be in space! Did you enter a black hole? How does it feel?', '2024-06-29 07:57:21', NULL, 'Waldo', 13),
(2, 'Mine is the flute, even if my lungs are not very powerful :(', '2024-06-29 07:57:21', NULL, 'Waldo', 8),
(3, 'I am totally down for it! Friday night ad Philly? I\'ll bring my flute!', '2024-06-29 07:57:21', NULL, 'Waldo', 2),
(4, 'Let me be your 96!', '2024-06-29 07:57:21', NULL, 'Waldo', 15),
(5, 'I have my beautiful cat just here near me. His name is Mr. Boo. He\'s not a normal cat. He\'s a miniature giant space cat! \r\nHere, let him write you something: efksdaJKAGJKGFAQsdcknlkw9832hr89jnsc', '2024-06-29 07:57:21', NULL, 'Waldo', 11),
(6, 'Can I bring Karlach (my cat) with me on the beach?', '2024-06-29 07:57:21', NULL, 'Kitty', 4),
(7, 'SO CUTEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEE!!!!', '2024-06-29 07:57:21', NULL, 'Kitty', 18),
(8, 'I imagine a nice rainy day, my cat Karlach, the book I\'m currently reading (A court of thorns and roses), a nice wool \r\nblanket and your song blasted at max volume!', '2024-06-29 07:57:21', NULL, 'Kitty', 7),
(9, '10/10. This outfit is FIRE!', '2024-06-29 07:57:21', NULL, 'Kitty', 5),
(10, 'New sleepy song unlocked!', '2024-06-29 07:57:21', NULL, 'SpaceAlien', 10),
(11, 'I think it should be called just \"Day\" because beautiful and joyous can be simplified to each other :):):)', '2024-06-29 07:57:21', NULL, 'SpaceAlien', 2),
(12, 'Bro... I\'m not even kidding I was thinking about this just the other day! Like Do you ever look into theyr beautiful black \r\neyes and think the entire space could be reflected in such a small sphere? Like AWESOME BRO! I also want black \r\neyes with the power of the cosmos. I want to se attack ships on fire off the shoulder of Orion, C-beams glitter in the dark \r\nnear the Tannhauser gate. All this moments in time... in a single blink.', '2024-06-29 07:57:21', NULL, 'SpaceAlien', 16),
(13, 'There will be a teleport to your concerts! And I will be the first to arrive ', '2024-06-29 07:57:21', NULL, 'SpaceAlien', 3),
(14, 'YES PLEASE! An eclipse album? Maybe with a little bit of gothic vibe... AND VAMPIRES!', '2024-06-29 07:57:21', NULL, 'SpaceAlien', 20),
(15, 'I\'m more of a poker and winning girl, but i\'m down for everything!', '2024-06-29 07:57:21', NULL, 'Britney', 17),
(16, 'GIRLS! This is so good. I swear it\'s in my head 24/7', '2024-06-29 07:57:21', NULL, 'Britney', 1),
(17, 'Thank you! Next track \"The cat you want\"?', '2024-06-29 07:57:21', NULL, 'Britney', 12),
(18, 'I believe in love again, thank to you two! Happy anniversary!', '2024-06-29 07:57:21', NULL, 'Britney', 18),
(19, 'I would listen to this song on repeat! Your vibes combined? Masterpiece', '2024-06-29 07:57:21', NULL, 'Britney', 2),
(20, 'I\'m sorry for you small stature... and I\'m sorry, I think that head is mine ', '2024-06-29 07:57:21', NULL, 'Britney', 6),
(21, 'I don\'t have a cat but seeing yours make me want to take the car and go buy one right this moment!', '2024-06-29 07:57:21', NULL, 'Britney', 11),
(22, 'We are so happy that you have some friends to help you! Starting a music carrier alone can be quite difficult. But don\'t be \r\nafraid! This website is full of people ready to give an hand!', '2024-06-29 07:57:21', NULL, 'Whitegreen', 9),
(23, 'No kidding, we need a break. Beach filler episode?', '2024-06-29 07:57:21', NULL, 'Whitegreen', 4),
(24, 'Next time write to us! We will give you VIP tickets', '2024-06-29 07:57:21', NULL, 'Whitegreen', 6),
(25, 'Right now, in the middle of releasing our next album, the calmest reading day we have is the one we read our songs text \r\nto check for any grammatical mistake :D', '2024-06-29 07:57:21', NULL, 'Whitegreen', 7),
(26, 'Such a good pun!', '2024-06-29 07:57:21', NULL, 'Whitegreen', 19),
(27, 'The triangle! Such a fine instrument', '2024-06-29 07:57:21', NULL, 'Whitegreen', 8),
(28, 'We need to know where you shop. We outfits with those vibes', '2024-06-29 07:57:21', NULL, 'Whitegreen', 5),
(29, 'An awesome fire we say! LET\'S DO IT', '2024-06-29 07:57:21', NULL, 'Whitegreen', 21),
(30, 'I love my cow Bessie', '2024-06-29 07:57:21', NULL, 'Cowboyblue', 11),
(31, 'You\'re a true cowboy son', '2024-06-29 07:57:21', NULL, 'Cowboyblue', 5),
(32, 'A truck', '2024-06-29 07:57:21', NULL, 'Cowboyblue', 8),
(33, 'Call it \"cheerful\r\necstatic\r\nexuberant\r\nfestive\r\nheartwarming\r\njoyful\r\njubilant\r\nmerry\r\nupbeat\r\nwonderful day\"', '2024-06-29 07:57:21', NULL, 'Cowboyblue', 2),
(34, 'Very excited about it', '2024-06-29 07:57:21', NULL, 'Cowboyblue', 21),
(35, 'Go get some sleep son', '2024-06-29 07:57:21', NULL, 'Cowboyblue', 10),
(36, 'The work of a true orchestra', '2024-06-29 07:57:21', NULL, 'ItalianOrchestra', 9),
(37, 'We would love to compose a new track for yours 7 years anniversary', '2024-06-29 07:57:21', NULL, 'ItalianOrchestra', 18),
(38, 'We think she would to dance to a little waltz', '2024-06-29 07:57:21', NULL, 'ItalianOrchestra', 11),
(39, 'Why just one instrument? Why not the entire orchestra!', '2024-06-29 07:57:21', NULL, 'ItalianOrchestra', 8);

--
-- Dump dei dati per la tabella `follow`
--

INSERT INTO `follow` (`Following`, `Follower`) VALUES
('Britney', 'Kitty'),
('Britney', 'Waldo'),
('Cowboyblue', 'ItalianOrchestra'),
('Cowboyblue', 'Kitty'),
('ItalianOrchestra', 'Kitty'),
('ItalianOrchestra', 'SpaceAlien'),
('Kitty', 'Britney'),
('Kitty', 'ItalianOrchestra'),
('Kitty', 'SpaceAlien'),
('Kitty', 'Waldo'),
('SpaceAlien', 'ItalianOrchestra'),
('SpaceAlien', 'Kitty'),
('Waldo', 'Cowboyblue'),
('Waldo', 'Kitty'),
('Waldo', 'SpaceAlien'),
('Whitegreen', 'Kitty'),
('Whitegreen', 'SpaceAlien'),
('Whitegreen', 'Waldo');

--
-- Dump dei dati per la tabella `genre`
--

INSERT INTO `genre` (`GenreTag`) VALUES
('Classic'),
('Country'),
('Folk'),
('Futuristic'),
('Hip-Hop'),
('Indie'),
('Instrumental'),
('Jazz'),
('kpop'),
('Lofi'),
('Metal'),
('Pop'),
('Rap'),
('Rock'),
('Sad'),
('Techno'),
('Upbeat');

--
-- Dump dei dati per la tabella `image`
--

INSERT INTO `image` (`PostImage`, `PostID`) VALUES
('user_img/24ef2381de14d5cdea79b1d7d037fe4b546c7687d4d96f0769452e352f67fb65ac848a689bec2b0b5d097896adfe78b0a3a4bb2758b61aa9652cabbc1a604348.jpg', 2),
('user_img/7d65d2780446c8451388801fe5740fd80e04719d2af7652528edd87be0705140e3e5bf06461d21a60d85ecf4217388109592f0f252287f5235771e363e98ed0f.jpg', 3),
('user_img/efa29d849225b56415b96d0c2a596463c603c822254f379dc1e30994a0ef4cd6d26694a088f6dffb69ac15f8d32374ba5fff131b0411ce49de73694c85b3523d.jpg', 5),
('user_img/02deff2d47b38f46957450efffcd3620a10866c38476d1c25d234ddfebbb508d9675f38ef9f73eafd053552812524b6020800dd2ae3ff33c59d34f3cb59e0707.jpg', 6),
('user_img/19962ff9350161c5be614d47967a5fd7b178128f2012abd5204d52d5b47af4446c5cab1b9ddce83d2b0068d787a958c9e168c8a54ade9ff447bebce648284b49.jpg', 6),
('user_img/1e3821940ecc5bef998273f464a66d7e506710e647e284ba8d8e12fcb0cb5b1faa8636cc1d98c9d67d14bf4b0ecbcf51c61549931433cf9d945506c2e3ecd447.jpg', 6),
('user_img/3fd60c1a126c31c5b76bc83ef32eaf1bea79777f8e6e7b20299c91ce8eee557cf54cd6a1f52b967fae80d7d1d6f809997e51b76762d23114c2ebf811617d0f8a.jpg', 7),
('user_img/e8dd3fbf554f89b770d093d9ee38b962197ab98b644678a19e05b057b1fb78c24b2f668f087e4526dcd7e7a2e4bf44a2ceb9b92b1bcf1c8d44367ec69e90e4a4.jpg', 7),
('user_img/1cccb08b9f9231bac65210597c4ed412c66a4202e8f7ee11346d59dad226e7597871f2cdeae66afa8bb799223a72b174c1f7bda184202be9eb4f3fce071fff1b.jpg', 9),
('user_img/9dbe57458a7aac4fa3dfff52b4dac44b43d30e8e8f73b3230a05fae1be6698c2a5474cb23c7a78a8ec87b17d283a3116aedd9ac6a4aa1c125d5fed91bcaa43a2.jpg', 9),
('user_img/c404d438ce2c0474a4e0921d120da5e18f2a55eb2fc365c3b92f9a5b6d1e98920ea6cfbcede96b1b3450e67549f1756b075d1b620a6014878067e6ab20b3865f.jpg', 9),
('user_img/6afef56631c8e5e690857ce7b563cd8fb2568a23290030594dedca6f26362a81487c60cf32bcecd8ef67e903b1f92b4be563a87c1833786f553618047513a9fd.jpg', 11),
('user_img/80d590d4a6283a7a2e8d54dde1da54633d907de55fb4c753bd0f54ed8029850065b5c6bc2978629d2c8237bf9293348e0043432f04529e9b9218f412046b281f.jpg', 11),
('user_img/ce7071acfb7692b38adf82df6d30087dc8ecc0e3e3f2f0cd48dcd23e0f7b120db92a7f624fcb270cf7a9030fd0fa753ea8d2e45860509f83835b05e6958d5440.jpg', 11),
('user_img/3c979aa9d413335b07bea1c68c5b905d4e6af2a9821504c57db7afedf99901c991f344b1757382694b09efba212e51b4e57794508bc43ea55084128eabda95d1.jpg', 13),
('user_img/66e3f5366b6886b23aabf0cc8debd71596bbfa809a65b6b4538c3e186c1221066fc786d39d8f3d7d1e2a2c9eee652483ed97f5aae53c909322e1549556de2a4b.jpg', 16),
('user_img/8927ed429de69c5b7e6a2b2448094f7a455675d308194c345c601bff9739e0c646c025683f3a73cf062eba3764e0368356251410679d9a5cdb1cb94cba3f244c.jpg', 16),
('user_img/41299cb315100fcc4e99b898846c617238e32edc2690d4effc566a7595fc1b47fb5bbe84a56d692599c5c942fa584969e0fe02862b7bbc6af3818a4f51a35a7d.jpg', 18),
('user_img/4ba1ad4163744612e3507d6061ea4107dd84e4b1f8a6c325c4f3cae1dc0359a388b80bac9a62e1222c51297b6e695b74639c8efdefd1acbfac84a02f2b921ada.jpg', 18),
('user_img/55e617ec4cdf23508a62f0fcc10039b77df0acd8489ba78b7a0cdfb51c1837b9aa0166bfcd4486128945ef23b252265eb53b4ac690eb407de3f3f00382d8b825.jpg', 18),
('user_img/6ffd6efddf90403a0c139a0a92d81e7328454cf27d8dba9478a702a83629254cfd5e14b81473a20b6f17a4402ec6cdb4eaaa12e49d0835ada362b1f0d747acd6.jpg', 18),
('user_img/7709c0fd549685e943c145328905b5fe49591e78795ab77d311ea58a7c9dae39f54284305febcde0c7913e22dbf12ff910fb179d204ebba2c189327e9df31370.jpg', 18),
('user_img/ca4246302c2e9fc22d823cf29c1c921a262d6f1e5f9629bc41a4b925c20810e5d85c7d6fecb86a131c661ee9d9a50d4ad5d3d9e60dcdbd228cd5111594331b80.jpg', 18),
('user_img/9f17a7e07bddce7667d6412253d0416ff2db93680c1208e903bfb8850fda323a6d7681ccdf48163bdde8fec6d137d8320023e28bd4ca0d258a640a2a776126f9.jpg', 19),
('user_img/932d2ec73aaebea6be6fa05c818d5cc08216f227a6920a8760488c69712e18dc36801040dff4fd2bf4ff95b0fd559755d078983bf459b569906aebb25807085f.jpg', 20),
('user_img/fbf856d6e062f6686df60ab105eda53fa84ea0c378f97884daba3c785404e1395d34f5b683d619cf78fcb5c9d8388701473265fd00479b49c6581f3b0dd53ef7.jpg', 20);

--
-- Dump dei dati per la tabella `notification`
--

INSERT INTO `notification` (`NotificationID`, `CommentID`, `NotificationTimestamp`, `Type`, `Receiver`, `TriggeringUser`, `PostID`, `Visualized`) VALUES
(1, NULL, '2024-06-29 07:42:06', 'Follower', 'Britney', 'Kitty', NULL, 0),
(2, NULL, '2024-06-29 07:42:06', 'Follower', 'Britney', 'Waldo', NULL, 0),
(3, NULL, '2024-06-29 07:42:06', 'Follower', 'Cowboyblue', 'ItalianOrchestra', NULL, 0),
(4, NULL, '2024-06-29 07:42:06', 'Follower', 'Cowboyblue', 'Kitty', NULL, 0),
(5, NULL, '2024-06-29 07:42:06', 'Follower', 'ItalianOrchestra', 'Kitty', NULL, 0),
(6, NULL, '2024-06-29 07:42:06', 'Follower', 'ItalianOrchestra', 'SpaceAlien', NULL, 0),
(7, NULL, '2024-06-29 07:42:06', 'Follower', 'Kitty', 'Britney', NULL, 1),
(8, NULL, '2024-06-29 07:42:06', 'Follower', 'Kitty', 'ItalianOrchestra', NULL, 1),
(9, NULL, '2024-06-29 07:42:06', 'Follower', 'Kitty', 'SpaceAlien', NULL, 1),
(10, NULL, '2024-06-29 07:42:06', 'Follower', 'Kitty', 'Waldo', NULL, 1),
(11, NULL, '2024-06-29 07:42:06', 'Follower', 'SpaceAlien', 'ItalianOrchestra', NULL, 0),
(12, NULL, '2024-06-29 07:42:06', 'Follower', 'SpaceAlien', 'Kitty', NULL, 0),
(13, NULL, '2024-06-29 07:42:06', 'Follower', 'Waldo', 'Cowboyblue', NULL, 0),
(14, NULL, '2024-06-29 07:42:06', 'Follower', 'Waldo', 'Kitty', NULL, 0),
(15, NULL, '2024-06-29 07:42:06', 'Follower', 'Waldo', 'SpaceAlien', NULL, 0),
(16, NULL, '2024-06-29 07:42:06', 'Follower', 'Whitegreen', 'Kitty', NULL, 0),
(17, NULL, '2024-06-29 07:42:06', 'Follower', 'Whitegreen', 'SpaceAlien', NULL, 0),
(18, NULL, '2024-06-29 07:42:06', 'Follower', 'Whitegreen', 'Waldo', NULL, 0),
(19, NULL, '2024-06-29 07:57:21', 'Post_Interaction', 'SpaceAlien', 'Waldo', 13, 0),
(20, NULL, '2024-06-29 07:57:21', 'Post_Interaction', 'Britney', 'Waldo', 8, 0),
(21, NULL, '2024-06-29 07:57:21', 'Post_Interaction', 'Whitegreen', 'Waldo', 2, 0),
(22, NULL, '2024-06-29 07:57:21', 'Post_Interaction', 'SpaceAlien', 'Waldo', 15, 0),
(23, NULL, '2024-06-29 07:57:21', 'Post_Interaction', 'Kitty', 'Waldo', 11, 1),
(24, NULL, '2024-06-29 07:57:21', 'Post_Interaction', 'ItalianOrchestra', 'Kitty', 4, 0),
(25, NULL, '2024-06-29 07:57:21', 'Post_Interaction', 'Cowboyblue', 'Kitty', 18, 0),
(26, NULL, '2024-06-29 07:57:21', 'Post_Interaction', 'Waldo', 'Kitty', 7, 0),
(27, NULL, '2024-06-29 07:57:21', 'Post_Interaction', 'Waldo', 'Kitty', 5, 0),
(28, NULL, '2024-06-29 07:57:21', 'Post_Interaction', 'Kitty', 'SpaceAlien', 10, 1),
(29, NULL, '2024-06-29 07:57:21', 'Post_Interaction', 'Whitegreen', 'SpaceAlien', 2, 0),
(30, NULL, '2024-06-29 07:57:21', 'Post_Interaction', 'Cowboyblue', 'SpaceAlien', 16, 0),
(31, NULL, '2024-06-29 07:57:21', 'Post_Interaction', 'Whitegreen', 'SpaceAlien', 3, 0),
(32, NULL, '2024-06-29 07:57:21', 'Post_Interaction', 'ItalianOrchestra', 'SpaceAlien', 20, 0),
(33, NULL, '2024-06-29 07:57:21', 'Post_Interaction', 'Cowboyblue', 'Britney', 17, 0),
(34, NULL, '2024-06-29 07:57:21', 'Post_Interaction', 'Whitegreen', 'Britney', 1, 0),
(35, NULL, '2024-06-29 07:57:21', 'Post_Interaction', 'Kitty', 'Britney', 12, 1),
(36, NULL, '2024-06-29 07:57:21', 'Post_Interaction', 'Cowboyblue', 'Britney', 18, 0),
(37, NULL, '2024-06-29 07:57:21', 'Post_Interaction', 'Whitegreen', 'Britney', 2, 0),
(38, NULL, '2024-06-29 07:57:21', 'Post_Interaction', 'Waldo', 'Britney', 6, 0),
(39, NULL, '2024-06-29 07:57:21', 'Post_Interaction', 'Kitty', 'Britney', 11, 1),
(40, NULL, '2024-06-29 07:57:21', 'Post_Interaction', 'Britney', 'Whitegreen', 9, 0),
(41, NULL, '2024-06-29 07:57:21', 'Post_Interaction', 'ItalianOrchestra', 'Whitegreen', 4, 0),
(42, NULL, '2024-06-29 07:57:21', 'Post_Interaction', 'Waldo', 'Whitegreen', 6, 0),
(43, NULL, '2024-06-29 07:57:21', 'Post_Interaction', 'Waldo', 'Whitegreen', 7, 0),
(44, NULL, '2024-06-29 07:57:21', 'Post_Interaction', 'Cowboyblue', 'Whitegreen', 19, 0),
(45, NULL, '2024-06-29 07:57:21', 'Post_Interaction', 'Britney', 'Whitegreen', 8, 0),
(46, NULL, '2024-06-29 07:57:21', 'Post_Interaction', 'Waldo', 'Whitegreen', 5, 0),
(47, NULL, '2024-06-29 07:57:21', 'Post_Interaction', 'ItalianOrchestra', 'Whitegreen', 21, 0),
(48, NULL, '2024-06-29 07:57:21', 'Post_Interaction', 'Kitty', 'Cowboyblue', 11, 1),
(49, NULL, '2024-06-29 07:57:21', 'Post_Interaction', 'Waldo', 'Cowboyblue', 5, 0),
(50, NULL, '2024-06-29 07:57:21', 'Post_Interaction', 'Britney', 'Cowboyblue', 8, 0),
(51, NULL, '2024-06-29 07:57:21', 'Post_Interaction', 'Whitegreen', 'Cowboyblue', 2, 0),
(52, NULL, '2024-06-29 07:57:21', 'Post_Interaction', 'ItalianOrchestra', 'Cowboyblue', 21, 0),
(53, NULL, '2024-06-29 07:57:21', 'Post_Interaction', 'Kitty', 'Cowboyblue', 10, 1),
(54, NULL, '2024-06-29 07:57:21', 'Post_Interaction', 'Britney', 'ItalianOrchestra', 9, 0),
(55, NULL, '2024-06-29 07:57:21', 'Post_Interaction', 'Cowboyblue', 'ItalianOrchestra', 18, 0),
(56, NULL, '2024-06-29 07:57:21', 'Post_Interaction', 'Kitty', 'ItalianOrchestra', 11, 1),
(57, NULL, '2024-06-29 07:57:21', 'Post_Interaction', 'Britney', 'ItalianOrchestra', 8, 0),
(58, NULL, '2024-06-29 07:58:11', 'Post_Interaction', 'Whitegreen', 'Kitty', 1, 0),
(59, NULL, '2024-06-29 07:58:11', 'Post_Interaction', 'Whitegreen', 'SpaceAlien', 1, 0),
(60, NULL, '2024-06-29 07:58:11', 'Post_Interaction', 'Whitegreen', 'Cowboyblue', 2, 0),
(61, NULL, '2024-06-29 07:58:11', 'Post_Interaction', 'Whitegreen', 'SpaceAlien', 2, 0),
(62, NULL, '2024-06-29 07:58:11', 'Post_Interaction', 'ItalianOrchestra', 'Cowboyblue', 4, 0),
(63, NULL, '2024-06-29 07:58:11', 'Post_Interaction', 'ItalianOrchestra', 'Kitty', 4, 0),
(64, NULL, '2024-06-29 07:58:11', 'Post_Interaction', 'ItalianOrchestra', 'SpaceAlien', 4, 0),
(65, NULL, '2024-06-29 07:58:11', 'Post_Interaction', 'ItalianOrchestra', 'Whitegreen', 4, 0),
(66, NULL, '2024-06-29 07:58:11', 'Post_Interaction', 'Waldo', 'Britney', 5, 0),
(67, NULL, '2024-06-29 07:58:11', 'Post_Interaction', 'Waldo', 'Whitegreen', 5, 0),
(68, NULL, '2024-06-29 07:58:11', 'Post_Interaction', 'Waldo', 'Britney', 6, 0),
(69, NULL, '2024-06-29 07:58:11', 'Post_Interaction', 'Waldo', 'Kitty', 6, 0),
(70, NULL, '2024-06-29 07:58:11', 'Post_Interaction', 'Waldo', 'Cowboyblue', 7, 0),
(71, NULL, '2024-06-29 07:58:11', 'Post_Interaction', 'Waldo', 'SpaceAlien', 7, 0),
(72, NULL, '2024-06-29 07:58:11', 'Post_Interaction', 'Britney', 'Cowboyblue', 8, 0),
(73, NULL, '2024-06-29 07:58:11', 'Post_Interaction', 'Britney', 'ItalianOrchestra', 8, 0),
(74, NULL, '2024-06-29 07:58:11', 'Post_Interaction', 'Britney', 'Waldo', 8, 0),
(75, NULL, '2024-06-29 07:58:11', 'Post_Interaction', 'Britney', 'SpaceAlien', 9, 0),
(76, NULL, '2024-06-29 07:58:11', 'Post_Interaction', 'Kitty', 'Waldo', 10, 1),
(77, NULL, '2024-06-29 07:58:11', 'Post_Interaction', 'Kitty', 'Waldo', 12, 1),
(78, NULL, '2024-06-29 07:58:11', 'Post_Interaction', 'SpaceAlien', 'Britney', 13, 0),
(79, NULL, '2024-06-29 07:58:11', 'Post_Interaction', 'SpaceAlien', 'Britney', 14, 0),
(80, NULL, '2024-06-29 07:58:11', 'Post_Interaction', 'SpaceAlien', 'Cowboyblue', 14, 0),
(81, NULL, '2024-06-29 07:58:11', 'Post_Interaction', 'SpaceAlien', 'Waldo', 14, 0),
(82, NULL, '2024-06-29 07:58:11', 'Post_Interaction', 'Cowboyblue', 'ItalianOrchestra', 16, 0),
(83, NULL, '2024-06-29 07:58:11', 'Post_Interaction', 'Cowboyblue', 'Waldo', 16, 0),
(84, NULL, '2024-06-29 07:58:11', 'Post_Interaction', 'Cowboyblue', 'ItalianOrchestra', 17, 0),
(85, NULL, '2024-06-29 07:58:11', 'Post_Interaction', 'Cowboyblue', 'SpaceAlien', 17, 0),
(86, NULL, '2024-06-29 07:58:11', 'Post_Interaction', 'Cowboyblue', 'Whitegreen', 17, 0),
(87, NULL, '2024-06-29 07:58:11', 'Post_Interaction', 'Cowboyblue', 'SpaceAlien', 18, 0),
(88, NULL, '2024-06-29 07:58:11', 'Post_Interaction', 'Cowboyblue', 'Britney', 19, 0),
(89, NULL, '2024-06-29 07:58:11', 'Post_Interaction', 'ItalianOrchestra', 'Britney', 20, 0),
(90, NULL, '2024-06-29 07:58:11', 'Post_Interaction', 'ItalianOrchestra', 'SpaceAlien', 21, 0),
(91, NULL, '2024-06-29 07:58:11', 'Post_Interaction', 'ItalianOrchestra', 'Whitegreen', 21, 0);

--
-- Dump dei dati per la tabella `playlist`
--

INSERT INTO `playlist` (`NumTracks`, `PlaylistID`, `Name`, `CoverImage`, `TimeLength`, `CreationDate`, `Creator`, `IsAlbum`) VALUES
(4, 1, 'Summer 2024 concerts setlists', 'user_img/ffbe4755d974b5ae300f55b46189adf426659fb4badced0054abfd39ac9c526aaf56859477ccd70cbad121a05d52f2368f1d13d530b70d312d5b9a6dd5adb2d5.jpg', '00:10:23', '2024-06-29 00:00:00', 'ItalianOrchestra', 0),
(4, 2, 'Space adventures', 'user_img/a55bf53ba183e47226fb1aee803b8d7bd10435d2a3817f050bf1f78674869ced64595d75bc82ea9f78a1d4d122a2b2769c95fddf909fa20fee7a02ca562babc9.jpg', '00:15:49', '2024-06-29 00:00:00', 'SpaceAlien', 1),
(3, 3, 'Tales of love', 'user_img/bc534ec61e6f3da1b3d6f6a467ea920269aceab8cc45ea32738140faed085536dbf07854dbb1cde309f2147e4bc72e6ee63859baee6df6300b0fa64a8a1edb12.jpg', '00:14:00', '2024-06-29 00:00:00', 'Britney', 1),
(4, 4, 'Songs I like', 'user_img/3efd15e0aaaef5183b51ba1e346fc8df640e5df854b3a8102e314da946cb53a3d618ab497424ee4b5121f2b0312db1aee29488502f4e21e2bbb6a8a2d6afe0d6.jpg', '00:22:26', '2024-06-29 00:00:00', 'Britney', 0),
(4, 5, 'Girls just wanna have fun', 'user_img/3878e73e36b8817239240103b0447e7d9e8994cef41a2cac826feb8a68f04f3220df72ec81002d181ae4ccfb67320358e843777519b1e31aeffd8cd8505ddf6e.jpg', '00:17:26', '2024-06-29 00:00:00', 'Whitegreen', 1);

--
-- Dump dei dati per la tabella `post`
--

INSERT INTO `post` (`PostID`, `Caption`, `NumLike`, `NumComments`, `PostTimestamp`, `TrackID`, `PlaylistID`, `Username`) VALUES
(1, 'Whitegreen in your area! Here\\\'s our first single. Let us know what you think \r\nabout it!', 3, 1, '2024-06-29 07:16:48', 13, NULL, 'Whitegreen'),
(2, 'Our dream would be doing a collab with Waldo. Do you think our collab name \r\nwould be \\\"Beautiful joyous day?', 2, 4, '2024-06-29 07:17:29', 2, NULL, 'Whitegreen'),
(3, 'In the future we think flying cars will blast our songs while taking you to our \r\nconcert! Soon there will be new dates posted on our socials.', 1, 1, '2024-06-29 07:18:26', 15, NULL, 'Whitegreen'),
(4, 'Go listen to our newest track. If you want the full experience, imagine being \r\nona beach during a beautiful sunset.', 4, 2, '2024-06-29 07:19:07', 22, NULL, 'ItalianOrchestra'),
(5, 'I am obsessed with this song. Who knows maybe I\'ll change job and become \r\na cowboy. Do you think this outfit will fit me?', 2, 3, '2024-06-29 07:20:00', 20, NULL, 'Waldo'),
(6, 'Yesterday I went to a Whitegreen concert! Here\'s some photos! I\'m talls as a \r\nSmurf so yes, I could only see some heads :)', 2, 2, '2024-06-29 07:21:22', 16, NULL, 'Waldo'),
(7, 'Have you ever wondered how a calm reading day would sound like?', 2, 2, '2024-06-29 07:21:58', 1, NULL, 'Waldo'),
(8, 'My favourite instrument is the ukulele, what is yours?', 4, 4, '2024-06-29 07:22:25', NULL, NULL, 'Britney'),
(9, 'Today I started composing my new album! Here\'s some photos of the \r\nrecording. Shout out to all my beautiful friends that helped me!', 2, 2, '2024-06-29 07:23:11', NULL, NULL, 'Britney'),
(10, 'I was very sleepy when writing this song hehe', 1, 2, '2024-06-29 07:23:56', 8, NULL, 'Kitty'),
(11, 'Do you like cats? Do you love cats just like me? My favourite is my little red \r\ncat, Karlach. Next song will be about her, I promise. In the meanwhile, here\'s \r\nsome photos of her.', 0, 4, '2024-06-29 07:24:35', NULL, NULL, 'Kitty'),
(12, 'GIRL POP! GIRLY GIRL POP!', 1, 1, '2024-06-29 07:25:02', 5, NULL, 'Kitty'),
(13, 'I\'ve been a few weeks in space. Gues what? I\'ve created a diary... A music \r\ndiary, to keep track of all the beautiful things that have happened. Check it \r\nout! P.S. This is me just before entering the spaceship ;)', 1, 1, '2024-06-29 07:26:12', NULL, 2, 'SpaceAlien'),
(14, 'I think no one has instilled fear into me as Blooooorb, the alien commander. \r\nHis terrible tentacles... I dream of them to this day.', 4, 0, '2024-06-29 07:26:51', 11, NULL, 'SpaceAlien'),
(15, 'Anyone is into space? I need new friends to talk about space... And maybe \r\nmore followers. I make music about space and we are nearly to 100.', 1, 1, '2024-06-29 07:27:20', NULL, NULL, 'SpaceAlien'),
(16, 'Do you ever think a cow would understand you better that other people? My \r\ndear friend Bessie is the protagonist of the nnew single I\'m working on', 2, 1, '2024-06-29 07:28:40', 18, NULL, 'Cowboyblue'),
(17, 'Have you ever been in Vegas? NO YOU HAVEN\'T. Not if you haven\'t been \r\npart of a rodeo in vegas. When you will finally smell horses and bulls, then... \r\nthen you\'ll be in Vegas.', 3, 1, '2024-06-29 07:29:09', 19, NULL, 'Cowboyblue'),
(18, 'This song I wrote for my beautiful and loving wife. Today we celebrate six \r\nyears of marriage. A round for applause for my wife, my best friend and my \r\nsource of inspiration, Edwina. Everytime I see this pictures I cry a little bit.', 1, 3, '2024-06-29 07:29:41', 21, NULL, 'Cowboyblue'),
(19, 'Do you think I could feature the sound of my truck in my newest track?', 1, 1, '2024-06-29 07:29:57', NULL, NULL, 'Cowboyblue'),
(20, 'Have you listened to SpaceAlien yet? We think they\'re pretty neat. Collab \r\nsoon?', 2, 1, '2024-06-29 07:40:12', 10, NULL, 'ItalianOrchestra'),
(21, 'Do you think an orchestral version of this song would be awesome or fire?', 2, 2, '2024-06-29 07:40:46', 14, NULL, 'ItalianOrchestra'),
(22, 'Anyone out there to talk about these absolute bangers?', 0, 0, '2024-06-29 07:41:39', NULL, 4, 'Britney');

--
-- Dump dei dati per la tabella `postlike`
--

INSERT INTO `postlike` (`PostID`, `Username`) VALUES
(1, 'Kitty'),
(1, 'SpaceAlien'),
(1, 'Whitegreen'),
(2, 'Cowboyblue'),
(2, 'SpaceAlien'),
(3, 'Whitegreen'),
(4, 'Cowboyblue'),
(4, 'Kitty'),
(4, 'SpaceAlien'),
(4, 'Whitegreen'),
(5, 'Britney'),
(5, 'Whitegreen'),
(6, 'Britney'),
(6, 'Kitty'),
(7, 'Cowboyblue'),
(7, 'SpaceAlien'),
(8, 'Britney'),
(8, 'Cowboyblue'),
(8, 'ItalianOrchestra'),
(8, 'Waldo'),
(9, 'Britney'),
(9, 'SpaceAlien'),
(10, 'Waldo'),
(12, 'Waldo'),
(13, 'Britney'),
(14, 'Britney'),
(14, 'Cowboyblue'),
(14, 'SpaceAlien'),
(14, 'Waldo'),
(15, 'SpaceAlien'),
(16, 'ItalianOrchestra'),
(16, 'Waldo'),
(17, 'ItalianOrchestra'),
(17, 'SpaceAlien'),
(17, 'Whitegreen'),
(18, 'SpaceAlien'),
(19, 'Britney'),
(20, 'Britney'),
(20, 'ItalianOrchestra'),
(21, 'SpaceAlien'),
(21, 'Whitegreen');

--
-- Dump dei dati per la tabella `single_track`
--

INSERT INTO `single_track` (`AudioFile`, `TrackID`, `Name`, `CoverImage`, `TimeLength`, `CreationDate`, `Creator`) VALUES
('user_audio/bdba526e0917fa187d510ef4a4cba8c47fa1ab12a9bc6f0edddd33f21629c8e121a6d2a35a1c598bb2438e73013e5a42a2c88fd161e1dc8c90e65c14ffb6ba24.mp3', 1, 'Calm reading', 'user_img/ce75a7e2ab9a7c3901d139a192fd7eed4fa1bc5af86ab271dbfc829cf1c1270b3682f74401d3eb75e909a9b6545890e4b2daeba80fbd28e35c7762f4dbc870d7.jpg', '00:04:24', '2024-06-29 08:40:53', 'Waldo'),
('user_audio/7be520e8ed88ee73a9b172bcfa21df5a3b52fd5a106883b171130b14756e3d345bc5f4e2b1c925665fd2d597d529448d92ac6d3434949264a8077fc50cb72658.mp3', 2, 'Joyous day', 'user_img/09a75db528bb5ed96187393a0c5db30cad33a8e328f704dfc05220c8c61d8b18ccb27dee70f3ac3487714926d1643ba8e839bc24e9e23d0dcd80d694a2b943dd.jpg', '00:02:13', '2024-06-29 08:45:49', 'Waldo'),
('user_audio/212e58be0ba83753e9ad0359eb214b6030f590090d7f6bd780334e6a63c7c31da4032ff4017e6c548203f674435c6c8e771db0db9be4a02925ea7827f18b0c34.mp3', 3, 'Abyss of love', 'user_img/be58beb9a5daf25c21da5549864e3e9e9edd81309399ab4e200507197ffc84cafaa4a662551c403d8f9648e8e0faaa49fc48901b2ab8731f2d1b51622c1b6cd4.jpg', '00:02:00', '2024-06-29 08:47:37', 'Britney'),
('user_audio/d74dd82c66b398a52e80f32fd9e7eb77bb4b2e7232377fcf9042f73f0a52691c15d51191eb0da1ad7d1b7fead55b84b1e343ba48ab70478ac8cfbf7f08db9c50.mp3', 4, 'With you my love', 'user_img/4a0aa9bb98edc86e878f66353d32e684b85fa46ab58b7fb287986433e9db1fc01f0f60b5d09b195b61ecb6ad448d4ad195b83ea7fffa03529ceaa64bd4f0c032.jpg', '00:03:09', '2024-06-29 08:48:12', 'Britney'),
('user_audio/75216d721b69c4a88cb6cf5c551f40eebc3dde785d16b5d37a2e5743a08c73000e14fb7cf670a56c7e74962ac538227c704f9ebb550c01dd76dca6007b5286ef.mp3', 5, 'The girl you want', 'user_img/e75a711c19d129616ca066603dc65e5c319f4ee0d48a7f164d5f6e311399488c2e4e8338ed4ee4c2b648a7d7730353a1abfe947d6518fb5caa6d52cf7849588a.jpg', '00:03:31', '2024-06-29 08:48:36', 'Britney'),
('user_audio/7f577c62615f92ed686a37ef7043c21168b0aeba1d4e188191379352eb72929391c9e4f1f1506326244776f43441abf4b151eabcb532ef4e23accb23aa77c0b3.mp3', 6, 'Archie cat', 'user_img/cf28b0d5724d09552b5da7817568759d678b90d443ba42adc567f304e853420f0a7912b5d3b461ed9ef070488972f4a49aa1818808d7e3ff49015fd4caefce73.jpg', '00:00:45', '2024-06-29 08:50:14', 'Kitty'),
('user_audio/e7c6efba2bf26ea0b7762f3acca28cabf174ce720fa49c6e3b6616c1c16e7cd7d889552ac5bb4777bc50c4b5b1899d1c8223ea1bd8e4887406c90f4699e47af1.mp3', 7, 'Excuse me cat', 'user_img/b796643fdc2f6037c649e2499e6cfead59ffb8704fe605b8517eb0b5922e5fc5f3e11bf6e4741f4a24d9768700a19641d764aea20a646c95311cfc5acaf32974.jpg', '00:01:22', '2024-06-29 08:51:14', 'Kitty'),
('user_audio/b6dfb0012d7bffbb3c058ddda5cba291dd2a8faa2f514b904b644ee25bb17544ddc10862620e387f8725231c423c4be6635771c7477e0ef5e7c38d84f4989e33.mp3', 8, 'Cat nap', 'user_img/5c0578afe7166610b5c79f6cfb11e59b719d57e420ab9934a2e80a488b8b3cb904c4d35dd52e8638c6c4b7946ed4743d8204a6e3503c61922263fba2a173d12c.jpg', '00:03:13', '2024-06-29 08:51:47', 'Kitty'),
('user_audio/8bb37b3757a38df7e35a10a08cd3a955248f274d9877d9f17e2df5d5e80496fd21c64d70bbc6686d5bb09d34f98b4b85a348eab75fe8b86fd6b4cc5735ea012e.mp3', 9, 'Light speed', 'user_img/5fe2b8d55a0cd67c9bbf6fe4d80d2e92407f740e2ab5d3f3826179a6d4808ad235554b13fea8925840c8a631bc5941cd8ae830e6f11923983fe675a18911f110.jpg', '00:02:28', '2024-06-29 08:53:58', 'SpaceAlien'),
('user_audio/307b9efea66928900c0595bb64425f68e1deab5c634e3cda2e6b5aacdb70b04fc5e294332679c9ea98e70b6e3e2a375477934e325cb3a2dfd84caae12543bdb8.mp3', 10, 'Deep space', 'user_img/cdc8afe7a83b7468d9c087d7d8eeeb3533670b47458a7c60b4e768122199fb46c26e3adb63405e5d7d6864750f1dc71fe43eee1fa8c43468a196d023be6ea2ed.jpg', '00:02:45', '2024-06-29 08:54:38', 'SpaceAlien'),
('user_audio/24401fb84c01ee9e7e48d45bc45bb74d6b71e2185360c45621e6676f16eb5502f24b8bce6878d3ce2b0d2cdb5d22d2d1e46ced49e77beacf4a9cf0c31398e7f9.mp3', 11, 'Alien commander', 'user_img/92b1d9f7c2aacf22f7d33a158c55b90c02558f1b1883bc3e8c64efa519b549ad2473f60e9b0007f38faa5ec8e46522f95dfbfa26d74df0dd4fd601682c704617.jpg', '00:02:32', '2024-06-29 08:55:10', 'SpaceAlien'),
('user_audio/9127c0bc7f5595d803b08d8b118e0d8a5b0fb13c8e46351f3fe935803be0de34f93389430ef00af45bf8955589d61faa40b6de633bf2e61a4da7d1b2c09a8e0a.mp3', 12, 'Cyber attack', 'user_img/b1ced2ae51626a9cc44eb0058569df9c267059d9d79a2b982295b796592fad1d0960abc4cdf6642314530a3d1d8f61fa001210c31c499af11369df5eeb2852b0.jpg', '00:02:44', '2024-06-29 08:55:53', 'SpaceAlien'),
('user_audio/e7503f117c12dc9d9fd3ad8455f74453ad39e9256c57aeb5f9e7eddb36ad1703bcc1767157715be73bdc51025a12822deb9e99cfe8f42431ea06c2efef946e54.mp3', 13, 'Stronger than ever', 'user_img/fc015b9d1bc75f0e63b8a7e8c1dba5bc34918c889e027f33071790b3a5ac1834cfb5d2528b76c7198d68c298809fe15198acbf31b45e42349025237c09d97959.jpg', '00:01:12', '2024-06-29 08:57:18', 'Whitegreen'),
('user_audio/6cd4b5b5d0902d4d54191260c34b3c67ca8be2793e1091a1bd42185aa876762b07c739dc6efb9514d586e1ee2015c870133742f0dab2872605a8128026bf7204.mp3', 14, 'Michelle', 'user_img/8b8bd5c3331585fb29135ea0fc5d3f3dac4c6a93845216276e753a3ddeddcdde4f8f6f12fc4e5b4d630089a958940dd9738b0c6fcb2aa687def9da26ac0b4851.jpg', '00:03:59', '2024-06-29 08:58:10', 'Whitegreen'),
('user_audio/ebe76167490b6f87730bd11660e1553b214a60226f3a87248ab127e97dd925aea427ca41e0181bc1b56a3c1a86560c3f8a060b8c4c6de125bb6cb4eebd437b80.mp3', 15, 'Future', 'user_img/edaf38480800678687a27abf978e8f8afe01f523d32c7f10667ebbf125a5b177d884caf0789130bd4ceb5a5f746cfe7286edfcb3a5a5993bffec9474f1b5c0b0.jpg', '00:03:20', '2024-06-29 08:59:13', 'Whitegreen'),
('user_audio/9e012b73775bab0dbe700ed8640a16d28518d0c8b8e375c19fb495ecf38cc0fe7492c7bde07df4dff5d3f4eb1f05fcbf13306ee9f34cf7ceed9b39ee1bb13a84.mp3', 16, 'Smile melody', 'user_img/35ab3bb9cec72dcb77074ff4076c8daab5a2bb4094b2c198ef670fe209895ea729a040e730df9536ba752295a7b0534eae90b7d02d9fcd787543cb064e67660c.jpg', '00:02:50', '2024-06-29 09:00:05', 'Whitegreen'),
('user_audio/146f58f0d79676d7408617628df5fa8e060b90763110c5632a4a5ea509b0762917e37ad54b9bffdbd2992419d697b1e99d8dc74d7082009ccf8dc6107b9790bb.mp3', 17, 'Beautiful days', 'user_img/d720973c697c585f7f224d513e9822a0cc0520af2b3459851e7efdeebd9ddf6b3917f0cd3288187b254af64715b6e16522bfd6db9f180562ced78e544a07bf18.jpg', '00:03:25', '2024-06-29 09:00:37', 'Whitegreen'),
('user_audio/0038b0e237ba6b3dc2c8db0d838c636f38c35b380d68f1359197def143605888f44bb6e8e7cb12da899cfea8aaeee9f2641da5d243da33abbe344d2cbd5d6042.mp3', 18, 'Rock around cows', 'user_img/22f577f4975ac2aa7c68b086aee9df73cd013c58d42b3e636672417af054b04e3ed9dc7aa66c2ce671640e404601c0abb7b17117729d8ffe43c983f0d52d990d.jpg', '00:02:09', '2024-06-29 09:02:06', 'Cowboyblue'),
('user_audio/cd7adc24b33dd1d0550473076b368d9475b70c3268f7c4ee663450f14265e653963852c82f09e60e26801670eaf2d7fe1e7e2595bf73bee33da705f68d5a862c.mp3', 19, 'Rodeo in Vegas', 'user_img/092c4394ce2366424e6fa490acfe57d242c0205ae17b0db189500863ce7a31a8664388a99972003088922a08af7c68c7502867e3635f48a6f17fca3441f81eda.jpg', '00:01:51', '2024-06-29 09:02:52', 'Cowboyblue'),
('user_audio/2c6966bd634995590692b9093b73b252b63fcda7485083e059d969261ac4486bd085e0daf815ad03b874e85716259bfced2f1a9a8b8e58ef72f9eeb9d4be6e25.mp3', 20, 'Pop those boots', 'user_img/4550b466361a4e44906d8b7437de7dd1e9fb9605f035050cfc4abb21974be270c10cb952b9f950262cf804e177abd367395dd69aac36e342d5319421dc5bc336.jpg', '00:02:35', '2024-06-29 09:03:26', 'Cowboyblue'),
('user_audio/ca68df4a115721f7d8625bf5ea5965ba5c640ef3348eb7e6b338e43e685de10431640f1e78fdbcf544636d2856903267712279919e6d1939f45021be4c97c063.mp3', 21, 'Mosquito blues', 'user_img/473a246f3e9189f6d492cb220d1b32397390bbd41b22916840c325c6d45942f8cbd8695f48bbf312d46bb6b1886836d8f2a4cc8cc8210355a4269dd57d6493e8.jpg', '00:01:54', '2024-06-29 09:03:58', 'Cowboyblue'),
('user_audio/2efdef5cc2e60d5fa88853b56ee87c897ec098344a3bf0477b3085beb9f9189f049d60d458da5dbf375412c877bdeada9bb1055ae46019e6e3d5a07d2a1199e7.mp3', 22, 'String quartet Adagio', 'user_img/4ff9e2ccf9d90cfcac875e48a3503f5b65599648eb113c743f50a26ed35cdc1ef978dc081e046950b451f19ca47fcc6cd723a9a23d5509ca3f8168098771a8e8.jpg', '00:02:35', '2024-06-29 09:05:24', 'ItalianOrchestra'),
('user_audio/d26e05eddeaea44c9ba0d6e2244072d2826ffb0b0f1d5d3d83e37e1d3b9959fefd150b6d7ef279695112e9d9da9d0c8b8e5722c6be91fda62c872b4cf872032b.mp3', 23, 'Waltz in F major', 'user_img/c258fc05c9801b92bb8b99dd2106b02dcfee34c1695409c196883b8566ccde8bfdaaee96ddc68f81166a1b40bd050cc37664055333cc4363d32083a38bcc8ba1.jpg', '00:01:50', '2024-06-29 09:05:49', 'ItalianOrchestra'),
('user_audio/732aaa682cc82982ba14d64ce0c51dc18efdf510cabc20abc9797a92de7a4b5469dc6d1fb17edd16e8cbe56199708885b67f56e33847385f908924b21b532b66.mp3', 24, 'Barcarolle', 'user_img/e83ae2817d5759bdae53c2c038e25ddcb02e12229b1879fd37ca415d70fe76704b6698efe631aa710944e752d46c6f646b1b403614742674d294361586851b1d.jpg', '00:01:26', '2024-06-29 09:06:06', 'ItalianOrchestra'),
('user_audio/0f3ff57b7e3a718e799d5e33a364b5f7c466afb44cd2c9a8cbdc8d71af84baaf2789e03a997cb6944ccd5658ff9cb582d8f03de4db8d2a620f6783d566d2b634.mp3', 25, 'String and flute Adagio', 'user_img/e5095613c12c8e81851c6122f5328f1a87432c185dae4dbb6adfa46135e5896a32f1b9cb3ed9ec23c38b3097c8fee28b24b5e99aee5b3511c20bf876b3b080e7.jpg', '00:01:12', '2024-06-29 09:07:02', 'ItalianOrchestra'),
('user_audio/bc207bb63bcfc4af872a50e8b37e1c4f9616c6f9e7224929df61276781e627b5da08d3c3773fa78232ffd9161d584a9a734976fe83808a4f65cb86f75e8f1e0d.mp3', 26, 'Reverie', 'user_img/22de2ff4dde9abdfdb28aa7c6456ba738ef788bc45e148f69e16dac4d16e9dc35cc7232c5a6864a507d06ae3556f0d281fd5be8ff8cbaff37468f59e50654deb.jpg', '00:01:45', '2024-06-29 09:09:47', 'ItalianOrchestra');

--
-- Dump dei dati per la tabella `tracklist`
--

INSERT INTO `tracklist` (`TrackID`, `PlaylistID`, `Position`) VALUES
(1, 4, 3),
(3, 3, 1),
(4, 3, 3),
(5, 3, 2),
(8, 4, 2),
(9, 2, 1),
(10, 2, 2),
(11, 2, 3),
(12, 2, 4),
(13, 5, 1),
(14, 4, 1),
(14, 5, 2),
(16, 4, 4),
(16, 5, 4),
(17, 5, 3),
(22, 1, 3),
(23, 1, 2),
(24, 1, 1),
(25, 1, 4);

--
-- Dump dei dati per la tabella `user`
--

INSERT INTO `user` (`Username`, `Biography`, `ProfileImage`, `Email`, `NumFollower`, `NumFollowing`, `Password`, `Salt`) VALUES
('Britney', 'Come on! Let\\\'s go shopping!', 'user_img/a20c0a65d4783bc882a44564f5db5efd8d66e49cf0c2b8d595824e552d0ec0240134376eea5a94b29d72bfcefddfc024316b5e60acf6af671f6a3dd022a514fa.jpg', 'spears@britney.com', 2, 1, '2c2f6cd188347e2a07d468f0e0731b15ceb2c6ac76b2a4821b12e95898695ad1d47d2c5461f68547d85fe74e1913abf854d8efb3401fd07f1ae639ffa0f15f0b', 'de0586f130371820b3c06948c14a59ca664ce72982d768f396616768725f2aecba59e8c34d322ff183eb8c04814f35ca157eae53e28141dd33ddacbb258cfb38'),
('Cowboyblue', 'Just a man and his cows in the vast land that is Minnesota.', 'user_img/a559b9bf37d19a1c82022378005493581711898bb46df794b97bd99809508b2afe7decbff8a4cb47802ea1d73ce5dc02c8afe9ab0eb84c118c7541a64fc39cf0.jpg', 'blue@cowboy.com', 2, 1, 'bceccfaf8bff208c1dc2d0e3245e172ac26a3667e45935f427133314588269f78f9c5f0c7ff4b8232c8f832ea5fcdd8575cf620da0370ee84a949e78ce211ea5', 'db5512098a43a076f1bed8781cc45f5aa81cd2e9c7cd5c037b45330e939608ea26989c97e104e95fe8c94685e25c1213e389f50f02189a161924f30f46916c7e'),
('ItalianOrchestra', 'We are the national italian orchestra. We have a wide musical repertoire. Why don\\\'t you stick around and learn something new about Mozart?', 'user_img/1056ab1baba773ccb5e71f3ebf26291456a60820f086a4b542b1566ad95dbc3d57404f027217d79a27f85bebf3d37f4b4434ad5e0b594e14e1d7051afce7f036.jpg', 'italian@orchestra.it', 2, 3, '38b8337d4a94b81b17ecb31f436db6ab31e9e8f821453515602bc69b16e968374cb343a5977b3cf2c8bdbece433eac78817ada4e94f0d67274887701621a622d', 'c5685aac84ab722dde130c44e58d918b202a7313a28d60f434471e331fdc9381a40977886db66a71e82567f76bf1821d5f85dc6b5a469cd6bbd021a5cef9db69'),
('Kitty', 'My mission is to represent cats and their beauty in every way possible', 'user_img/d1a547e0a1549f107b75d0473ff71e22f6003a6c2a299ced597c460fa225ef7ae13c10226cbf1a47537cabd7b82eed946034bc3e908cd691c26a0c5f58bc18d9.jpg', 'kittykat@kat.com', 4, 6, 'f4ce0224b13a1575b87ded63d9cca54d61a11a6f86f6337a455df424ab1b20172be3861701707c0fde4d6747fdcb3d88810c02ce0489c7116b1a100ab5e0b765', 'c3a1052df5deb1667c68a5e23ec8e3d1a730f2f858698b3fe9d87e16f447cb675234e82d3452cc38aab7cb837107c5043a491a5f8260b46c660b9191a37056d5'),
('SpaceAlien', 'I\\\'m an alien from space, here to bring you futuristic music', 'user_img/acb0aa09171dea94dadbb2518da6b902f20bc88e43d6d0000206d88a96b8d7f0eed2289cac3dd8d343fe9a63eed23e491cfb457d23057dfc515ef50e0f762d92.jpg', 'space@alien.it', 2, 4, 'e95247a94da0feda92e2f9448b68c842525c50e1eff727565c023263565dd9acbf7de49fc0a4a5b33c96bd33068fbe5a3f859919622a07722c0fade79e2390bd', 'f40dd1571b478659422d44ac4e7700bff13325e17da6ff6d239c4df4a3cdec9cf038b4b5a68e194b52b6f86d86f1325319479a4a57f3c44ef12e528440f361a2'),
('Waldo', 'I write music to bring happiness to everyone arounf me. Follow me in this journey to joy.', NULL, 'waldo@waldo.it', 3, 3, '505511baf8c268f5cc944ec853b2115806d186c31e9d429bc191c67b8ee77e679bc1a6468672aad1b6c95958a6103304e51caa77f8dfd899a393e7a0d3792c0b', 'a05ab997e95c35d4b9db4b5aabdc42f678e06dd1b12d1dd1219703d8f85049a26c684f0f1bebcd4129378668f854dafe5deaf33d86f0409e3cf83c2a13464dc9'),
('Whitegreen', 'WHITEGREEN IN YOUR AREA!\\r\\nAn-nyeong-ha-se-yo, we are Whitegreen. Stay tuned for lots of good music', 'user_img/4c5fc2415f71f93de29cc2dd153a234950097aa6e44f44cf865bc3c794deb7bbf540c4b03af98f9ac1f2348227a94f60b049dc585118f461ff1f26f3729a9115.jpg', 'whitegreen@inyourarea.ko', 3, 0, 'af99f216bfec9e9b90b249621fa64dff99ae9b9cc214e68cac4001ef4433ee9c3e5f1bc64cfdd0b44ecc0f4158574ca7215c4d66429da36f64a76c941c5d38af', 'bc7349207d05f25fbe8d50b33cc154ca9e10184388dc4e246c268c1151f639348d1faf483e411d8781097292656e7ca7a17ae51b939b3d59677cfb738b2a07e7');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
