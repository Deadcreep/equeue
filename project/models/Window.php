<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 20.04.18
 * Time: 9:56
 */

namespace app\models;
use Yii;
use yii\data\ActiveDataProvider;

class Window  extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Windows';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['number'], 'required'],
            [['number'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'number' => 'number',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOperators()
    {
        return $this->hasMany(Operator::className(), ['windowId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTickets()
    {
        return $this->hasMany(Ticket::className(), ['windowId' => 'id']);
    }

    public function createWindow($numberWin){
        $window = new Window();
        $window->number=$numberWin;
        $this->save();
        return $window;
    }

    public function search($params)
    {
        $query = Window::find();
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
        $query->andFilterWhere(['like', 'number', $this->number]);
        return $dataProvider;
    }


}