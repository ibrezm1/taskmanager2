CREATE TABLE `demo_appointment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `description` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `date` date DEFAULT NULL,
  UNIQUE KEY `demo_appointment_Id_IDX` (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 ;

INSERT INTO test.demo_appointment
( description, `date`)
VALUES
    ( 'test1', '2001-01-01'),
    ( 'test2', '2024-02-06'),
    ( 'test3', '2024-02-13'),
    ( 'test4', '2024-02-14');