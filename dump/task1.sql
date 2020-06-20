USE content;

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `one_row` mediumtext CHARACTER SET utf8 NOT NULL,
  `hash_text` varchar(250) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `book`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `hash_one_row` (`hash_text`);

ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
