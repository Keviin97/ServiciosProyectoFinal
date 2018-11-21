<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate solicitante object
include_once '../objects/solicitante.php';
 
$database = new Database();
$db = $database->getConnection();
 
$solicitante = new Solicitante($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
if(
    !empty($data->Nombre) &&
    !empty($data->Email) &&
    !empty($data->Telefono) &&
    !empty($data->Fecha_Nacimiento) &&
    !empty($data->DPI) &&
    !empty($data->Experiencia)
){
 
    // set solicitante property values
    $solicitante->Nombre = $data->Nombre;
    $solicitante->Email = $data->Email;
    $solicitante->Telefono = $data->Telefono;
    $solicitante->Fecha_Nacimiento = $data->Fecha_Nacimiento;
    $solicitante->DPI = $data->DPI;
    $solicitante->Experiencia = $data->Experiencia;
 
    // create the solicitante
    if($solicitante->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "El solicitante fue creado."));
    }
 
    // if unable to create the solicitante, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "No se pudo crear el solicitante."));
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "No se pudo crear el solicitante. Los datos estan incompletos."));
}
?>