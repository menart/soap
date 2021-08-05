<?php

namespace Entity;

class CalcSwap
{
	private int $time;
	private string $arr;
	private CalcArraySwap $swaps;

	/**
	 * @param int $time
	 * @param array $arr
	 * @param array $swaps
	 */
	public function __construct(int $time, string $arr, array $swaps, ?int $id = null)
	{
		$this->time = $time;
		$this->arr = $arr;
		$this->swaps = new CalcArraySwap($swaps);
	}


	/**
	 * @return string
	 */
	public function getArr(): string
	{
		return $this->arr;
	}

	/**
	 * @return int
	 */
	public function getTime(): int
	{
		return $this->time;
	}

	/**
	 * @return array
	 */
	public function getSwaps(): array
	{
		return $this->swaps->getArraySwaps();
	}

	public function getArrayValue(): array
	{
		return [
			'time' => $this->getTime(),
			'array' => $this->getArr(),
			'swaps' => $this->getSwaps(),
			'count' => count($this->getSwaps())
		];
	}
}