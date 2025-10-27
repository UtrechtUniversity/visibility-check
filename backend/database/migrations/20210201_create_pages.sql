CREATE TABLE `page` (
                        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                        `title` tinytext DEFAULT NULL,
                        `content` text DEFAULT NULL,
                        PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


LOCK TABLES `page` WRITE;
/*!40000 ALTER TABLE `page` DISABLE KEYS */;

INSERT INTO `page` (`id`, `title`, `content`)
VALUES
(1,'home text','<p>The Visibility Check provides you with insight into the extent of your academic outreach. Moreover, it gives advice on how to generate more attention for your academic work and professional career.</p>\n\n<p>Do you see room for improvement? Any tips? Please use the Feedback button.</p>'),
(2,'results text','<p>The check helps you to gain insight into the extent of your academic visibility. Practical tips and advice can be found on <a href=\"https://www.uu.nl/en/university-library/advice-support-for/researchers/visibility-check/visibility-to-do-list\" target=\"_blank\" rel=\"noopener noreferrer\">the to-do list</a>.</p>\n\n<p>It could be that you have a specific question you need answered. If so, feel free to request a consultation with our team. Leave your details below and let us know what you need.</p>');

/*!40000 ALTER TABLE `page` ENABLE KEYS */;
UNLOCK TABLES;
