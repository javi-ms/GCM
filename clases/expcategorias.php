<?php
class ExpCategorias
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

    public function anadir_experto_categoria($idExperto,$categoria)
    {
        try {
            $query = $this->dbh->prepare('insert into expcategorias values(null,?,?)');
            $query->bindParam(1, $idExperto);
            $query->bindParam(2, $categoria);

            $query->execute();
            //$this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function borrar_experto_categoria($id)
    {
        try {
            $query = $this->dbh->prepare('delete from expcategorias where idExperto = ?');
            $query->bindParam(1, $id);
            $query->execute();
            //$this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

        public function get_experto_categorias($id)
    {
        try {
            $query = $this->dbh->prepare('select categoria from expcategorias where idExperto= ?');
            $query->bindParam(1, $id);
            $query->execute();
            $resultado=$query->fetchAll();
            return($resultado);
            $this->dbh = null;
        }catch (PDOException $e) {
            $e->getMessage();
        }
    }
}
