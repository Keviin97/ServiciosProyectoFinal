<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/solicitante.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare solicitante object
$solicitante = new Solicitante($db);
 
// get id_Solicitante of solicitante to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set id_Solicitante property of solicitante to be edited
$solicitante->id_Solicitante = $data->id_Solicitante;
 
// set solicitante property values
$solicitante->Nombre = $data->Nombre;
$solicitante->Email = $data->Email;
$solicitante->Telefono = $data->Telefono;
$solicitante->Fecha_Nacimiento = $data->Fecha_Nacimiento;
$solicitante->DPI = $data->DPI;
$solicitante->Experiencia = $data->Experiencia;
 
// update the solicitante
if($solicitante->update()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "El solicitante fue actualizado."));
}
 
// if unable to update the solicitante, tell the user
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "El solicitante no pudo ser actualizado."));
}
?>