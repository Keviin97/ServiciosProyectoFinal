<?php
class Solicitud{
 
    // database connection and table Nombre
    private $conn;
    private $table_Nombre = "trabajo";
 
    // object properties
    public $id_Solicitud;
    public $id_Solicitante;
    public $Nombre;
    public $Email;
    public $Telefono;
    public $Fecha_Nacimiento;
    public $DPI;
    public $Experiencia;
    public $id_Trabajo;
    public $Trabajo;
    public $Requisitos;
    public $Conocimientos;
    public $Beneficios;
    public $Fecha_Publicacion;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function read(){
 
        // select all query
        $query = "SELECT S.id_Solicitud,S.id_Solicitante, SL.Nombre, SL.Email, SL.Telefono, SL.Fecha_Nacimiento, SL.DPI, SL.Experiencia, S.id_Trabajo, T.Nombre as Trabajo, 
        T.Requisitos, T.Conocimientos, T.Beneficios, T.Fecha_Publicacion from solicitud S, solicitante SL, trabajo T 
        where S.id_Solicitante = SL.id_Solicitante and S.id_Trabajo = T.id_Trabajo;";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    function create(){
 
        // query to insert record
        $query = "INSERT INTO solicitud SET id_Solicitante = :id_Solicitante, id_Trabajo = :id_Trabajo;";
     
        // prepare query
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->id_Solicitante=htmlspecialchars(strip_tags($this->id_Solicitante));
        $this->id_Trabajo=htmlspecialchars(strip_tags($this->id_Trabajo));
     
        // bind values
        $stmt->bindParam(":id_Solicitante", $this->id_Solicitante);
        $stmt->bindParam(":id_Trabajo", $this->id_Trabajo);
     
        // execute query
        if($stmt->execute()){
            return true;
        }
     
        return false;
         
    }
    // used when filling up the update product form
    function readOne(){
    
        // query to read single record
        $query = "SELECT S.id_Solicitud,S.id_Solicitante, SL.Nombre, SL.Email, SL.Telefono, SL.Fecha_Nacimiento, SL.DPI, SL.Experiencia, S.id_Trabajo, T.Nombre as Trabajo, 
        T.Requisitos, T.Conocimientos, T.Beneficios, T.Fecha_Publicacion from solicitud S, solicitante SL, trabajo T 
        where S.id_Solicitante = SL.id_Solicitante and S.id_Trabajo = T.id_Trabajo and id_Solicitud = ? LIMIT 0,1;";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id of product to be updated
        $stmt->bindParam(1, $this->id_Solicitud);
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // set values to object properties
        $this->id_Solicitante = $row['id_Solicitante'];
        $this->Nombre = $row['Nombre'];
        $this->Email = $row['Email'];
        $this->Telefono = $row['Telefono'];
        $this->Fecha_Nacimiento = $row['Fecha_Nacimiento'];
        $this->DPI = $row['DPI'];
        $this->Experiencia = $row['Experiencia'];
        $this->id_Trabajo = $row['id_Trabajo'];
        $this->Trabajo = $row['Trabajo'];
        $this->Requisitos = $row['Requisitos'];
        $this->Conocimientos = $row['Conocimientos'];
        $this->Beneficios = $row['Beneficios'];
        $this->Fecha_Publicacion = $row['Fecha_Publicacion'];
    }
    // update the product
    function update(){
    
        // update query
        $query = "UPDATE solicitud SET id_Solicitante = :id_Solicitante, id_Trabajo = :id_Trabajo WHERE id_Solicitud = :id_Solicitud;";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_Solicitante=htmlspecialchars(strip_tags($this->Nomid_Solicitantebre));
        $this->id_Trabajo=htmlspecialchars(strip_tags($this->id_Trabajo));
        $this->id_Solicitud=htmlspecialchars(strip_tags($this->id_Solicitud));
    
        // bind new values
        $stmt->bindParam(':id_Solicitante', $this->id_Solicitante);
        $stmt->bindParam(':id_Trabajo', $this->id_Trabajo);
        $stmt->bindParam(':id_Solicitud', $this->id_Solicitud);
    
        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }
    // delete the product
    function delete(){
    
        // delete query
        $query = "DELETE FROM solicitud WHERE id_Solicitud = ?";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_Solicitud=htmlspecialchars(strip_tags($this->id_Solicitud));
    
        // bind id of record to delete
        $stmt->bindParam(1, $this->id_Solicitud);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }
}