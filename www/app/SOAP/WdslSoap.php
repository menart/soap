<?php

namespace SOAP;

class WdslSoap
{
	public \domDocument $xml;

	public function __construct()
	{
		$this->xml = new \domDocument("1.0", "utf-8"); // Создаём XML-документ версии 1.0 с кодировкой utf-8
	}

	public function getWdsl():string
	{
		return $this->xml->saveXML();
	}
}