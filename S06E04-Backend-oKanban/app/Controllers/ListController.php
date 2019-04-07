<?php

namespace oKanban\Controllers;

use oKanban\Models\ListModel;

class ListController extends CoreController {

    public function lists() {

        $lists = ListModel::findAll('page_order ASC');

        $this->showJson($lists);
    }
}