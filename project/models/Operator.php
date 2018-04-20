<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 20.04.18
 * Time: 0:08
 */

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Operators;


class Operator extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Operators';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userId', 'windowId'], 'required'],
            [['userId', 'windowId'], 'integer'],
            [['windowId'], 'exist', 'skipOnError' => true, 'targetClass' => Window::className(), 'targetAttribute' => ['windowId' => 'id']],
            [['idUser'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'userId' => 'userId',
            'windowId' => 'windowId',
            'beginWorkTime' => 'beginWorkTime',
            'endWorkTime' => 'endWorkTime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOperatorWindow()
    {
        return $this->hasOne(Window::className(), ['id' => 'windowId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }

    public function createOperator($windowId, $userId)
    {
        $operator = new Operator();
        $operator->windowId = $windowId;
        $operator->userId = $userId;
        $operator->beginWorkTime = date("y-m-d h:i:s");
        $this->save();
        return $operator;
    }

    public function completeWork()
    {
        $this->endWorkTime = date("y-m-d h:i:s");
        $this->save();
    }

    public function beginWork()
    {
        $this->beginWorkTime = date("y-m-d h:i:s");
        $this->save();
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return Model::scenarios();
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
        $query = Operator::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'userId' => $this->userId,
            'windowId' => $this->windowId,
            'beginWorkTime' => $this->beginWorkTime,
            'endWorkTime' => $this->endWorkTime,
        ]);

        return $dataProvider;
    }

}