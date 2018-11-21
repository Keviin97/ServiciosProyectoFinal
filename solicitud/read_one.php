<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/solicitud.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare solicitud object
$solicitud = new Solicitud($db);
 
// set ID property of record to read
$solicitud->id_Solicitud = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of solicitud to be edited
$solicitud->readOne();
 
if($solicitud->id_Solicitante!=null){
    // create array
    $solicitud_arr = array(
        "id_Solicitud" =>  $solicitud->id_Solicitud,
        "id_Solicitante" => $solicitud->id_Solicitante,
        "Nombre" => $solicitud->Nombre,
        "Email" => $solicitud->Email,
        "Telefono" => $solicitud->Telefono,
        "Fecha_Nacimiento" => $solicitud->Fecha_Nacimiento,
        "DPI" => $solicitud->DPI,
        "Experiencia" => $solicitud->Experiencia,
        "id_Trabajo" => $solicitud->id_Trabajo,
        "Trabajo" => $solicitud->Trabajo,
        "Requisitos" => $solicitud->Requisitos,
        "Conocimientos" => $solicitud->Conocimientos,
        "Beneficios" => $solicitud->Beneficios,
        "Fecha_Publicacion" => $solicitud->Fecha_Publicacion
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($solicitud_arr);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user solicitud does not exist
    echo json_encode(array("message" => "El solicitud no existe."));
}
?>