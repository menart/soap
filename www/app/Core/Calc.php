<?php

namespace Core;

use Entity\CalcSwap;
use Exceptions\ExceptionNotActualParam;
use Model\Swap;

class Calc
{

	//P = count! / (r1! * r2! * ... * rn!)
	public static function swap(array $arr): array
	{
		if (count($arr) === 1) return $arr;
		if (count($arr) === 2) {
			return $arr[0] !== $arr[1] ?
				[[$arr[0], $arr[1]], [$arr[1], $arr[0]]] :
				[[$arr[0], $arr[1]]];
		} else {
			$swapArray = [];
			foreach ($arr as $key => $item) {
				$tmpArr = $arr;
				unset($tmpArr[$key]);
				$newArr = array_values($tmpArr);
				foreach (self::swap($newArr) as $swapItem) {
					$newItems = array_merge([$item], $swapItem);
					if (!in_array($newItems, $swapArray, true))
						$swapArray[] = $newItems;
				}
			}
			return $swapArray;
		}
	}

	public static function getCalcSwap(string $arr): array
	{
		if (strlen($arr) > 8 || strlen($arr) === 0)
			throw new ExceptionNotActualParam($arr . '- Не верная длина массива');
		if (!ctype_alnum($arr))
			throw new ExceptionNotActualParam($arr. '- В массиве неверные символы');

		$calcSwap = Swap::find($arr);
		if ($calcSwap === null) {
			$timeStart = microtime(true);
			$calcSwapArray = self::swap(str_split($arr));
			$timeSwap = (microtime(true) - $timeStart) * 100000;
			$swapArray = [];
			foreach ($calcSwapArray as $item)
				$swapArray[] = implode($item);
			$calcSwap = new CalcSwap($timeSwap, $arr, $swapArray);
			Swap::save($calcSwap);
		}
		return $calcSwap->getArrayValue();
	}
}