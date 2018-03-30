<?php

namespace app\models;

class User extends \yii\db\ActiveRecord
{
    private $Password;
    private $Login;

    public function rules()
    {
        return [
          [['login', 'password'], 'required'],
            [['login', 'password', 'name', 'surname', 'role'], 'string', 'max' => '50']
        ];
    }

    public function attributeLabels()
    {
        return [
          'id' => 'ID',
            'name' => 'Name',
            'surname' => 'Surname',
            'login' => 'Login',
            'password' => 'Password',
            'role' => 'Role'
        ];
    }

    public static function getTableName(){
        return 'Users';
    }

    public function findByUsername($username){
        return $this->Login == $username;
    }
    public function validatePassword($password){
        return $this->Password == $password;
    }
}
