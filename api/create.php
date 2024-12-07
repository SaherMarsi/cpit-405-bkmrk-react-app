<?php

if($_SERVER['REQUEST_METHOD']!== 'POST'){
    header('Allow: POST');
    http_response_code(405);
    echo json_encode(array('message'=> 'Method not allowed!'));
    return;
}

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204); // Preflight response to solve cors problem
    exit;
}

include_once '../db/Database.php';
include_once '../models/bkmrk.php';

$database = new Database();
$dbConnection = $database->connect();
$bkmrk = new bkmrk($dbConnection);
$data = json_decode(file_get_contents('php://input'), true);
if(!$data || !isset($data['urls']) || !isset($data['title'])){
    http_response_code(422);
    echo json_encode(
        array('message' => 'Error missing required parameter url in the JSON body')
    );
    return;
}

$bkmrk->setUrls($data['urls']);
$bkmrk->setTitle($data['title']);
if($bkmrk->create()){
    echo json_encode(
        array('message'=> 'A bookmark was created')
    );
}
else{
    echo json_encode(
        array('message'=>'Error: No bookmark was created')
    );
}