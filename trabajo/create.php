<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate trabajo object
include_once '../objects/trabajo.php';
 
$database = new Database();
$db = $database->getConnection();
 
$trabajo = new Trabajo($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
if(
    !empty($data->Nombre) &&
    !empty($data->Requisitos) &&
    !empty($data->Conocimientos) &&
    !empty($data->Beneficios) &&
    !empty($data->Fecha_Publicacion)
){
 
    // set trabajo property values
    $trabajo->Nombre = $data->Nombre;
    $trabajo->Requisitos = $data->Requisitos;
    $trabajo->Conocimientos = $data->Conocimientos;
    $trabajo->Beneficios = $data->Beneficios;
    $trabajo->Fecha_Publicacion = $data->Fecha_Publicacion;
 
    // create the trabajo
    if($trabajo->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "El trabajo fue creado."));
    }
 
    // if unable to create the trabajo, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "No se pudo crear el trabajo."));
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "No se pudo crear el trabajo. Los datos estan incompletos."));
}
?>