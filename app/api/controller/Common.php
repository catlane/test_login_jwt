<?php
/**
 * Created by PhpStorm.
 * User: 猫巷
 * Email:catlane@foxmail.com
 * Date: 2019/9/18
 * Time: 10:48 AM
 */

namespace app\api\controller;

use app\BaseController;
use app\Response;
use Firebase\JWT\JWT;
use think\App;
use think\facade\Request;

class Common extends BaseController {
    public function __construct ( App $app ) {
        $this->checkToken ();
        parent::__construct ( $app );
    }

    public function checkToken () {
        $header = Request::header ( 'authorization' );
        if ( $header == null ) {
            Response::error ( 1002 , 'Token不存在,拒绝访问' );
        } else {
            $checkJwtToken = $this->verifyJwt ( $header );
            if ( $checkJwtToken[ 'status' ] == 1001 ) {
                return true;
            }
        }
    }

    //校验jwt权限API
    protected function verifyJwt ( $jwt ) {
        $key = md5 ( 'nobita' );
        try {

            $jwtAuth  = json_encode ( JWt::decode ( $jwt , $key , array ( 'HS256' ) ) );
            $authInfo = json_decode ( $jwtAuth , true );
            $msg      = [];
            if ( ! empty( $authInfo[ 'user_id' ] ) ) {
                return true;
            } else {
                Response::error ( 1002 , 'Token验证不通过,用户不存在' );
            }
            return $msg;
        } catch ( \Firebase\JWT\SignatureInvalidException $e ) {
            Response::error ( 1002 , 'Token无效' );
        } catch ( \Firebase\JWT\ExpiredException $e ) {
            Response::error ( 1003 , 'Token过期' );

        } catch ( \Exception $e ) {
            return $e;
        }
    }
}