<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/trabajo.php';
 
// instantiate database and trabajo object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$trabajo = new Trabajo($db);
 
// query trabajos
$stmt = $trabajo->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // trabajos array
    $trabajos_arr=array();
    $trabajos_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $trabajo_item=array(
            "id_Trabajo" => $id_Trabajo,
            "Nombre" => $Nombre,
            "Requisitos" => $Requisitos,
            "Conocimientos" => $Conocimientos,
            "Beneficios" => $Beneficios,
            "Fecha_Publicacion" => $Fecha_Publicacion
        );
 
        array_push($trabajos_arr["records"], $trabajo_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show trabajos data in json format
    echo json_encode($trabajos_arr);
}
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "No se encontraron trabajos.")
    );
}