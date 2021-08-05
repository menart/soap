<?php

namespace Core;

use Controller\Controller;
use Exceptions\ExceptionNotFoundURI;

class Request
{

	const PATH_CONTROLLER = 'Controller\\';
	const SUFFIX_CONTROLLER = 'Controller';
	const DEFAULT_CONTROLLER = self::PATH_CONTROLLER . 'Main' . self::SUFFIX_CONTROLLER;

	private $uri;
	private Controller $controller;
	private string $method;

	/**
	 * @return Controller
	 * @throws ExceptionNotFoundURI
	 */
	public function getController(): Controller
	{
		if (empty($this->controller)) {
			$ControllerClass = empty($this->uri[1]) ?
				self::DEFAULT_CONTROLLER : self::PATH_CONTROLLER . ucfirst($this->uri[1]) . self::SUFFIX_CONTROLLER;
			if (!class_exists($ControllerClass)) {
				throw new ExceptionNotFoundURI('Не найден контроллер: ' . $this->uri[1]);
			}
			$this->controller = new $ControllerClass();
		}
		return $this->controller;
	}

	/**
	 * @return String
	 * @throws ExceptionNotFoundURI
	 */
	public function getMethod(): string
	{
		if (empty($this->method)) {
			$this->method = empty($this->uri[2]) || (strpos($this->uri[2],'?') === 0) ? 'index' : $this->uri[2];
			if(!method_exists($this->controller, $this->method))
				throw new ExceptionNotFoundURI('Не найден метод: ' . $this->method);
		}
		return $this->method;
	}

	/**
	 * Request constructor.
	 */
	public function __construct()
	{
		$this->uri = explode('/', $_SERVER['REQUEST_URI']);
		$this->uri = array_diff($this->uri, ['']);
	}

}