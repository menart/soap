<?php

namespace View;

class IndexView implements View
{
	private $data;

	public function __construct(array $data)
	{
		$this->data = $data;
	}

	public function send(): void
	{
		$mime = $this->data['mime'] ?? 'text/html';
		$charset = $this->data['charset'] ?? 'utf8';
		header("Content-Type: $mime; charset=$charset");
		$response = file_get_contents(__DIR__ . '/' . $this->data['index']);
		if (!empty($this->data['replace'])) {
			foreach ($this->data['replace'] as $search => $replace) {
				$response = str_replace($search, $replace, $response);
			}
		}
		echo $response;
	}
}