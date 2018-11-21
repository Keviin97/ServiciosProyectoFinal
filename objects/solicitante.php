<?php
class Solicitante{
 
    // database connection and table Nombre
    private $conn;
    private $table_Nombre = "solicitante";
 
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

    function create(){
 
        // query to insert record
        $query = "INSERT INTO solicitante SET Nombre = :Nombre, Email = :Email, Telefono = :Telefono, Fecha_Nacimiento = :Fecha_Nacimiento, DPI = :DPI, Experiencia = :Experiencia;";
     
        // prepare query
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->Nombre=htmlspecialchars(strip_tags($this->Nombre));
        $this->Email=htmlspecialchars(strip_tags($this->Email));
        $this->Telefono=htmlspecialchars(strip_tags($this->Telefono));
        $this->Fecha_Nacimiento=htmlspecialchars(strip_tags($this->Fecha_Nacimiento));
        $this->DPI=htmlspecialchars(strip_tags($this->DPI));
        $this->Experiencia=htmlspecialchars(strip_tags($this->Experiencia));
     
        // bind values
        $stmt->bindParam(":Nombre", $this->Nombre);
        $stmt->bindParam(":Email", $this->Email);
        $stmt->bindParam(":Telefono", $this->Telefono);
        $stmt->bindParam(":Fecha_Nacimiento", $this->Fecha_Nacimiento);
        $stmt->bindParam(":DPI", $this->DPI);
        $stmt->bindParam(":Experiencia", $this->Experiencia);
     
        // execute query
        if($stmt->execute()){
            return true;
        }
     
        return false;
         
    }
    // used when filling up the update product form
    function readOne(){
    
        // query to read single record
        $query = "SELECT * FROM solicitante where id_Solicitante = ? LIMIT 0,1;";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id of product to be updated
        $stmt->bindParam(1, $this->id_Solicitante);
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // set values to object properties
        $this->Nombre = $row['Nombre'];
        $this->Email = $row['Email'];
        $this->Telefono = $row['Telefono'];
        $this->Fecha_Nacimiento = $row['Fecha_Nacimiento'];
        $this->DPI = $row['DPI'];
        $this->Experiencia = $row['Experiencia'];
    }
    // update the product
    function update(){
    
        // update query
        $query = "UPDATE solicitante SET Nombre = :Nombre, Email = :Email, Telefono = :Telefono, Fecha_Nacimiento = :Fecha_Nacimiento, DPI = :DPI, 
        Experiencia = :Experiencia WHERE id_Solicitante = :id_Solicitante;";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->Nombre=htmlspecialchars(strip_tags($this->Nombre));
        $this->Email=htmlspecialchars(strip_tags($this->Email));
        $this->Telefono=htmlspecialchars(strip_tags($this->Telefono));
        $this->Fecha_Nacimiento=htmlspecialchars(strip_tags($this->Fecha_Nacimiento));
        $this->DPI=htmlspecialchars(strip_tags($this->DPI));
        $this->Experiencia=htmlspecialchars(strip_tags($this->Experiencia));
        $this->id_Solicitante=htmlspecialchars(strip_tags($this->id_Solicitante));
    
        // bind new values
        $stmt->bindParam(':Nombre', $this->Nombre);
        $stmt->bindParam(':Email', $this->Email);
        $stmt->bindParam(':Telefono', $this->Telefono);
        $stmt->bindParam(':Fecha_Nacimiento', $this->Fecha_Nacimiento);
        $stmt->bindParam(':DPI', $this->DPI);
        $stmt->bindParam(':Experiencia', $this->Experiencia);
        $stmt->bindParam(':id_Solicitante', $this->id_Solicitante);
    
        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }
    // delete the product
    function delete(){
    
        // delete query
        $query = "DELETE FROM solicitante WHERE id_Solicitante = ?";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_Solicitante=htmlspecialchars(strip_tags($this->id_Solicitante));
    
        // bind id of record to delete
        $stmt->bindParam(1, $this->id_Solicitante);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }
}