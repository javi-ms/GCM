<?php
class Respuestas
{
    private static $instancia;
    private $dbh;

    private function __construct()
    {
    	try {
            $this->dbh = new PDO('mysql:host=localhost;dbname=sabiogc', 'root', '');
            $this->dbh->exec("SET CHARACTER SET utf8");
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
            die();
        }
    }

    public static function singleton()
    {
        if (!isset(self::$instancia)) {
            $miclase = __CLASS__;
            self::$instancia = new $miclase;
        }
        return self::$instancia;
    }

    public function get_respuestas($id)
    {
        try {
            $query = $this->dbh->prepare('select * from respuestas where idPregunta='.$id);
            $query->execute();

            $resultado=$query->fetchAll(PDO::FETCH_COLUMN, 1);
            
            return($resultado);
            $this->dbh = null;
        }catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function comprobar_respuesta($id,$respuesta){
         try {
            $query = $this->dbh->prepare('select valida from respuestas where idPregunta='.$id.' and respuesta="'.$respuesta.'"');
            $query->execute();

            $resultado=$query->fetch(PDO::FETCH_ASSOC);
            
            return($resultado);
            $this->dbh = null;
        }catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function ins_respuesta($id,$respuesta,$valida)
    {
     try {
        $query = $this->dbh->prepare('insert into respuestas (respuesta,idPregunta,valida) values (?,?,?)');
        $query->bindParam(1, $respuesta);
        $query->bindParam(2, $id);
        $query->bindParam(3, $valida);
        $query->execute();
        //$this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
}