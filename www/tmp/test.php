<?php

$arr = [4, 4, 3, 3, 5];

echo array_product(range(1, count($arr))) /array_reduce(array_values(array_count_values($arr)),
	fn ($multi, $item) => $multi * array_product(range(1, $item)),1);