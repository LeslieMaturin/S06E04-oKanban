<?php

namespace oKanban\Models;

use oKanban\Utils\Database;
use PDO;

class LabelModel extends CoreModel {

    /**
     * @var string
     */
    protected $name;

    protected static $table = 'label';

    /**
     * 
     * @return bool
     */
    protected function insert() {

        $sql = '
            INSERT INTO `label` (`name`)
            VALUES (:name)
        ';

        $pdoStatement = Database::getPDO()->prepare($sql);

        $pdoStatement->bindValue(':name', $this->name, PDO::PARAM_STR);

        $pdoStatement->execute();

        $addedRows = $pdoStatement->rowCount();

        if ($addedRows > 0) {

            $this->id = Database::getPDO()->lastInsertId();

            return true;
        }
        else {
            return false;
        }
    }

    /**
     * @return bool
     */
    protected function update() {
        $sql = '
            UPDATE `label` 
            SET `name` = :name,
            `updated_at` = NOW()
            WHERE id = :id
        ';
        $pdoStatement = Database::getPDO()->prepare($sql);
        $pdoStatement->bindValue(':name', $this->name, PDO::PARAM_STR);
        $pdoStatement->bindValue(':id', $this->id, PDO::PARAM_INT);
        $pdoStatement->execute();

        $results = $pdoStatement->rowCount();

        return ($results > 0);
    }

    public function jsonSerialize() {
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }

    /**
     * Get the value of name
     *
     * @return string
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param string $name
     */ 
    public function setName(string $name)
    {
        $this->name = $name;
    }
}