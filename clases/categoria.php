<?php
class Categoria
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

    public function get_categorias()
    {
        try {
            $query = $this->dbh->prepare('select * from categorias');
            $query->execute();

            $resultado=$query->fetchAll();
            
            return($resultado);
            $this->dbh = null;
        }catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function anadir_categoria($categoria)
    {
        try {
            $query = $this->dbh->prepare('insert into categorias values (?)');
            $query->bindParam(1, $categoria);
            $query->execute();
            
            $this->dbh = null;
        }catch (PDOException $e) {
            $e->getMessage();
        }
    }
}
