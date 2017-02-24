<?php
class Pregunta
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

    public function get_pregunta_aleatoria()
    {
        try {
            $query = $this->dbh->prepare('SELECT MAX(id) FROM preguntas');
            $query->execute();

            $ultimoRegistro=$query->fetch();

            do{

                $aleatorio=rand(1,$ultimoRegistro['MAX(id)']);

                $query = $this->dbh->prepare('select * from preguntas where id='.$aleatorio);
                $query->execute();
                $array=$query->fetch(PDO::FETCH_ASSOC);
            }while(empty($array));

            return $array;
            $this->dbh = null;
        }catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function get_ultimas_preguntas($id)
    {
        try {
            $query = $this->dbh->prepare('select * from preguntas where idExperto='.$id.' order by id desc limit 5');
            $query->execute();

            $resultado=$query->fetchAll();
            return($resultado);
            $this->dbh = null;
        }catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function sel_pregunta_max()
    {
        try {
            $query = $this->dbh->prepare('select MAX(id) as id from preguntas');
            $query->execute();

            $resultado=$query->fetch();
            return($resultado);
            //$this->dbh = null;
        }catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function ins_pregunta($id,$pregunta,$objeto,$tipoObjeto,$categorias,$niveles,$idExp)
    {
       try {
            $query = $this->dbh->prepare('insert into preguntas (id,pregunta,objeto,tipoObjeto,categoria,nivel,idExperto) values (?,?,?,?,?,?,?)');
            $query->bindParam(1, $id);
            $query->bindParam(2, $pregunta);
            $query->bindParam(3, $objeto);
            $query->bindParam(4, $tipoObjeto);
            $query->bindParam(5, $categorias);
            $query->bindParam(6, $niveles);
            $query->bindParam(7, $idExp);
            $query->execute();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
}
