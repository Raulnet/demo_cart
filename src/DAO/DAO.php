<?php
namespace DAO;

/**
 * Created by PhpStorm.
 * User: raulnet
 * Date: 02/08/17
 * Time: 21:46
 */
abstract class DAO
{
    const DB_USER = 'root';
    const DB_PASSWORD = '';
    /**
     * @var \PDO
     */
    protected $db;

    /**
     * @var bool|int
     */
    protected $lastId = false;

    /**
     * @var string
     */
    protected $table = "";

    /**
     * AbstractController constructor.
     */
    public function __construct()
    {
        $this->db = new \PDO('mysql:host=localhost;dbname=demo_cart;charset=utf8', self::DB_USER, self::DB_PASSWORD);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id){
        return $this->query("SELECT * FROM ".$this->table." WHERE id = :id",
            [':id' => (int)$id])
            ->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * @param $params
     * @return array|bool
     */
    public function findBy($params){
        $query = "SELECT * FROM ".$this->table." WHERE ";
        $where = "";
        $arg = [];
        foreach ($params as $key => $param){
            $where .= $key.' = :'.$key.' AND ';
            $arg[':'.$key] = $param;
        }
        $query = substr($query.$where, 0, -4);
        return $this->query($query, $arg)
            ->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @param string    $req
     * @param array     $params
     * @return \PDOStatement
     */
    public function query($req, array $params = []){

        $query = $this->db->prepare($req);
        $query->execute($params);
        $this->lastId = $this->db->lastInsertId();

        return $query;
    }
}