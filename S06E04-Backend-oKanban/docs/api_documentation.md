# Documentation de l'API

| Endpoint | Méthode HTTP | Donnée(s) | Description |
|--|--|--|--|
| `/lists` | GET | - | Récupération des données de toutes les listes |
| `/lists/add` | POST | listName | Ajout d'une liste |
| `/lists/[id]` | GET | - | Récupération des données de la liste dont l'id est fourni |
| `/lists/[id]/update` | POST | listName, pageOrder | Modification des données de la liste dont l'id est fourni |
| `/lists/[id]/delete` | POST | - | Suppression de la liste dont l'id est fourni |
| `/lists/[id]/cards/add` | POST | cardName | Ajout d'un post-it |
| `/lists/[id]/cards` | ? | ? | Récupération de tous les post-it de la liste dont l'id est fourni |
| `/cards/[id]/update` | ? | cardName, listId, listOrder | Modification des données du post-it dont l'id est fourni |
| `/cards/[id]/delete` | ? | ? | Suppression du post-it dont l'id est fourni |
| `/labels` | ? | ? | Récupération des données de tous les labels |
| `/labels/add` | ? | labelName | ? |
| `/labels/[id]` | ? | ? | ? |
| `/labels/[id]/update` | ? | labelName | ? |
| `/labels/[id]/delete` | ? | ? | ? |
| `/cards/[id]/labels` | ? | - | Récupération des labels affectés au post-it dont l'id est fourni |
| `/cards/[id]/labels/add` | ? | ? | Affectation d'un label au post-it dont l'id est fourni |
| `/cards/[id]/labels/[id]/delete` | ? | ? | Désaffectation du label dont l'id est fourni au post-it dont l'id est fourni |
