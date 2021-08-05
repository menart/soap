<?php


namespace Model;

use Core\DB;
use Entity\CalcSwap;
use Exception;

class Swap
{

	/**
	 * @throws Exception
	 */
	public static function save(CalcSwap $calcSwap)
	{
		$db = DB::getDB();
		$db->beginTransaction();
		try {
			$sql = 'insert into swaps (swap_time, swap_array) values (:time, :arr)';
			$query = $db->prepare($sql);
			$json_arr = $calcSwap->getArr();
			$time = $calcSwap->getTime();
			$query->bindParam('time', $time);
			$query->bindParam('arr', $json_arr);
			$query->execute();

			$id = $db->lastInsertId();
			$count = count($calcSwap->getSwaps());
			$qmarks = "($id,?)" . str_repeat(",($id,?)", $count - 1);
			$sql = 'insert into swaps_arrays (swaps_id, swaps_array) values ' . $qmarks;
			$vals = [];
			foreach($calcSwap->getSwaps() as $row)
				$vals = array_merge($vals, [$row]);
			$db->prepare($sql)->execute($vals);
			$db->commit();
		} catch (Exception $exp) {
			$db->rollBack();
			throw $exp;
		}
	}

	public static function find(string $str): ?CalcSwap
	{
		$db = DB::getDB();
		$sql = 'select id, swap_time from swaps where swap_array = :arr';
		$query = $db->prepare($sql);
		$query->bindParam('arr', $str);
		$query->execute();
		$query->setFetchMode(\PDO::FETCH_ASSOC);
		$row = $query->fetch();
		if (!$row) return null;
		$swapTime = $row['swap_time'];
		$sql = 'select swaps_array from swaps_arrays where swaps_id = :id';
		$queryArrays = $db->prepare($sql);
		$queryArrays->bindParam('id', $row['id'], \PDO::PARAM_INT);
		$queryArrays->execute();
		$queryArrays->setFetchMode(\PDO::FETCH_ASSOC);
		$swapsArray = [];
		while($row = $queryArrays->fetch())
			$swapsArray[] = $row['swaps_array'];
		return new CalcSwap($swapTime, $str, $swapsArray);
	}
}