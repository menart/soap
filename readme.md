Для запуска приложения, необходимо запустить 
````shell
docker-compose up
````

phpmyadmin Доступен по порту 8080 

SQL 
````sql
CREATE DATABASE `swap`

CREATE TABLE `swaps` (
  `id` int NOT NULL AUTO_INCREMENT,
  `swap_array` varchar(8) NOT NULL,
  `swap_time` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `swaps_arrays` (
  `id` int NOT NULL AUTO_INCREMENT,
  `swaps_id` int NOT NULL,
  `swaps_array` varchar(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46234 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
````

SOAP

точка входа в SOAP /soap

wdsl - /soap/wdsl

client - /soap/client/?arr=массив