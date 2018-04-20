<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;


class User extends \yii\db\ActiveRecord
{

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
            'id' => 'id',
            'name' => 'name',
            'surname' => 'surname',
            'login' => 'login',
            'password' => 'password',
            'role' => 'role'
        ];
    }

    public function getOperators()
    {
        return $this->hasMany(Operator::className(), ['userId' => 'id']);
    }


    public static function findIdentity($id)
    {
        return static::findOne($id);
    }


    public static function getTableName()
    {
        return 'Users';
    }

    public function findByUsername($username)
    {
        return $this->login == $username;
    }


    public function getId()
    {
        return $this->id;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }


    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }


    public function validatePassword($password)
    {
        return $this->password == $password;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = User::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'surname', $this->surname])
            ->andFilterWhere(['like', 'login', $this->login])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'role', $this->role]);

        return $dataProvider;
    }
}
