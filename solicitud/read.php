<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/solicitud.php';
 
// instantiate database and solicitud object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$solicitud = new Solicitud($db);
 
// query solicituds
$stmt = $solicitud->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // solicituds array
    $solicituds_arr=array();
    $solicituds_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $solicitud_item=array(
            "id_Solicitud" =>  $id_Solicitud,
            "id_Solicitante" => $id_Solicitante,
            "Nombre" => $Nombre,
            "Email" => $Email,
            "Telefono" => $Telefono,
            "Fecha_Nacimiento" => $Fecha_Nacimiento,
            "DPI" => $DPI,
            "Experiencia" => $Experiencia,
            "id_Trabajo" => $id_Trabajo,
            "Trabajo" => $Trabajo,
            "Requisitos" => $Requisitos,
            "Conocimientos" => $Conocimientos,
            "Beneficios" => $Beneficios,
            "Fecha_Publicacion" => $Fecha_Publicacion
        );
 
        array_push($solicituds_arr["records"], $solicitud_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show solicituds data in json format
    echo json_encode($solicituds_arr);
}
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "No se encontraron solicitudes.")
    );
}