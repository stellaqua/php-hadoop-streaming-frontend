<?php
abstract class HadoopStreaming_Mapper
{
	private $is_tab_separated;

	public function __construct ( $is_tab_separated = false )
	{
		$this->is_tab_separated = $is_tab_separated;
	}
	
	abstract function map ( $key, $value );
	
	public function run (  )
	{
		while ( !feof(STDIN) ) {
			$line = trim(fgets(STDIN));
			if ( $line !== '' ) {
				if ( $this->is_tab_separated === true
					 && strpos($line, "\t") !== false ) {
					list($key, $value) = split("\t+", $line, 2);
				} else {
					$key = '';
					$value = $line;
				}
				$this->map($key, $value);
			}
		}
	}
	
	public function emit ( $key, $value )
	{
		echo "${key}\t${value}".PHP_EOL;
	}
}
?>
