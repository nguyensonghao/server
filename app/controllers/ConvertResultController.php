<?php 
// Convert kết quả trả về sau khi tìm kiếm hợp với mẫu

class ConvertResultController {

	public function convertExample ($result) {
		$response = [];

		if (count($result['hits']['hits']) == 0) {
			$response['status'] = 304;
		} else {
			$response['status'] = 200;
			$response['data'] = [];
			for ($i = 0; $i < count($result['hits']['hits']); $i++) {
				$record = array(
					'_id'     => $result['hits']['hits'][$i]['_id'],
					'id'      => $result['hits']['hits'][$i]['_source']['id'],
					'content' => $result['hits']['hits'][$i]['_source']['eng']
				);
				array_push($response['data'], $record);
			}
		}

		return $response;
	}

	public function convertJaen ($result) {
		$response = [];

		if (count($result['hits']['hits']) == 0) {
			$response['status'] = 304;
		} else {
			$response['status'] = 200;
			$response['data'] = [];
			for ($i = 0; $i < count($result['hits']['hits']); $i++) {
				$record = array(
					'_id'      => $result['hits']['hits'][$i]['_id'],
					'id'       => $result['hits']['hits'][$i]['_source']['id'],
			    	'word'     => $result['hits']['hits'][$i]['_source']['_word'],
			    	'phonetic' => $result['hits']['hits'][$i]['_source']['phonetic'],
			    	'seq'      => $result['hits']['hits'][$i]['_source']['seq'],
				);

				$means = json_decode($result['hits']['hits'][$i]['_source']['mean']);
				$record['means'] = [];

				for ($j = 0; $j < count($means); $j++) {
					$mean = $means[$j]->mean;
					if (!isset($means[$j]->kind))
						$kind = null;
					else
						$kind = $means[$j]->kind;

					array_push($record['means'], array(
						'mean' => $mean,
						'kind' => $kind
					));

				}
				array_push($response['data'], $record);
			}
		}

		return $response;
	}

	public function convertKanji ($result, $numberRecord) {
		$response = [];

		if (count($result['hits']['hits']) == 0) {
			$response['status'] = 304;
		} else {
			$response['status'] = 200;
			$response['data'] = [];
			for ($i = 0; $i < count($result['hits']['hits']); $i++) {
				if ($i == (int)$numberRecord)
					break;

				$record = array(
					'_id'          => $result['hits']['hits'][$i]['_id'],
					'kanji'        => $result['hits']['hits'][$i]['_source']['kanji'],
			    	'mean'         => $result['hits']['hits'][$i]['_source']['mean'],
			    	'jlpt'         => $result['hits']['hits'][$i]['_source']['jlpt'],
			    	'seq'          => $result['hits']['hits'][$i]['_source']['seq'],
			    	'on'           => $result['hits']['hits'][$i]['_source']['on'],
			    	'kun'          => $result['hits']['hits'][$i]['_source']['kun'],
			    	'stroke_count' => $result['hits']['hits'][$i]['_source']['stroke'],
				);
				array_push($response['data'], $record);
			}
		}

		return $response;
	}

}

?>