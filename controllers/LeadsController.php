<?php

namespace app\controllers;

use app\models\Customers;
use app\models\Leads;
use app\models\LeadsSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LeadsController implements the CRUD actions for Leads model.
 */
class LeadsController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
//                'access' => [
//                    'class' => AccessControl::class,
//                    'rules' => [
//                        [
//                            'allow' => true,
//                            'actions' => ['get-parents-data'],
//                            'roles' => ['@'],
//                        ]
//                    ]
//                ]
            ]
        );
    }

    /**
     * Lists all Leads models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new LeadsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Leads model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Leads model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Leads();

        if ($this->request->isPost) {
            $model->created = time();
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Leads model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost) {
            $model->modified = time();

            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Leads model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Leads model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Leads the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Leads::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionConvertToCustomer($id)
    {
        $model = $this->findModel($id);

        if ($this->request->post()) {
            $customer = new Customers();
            $customer->first_name = $model->first_name;
            $customer->second_name = $model->second_name;
            $customer->phone = $model->phone;
            $customer->address = $model->address;
            $customer->email = $model->email;
            $customer->status = $model->status;
            $customer->parent_id = $model->id;
            $customer->description = $model->description;
            $customer->created = time();
            if ($model->load($this->request->post()) && $customer->save()) {
                return $this->redirect(['customers/view', 'id' => $customer->id]);
            }
        }

        return $this->render('conversion', [
            'model' => $model
        ]);
    }

    public function actionGetParentsData()
    {
        $id = yii::$app->request->post('id');
        $model = Leads::find()->where(['id' => $id])->asArray()->one();
        return json_encode($model);
    }
}
