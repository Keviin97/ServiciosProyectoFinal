<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/solicitante.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare solicitante object
$solicitante = new Solicitante($db);
 
// set ID property of record to read
$solicitante->id_Solicitante = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of solicitante to be edited
$solicitante->readOne();
 
if($solicitante->Nombre!=null){
    // create array
    $solicitante_arr = array(
        "id_Solicitante" =>  $solicitante->id_Solicitante,
        "Nombre" => $solicitante->Nombre,
        "Email" => $solicitante->Email,
        "Telefono" => $solicitante->Telefono,
        "Fecha_Nacimiento" => $solicitante->Fecha_Nacimiento,
        "DPI" => $solicitante->DPI,
        "Experiencia" => $solicitante->Experiencia
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($solicitante_arr);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user solicitante does not exist
    echo json_encode(array("message" => "El solicitante no existe."));
}
?>