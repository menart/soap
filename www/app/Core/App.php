<?php


namespace Core;


use View\DefaultView;

class App
{
	private Request $request;
	private Response $response;

	public function __construct()
	{
		$this->request = new Request();
		$this->response = new Response();
	}

	public function run()
	{
		$controller = $this->request->getController();
		$method = $this->request->getMethod();

		$view = $controller->$method();
		$this->response->send($view ?? new DefaultView([]));
	}

}