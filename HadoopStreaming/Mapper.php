<?php
abstract class HadoopStreaming_Mapper
{
	abstract function map ( $key, $value );
	
	public function run (  )
	{
		while ( !feof(STDIN) ) {
			$line = trim(fgets(STDIN));
			$this->map(null, $line);
		}
	}
	
	public function emit ( $key, $value )
	{
		echo "${key}\t${value}".PHP_EOL;
	}
}
?>
