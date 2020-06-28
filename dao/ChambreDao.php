<?php

class ChambreDao extends Manager {

    public function __construct(){
        $this->tableName="chambre";
        $this->className="Chambre";
    }

    public function add($obj){
        $sql = "INSERT INTO $this->tableName (num, type, numBat) VALUES (:num, :type, :numBat)";
        return $this->executeUpdate($sql, $obj);
    }

    public function update($obj){

    }

    public function showRooms($limit, $offset){
        $sql = "
            SELECT * 
            FROM $this->tableName
            LIMIT {$limit} 
            OFFSET {$offset}
        ";
        return $this->returnObject($sql);
    }

    public function showDispo(){
        $sql = "
            SELECT *
            FROM chambre c
            WHERE id NOT IN (SELECT idChambre
                             FROM etudiant
                             WHERE c.id = idChambre)
            UNION ALL
            SELECT *
            FROM chambre
            WHERE type = 'duo'
            AND id IN (SELECT idChambre
                         FROM etudiant
                         GROUP BY idChambre
                         HAVING COUNT(id) < 2)
        ";
        return $this->returnObject($sql);
    }

}