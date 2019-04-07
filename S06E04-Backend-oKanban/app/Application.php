<?php

namespace oKanban;

use AltoRouter; 
use Dispatcher; 

class Application {
    /**
     * @var AltoRouter
     */
    private $router;

    public function __construct() {

        $this->router = new AltoRouter();

        $baseUrl = isset($_SERVER['BASE_URI']) ? trim($_SERVER['BASE_URI']) : '';
        $this->router->setBasePath($baseUrl);
        $this->mapRoutes();
    }

    public function mapRoutes() {
        $this->router->map('GET', '/', [
            'controller' => '\oKanban\Controllers\MainController',
            'method' => 'home'
        ], 'home');
        $this->router->map('GET', '/marianne', '\oKanban\Controllers\MainController::marianne', 'marianne');
        $this->router->map('GET', '/lists', '\oKanban\Controllers\ListController::lists', 'list_lists');
        $this->router->map('POST', '/lists/add', '\oKanban\Controllers\ListController::add', 'list_add');
        $this->router->map('GET', '/lists/[i:id]', '\oKanban\Controllers\ListController::list', 'list_list');
        $this->router->map('POST', '/lists/[i:id]/update', '\oKanban\Controllers\ListController::update', 'list_update');
        $this->router->map('POST', '/lists/[i:id]/delete', '\oKanban\Controllers\ListController::delete', 'list_delete');
        $this->router->map('POST', '/lists/[i:id]/cards/add', '\oKanban\Controllers\CardController::add', 'card_add');
        $this->router->map('GET', '/lists/[i:id]/cards', '\oKanban\Controllers\CardController::cards', 'card_cards');
        $this->router->map('POST', '/cards/[id]/update', '\oKanban\Controllers\CardController::update', 'card_update');
        $this->router->map('POST', '/cards/[id]/delete', '\oKanban\Controllers\CardController::delete', 'card_delete');
        $this->router->map('GET', '/labels', '\oKanban\Controllers\LabelController::labels', 'label_labels');
        $this->router->map('POST', '/labels/add', '\oKanban\Controllers\LabelController::add', 'label_add');
        $this->router->map('GET', '/labels/[i:id]', '\oKanban\Controllers\LabelController::label', 'label_label');
        $this->router->map('POST', '/labels/[id]/update', '\oKanban\Controllers\LabelController::update', 'label_update');
        $this->router->map('POST', '/labels/[id]/delete', '\oKanban\Controllers\LabelController::delete', 'label_delete');
        $this->router->map('GET', '/cards/[id]/labels', '\oKanban\Controllers\CardController::labels', 'card_labels');
        $this->router->map('POST', '/cards/[id]/labels/add', '\oKanban\Controllers\CardController::addLabel', 'card_addLabel');
        $this->router->map('POST', '/cards/[id]/labels/[id]/delete', '\oKanban\Controllers\CardController::deleteLabel', 'card_deleteLabel');

        $this->router->map('GET', '/test/', '\oKanban\Controllers\MainController::test', 'main_test');
    }

    public function run() {
        $match = $this->router->match();

        $dispatcher = new Dispatcher($match, '\oKanban\Controllers\ErrorController::err404');
        $dispatcher->dispatch();
    }
}