<?php
class HadoopStreaming_Reducer_Iterator
{
	public $current_key = '';
	public $current_value = '';
	public $has_next_key = true;
	public $has_next_value = true;

	public function __construct (  )
	{
		list($key, $value) = $this->get_stdin();
		$this->current_key = $key;
		$this->current_value = $value;
	}
	
	public function next (  )
	{
		list($key, $value) = $this->get_stdin();
		if ( $key === $this->current_key ) {
			$this->has_next_value = true;
		} else {
			$this->has_next_value = false;
		}
		$this->current_key = $key;
		$this->current_value = $value;
		return true;
	}
	
	private function get_stdin (  )
	{
		if ( feof(STDIN) === true ) {
			$this->has_next_key = false;
			$this->has_next_value = false;
			return array('', '');
		}

		do {
			$line = trim(fgets(STDIN));
		} while ( !feof(STDIN) && $line === '' );

		if ( $line === '' ) {
			$this->has_next_key = false;
			$this->has_next_value = false;
			return array('', '');
		}

		list($key, $value) = explode("\t", $line, 2);
		return array($key, $value);
	}
	
}

?>
