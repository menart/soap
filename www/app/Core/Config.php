<?php

namespace Core;

class Config
{

	private static Config $thisConfig;
	private array $config;

	private function __construct()
	{
		$this->config = parse_ini_file('/www/config.ini', true, INI_SCANNER_TYPED);
	}

	public static function getConfig(): Config
	{
		if(!isset(self::$thisConfig))
			self::$thisConfig = new self();
		return self::$thisConfig;
	}

	public function getParam($section, $param)
	{
		return $this->config[$section][$param];
	}

	public function getSection($name)
	{
		return $this->config[$name];
	}
}