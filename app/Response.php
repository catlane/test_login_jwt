<?php
/**
 * Created by PhpStorm.
 * User: 猫巷
 * Email:catlane@foxmail.com
 * Date: 2019/9/18
 * Time: 10:50 AM
 */

namespace app;
class Response {
    static public function success ( $data ) : array {
        echo json_encode ( [
            'status' => 200 ,
            'msg'    => '' ,
            'data'   => $data
        ] );
        die;

    }

    static public function error ( $code , $msg ) {
        echo json_encode ( [
            'status' => $code ,
            'msg'    => $msg
        ] );
        die;

    }
}