<?php

use think\migration\Migrator;

class CreateTableUser extends Migrator {
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change () {
        // create the table
        $table = $this->table ( 'users' , array ( 'engine' => 'MyISAM' ) );
        $table->addColumn ( 'username' , 'string' , array ( 'limit' => 15 , 'default' => '' , 'comment' => '用户名，登陆使用' ) )
            ->addColumn ( 'password' , 'string' , array ( 'limit' => 32 , 'default' => '' , 'comment' => '用户密码' ) )
            ->addColumn ( 'login_status' , 'boolean' , array ( 'limit' => 1 , 'default' => 0 , 'comment' => '登陆状态' ) )
            ->addColumn ( 'last_login_ip' , 'string' , array ( 'limit' => 15 , 'default' => '' , 'comment' => '最后登录IP' ) )
            ->addColumn ( 'last_login_time' , 'datetime' , array ( 'default' => null , 'comment' => '最后登录时间' ) )
            ->addColumn ( 'is_delete' , 'boolean' , array ( 'limit' => 1 , 'default' => 0 , 'comment' => '删除状态，1已删除' ) )
            ->addIndex ( array ( 'username' ) , array ( 'unique' => true ) )
            ->create ();
    }
}
