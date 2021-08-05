<?php


namespace Core;


use View\View;

class Response
{
	public function send(View $view)
	{
		$view->send();
	}
}