INSERT INTO `user`(
    `userEmail`,
    `userName`,
    `points`,
    `numberOfQuestion`,
    `numberOfReplies`
)
VALUES(
    'kavindu@gmail.com',
    'Kavindu',
    '10',
    '1',
    '2'
),(
    'test@outlook.com',
    'Test User',
    '10',
    '2',
    '3'
);

INSERT INTO `post`(
    `postId`,
    `createdDate`,
    `userEmail`,
    `likeCount`,
    `disLikesCount`
)
VALUES(
    NULL,
    '2023-01-14 10:46:57.000000',
    'kavindu@gmail.com',
    '10',
    '2'
),(
    NULL,
    '2023-01-14 10:46:57.000000',
    'kavindu@gmail.com',
    '3',
    '3'
),(
    NULL,
    '2023-01-14 10:46:57.000000',
    'test@outlook.com',
    '2',
    '1'
);

INSERT INTO `question`(
    `postId`,
    `questionId`,
    `userEmail`,
    `questionTitle`,
    `content`,
    `questionState`
)
VALUES(
    '1',
    NULL,
    'kavindu@gmail.com',
    'Data Type Error',
    'Data Error in converting a number to a string',
    'Answered'
),(
    '3',
    NULL,
    'test@outlook.com',
    'Data Size Error',
    'Size exceeded for custom field',
    'Not Answered'
);