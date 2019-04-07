<?php

namespace oKanban\Controllers;

abstract class CoreController {

    public function notFound()
    {
    }

    protected function show($tplName, $viewVars = [])
    {
    
        extract($viewVars);

        require __DIR__.'/../views/header.tpl.php';
        require __DIR__.'/../views/'.$tplName.'.tpl.php';
        require __DIR__.'/../views/footer.tpl.php';
    }


    protected function showJson($data)
    {

        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Credentials: true');

        header('Content-Type: application/json');

        echo json_encode($data);
    }
}