CREATE TABLE `Account` (
    `username` varchar(100)  NOT NULL ,
    `email` varchar(100)  NOT NULL ,
    `password` text  NOT NULL ,
    `type` enum('admin','user') DEFAULT 'user' NOT NULL ,
    `name` text  NULL ,
    `about` text  NULL ,
    `join_date` datetime  NOT NULL ,
    `upload` int  NOT NULL default 0,
    `mediaID` int NULL default 1,
    PRIMARY KEY (
        `username`
    ),
    CONSTRAINT `uc_Account_email` UNIQUE (
        `email`
    )
);

CREATE TABLE `Contact` (
    `username` varchar(100)  NOT NULL ,
    `friend` varchar(100)  NOT NULL ,
    -- Friend, family, favorite
    `category` enum('none','favorite','family','friend')  NOT NULL default 'none'
);

CREATE TABLE `Blocked_user` (
    `username` varchar(100)  NOT NULL ,
    `blocked` varchar(100)  NOT NULL 
);

CREATE TABLE `Media` (
    `mediaID` int  NOT NULL auto_increment,
    `path` varchar(150)  NOT NULL ,
    `type` varchar(30) NOT NULL ,
    `name` text  NOT NULL ,
    `last_access` datetime  NOT NULL ,
    `viewcount` int  NOT NULL default 0 ,
    `description` text  NULL ,
    `public` bool  NOT NULL default TRUE ,
    `likes` int  NOT NULL default 0,
    PRIMARY KEY (
        `mediaID`
    ),
    CONSTRAINT `uc_Media_path` UNIQUE (
        `path`
    )
);

CREATE TABLE `Upload` (
    `uploadID` int  NOT NULL auto_increment ,
    `username` varchar(100)  NOT NULL ,
    `mediaID` int  NOT NULL ,
    `ip` text  NOT NULL ,
    `upload_time` datetime  NOT NULL ,
    PRIMARY KEY (
        `uploadID`
    )
);

CREATE TABLE `Media_Tag` (
    `tag` text  NOT NULL ,
    `mediaID` int  NOT NULL 
);

CREATE TABLE `Media_Categories` (
    `categories` text  NOT NULL ,
    `mediaID` int  NOT NULL 
);

CREATE TABLE `Playlist` (
    `playlistID` int  NOT NULL auto_increment,
    `owner` varchar(100)  NOT NULL ,
    `name` text  NOT NULL ,
    `description` text  NULL ,
    `creation_time` datetime  NOT NULL ,
    `last_access` datetime  NOT NULL ,
    PRIMARY KEY (
        `playlistID`
    )
);

CREATE TABLE `Playlist_Tag` (
    `playlistID` int  NOT NULL ,
    `tag` text  NOT NULL 
);

CREATE TABLE `Playlist_Categories` (
    `playlistID` int  NOT NULL ,
    `categories` text  NOT NULL 
);

CREATE TABLE `Playlist_Media` (
    `playlistID` int NOT NULL,
    `mediaID` int NOT NULL

);

CREATE TABLE `Comments` (
    `commentID` int  NOT NULL auto_increment,
    `mediaID` int  NOT NULL ,
    `username` varchar(100)  NOT NULL ,
    `comment` text  NOT NULL ,
    PRIMARY KEY (
        `commentID`
    )
);

CREATE TABLE `Messages` (
    `messageID` int  NOT NULL auto_increment ,
    `sender` varchar(100)  NOT NULL ,
    `reciever` varchar(100)  NOT NULL ,
    `message` text  NOT NULL ,
    `date` datetime  NOT NULL ,
    PRIMARY KEY (
        `messageID`
    )
);

ALTER TABLE `Account` ADD CONSTRAINT `fk_Account_mediaID` FOREIGN KEY(`mediaID`)
REFERENCES `Media` (`mediaID`) ON DELETE SET NULL;

ALTER TABLE `Contact` ADD CONSTRAINT `fk_Contact_username` FOREIGN KEY(`username`)
REFERENCES `Account` (`username`) ON DELETE CASCADE;

ALTER TABLE `Contact` ADD CONSTRAINT `fk_Contact_friend` FOREIGN KEY(`friend`)
REFERENCES `Account` (`username`) ON DELETE CASCADE;

ALTER TABLE `Blocked_user` ADD CONSTRAINT `fk_Blocked_user_username` FOREIGN KEY(`username`)
REFERENCES `Account` (`username`) ON DELETE CASCADE;

ALTER TABLE `Blocked_user` ADD CONSTRAINT `fk_Blocked_user_blocked` FOREIGN KEY(`blocked`)
REFERENCES `Account` (`username`) ON DELETE CASCADE;

ALTER TABLE `Upload` ADD CONSTRAINT `fk_Upload_username` FOREIGN KEY(`username`)
REFERENCES `Account` (`username`) ON DELETE CASCADE;

ALTER TABLE `Upload` ADD CONSTRAINT `fk_Upload_mediaID` FOREIGN KEY(`mediaID`)
REFERENCES `Media` (`mediaID`) ON DELETE CASCADE;

ALTER TABLE `Media_Tag` ADD CONSTRAINT `fk_Media_Tag_mediaID` FOREIGN KEY(`mediaID`)
REFERENCES `Media` (`mediaID`) ON DELETE CASCADE;

ALTER TABLE `Media_Categories` ADD CONSTRAINT `fk_Media_Categories_mediaID` FOREIGN KEY(`mediaID`)
REFERENCES `Media` (`mediaID`) ON DELETE CASCADE;

ALTER TABLE `Playlist` ADD CONSTRAINT `fk_Playlist_owner` FOREIGN KEY(`owner`)
REFERENCES `Account` (`username`) ON DELETE CASCADE;

ALTER TABLE `Playlist_Tag` ADD CONSTRAINT `fk_Playlist_Tag_playlistID` FOREIGN KEY(`playlistID`)
REFERENCES `Playlist` (`playlistID`) ON DELETE CASCADE;

ALTER TABLE `Playlist_Categories` ADD CONSTRAINT `fk_Playlist_Categories_playlistID` FOREIGN KEY(`playlistID`)
REFERENCES `Playlist` (`playlistID`) ON DELETE CASCADE;

ALTER TABLE `Playlist_Media` ADD CONSTRAINT `fk_Playlist_Media_playlistID` FOREIGN KEY(`playlistID`)
REFERENCES `Playlist` (`playlistID`) ON DELETE CASCADE;

ALTER TABLE `Playlist_Media` ADD CONSTRAINT `fk_Playlist_Media_mediaID` FOREIGN KEY(`mediaID`)
REFERENCES `Media` (`mediaID`) ON DELETE CASCADE;

ALTER TABLE `Comments` ADD CONSTRAINT `fk_Comments_mediaID` FOREIGN KEY(`mediaID`)
REFERENCES `Media` (`mediaID`) ON DELETE CASCADE;

ALTER TABLE `Comments` ADD CONSTRAINT `fk_Comments_username` FOREIGN KEY(`username`)
REFERENCES `Account` (`username`) ON DELETE CASCADE;

ALTER TABLE `Messages` ADD CONSTRAINT `fk_Messages_sender` FOREIGN KEY(`sender`)
REFERENCES `Account` (`username`) ON DELETE CASCADE;

ALTER TABLE `Messages` ADD CONSTRAINT `fk_Messages_reciever` FOREIGN KEY(`reciever`)
REFERENCES `Account` (`username`) ON DELETE CASCADE;

INSERT INTO Media (path, type, name, last_access, public)
values ('site/profile.png', 'image/png', 'profile', 0, 0);

