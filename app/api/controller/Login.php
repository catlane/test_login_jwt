<?php

namespace app\api\controller;


use app\BaseController;
use app\model\Users;
use app\Response;
use Firebase\JWT\JWT;
use think\App;
use think\Request;

class Login extends BaseController {

    protected $request;

    public function __construct ( App $app , Request $request ) {
        $this->request = $request;
        parent::__construct ( $app );
    }

    public function index () {
        $data     = input ( 'post.' );
        $username = htmlspecialchars ( $data[ 'username' ] );
        $password = htmlspecialchars ( $data[ 'password' ] );
        $user     = Users::where ( 'username' , $username )->find ();
        if ( $user ) {
            if ( $username === $user[ 'username' ] && $password === $user[ 'password' ] ) {
                $user->login_status    = 1;
                $user->last_login_ip   = $this->getIp ();//没有用更麻烦的方法，只是简单的入库而已
                $user->last_login_time = date ( 'Y-m-d H:i:s' );
                $user->save ();

                Response::success ( [
                    'status' => 1001 ,
                    'msg'    => '登录成功' ,
                    'jwt'    => self::createJwt ( $user[ 'id' ] )
                ] );
            } else {
                return [
                    'status' => 1002 ,
                    'msg'    => '账号密码错误'
                ];
            }
        } else {
            Response::error ( 1002 , '用户名不存在' );
        }
    }

    public function createJwt ( $userId ) {
        $key    = md5 ( 'nobita' ); //jwt的签发密钥，验证token的时候需要用到
        $time   = time (); //签发时间
        $expire = $time + 14400; //过期时间
        $token  = array (
            "user_id" => $userId ,
            "iss"     => "https://lovyou.top" ,//签发组织
            "aud"     => "https://lovyou.top" , //签发作者
            "iat"     => $time ,
            "nbf"     => $time ,
            "exp"     => $expire
        );
        $jwt    = JWT::encode ( $token , $key );
        return $jwt;
    }


    protected function getIp () {
        if ( isset($_SERVER[ "HTTP_CLIENT_IP" ]) && strcasecmp ( $_SERVER[ "HTTP_CLIENT_IP" ] , "unknown" ) ) {
            $ip = $_SERVER[ "HTTP_CLIENT_IP" ];
        } else {
            if ( isset($_SERVER[ "HTTP_X_FORWARDED_FOR" ]) && strcasecmp ( $_SERVER[ "HTTP_X_FORWARDED_FOR" ] , "unknown" ) ) {
                $ip = $_SERVER[ "HTTP_X_FORWARDED_FOR" ];
            } else {
                if ( $_SERVER[ "REMOTE_ADDR" ] && strcasecmp ( $_SERVER[ "REMOTE_ADDR" ] , "unknown" ) ) {
                    $ip = $_SERVER[ "REMOTE_ADDR" ];
                } else {
                    if ( isset ( $_SERVER[ 'REMOTE_ADDR' ] ) && $_SERVER[ 'REMOTE_ADDR' ] && strcasecmp ( $_SERVER[ 'REMOTE_ADDR' ] ,
                            "unknown" )
                    ) {
                        $ip = $_SERVER[ 'REMOTE_ADDR' ];
                    } else {
                        $ip = "unknown";
                    }
                }
            }
        }
        return ( $ip );
    }

}
