CREATE TABLE `w1761405_0`.`user`(
    `userEmail` VARCHAR(255) NOT NULL,
    `userName` VARCHAR(255) NOT NULL,
    `points` INT(10) NOT NULL,
    `numberOfQuestion` INT(10) NOT NULL,
    `numberOfReplies` INT(10) NOT NULL,
    PRIMARY KEY(`userEmail`(255))
) ENGINE = InnoDB;

CREATE TABLE `w1761405_0`.`post`(
    `postId` INT(10) NOT NULL AUTO_INCREMENT,
    `createdDate` DATETIME NOT NULL,
    `userEmail` VARCHAR(100) NOT NULL,
    `likeCount` INT(10) NOT NULL,
    `disLikesCount` INT(10) NOT NULL,
    PRIMARY KEY(`postId`)
) ENGINE = InnoDB;

ALTER TABLE post
ADD FOREIGN KEY (userEmail) REFERENCES user(userEmail);

CREATE TABLE `w1761405_0`.`question`(
    `postId` INT(10) NOT NULL,
    `questionId` INT(10) NOT NULL AUTO_INCREMENT,
    `userEmail` VARCHAR(255) NOT NULL,
    `questionTitle` VARCHAR(255) NOT NULL,
    `content` VARCHAR(255) NOT NULL,
    `questionState` VARCHAR(255) NOT NULL,
    PRIMARY KEY(`questionId`)
) ENGINE = InnoDB;

ALTER TABLE question
ADD FOREIGN KEY (userEmail) REFERENCES user(userEmail),
ADD FOREIGN KEY (postId) REFERENCES post(postId);
