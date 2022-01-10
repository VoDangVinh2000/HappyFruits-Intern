-- 08/07/2018 - Costs/debts table
ALTER TABLE `costs` ADD `date_time` datetime NOT NULL AFTER `type_id`;
ALTER TABLE `costs` ADD `branch_id` int(11) NOT NULL DEFAULT '1' AFTER `description`;

INSERT INTO `cost_types` (`id`, `name`, `description`, `is_public`, `created_dtm`, `modified_dtm`) VALUES
(1, 'Chi phí trái cây', NULL, 0, '2018-07-06 00:00:00', '2018-07-09 16:03:38'),
(2, 'Chi phí cố định', NULL, 0, '2018-07-06 00:00:00', '2018-07-05 17:50:21'),
(3, 'Lương', NULL, 0, '2018-07-06 00:00:00', '2018-07-05 17:50:37'),
(4, 'Vật dụng', NULL, 0, '2018-07-06 00:00:00', '2018-07-05 17:50:47'),
(5, 'Nguyên liệu', NULL, 0, '2018-07-06 00:00:00', '2018-07-05 17:50:59'),
(6, 'Máy móc', NULL, 0, '2018-07-06 00:00:00', '2018-07-05 17:51:13'),
(7, 'Khấu hao', NULL, 0, '2018-07-06 00:00:00', '2018-07-05 17:51:32');

ALTER TABLE `debts` ADD `branch_id` int(11) NOT NULL DEFAULT '1' AFTER `description`;

INSERT INTO `debt_types` (`id`, `name`, `description`, `is_public`, `created_dtm`, `modified_dtm`) VALUES
(1, 'Chi phí trái cây', NULL, 0, '2018-07-06 00:00:00', '2018-07-09 16:03:38'),
(2, 'Chi phí cố định', NULL, 0, '2018-07-06 00:00:00', '2018-07-05 17:50:21'),
(3, 'Lương', NULL, 0, '2018-07-06 00:00:00', '2018-07-05 17:50:37'),
(4, 'Vật dụng', NULL, 0, '2018-07-06 00:00:00', '2018-07-05 17:50:47'),
(5, 'Nguyên liệu', NULL, 0, '2018-07-06 00:00:00', '2018-07-05 17:50:59'),
(6, 'Máy móc', NULL, 0, '2018-07-06 00:00:00', '2018-07-05 17:51:13'),
(7, 'Khấu hao', NULL, 0, '2018-07-06 00:00:00', '2018-07-05 17:51:32');