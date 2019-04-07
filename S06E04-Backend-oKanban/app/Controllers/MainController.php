<?php

namespace oKanban\Controllers;


use oKanban\Utils\Database; 
use oKanban\Models\ListModel; 
use oKanban\Models\CardModel; 
use oKanban\Models\LabelModel; 

class MainController extends CoreController {

    public function home() {

        $this->show('home');
    }

    public function marianne() {
        $data = [
            'toto' => 45,
            'temperature' => 15,
            'location' => 'Bar-Le-Duc'
        ];

        $this->showJson($data);
    }

    public function test() {

        echo '<h3>ListModel::findAll()</h3>';
        $lists = ListModel::findAll(); 
        dump($lists);

        $firstListModel = $lists[0];
        dump($firstListModel);

        echo '<h3>CardModel::findAll()</h3>';
        $cards = CardModel::findAll(); 
        dump($cards);


        $cardModelId3 = CardModel::find(3);
        dump($cardModelId3);


        echo CardModel::getToto();

        $newCard = new CardModel();
        echo '<h3>création</h3>';
        dump($newCard);
        $newCard->setTitle('carte ajoutée depuis MainController');
        $newCard->setListOrder(4);
        $newCard->setListId(1);
        echo '<h3>avant insert</h3>';
        dump($newCard);
        $newCard->save();
        echo '<h3>après insert</h3>';
        dump($newCard);


        $cardModelId4 = CardModel::find(4);
        echo '<h3>Récupération</h3>';
        dump($cardModelId4);

        $cardModelId4->setListOrder(99);
        echo '<h3>Modification</h3>';
        dump($cardModelId4);

        $cardModelId4->save();
        echo '<h3>Après update</h3>';
        dump($cardModelId4);


        echo '<h3>LabelModel::findAll()</h3>';
        $labels = LabelModel::findAll(); 
        dump($labels);

        $labelModelId2 = LabelModel::find(2);
        dump($labelModelId2);

        echo '<h3>Création d\'un label</h3>';
        $newLabel = new LabelModel();
        $newLabel->setName('label crée par MainController');
        dump($newLabel);
        $newLabel->save();
        dump($newLabel);

    }
}