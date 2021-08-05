<?php


namespace View;


class JsonView implements View
{
	private array $data;

	public function __construct(array $data)
	{
		$this->data = $data;
	}

	public function send(): void
	{
		header('Content-Type: application/json');
		echo json_encode($this->data);
	}
}