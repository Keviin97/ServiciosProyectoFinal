<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/trabajo.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare trabajo object
$trabajo = new Trabajo($db);
 
// get id_trabajo of trabajo to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set id_trabajo property of trabajo to be edited
$trabajo->id_Trabajo = $data->id_Trabajo;
 
// set trabajo property values
$trabajo->Nombre = $data->Nombre;
$trabajo->Requisitos = $data->Requisitos;
$trabajo->Conocimientos = $data->Conocimientos;
$trabajo->Beneficios = $data->Beneficios;
$trabajo->Fecha_Publicacion = $data->Fecha_Publicacion;
 
// update the trabajo
if($trabajo->update()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "El trabajo fue actualizado."));
}
 
// if unable to update the trabajo, tell the user
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "El trabajo no pudo ser actualizado."));
}
?>