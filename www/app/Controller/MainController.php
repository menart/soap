<?php


namespace Controller;

use Core\Calc;
use Exceptions\ExceptionNotActualParam;
use View\IndexView;
use View\View;

class MainController implements Controller
{

	private function getView(string $nameView): string
	{
		return class_exists('View\\' . $nameView . "View") ? 'View\\' . $nameView . "View" : 'View\\DefaultView';
	}

	public function index($data = null): ?View
	{
		return new IndexView(['index' => 'index.html']);
	}

	/**
	 * @throws ExceptionNotActualParam
	 */
	public function calc($data = null): View
	{
		$typeView = ucfirst($_GET['type'] ?? $_POST['type'] ?? 'default');
		$view = $this->getView($typeView);
		$arr = array_filter(explode(',', ($_GET['arr'] ?? $_POST['arr'] ?? '')));
		if (empty($arr)) throw new ExceptionNotActualParam('Не передан массив!');
		$arr = is_array($arr) ? $arr : [$arr];
		$response = [];
		foreach ($arr as $item) $response[] = Calc::getCalcSwap($item);
		return new $view($response);
	}
}