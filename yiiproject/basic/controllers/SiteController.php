<?php

namespace app\controllers;

//use app\components\web\LanguageTrait;
use app\components\web\SecuredController;
use app\exceptions\DBException;
use app\models\entities\ProgramminglanguagesEntities;
use app\models\forms\LanguagesForm;
use app\models\forms\RegistrationForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\forms\LoginForm;
use app\models\ContactForm;
use app\components\web\LanguageComponentsTrait;

class SiteController extends Controller
{
    use LanguageComponentsTrait;
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {   $this->layout = 'main';
//        var_dump(Yii::$app->urlManager->rules[5]->route);
//        Yii::$app->urlManager->rules[5]->route = '/users/view?id=' . Yii::$app->user->identity->id;
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $this->layout = 'login';

        $this->view->title = 'Login';

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * @return string|Response
     */
    public function actionRegistration(){

        $this->layout = 'registration';

        $this->getView()->title = 'Registration';

        $model = new RegistrationForm();

        if($model->load($this->request->post()) && $model->save()){

            $insertIdLanguages = new ProgramminglanguagesEntities();
            $insertIdLanguages->user_id = $model->id;
            if(!$insertIdLanguages->save()){
                throw new DBException('Error while inserting data into \"Table:Programming languages\"');
            }

            $role = Yii::$app->authManager->createRole('user');
            Yii::$app->authManager->assign($role, $model->id);


            return $this->redirect('login');
        }

        return $this->render('registration', ['model' => $model]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect('login');
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        if (!Yii::$app->user->isGuest) {
            $this->layout = 'main';
        }

        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        if (!Yii::$app->user->isGuest) {
            $this->layout = 'main';
        }

        return $this->render('about');
    }

    /**
     * @return Response
     */
    public function actionLanguage(){

        $model = new LanguagesForm();


        if(!$model->load($this->request->post()) || !$model->validate()){
            return $this->goBack();
        }


        $this->getLanguage()->set($model->language);
        return $this->goBack();

    }
}
