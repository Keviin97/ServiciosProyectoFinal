<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/solicitud.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare solicitud object
$solicitud = new Solicitud($db);
 
// get id_solicitud of solicitud to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set id_solicitud property of solicitud to be edited
$solicitud->id_Solicitud = $data->id_Solicitud;
 
// set solicitud property values
$solicitud->id_Solicitante = $data->id_Solicitante;
$solicitud->id_Trabajo = $data->id_Trabajo;
 
// update the solicitud
if($solicitud->update()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "La solicitud fue actualizada."));
}
 
// if unable to update the solicitud, tell the user
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "La solicitud no pudo ser actualizada."));
}
?>