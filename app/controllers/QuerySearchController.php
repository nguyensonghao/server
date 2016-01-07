<?php 

// Tim kiem full text search

require_once public_path() . '/vendor/autoload.php';

class QuerySearchController {
	public $client;
	public $convert;

	public function __construct() {
		$this->client = Elasticsearch\ClientBuilder::create()
	    ->setHosts(["localhost:9200"])
	    ->setRetries(0)
	    ->build();
	    $this->convert = new ConvertResultController();
	}

	public function actionSearchExample ($key) {
		$params = [
		    'index' => 'mazii',
		    'type'  => 'exam',
		    'body' => [
		        'query' => [
		            'bool' => [
		                'should' => [
		                    [ 'match' => [ 'eng' => $key ] ],
		                    [ 'match' => [ 'jap' => $key ] ]
		                ]
		            ]
		        ]
		    ]
		];

		$results = $this->client->search($params);
		return $this->convert->convertExample($results);
	}

	public function actionSearchJaen ($key) {
		$params = [
		    'index' => 'mazii',
		    'type'  => 'jaen',
		    'body' => [
		        'query' => [
		            'bool' => [
		                'should' => [
		                    [ 'match' => [ '_word'    => $key ] ],
		                    [ 'match' => [ 'phonetic' => $key ] ],
		                    [ 'match' => [ 'mean'     => $key ] ]
		                ]
		            ]
		        ]
		    ]
		];

		$results = $this->client->search($params);
		return $this->convert->convertJaen($results);
		// return $results;
	}

	public function actionSearchKanji ($key, $numberRecord) {
		$params = [
		    'index' => 'mazii',
		    'type'  => 'kanji',
		    'body' => [
		        'query' => [
		            'bool' => [
		                'should' => [
		                    [ 'match' => [ 'kanji' => $key ] ],
		                    [ 'match' => [ 'mean'  => $key ] ],
		                    [ 'match' => [ 'on'    => $key ] ],
		                    [ 'match' => [ 'kun'   => $key ] ]
		                ]
		            ]
		        ]
		    ]
		];

		$results = $this->client->search($params);
		return $this->convert->convertKanji($results, $numberRecord);
	}

}

?>