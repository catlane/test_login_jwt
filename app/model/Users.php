<?php
/**
 * Created by PhpStorm.
 * User: 猫巷
 * Email:catlane@foxmail.com
 * Date: 2019/9/18
 * Time: 10:26 AM
 */

namespace app\model;

use think\Model;

class Users extends Model {
    protected $name = 'users';
    protected $pk = 'id';
    protected $prefix = '';
}