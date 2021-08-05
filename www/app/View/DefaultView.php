<?php


namespace View;


class DefaultView implements View
{

	private array $data;
	/**
	 * DefaultView constructor.
	 */
	public function __construct(array $data)
	{
		$this->data = $data;
	}

	public function send() : void
	{
		echo implode(', ', $this->data);
	}
}