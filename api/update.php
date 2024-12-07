<?php

if($_SERVER['REQUEST_METHOD']!== 'PUT'){
    header('Allow: PUT');
    http_response_code(405);
    echo json_encode(array('message'=> 'Method not allowed!'));
    return;
}

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');

include_once '../db/Database.php';
include_once '../models/bkmrk.php';

$database = new Database();
$dbConnection = $database->connect();
$bkmrk = new bkmrk($dbConnection);

$data = json_decode(file_get_contents('php://input'));

if(!$data || !$data->id || !$data->urls || !$data->title){
    http_response_code(422);
    echo json_encode(
        array('message' => 'Error missing required parameter url and title in the JSON body')
    );
    return;
}
$bkmrk->setId($data->id);
$bkmrk->setUrls($data->urls);
$bkmrk->setTitle($data->title);
if($bkmrk->update()){
    echo json_encode(
        array('message'=>'A bookmark was updated!')
    );
}
else{
    echo json_encode(
        array('message'=>'A bookmark was not updated!!!')
    );
}
