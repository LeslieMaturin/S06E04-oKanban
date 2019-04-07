<?php

namespace oKanban\Controllers;

class ErrorController extends CoreController {

    public function err404() {

        $this->show('404');
    }
}