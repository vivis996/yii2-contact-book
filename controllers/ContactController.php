<?php

namespace app\controllers;

use app\models\Contact;
use Exception;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\data\Pagination;
use yii\filters\VerbFilter;

class ContactController extends Controller
{
    public $enableCsrfValidation = false;

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
                    'save' => ['POST', 'PUT'],
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
    {
        $query = Contact::find();
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $pages->defaultPageSize = 4;

        $contacts = $query->offset($pages->offset)
            ->orderBy('status DESC, name, lastName')
            ->limit($pages->limit)
            ->all();
        return $this->render('index', [
            'contacts' => $contacts,
            'pages' => $pages,
        ]);
    }

    /**
     * Displays form new contact.
     *
     * @return string
     */
    public function actionNew()
    {
        return $this->render('contactForm');
    }

    /**
     * Displays form edit contact.
     *
     * @return string
     */
    public function actionView($id)
    {
        $contact = Contact::findOne([
            'id' => $id,
        ]);
        return $this->render('contactview', ['contact' => $contact,]);
    }

    /**
     * Displays form edit contact.
     *
     * @return string
     */
    public function actionEdit($id)
    {
        $contact = Contact::findOne([
            'id' => $id,
        ]);
        return $this->render('contactForm', ['contact' => $contact,]);
    }

    /**
     * Displays form edit contact.
     *
     * @return string
     */
    public function actionDelete($id)
    {
        $contact = Contact::findOne([
            'id' => $id,
        ]);
        $contact->status = false;
        $contact->save();
        return $this->redirect('/');
    }

    /**
     * Save contact.
     *
     * @return string
     */
    public function actionSave($id = 0)
    {
        if ($id == 0) {
            $contact = new Contact();
        } else {
            $contact = Contact::findOne([
                'id' => $id,
            ]);
        }
        $content = Yii::$app->request->post();
        $contact->setAttributes($content, false);
        $contact->save();

        return $this->redirect('/');
    }
}
