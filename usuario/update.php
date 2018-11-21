<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/usuario.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare usuario object
$usuario = new Usuario($db);
 
// get id_Usuario of usuario to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set id_Usuario property of usuario to be edited
$usuario->id_Usuario = $data->id_Usuario;
 
// set usuario property values
$usuario->Usuario = $data->Usuario;
$usuario->Pass = $data->Pass;
 
// update the usuario
if($usuario->update()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "El usuario fue actualizado."));
}
 
// if unable to update the usuario, tell the user
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "El usuario no pudo ser actualizado."));
}
?>