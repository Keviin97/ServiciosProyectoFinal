<?php
class Solicitante{
 
    // database connection and table name
    private $conn;
    private $table_name = "solicitante";
 
    // object properties
    public $id_Solicitante;
    public $Nombre;
    public $Email;
    public $Telefono;
    public $Fecha_Nacimiento;
    public $DPI;
    public $Experiencia;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function read(){
 
        // select all query
        $query = "SELECT * FROM solicitante order by id_Solicitante;";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }
}