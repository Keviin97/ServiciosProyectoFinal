<?php
class Usuario{
 
    // database connection and table Nombre
    private $conn;
    private $table_Nombre = "usuario";
 
    // object properties
    public $id_Usuario;
    public $Usuario;
    public $Pass;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function read(){
 
        // select all query
        $query = "SELECT * FROM usuario;";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    function create(){
 
        // query to insert record
        $query = "INSERT INTO usuario SET Usuario = :Usuario, Pass = :Pass;";
     
        // prepare query
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->Usuario=htmlspecialchars(strip_tags($this->Usuario));
        $this->Pass=htmlspecialchars(strip_tags($this->Pass));
     
        // bind values
        $stmt->bindParam(":Usuario", $this->Usuario);
        $stmt->bindParam(":Pass", $this->Pass);
     
        // execute query
        if($stmt->execute()){
            return true;
        }
     
        return false;
         
    }
    // used when filling up the update product form
    function readOne(){
    
        // query to read single record
        $query = "SELECT * from usuario where id_Usuario = ? LIMIT 0,1;";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id of product to be updated
        $stmt->bindParam(1, $this->id_Usuario);
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // set values to object properties
        $this->Usuario = $row['Usuario'];
        $this->Pass = $row['Pass'];
    }
    // update the product
    function update(){
    
        // update query
        $query = "UPDATE usuario SET Usuario = :Usuario, Pass = :Pass WHERE id_Usuario = :id_Usuario;";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->Usuario=htmlspecialchars(strip_tags($this->Usuario));
        $this->Pass=htmlspecialchars(strip_tags($this->Pass));
        $this->id_Usuario=htmlspecialchars(strip_tags($this->id_Usuario));
    
        // bind new values
        $stmt->bindParam(':Usuario', $this->Usuario);
        $stmt->bindParam(':Pass', $this->Pass);
        $stmt->bindParam(':id_Usuario', $this->id_Usuario);
    
        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }
    // delete the product
    function delete(){
    
        // delete query
        $query = "DELETE FROM usuario WHERE id_Usuario = ?";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_Usuario=htmlspecialchars(strip_tags($this->id_Usuario));
    
        // bind id of record to delete
        $stmt->bindParam(1, $this->id_Usuario);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }
}