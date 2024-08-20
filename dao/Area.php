<?php

namespace DAO;

use PDO;

class Area extends Database
{

    const TABLE = 'area';
    protected static $oInstance;

    public function comContagemMelhorias($ids = null, $descricoes = null)
    {
        $query = 'select DISTINCT area.id, area.descricao, count(melhorias.area) as "melhorias" from area 
                    left join melhorias on area.id = melhorias.area';

        if (!empty($ids)) {
            if (is_array($ids)) {
                $query .= ' WHERE area.id IN (' . str_repeat('?, ', count($ids) - 1) . '?' . ')';
            } else {
                $query .= ' WHERE area.id = ?';
                $ids = [$ids];
            }
        }

        if (!empty($descricoes)) {
            $operator = 'WHERE';

            if (!empty($ids)) {
                $operator = 'OR';
            }

            if (is_array($descricoes)) {
                $query .= " $operator area.descricao IN (" . str_repeat('?, ', count($descricoes) - 1) . '?' . ')';
            } else {
                $query .= " $operator area.descricao = ?";
                $descricoes = [$descricoes];
            }
        }

        $query .= ' group by area.id order by area.id';

        if ($pdoInstance = $this->db->prepare($query)) {
            $pdoInstance->setFetchMode(PDO::FETCH_OBJ);
            $pdoInstance->execute(array_merge(is_array($ids) ? $ids : [], is_array($descricoes) ? $descricoes : []));
        }

        return $pdoInstance->fetchAll();
    }
}
