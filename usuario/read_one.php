<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/usuario.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare usuario object
$usuario = new Usuario($db);
 
// set ID property of record to read
$usuario->Usuario = isset($_GET['user']) ? $_GET['user'] : die();
$usuario->Pass = isset($_GET['pass']) ? $_GET['pass'] : die();
 
// read the details of usuario to be edited
$usuario->readOne();
 
if($usuario->Usuario!=null){
    // create array
    $usuario_arr = array(
        "id_Usuario" =>  $usuario->id_Usuario,
        "Usuario" => $usuario->Usuario,
        "Pass" => $usuario->Pass
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($usuario_arr);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user usuario does not exist
    echo json_encode(array("message" => "El usuario no existe."));
}
?>