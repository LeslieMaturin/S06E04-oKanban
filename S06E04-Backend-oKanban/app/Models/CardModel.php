<?php

namespace oKanban\Models;

use oKanban\Utils\Database;
use PDO; 

class CardModel extends CoreModel {

    /**
     * @var string
     */
    protected $title;
    /**
     * @var int
     */
    protected $list_order;
    /**
     * @var int
     */
    protected $list_id;


    protected static $table = 'card';

    /**
     * 
     * @return bool
     */
    protected function insert() {

        $sql = '
            INSERT INTO `card`(`title`, `list_order`, `list_id`)
            VALUES (:title, :list_order, :list_id)
        ';

        $pdoStatement = Database::getPDO()->prepare($sql);
        $pdoStatement->bindValue(':title', $this->title, PDO::PARAM_STR);
        $pdoStatement->bindValue(':list_order', $this->list_order, PDO::PARAM_INT);
        $pdoStatement->bindValue(':list_id', $this->list_id, PDO::PARAM_INT);

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
     * Méthode permettant de mettre à jour une liste dans la DB
     * 
     * @return bool
     */
    protected function update() {
        $sql = '
            UPDATE `card` 
            SET `title` = :title,
            `list_order` = :listOrder,
            `list_id` = :listId,
            `updated_at` = NOW()
            WHERE id = :id
        ';
        $pdoStatement = Database::getPDO()->prepare($sql);
        $pdoStatement->bindValue(':title', $this->title, PDO::PARAM_STR);
        $pdoStatement->bindValue(':listOrder', $this->list_order, PDO::PARAM_INT);
        $pdoStatement->bindValue(':listId', $this->list_id, PDO::PARAM_INT);
        $pdoStatement->bindValue(':id', $this->id, PDO::PARAM_INT);
        $pdoStatement->execute();

        $results = $pdoStatement->rowCount();

        return ($results > 0);
    }

    public static function getToto() {
        return 'toto';
    }

    public function jsonSerialize() {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'list_order' => $this->list_order,
            'list_id' => $this->list_id
        ];
    }

    /**
     * Get the value of title
     *
     * @return string
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @param string  $title
     */ 
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * Get the value of list_order
     *
     * @return int
     */ 
    public function getListOrder()
    {
        return $this->list_order;
    }

    /**
     * Set the value of list_order
     *
     * @param int  $list_order
     */ 
    public function setListOrder(int $list_order)
    {
        $this->list_order = $list_order;
    }

    /**
     * Get the value of list_id
     *
     * @return int
     */ 
    public function getListId()
    {
        return $this->list_id;
    }

    /**
     * Set the value of list_id
     *
     * @param int  $list_id
     */ 
    public function setListId(int $list_id)
    {
        $this->list_id = $list_id;
    }
}