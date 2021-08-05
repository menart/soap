<?php


namespace Controller;


use View\View;

interface Controller
{
	public function index($data = null): ?View;
}