<?php
class Trabajo{
 
    // database connection and table Nombre
    private $conn;
    private $table_Nombre = "trabajo";
 
    // object properties
    public $id_Trabajo;
    public $Nombre;
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
        $query = "SELECT * FROM trabajo order by id_Trabajo;";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    function create(){
 
        // query to insert record
        $query = "INSERT INTO trabajo SET Nombre = :Nombre, Requisitos = :Requisitos, Conocimientos = :Conocimientos, Beneficios = :Beneficios, Fecha_Publicacion = :Fecha_Publicacion;";
     
        // prepare query
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->Nombre=htmlspecialchars(strip_tags($this->Nombre));
        $this->Requisitos=htmlspecialchars(strip_tags($this->Requisitos));
        $this->Conocimientos=htmlspecialchars(strip_tags($this->Conocimientos));
        $this->Beneficios=htmlspecialchars(strip_tags($this->Beneficios));
        $this->Fecha_Publicacion=htmlspecialchars(strip_tags($this->Fecha_Publicacion));
     
        // bind values
        $stmt->bindParam(":Nombre", $this->Nombre);
        $stmt->bindParam(":Requisitos", $this->Requisitos);
        $stmt->bindParam(":Conocimientos", $this->Conocimientos);
        $stmt->bindParam(":Beneficios", $this->Beneficios);
        $stmt->bindParam(":Fecha_Publicacion", $this->Fecha_Publicacion);
     
        // execute query
        if($stmt->execute()){
            return true;
        }
     
        return false;
         
    }
    // used when filling up the update product form
    function readOne(){
    
        // query to read single record
        $query = "SELECT * FROM trabajo where id_Trabajo = ? LIMIT 0,1;";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id of product to be updated
        $stmt->bindParam(1, $this->id_Trabajo);
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // set values to object properties
        $this->Nombre = $row['Nombre'];
        $this->Requisitos = $row['Requisitos'];
        $this->Conocimientos = $row['Conocimientos'];
        $this->Beneficios = $row['Beneficios'];
        $this->Fecha_Publicacion = $row['Fecha_Publicacion'];
    }
    // update the product
    function update(){
    
        // update query
        $query = "UPDATE trabajo SET Nombre = :Nombre, Requisitos = :Requisitos, Conocimientos = :Conocimientos, Beneficios = :Beneficios, Fecha_Publicacion = :Fecha_Publicacion 
        WHERE id_Trabajo = :id_Trabajo;";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->Nombre=htmlspecialchars(strip_tags($this->Nombre));
        $this->Requisitos=htmlspecialchars(strip_tags($this->Requisitos));
        $this->Conocimientos=htmlspecialchars(strip_tags($this->Conocimientos));
        $this->Beneficios=htmlspecialchars(strip_tags($this->Beneficios));
        $this->Fecha_Publicacion=htmlspecialchars(strip_tags($this->Fecha_Publicacion));
        $this->id_Trabajo=htmlspecialchars(strip_tags($this->id_Trabajo));
    
        // bind new values
        $stmt->bindParam(':Nombre', $this->Nombre);
        $stmt->bindParam(':Requisitos', $this->Requisitos);
        $stmt->bindParam(':Conocimientos', $this->Conocimientos);
        $stmt->bindParam(':Beneficios', $this->Beneficios);
        $stmt->bindParam(':Fecha_Publicacion', $this->Fecha_Publicacion);
        $stmt->bindParam(':id_Trabajo', $this->id_Trabajo);
    
        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }
    // delete the product
    function delete(){
    
        // delete query
        $query = "DELETE FROM trabajo WHERE id_Trabajo = ?";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_Trabajo=htmlspecialchars(strip_tags($this->id_Trabajo));
    
        // bind id of record to delete
        $stmt->bindParam(1, $this->id_Trabajo);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }
}