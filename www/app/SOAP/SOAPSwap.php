<?php

namespace SOAP;

use Core\Calc;
use SOAP\Types\SwapsList;

class SOAPSwap
{
	public function swapArray($messagesData)
	{

		$calcSwap = [];
		foreach ($messagesData->inputArray as $inputArray)
			$calcSwap[] = Calc::getCalcSwap($inputArray);

		$swapResponse = new Types\SwapResponse();
		$swapResponse->swapsList = [];
		foreach ($calcSwap as $item){
			$swaps = new SwapsList();
			$swaps->count = $item['count'];
			$swaps->time = $item['time'];
			$swaps->array = $item['array'];
			$swaps->swaps = $item['swaps'] ?? [];
			$swapResponse->swapsList[] = $swaps;
		}

		return $swapResponse;
	}
}