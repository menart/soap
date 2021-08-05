<?php

namespace Entity;

class CalcArraySwap
{
	/**
	 * @var string[]
	 */
	private array $arraySwaps;

	/**
	 * @param $arraySwaps
	 */
	public function __construct($arraySwaps)
	{
		$this->arraySwaps = $arraySwaps;
	}

	/**
	 * @return string[]
	 */
	public function getArraySwaps(): array
	{
		return $this->arraySwaps;
	}
}