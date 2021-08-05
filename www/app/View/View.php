<?php


namespace View;


interface View
{
	public function __construct(array $data);

	public function send(): void;
}