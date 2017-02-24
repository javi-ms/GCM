<?php
class niveles
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
    public function get_niveles()
    {
        try {
            $query = $this->dbh->prepare('select nivel from niveles');
            $query->execute();

            $array=$query->fetchAll();

            return $array;
            $this->dbh = null;
        }catch (PDOException $e) {
            $e->getMessage();
        }
    }

}
