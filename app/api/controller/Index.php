<?php

namespace app\api\controller;


use app\Response;
use think\App;
use think\Request;

class Index extends Common {

    protected $request;

    public function __construct ( App $app , Request $request ) {
        $this->request = $request;
        parent::__construct ( $app );
    }

    public function index () {
        Response::success ( [] );
    }

}
