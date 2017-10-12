<?php

// use GuzzleHttp\Client;

// use GuzzleHttp\Exception\RequestException;

// use GuzzleHttp\Psr7\Request;

Class NhsApiClient
{
	private $client = null;

	const API_BASE = 'http://v1.syndication.nhschoices.nhs.uk';
	const API_KEY = 'OLQQWNWU';

	public function __construct()
	{
		// $this->client = new Client();
	}

	/**
	 * 
	 * Query API
	 *
	 */
	// private function _query($type, $postcode, $_url = null)
	// {
	// 	$postcode = str_replace(' ', '', $postcode);

	// 	// $url = self::API_BASE . '/organisations/' . $type . '/postcode/' . $postcode . '?apikey=' . self::API_KEY;
	// 	// $url = self::API_BASE . '/organisations/' . $type . '/postcode/' . $postcode . '.xml?apikey=' . self::API_KEY . '&range=5';

	// 	if( $_url ) {
	// 		$url = $_url;
	// 	} else {
	// 		// $url = self::API_BASE . '/organisations/' . $type . '/postcode/' . $postcode . '.xml?apikey=' . self::API_KEY . '&range=5';
	// 		$url = self::API_BASE . '/organisations/' . $type . '/postcode/' . $postcode . '.xml?apikey=' . self::API_KEY;
	// 	}

	// 	try {
	// 		// $options = [
	// 		// 	'exceptions'	=>	FALSE
	// 		// ];

	// 		// $response = $this->client->get($url, [
	// 		// 		'headers'	=>	null
	// 		// 	]);

	// 		// $result = $response->getBody()->getContents();

	// 		return simplexml_load_file($url);

	// 	} catch(RequestException $e) {

	// 		die('Exception: ' . $e);

	// 	}
	// }
	private function _query($type, $postcode, $_url = null)
	{
		$postcode = str_replace(' ', '', $postcode);

		if( $_url ) {
			$url = $_url;
		} else {
			$url = self::API_BASE . '/organisations/' . $type . '/postcode/' . $postcode . '.xml?apikey=' . self::API_KEY . '&range=50';
		}

		// $url = 'http://v1.syndication.nhschoices.nhs.uk/organisations/pharmacies/postcode/SE17AE.xml?apikey=OLQQWNWU&range=100';

		return simplexml_load_file($url);
	}

	public function get_gppractices($postcode)
	{
		$xml = $this->_query('gppractices', $postcode);

		$xml->registerXPathNamespace('s', 'http://syndication.nhschoices.nhs.uk/services');

		$entry = $xml->entry;
		$_ids = [];
		foreach ($entry as $value) {
			$_ids[str_replace(' ', '', $value->title)] = (string) $value->id[0];
		}

		$i = 0;
		$item = [];

		$org = $xml->xpath('//s:organisationSummary');

		foreach ($org as $o) {
			if( $i < 5 ):

				// name
				$aux = $o->xpath('s:name');
				$item[$i]['name'] = (string) $aux[0];

				// address
				$addr = $o->xpath('s:address');

				foreach ($addr as $a)
			        {
			            $aux = '';

			            $addressLine = $a->xpath('s:addressLine');
			            foreach ($addressLine as $a2)
			            {
			                $aux .= (string) $a2[0] . " - ";
			            }

			            $aux2 = $a->xpath('s:postcode');
			            if (is_array($aux2))
			            {
			                $aux .= (string) $aux2[0];
			            }

			            $item[$i]['address'] = $aux;
			        }

			        // distance_from_postcode_center
			        $dist = $o->xpath('s:Distance');
			        $item[$i]['distance_from_postcode_center'] = round((float) $dist[0], 2, PHP_ROUND_HALF_EVEN) . ' miles';


			        
			        $o_link = $_ids[str_replace(' ', '', $item[$i]['name'])] . '/overview.rss?apikey=' . self::API_KEY;
				$overview_ = $this->_query('', '', $o_link);

				$overview_->registerXPathNamespace('s', 'http://syndication.nhschoices.nhs.uk/services');
				$overview = $overview_->xpath('//s:parentOrganisation');

				$home = $this->_query('', '', $_ids[str_replace(' ', '', $item[$i]['name'])] . '.xml?apikey=' . self::API_KEY);

				$performance = $this->_query('', '', $_ids[str_replace(' ', '', $item[$i]['name'])] . '/performance.rss?apikey=' . self::API_KEY);
				$performance->registerXPathNamespace('s', 'http://syndication.nhschoices.nhs.uk/services');

				// nhs_choices_user_star_rating
				$item[$i]['nhs_choices_user_star_rating'] = round((string) $home->FiveStarRecommendationRating->Value[0], 0, PHP_ROUND_HALF_UP);

			        // number_of_registred_patients
			        $item[$i]['number_of_registred_patients'] = (string) $overview_->xpath('//s:value')[0];

			        // percentage_surgery_recommend
			        $item[$i]['percentage_surgery_recommend'] = (string) $performance->xpath('//s:npsMetricValue')[0];

			        // accepting_new_patients_yn
			        $item[$i]['accepting_new_patients_yn'] = (string) $overview_->xpath('//s:newPatients')[0]['accepting'];

			        $i++;
		        endif;
		}

		// var_dump($item);
		return $item;
	}

	public function get_dentists($postcode)
	{
		$xml = $this->_query('dentists', $postcode);

		$xml->registerXPathNamespace('s', 'http://syndication.nhschoices.nhs.uk/services');

		$entry = $xml->entry;
		$_ids = [];
		foreach ($entry as $value) {
			$_ids[str_replace(' ', '', $value->title)] = (string) $value->id[0];
		}

		$i = 0;
		$item = [];

		$org = $xml->xpath('//s:organisationSummary');

		foreach ($org as $o) {
			if( $i < 5 ):

				// name
				$aux = $o->xpath('s:name');
				$item[$i]['name'] = (string) $aux[0];

				// address
				$addr = $o->xpath('s:address');

				foreach ($addr as $a)
			        {
			            $aux = '';

			            $addressLine = $a->xpath('s:addressLine');
			            foreach ($addressLine as $a2)
			            {
			                $aux .= (string) $a2[0] . " - ";
			            }

			            $aux2 = $a->xpath('s:postcode');
			            if (is_array($aux2))
			            {
			                $aux .= (string) $aux2[0];
			            }

			            $item[$i]['address'] = $aux;
			        }

			        // distance_from_postcode_center
			        $dist = $o->xpath('s:Distance');
			        $item[$i]['distance_from_postcode_center'] = round((float) $dist[0], 2, PHP_ROUND_HALF_EVEN) . ' miles';

			        // var_dump($dist);


			        
			        $o_link = $_ids[str_replace(' ', '', $item[$i]['name'])] . '/overview.rss?apikey=' . self::API_KEY;
				$overview_ = $this->_query('', '', $o_link);

				$overview_->registerXPathNamespace('s', 'http://syndication.nhschoices.nhs.uk/services');

				$home = $this->_query('', '', $_ids[str_replace(' ', '', $item[$i]['name'])] . '.xml?apikey=' . self::API_KEY);

				// nhs_choices_user_star_rating
				$item[$i]['nhs_choices_user_star_rating'] = round((string) $home->FiveStarRecommendationRating->Value[0], 0, PHP_ROUND_HALF_UP);

			        // accepting_new_patients_yn
			        $item[$i]['accepting_new_patients_yn'] = (string) $overview_->xpath('//s:value')[0];

			        $i++;
		        endif;
		}

		// var_dump($item);
		return $item;
	}



}



