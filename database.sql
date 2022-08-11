CREATE TABLE `users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(150) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `password` VARCHAR(70) NOT NULL, 
  PRIMARY KEY (`id`),
  UNIQUE (`email`)
);

CREATE TABLE `tasks` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED NOT NULL,
  `title` VARCHAR(150) NOT NULL,
  `description` TEXT NOT NULL,
  `image` VARCHAR(250) NOT NULL,
  `due_date` DATE NOT NULL,
  `status` ENUM('open','progress','completed') NOT NULL DEFAULT 'open',
  PRIMARY KEY (`id`),
  INDEX `fk_task_users_idx` (`user_id`),
  CONSTRAINT `fk_user_tasks` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
);
