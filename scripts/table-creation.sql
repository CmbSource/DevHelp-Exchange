CREATE TABLE `w1761405_0`.`post`(
    `postId` INT(10) NOT NULL AUTO_INCREMENT,
    `createdDate` DATETIME NOT NULL,
    `userEmail` VARCHAR(100) NOT NULL,
    `likeCount` INT(10) NOT NULL,
    `disLikesCount` INT(10) NOT NULL,
    PRIMARY KEY(`postId`)
) ENGINE = InnoDB;

