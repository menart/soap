<?php

namespace Core;

use PDO;

class DB
{
	private static PDO $db;

	private function __construct()
	{
	}

	public static function getDB(): \PDO
	{
		if(!isset(self::$db)){
			$config = Config::getConfig();
			$user = $config->getParam('db', 'user');
			$password = $config->getParam('db', 'password');
			$DB = array_filter(
				$config->getSection('db'),
				fn($key) => !in_array($key, ['driver', 'user', 'password']), ARRAY_FILTER_USE_KEY);
			$string = $config->getParam('db', 'driver') . ':' .
				implode(';', array_map(fn(string $key, string $item): string => "$key=$item",
					array_keys($DB), array_values($DB)));
			self::$db = new PDO($string, $user, $password);
		}
		return self::$db;
	}
}