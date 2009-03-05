<?php
require_once(dirname(__FILE__).'/Reducer/Iterator.php');

abstract class HadoopStreaming_Reducer
{
	abstract function reduce ( $key, $values );
	
	public function run (  )
	{
		$iterator = new HadoopStreaming_Reducer_Iterator();

		while ( $iterator->has_next_key ) {
			$this->reduce($iterator->current_key, $iterator);
			$iterator->has_next_value = true;
		}
	}
	
	public function emit ( $key, $value )
	{
		echo "${key}\t${value}".PHP_EOL;
	}
}
?>
