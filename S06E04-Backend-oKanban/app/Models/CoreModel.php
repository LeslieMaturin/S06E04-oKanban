<?php

namespace oKanban\Models;


use oKanban\Utils\Database;
use PDO;

abstract class CoreModel implements \JsonSerializable {
    /**
     * @var int
     */
    protected $id;
    /**
     * @var string
     */
    protected $created_at;
    /**
     * @var string
     */
    protected $updated_at;

    /**
     * @return LabelModel[]
     */
    public static function findAll($orderBy='') { 
        $sql = '
            SELECT *
            FROM '.static::$table;
        if ($orderBy != '') {
            $sql .= ' ORDER BY '.$orderBy;
        }
 
        $pdoStatement = Database::getPDO()->query($sql);

        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, static::class);

        return $results;
    }
    
    /**
     * 
     * @param int $id
     * @return CoreModel
     */
    public static function find($id) {
        $sql = '
            SELECT *
            FROM '.static::$table.'
            WHERE id = :id
        ';

        $pdoStatement = Database::getPDO()->prepare($sql);

        $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);

        $pdoStatement->execute();

        $result = $pdoStatement->fetchObject(static::class);


        return $result;
    }
    
    /**
     * 
     * @return bool
     */
    public function delete() {

        $sql = '
            DELETE FROM '.static::$table.'
            WHERE id = :idToto
        ';

        $pdoStatement = Database::getPDO()->prepare($sql);

        $pdoStatement->bindValue(':idToto', $this->id, PDO::PARAM_INT);

        $pdoStatement->execute();

        $deletedRows = $pdoStatement->rowCount();


        return ($deletedRows > 0);
    }

    /**
     * 
     * @return bool
     */
    public function save() {

        if ($this->id > 0) {
            return $this->update();
        }
        else {
            return $this->insert();
        }
    }

    protected abstract function insert(); 
    protected abstract function update();

    /**
     * Get the value of id
     * 
     * @return int
     */ 
    public function getId() : int 
    {
        return $this->id;
    }

    /**
     * Get the value of created_at
     * 
     * @return string
     */ 
    public function getCreatedAt() : string
    {
        return $this->id;
    }

    /**
     * Get the value of updated_at
     * 
     * @return string
     */ 
    public function getUpdatedAt() : string
    {
        return $this->id;
    }
}