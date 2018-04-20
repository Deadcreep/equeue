<?php
namespace app\controllers;

use Yii;
use app\models\Operator;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class OperatorController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }


    public function actionIndex()
    {
        if (Yii::$app->user->identity->role === 'admin') {
            $model = new Operator();
            $dataProvider = $model->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $model,
                'dataProvider' => $dataProvider,
            ]);
        } else {
            return "Permission denied";
        }

    }


    public function actionView($id)
    {
        if (Yii::$app->user->identity->role === 'admin') {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        } else {
            return "Permission denied";
        }
    }


    public function actionCreate()
    {
        if (Yii::$app->user->identity->role === 'admin') {
            $model = new Operator();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('create', [
                'model' => $model,
            ]);
        } else {
            return "Permission denied";
        }
    }


    public function actionUpdate($id)
    {
        if (Yii::$app->user->identity->role === 'admin') {
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('update', [
                'model' => $model,
            ]);
        } else {
            return "Permission denied";
        }
    }


    public function actionDelete($id)
    {
        if (Yii::$app->user->identity->role === 'admin') {
            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        } else {
            return "Permission denied";
        }
    }


    protected function findModel($id)
    {
        if (($model = Operator::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Requested page not found');
    }

    public function completeWork()
    {
        $this->endWorkTime = date("y-m-d h:i:s");
        $this->save();
    }

    public function actionOperator()
    {
        $dateTime = dateTime("y-m-d h:i:s");
        return $this->render('operator', ['dateTime' => $dateTime]);
    }
}