<?php

// header('Access-Control-Allow-Origin: *');

require_once 'NhsApiClient.php';

$postcode = $_GET['postcode'];

$nhs_api = new NhsApiClient();

$dentists = $nhs_api->get_dentists($postcode);

echo json_encode($dentists);

