<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object file
include_once '../config/database.php';
include_once '../objects/solicitante.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare solicitante object
$solicitante = new Solicitante($db);
 
// get solicitante id
$data = json_decode(file_get_contents("php://input"));
 
// set solicitante id to be deleted
$solicitante->id_Solicitante = $data->id_Solicitante;
 
// delete the solicitante
if($solicitante->delete()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "El solicitante fue eliminado."));
}
 
// if unable to delete the solicitante
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "El solicitante no pudo ser eliminado."));
}
?>