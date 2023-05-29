<?php
ini_set("display_errors", 1);

ini_set("display_startup_errors", 1);

error_reporting(E_ALL);

require_once("db.php");

class Config{
    private $id;
    private $nombre;
    private $descripcion;
    private $imagen;

    public function __construct($id=0, $nombre="",$descripcion="",$imagen="" )
    {
        $this->id=$id;
        $this->nombre=$nombre;
        $this->descripcion=$descripcion;
        $this->imagen=$imagen;
        $this->dbCnx = new PDO(DB_TYPE.":host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PWD,[PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
    }
    public function setId($id){
        $this->id=$id;
    }
    public function getId(){
        return $this->id;
    }
    public function setNombre($nombre){
        $this->nombre=$nombre;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function setDescripcion($descripcion){
        $this->descripcion=$descripcion;
    }
    public function getDescripcion(){
        return $this->descripcion;
    }
    public function setImagen($imagen){
        $this->imagen=$imagen;
    }
    public function geImagen(){
        return $this->imagen;
}

public function insertData(){
    try {
        $stm = $this-> dbCnx -> prepare("INSERT INTO categorias (nombre, descripcion , imagen ) VALUES (?,?,?)");
        $stm -> execute([$this->nombre , $this->descripcion , $this->imagen]); 
    } catch (Exception $e) {
        return $e->getMessage();
    }   
    
} 
public function obtainAll(){
    try {
        $stm= $this->dbCnx->prepare("SELECT * FROM categorias");
        $stm-> execute();
        return $stm -> fetchAll();
    } catch (Exception $e) {
        return $e->getMessage();
    }
}
public function delete(){
    try {
        $stm = $this->dbCnx->prepare("DELETE FROM categorias WHERE id= ?");
        $stm->execute([$this->id]);
        return $stm->fetchAll();
        echo "<script> alert('Los datos fueron guardados satisfactoriamente');document.location='facturas.php'</script>";
    } catch(Exception $e){
        return $e->getMessage();
    }
}
public function selectOne(){
    try {
        $stm = $this-> dbCnx->prepare("SELECT * FROM categorias WHERE id=?");
        $stm->execute([$this->id]);
        return $stm -> fetchAll();
    } catch(Exception $e){
        return $e->getMessage();
    }
}
public function update(){
    try{
        $stm = $this->dbCnx->prepare("UPDATE categorias SET nombre=?, descripcion=?, imagen=? WHERE id=?");
        $stm ->execute([$this->nombre, $this->descripcion, $this->imagen, $this->id]);
    }catch(Exception $e){
        return $e->getMessage();
    }
}

}

?>