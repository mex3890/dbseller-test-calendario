<?php

namespace DAO;

use Application\Helpers\Response;
use DAO\Database\Exceptions\InvalidIdOnTryDelete;
use http\Exception\InvalidArgumentException;
use PDO;

class Database
{

    protected $db;
    protected $order = [];

    /**
     * Representa a instancia a classe,
     * logo nas classes filhas esse atributo
     * deve ser sobrescrito de maneira que
     * mantenha em memória a instância correta
     *
     * @var Class
     * @access protected
     */
    protected static $oInstance;

    public function __construct(
        $dbname = 'melhorias',
        $host = 'calendario_database',
        $port = '5432',
        $user = 'postgres',
        $pass = ''
    )
    {
        $dsn = "pgsql:dbname={$dbname};host={$host};port={$port}";

        $this->db = new \PDO($dsn, $user, $pass);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Retorna a instancia do repositório
     *
     * @return static
     */
    public static function getInstance()
    {
        if (empty(static::$oInstance)) {
            static::$oInstance = new static;
        }

        return static::$oInstance;
    }

    public function filtrarPorId($id, $fields = null)
    {
        $fields = $this->prepareFields($fields);

        $dbst = $this->db->prepare(" SELECT $fields FROM " . static::TABLE . " WHERE id = :id ");
        $dbst->bindValue(':id', $id, \PDO::PARAM_STR);

        return $this->execute($dbst);
    }

    public function filtrarPorDescricao($descricao, $fields = null)
    {
        $fields = $this->prepareFields($fields);

        $dbst = $this->db->prepare(" SELECT $fields FROM " . static::TABLE . " WHERE descricao = :descricao ");
        $dbst->bindValue(':descricao', $descricao, \PDO::PARAM_STR);

        return $this->execute($dbst);
    }

    protected function filtrar($where, $whereValues, $fields = null)
    {
        $fields = $this->prepareFields($fields);

        $order = null;
        if (!empty($this->order)) {

            $ords = [];
            foreach ($this->order as $ord => $dir) {

                $ords[] = "{$ord} {$dir}";
            }

            $order = ' ORDER BY ' . implode(',', $ords);
        }

        $dbst = $this->db->prepare(" SELECT {$fields} FROM " . static::TABLE . " WHERE {$where} {$order} ");

        if (is_array($whereValues) && !empty($whereValues)) {

            foreach ($whereValues as $param => $value) {

                if (strpos($value, ',') === false) {
                    $typeParam = is_int($value) ? \PDO::PARAM_INT : \PDO::PARAM_STR;
                    $dbst->bindValue(':' . $param, $value, $typeParam);
                }
            }
        }

        return $this->execute($dbst);
    }

    public function getAll($limit = null)
    {
        if (!empty($limit)) {
            $limit = ' LIMIT ' . (int)$limit;
        }

        $order = null;
        if (!empty($this->order)) {

            $ords = [];
            foreach ($this->order as $ord => $dir) {

                $ords[] = "{$ord} {$dir}";
            }

            $order = ' ORDER BY ' . implode(',', $ords);
        }

        $fields = $this->prepareFields();

        return $this->execute($this->db->prepare(" SELECT $fields FROM " . static::TABLE . " {$order} {$limit} "));
    }

    public function order($column, $direction = 'ASC')
    {
        if (!empty($column) && !empty($direction)) {
            $this->order[$column] = $direction;
        }

        return $this;
    }

    protected function execute($dbst)
    {
        $results = $dbst->execute();

        if ($results === false) {
            throw new \Exception("Não foi possível executar a consulta\n" . implode("\n", $dbst->errorInfo()));
        }

        if ($dbst->rowCount() == 0) {
            return null;
        }

        if ($dbst->rowCount() == 1) {
            return $dbst->fetchObject();
        }

        $res = [];
        while ($row = $dbst->fetch(\PDO::FETCH_ASSOC, \PDO::FETCH_ORI_NEXT)) {
            $res[] = (object)$row;
        }

        return $res;
    }

    protected function prepareFields($fields = null)
    {
        if (empty($fields)) {
            $fields = '*';
        } else {

            if (is_array($fields)) {
                $fields = implode(', ', $fields);
            }
        }

        return $fields;
    }

    public function __destruct()
    {
    }

    /**
     * @param $id
     * @return bool
     * @throws InvalidIdOnTryDelete
     */
    public function deleteById($id)
    {
        if (!is_int($id) && !is_string($id)) {
            throw new InvalidIdOnTryDelete;
        }

        if ($pdoInstance = $this->db->prepare('DELETE FROM ' . static::TABLE . " WHERE id = ?")) {
            return $pdoInstance->execute([$id]);
        }

        return false;
    }

    /**
     * @param $id
     * @param $parameters
     * @return bool
     */
    public function updateById($id, $parameters)
    {
        if (!is_int($id) && !is_string($id)) {
            throw new InvalidIdOnTryDelete;
        }

        if (empty($parameters)) {
            throw new InvalidArgumentException('Parameters cannot be empty on update.');
        }

        $query = 'UPDATE ' . static::TABLE . ' SET ';

        foreach ($parameters as $key => $value) {
            $query .= "$key = ?,";
        }

        $query = substr($query, 0, -1);

        if ($pdoInstance = $this->db->prepare("$query WHERE " . static::TABLE . '.id = ?')) {
            return $pdoInstance->execute(array_merge(array_values($parameters), [$id]));
        }

        return false;
    }

    public function create(array $parameters = [])
    {
        $query = "INSERT INTO " . static::TABLE . '(' . implode(',', array_keys($parameters)) . ') VALUES (';

        $count = count($parameters);

        foreach (array_values($parameters) as $index => $value) {
            $query .= $index === $count - 1 ? '?)' : '?,';
        }

        if ($pdoInstance = $this->db->prepare($query)) {
            return $pdoInstance->execute(array_values($parameters)) ? $this->db->lastInsertId() : false;
        }

        return false;
    }
}
