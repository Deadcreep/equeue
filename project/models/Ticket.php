<?php

namespace app\models;
use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "tickets".
 *
 * @property int $id
 * @property string number
 * @property int windowId
 * @property string $creationDate
 * @property string $completionDate
 * @property string $receptionDate
 *
 * @property Window $ticketWindow
 */
class Ticket extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Tickets';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['number'], 'required'],
            [['windowId'], 'integer'],
            [['creationDate', 'completionDate', 'receptionDate'], 'safe'],
            [['number'], 'string', 'max' => 255],
            [['windowId'], 'exist', 'skipOnError' => true, 'targetClass' => Window::class, 'targetAttribute' => ['windowId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'number' => 'number',
            'windowId' => 'windowId',
            'creationDate' => 'creationDate',
            'completionDate' => 'completionDate',
            'receptionDate' => 'receptionDate',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketWindow()
    {
        return $this->hasOne(Window::className(), ['id' => 'idTicketWindow']);
    }


    public function newTicket(){
        $ticket= new Ticket();
        $ticket->number=random_int(0,100)+ random_int(1,100);
        $ticket->creationDate=date("y-m-d h:i:s");
        $this->save();
        return $ticket;
    }

    public function endTicket(){
        $this->receptionDate=date("y-m-d h:i:s");
        $this->save();
    }

    public function adoptionTicket($windowId){
        $this->completionDate=date("y-m-d h:i:s");
        $this->windowId=$windowId;
        $this->save();
    }

    public function waitingTickets(){
        return Ticket::find()->where(['windowId'=>null])->all();
    }

    public static function busyTickets(){
        return Ticket::find()->where(['completionDate'=>null])->all();

    }

    public function getTicketNumberWin(){
        if($this->windowId!==null){
            $num = Window::findOne($this->windowId);
            return Window::findOne($num->id)['number'];
        }
    }


    public static function allocationTickets(){

        while(Ticket::waitingTickets()){
            Ticket::waitingTickets()[1]->adoptionTicket(Window::findAll()[1]->id);
        }
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
        $query = Ticket::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'windowId' => $this->windowId,
            'creationDate' => $this->creationDate,
            'completionDate' => $this->completionDate,
            'receptionDate' => $this->receptionDate,
        ]);

        $query->andFilterWhere(['like', 'number', $this->number]);

        return $dataProvider;
    }

}