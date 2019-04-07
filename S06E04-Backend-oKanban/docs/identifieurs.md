# Identifieurs

## De Classe

### self

La classe dans laquelle le mot-clé self a été écrit.  
Ce ne peut signifier qu'une seule classe

Dans l'exemple, `self` signifie `ListModel`

```php
<?php

class ListModel extends CoreModel {

    // On créé une propriété statique => propriété liée à la classe
    // elle contient le nom de la table lié à la classe ListModel
    // Pour y accéder : "maClasse::$table;"
    protected static $table = 'list';

    /**
     * Méthode permettant de retourner les infos d'une liste pour l'id fourni en paramètre
     * 
     * @param int $id
     * @return ListModel
     */
    public static function find($id) {
        // SELECT * FROM list WHERE id = xxx
        $sql = '
            SELECT *
            FROM '.self::$table.'
            WHERE id = :id
        ';
        // On utilise prepare car la requête contient un donnée dynamique
        $pdoStatement = Database::getPDO()->prepare($sql);
        // On donne une valeur à cette donnée dynamique (token/jeton/placeholder)
        $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);
        // Je n'oublie pas d'exécuter la requête
        $pdoStatement->execute();

        // Je peux donc récupérer mes résultats (en l'occurence 1 seul max)
        $result = $pdoStatement->fetchObject(self::class);

        // Je retourne l'objet
        return $result;
    }
}
```

### static

La classe depuis laquelle on appele la méthode ou la propriété.  
Cet identifieur peut signifier plusieurs classes (mais une seule à la fois) selon le contexte. Cela dépend de la classe qui a appelé.

Dans l'exemple,  
Si `ListModel::findAll()` => static = `ListModel`  
Si `LabelModel::findAll()` => static = `LabelModel`  
Si `CardModel::findAll()` => static = `CardModel`  
Si `TotoModel::findAll()` => static = `TotoModel`  

```php
<?php

abstract class CoreModel {
    /**
     * Méthode permettant de récupérer tous les labels de la table label
     * 
     * @return LabelModel[]
     */
    public static function findAll() {
        $sql = '
            SELECT *
            FROM '.static::$table;
        $pdoStatement = Database::getPDO()->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, static::class);
        return $results;
    }
}
```

### parent

La classe "parente" à la classe actuelle (extends)

## D'objet

### $this

L'objet courant