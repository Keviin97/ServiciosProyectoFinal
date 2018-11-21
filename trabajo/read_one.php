<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/trabajo.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare trabajo object
$trabajo = new Trabajo($db);
 
// set ID property of record to read
$trabajo->id_Trabajo = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of trabajo to be edited
$trabajo->readOne();
 
if($trabajo->Nombre!=null){
    // create array
    $trabajo_arr = array(
        "id_Trabajo" =>  $trabajo->id_Trabajo,
        "Nombre" => $trabajo->Nombre,
        "Requisitos" => $trabajo->Requisitos,
        "Conocimientos" => $trabajo->Conocimientos,
        "Beneficios" => $trabajo->Beneficios,
        "Fecha_Publicacion" => $trabajo->Fecha_Publicacion
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($trabajo_arr);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user trabajo does not exist
    echo json_encode(array("message" => "El trabajo no existe."));
}
?>