<?php

namespace oKanban\Models;

use oKanban\Utils\Database;
use PDO;

class ListModel extends CoreModel {
    /**
     * @var string
     */
    protected $name;
    /**
     * @var int
     */
    protected $page_order;

    protected static $table = 'list';

    /**
     * 
     * @return bool
     */
    protected function insert() {
        $sql = '
            INSERT INTO `list` (`name`, `page_order`)
            VALUES (:name, :page_order)
        ';

        $pdoStatement = Database::getPDO()->prepare($sql);
        $pdoStatement->bindValue(':name', $this->name, PDO::PARAM_STR);
        $pdoStatement->bindValue(':page_order', $this->page_order, PDO::PARAM_INT);
        $pdoStatement->execute();

        $addedRows = $pdoStatement->rowCount();

        if ($addedRows > 0) {
            // Je complète l'objet courant par l'id gnéré par MySQL
            // Ici, on demande à PDO, de demander à MySQL de nous donner l'id qui vient d'être généré
            $this->id = Database::getPDO()->lastInsertId();

            return true;
        }
        else {
            return false;
        }
    }

    /**
     * Méthode permettant de mettre à jour une liste dans la DB
     * 
     * @return bool
     */
    protected function update() {
        // UPDATE list SET ... WHERE id = xxx
        $sql = '
            UPDATE `list` 
            SET `name` = :name,
            `page_order` = :page_order,
            `updated_at` = NOW()
            WHERE id = :id
        ';
        $pdoStatement = Database::getPDO()->prepare($sql);
        $pdoStatement->bindValue(':name', $this->name, PDO::PARAM_STR);
        $pdoStatement->bindValue(':page_order', $this->page_order, PDO::PARAM_INT);
        $pdoStatement->bindValue(':id', $this->id, PDO::PARAM_INT);
        $pdoStatement->execute();

        $results = $pdoStatement->rowCount();

        return ($results > 0);
    }

    public function jsonSerialize() {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'page_order' => $this->page_order,
            'toto' => 'tata'
        ];
    }

    /**
     * Get the value of name
     *
     * @return  string
     */ 
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param  string  $name
     */ 
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * Get the value of page_order
     *
     * @return  int
     */ 
    public function getPageOrder() : int
    {
        return $this->page_order;
    }

    /**
     * Set the value of page_order
     *
     * @param  int  $page_order
     */ 
    public function setPageOrder(int $page_order)
    {
        $this->page_order = $page_order;
    }
}