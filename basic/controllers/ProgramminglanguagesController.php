<?php

namespace app\controllers;

use app\components\getCurrentUserTrait;
use Yii;
use app\models\entities\ProgramminglanguagesEntities;
use app\models\search\ProgramminglanguagesSearch;
use app\components\web\SecuredController;
use app\controllers\UsersController;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\entities\Yiiusers;


/**
 * ProgramminglanguagesController implements the CRUD actions for ProgramminglanguagesEntities model.
 */
class ProgramminglanguagesController extends Controller
{
    use getCurrentUserTrait;

    static ?ProgramminglanguagesEntities $model = null;

    /**
     * {@inheritdoc}
     */
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

    /**
     * Lists all ProgramminglanguagesEntities models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProgramminglanguagesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProgramminglanguagesEntities model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        self::$model = $this->findModel($id);
        $this->setCurrentUser($id);

        if (self::$model->user_id !== Yii::$app->user->identity->id) {
            $this->layout = 'main2';
        }


        return $this->render('view', [
            'model' => self::$model,
        ]);
    }

    /**
     * Creates a new ProgramminglanguagesEntities model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProgramminglanguagesEntities();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->user_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ProgramminglanguagesEntities model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {

        self::$model = $this->findModel($id);
        $this->setCurrentUser($id);


        if (!Yii::$app->user->isGuest && self::$model->user_id == Yii::$app->user->identity->id) {
            $this->layout = 'main2';
        }

        if (self::$model->load(Yii::$app->request->post()) && self::$model->save()) {
            return $this->redirect(['view', 'id' => self::$model->user_id]);
        }

        return $this->render('update', [
            'model' => self::$model,
        ]);
    }

    /**
     * Deletes an existing ProgramminglanguagesEntities model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProgramminglanguagesEntities model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProgramminglanguagesEntities the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProgramminglanguagesEntities::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

}
