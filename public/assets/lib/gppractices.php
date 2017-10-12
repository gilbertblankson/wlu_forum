<?php

// header('Access-Control-Allow-Origin: *');

require_once 'NhsApiClient.php';

$postcode = $_GET['postcode'];

$nhs_api = new NhsApiClient();

$gp = $nhs_api->get_gppractices($postcode);

echo json_encode($gp);
