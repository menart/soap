<?php

namespace Controller;

use Exceptions\ExceptionNotActualParam;
use SOAP\Types\SendSoapMessage;
use SOAP\WdslSoap;
use View\IndexView;
use View\View;
use SOAP\SOAPSwap;

class SoapController implements Controller
{

	private function getServerSoap():string
	{
		return $_SERVER['SERVER_ADDR'] .':' . $_SERVER['SERVER_PORT'];
	}

	public function wdsl()
	{
		$replace = ['this_server' => $this->getServerSoap()];
		return new IndexView([
			//'mime' => 'application/wsdl+xml',
			'replace' => $replace,
			'mime' => 'text/xml',
			'index' => '../SOAP/swap.wsdl'
		]);
		//TODO:Сделать автогенерацию wdsl
		/*echo (new WdslSoap())->getWdsl();
		return null;*/
	}

	public function index($data = null): ?View
	{
		ini_set("soap.wsdl_cache_enabled", "0"); // отключаем кеширование WSDL-файла для тестирования
		//Создаем новый SOAP-сервер
		$server = new \SoapServer("http://{$this->getServerSoap()}/soap/wdsl");
		$server->setClass("SOAP\SOAPSwap");
		$server->handle();
		return null;
	}

	public function client()
	{
		ini_set('soap.wsdl_cache_enabled',0);
		ini_set('soap.wsdl_cache_ttl',0);

		$arr = array_filter(explode(',', ($_GET['arr'] ?? $_POST['arr'] ?? '')));
		if (empty($arr)) throw new ExceptionNotActualParam('Не передан массив!');

		$req = new SendSoapMessage();

		$req->inputArray = is_array($arr) ? $arr : [$arr];

		$client = new \SoapClient("http://{$this->getServerSoap()}/soap/wdsl",
			array('soap_version' => SOAP_1_2));
		var_dump($client->swapArray($req));
	}
}

