<?php

if($_SERVER['REQUEST_METHOD']!== 'DELETE'){
    header('Allow: DELETE');
    http_response_code(405);
    echo json_encode(array('message'=> 'Method not allowed!'));
    return;
}

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');

include_once '../db/Database.php';
include_once '../models/bkmrk.php';

$database = new Database();
$dbConnection = $database->connect();
$bkmrk = new bkmrk($dbConnection);

$data = json_decode(file_get_contents('php://input'));

if(!$data || !$data->id){
    http_response_code(422);
    echo json_encode(
        array('message' => 'Error missing required parameter id in the JSON body')
    );
    return;
}
$bkmrk->setId($data->id);
if($bkmrk->delete()){
    echo json_encode(
        array('message'=>'A bookmark was deleted!')
    );
}
else{
    echo json_encode(
        array('message'=>'A bookmark was not deleted!!!')
    );
}
