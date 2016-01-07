<?php 

class SearchController extends BaseController {
	protected $querySearch;

	public function __construct () {
		$this->querySearch = new QuerySearchController();
	}

	public function searchExample ($key) {	
		Log::info($this->getTimeToMicroseconds());
		$result = $this->querySearch->actionSearchExample($key);
		Log::info($this->getTimeToMicroseconds());
		return Response::json($result);
	}

	public function searchJaen ($key) {
		$result = $this->querySearch->actionSearchJaen($key);
		return Response::json($result);
	}

	public function searchKanji ($key, $numberRecord) {
		$result = $this->querySearch->actionSearchKanji($key, $numberRecord);
		return Response::json($result);
	}

	public function getTimeToMicroseconds() {
	    $t = microtime(true);
	    $micro = sprintf("%06d", ($t - floor($t)) * 1000000);
	    $d = new DateTime(date('Y-m-d H:i:s.' . $micro, $t));

	    return $d->format("Y-m-d H:i:s.u"); 
	}

	public function test () {
		$result = $this->querySearch->actionSearchKanji('something', 10);
		echo "<pre>";
		print_r($result);
		echo "</pre>";
	}
}

?>