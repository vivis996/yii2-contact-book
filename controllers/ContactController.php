<?php

namespace app\controllers;

use app\models\Contact;
use app\models\EmailContact;
use app\models\PhoneContact;
use app\models\TypeInput;
use app\models\UploadForm;
use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

class ContactController extends Controller
{
    public $enableCsrfValidation = false;

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
        $pages->defaultPageSize = 10;

        $contacts = $query->offset($pages->offset)
            ->orderBy('name, lastName')
            ->limit($pages->limit)
            ->all();

        foreach ($contacts as $i => $contact) {
            $contact->email_List = count($contact->emails) == 0 ? new EmailContact() : $contact->emails[0];
            $contact->phone_List = count($contact->phones) == 0 ? new PhoneContact() : $contact->phones[0];
        }
        // return $contacts;

        return $this->render('index', [
            'contacts' => $contacts,
            'pages' => $pages,
        ]);
    }

    public function actionImport()
    {
        $model = new UploadForm();
        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            $model->csvFile = UploadedFile::getInstance($model, 'csvFile');
            $contacts = [];
            if ($model->csvFile) {
                $model->csvFile->saveAs('../csv/' . $model->csvFile->baseName . '.' . $model->csvFile->extension);
                $model->csvFile = '../csv/' . $model->csvFile->baseName . '.' . $model->csvFile->extension;
                $handle = fopen($model->csvFile, "r");
                $headers = null;
                $types = TypeInput::find()->orderBy('name')->all();

                while (($fileop = fgetcsv($handle, 1000, ",")) !== false) {
                    if (!$headers) {
                        $headers = $fileop;
                        continue;
                    }
                    $contentContact = [];
                    $phones = [];
                    $emails = [];
                    foreach ($headers as $i => $header) {
                        if (str_contains($header, 'phone')) {
                            $type = str_replace('phone', '', $header);
                            foreach ($types as $j => $t) {
                                if ($t->name == $type) {
                                    $type = $t;
                                    break;
                                }
                            }
                            if (!$type) {
                                $type = $types[0];
                            }
                            $phone = new PhoneContact();
                            $phone->phone = preg_replace('/[^0-9]/', '', $fileop[$i]);
                            $phone->type_id = $type->id;
                            $phones = array_merge($phones, [$phone]);
                        } else {
                            if (str_contains($header, 'email')) {
                                $type = str_replace('email', '', $header);
                                foreach ($types as $j => $t) {
                                    if ($t->name == $type) {
                                        $type = $t;
                                        break;
                                    }
                                }
                                if (!$type) {
                                    $type = $types[0];
                                }
                                $email = new EmailContact();
                                $email->email = $fileop[$i];
                                $email->type_id = $type->id;
                                $emails = array_merge($emails, [$email]);
                            } else {
                                $contentContact = array_merge($contentContact, [trim($header) => $fileop[$i]]);
                            }
                        }
                    }

                    $contact = new Contact();
                    $contact->load($contentContact, '');
                    if ($contact->validate() && $contact->save()) {
                        $contact->email_List = $emails;
                        $contact->phone_List = $phones;
                        $contacts = array_merge($contacts, [$contact]);
                    }
                }
            }

            foreach ($contacts as $i => $contact) {
                foreach ($contact->email_List as $j => $email) {
                    $email->contact_id = $contact->id;
                    if ($email->validate()) {
                        $email->save();
                    }
                }
                foreach ($contact->phone_List as $j => $phone) {
                    $phone->contact_id = $contact->id;
                    if ($phone->validate()) {
                        $phone->save();
                    }
                }
            }

            // return $contacts;
            return $this->redirect(['index']);
        }
        return $this->render('importView', ['model' => $model]);
    }

    /**
     * Displays form new contact.
     *
     * @return string
     */
    public function actionNew()
    {
        $contact = new Contact();
        if (Yii::$app->request->isPost) {
            $content = Yii::$app->request->post();
            $contact->load($content);
            if ($content['Contact']['id']) {
                $contact = Contact::findOne([
                    'id' => $content['Contact']['id'],
                ]);
                $contact->load($content);
            }
            if ($contact->validate()  && $contact->save()) {
                $contact->email_List = $contact->emails;
                $contact->phone_List = $contact->phones;
                if ($this->saveContactContent($content, $contact)) {
                    return $this->redirect(['view', 'id' => $contact->id]);
                }
            }
        } else {
            $contact->email_List = array(new EmailContact());
            $contact->phone_List = array(new PhoneContact());
        }

        $typeInputs = ArrayHelper::map(TypeInput::find()
            ->orderBy('name')
            ->all(), 'id', 'name');
        return $this->render('contactForm', [
            'contact' => $contact,
            'typeInputs' => $typeInputs,
        ]);
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
        if (!$contact) {
            return $this->redirect(['index']);
        }
        $contact->email_List = $contact->emails;
        $contact->phone_List = $contact->phones;

        return $this->render('contactview', ['contact' => $contact,]);
    }

    private function setExtraContentOfPost($values, $send, $idExternal, $objectFinal)
    {
        if ($send['id']) {
            $objectFinal->id = +$send['id'];
        }
        $objectFinal->load($send, '');
        $objectFinal->contact_id = $idExternal;
        return array_merge($values, [$objectFinal]);
    }

    private function setExtraValuesOfPostContent($originalValues, $newValues)
    {
        $tempValues = [];
        foreach ($originalValues as $i => $value) {
            $indexToReplace = null;
            foreach ($newValues as $j => $valueTemp) {
                if ($valueTemp->id == $value->id) {
                    $indexToReplace = $j;
                    $value->load($valueTemp->attributes, '');
                    break;
                }
            }
            if ($indexToReplace === null) {
                if ($value->delete()) {
                    continue;
                }
            }
            $tempValues = array_merge($tempValues, [$value]);
            array_splice($newValues, $indexToReplace, 1);
        }
        return array_merge($tempValues, $newValues);
    }

    private function saveContentList($values)
    {
        foreach ($values as $i => $value) {
            if (!($value->validate() && $value->save())) {
                return false;
            }
        }
        return true;
    }

    private function saveContactContent($content, $contact)
    {
        $phones = [];
        $emails = [];
        if (isset($content['PhoneContact'])) {
            foreach ($content['PhoneContact'] as $i => $phone) {
                $phones = $this->setExtraContentOfPost($phones, $phone, $contact->id, new PhoneContact());
            }
        }
        if (isset($content['EmailContact'])) {
            foreach ($content['EmailContact'] as $i => $email) {
                $emails = $this->setExtraContentOfPost($emails, $email, $contact->id, new EmailContact());
            }
        }
        $contact->phone_List = $this->setExtraValuesOfPostContent($contact->phone_List, $phones);
        $contact->email_List = $this->setExtraValuesOfPostContent($contact->email_List, $emails);

        return $this->saveContentList($contact->phone_List) && $this->saveContentList($contact->email_List);
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
        if (!$contact) {
            return $this->redirect(['index']);
        }

        if (Yii::$app->request->isPost) {
            $content = Yii::$app->request->post();
            $contact->load($content);
            if ($contact->validate()  && $contact->save()) {
                $contact->email_List = $contact->emails;
                $contact->phone_List = $contact->phones;
                if ($this->saveContactContent($content, $contact)) {
                    return $this->redirect(['view', 'id' => $contact->id]);
                }
            }
        } else {
            $contact->email_List = $contact->emails;
            $contact->phone_List = $contact->phones;
        }

        $typeInputs = ArrayHelper::map(TypeInput::find()
            ->orderBy('name')
            ->all(), 'id', 'name');

        return $this->render('contactForm', [
            'contact' => $contact,
            'typeInputs' => $typeInputs,
        ]);
    }

    public function actionEmail($i)
    {
        $this->layout = false;
        $email = new EmailContact();
        $typeInputs = ArrayHelper::map(TypeInput::find()
            ->orderBy('name')
            ->all(), 'id', 'name');

        return $this->render('extras/emailForm', [
            'i' => $i,
            'email' => $email,
            'typeInputs' => $typeInputs,
        ]);
    }

    public function actionPhone($i)
    {
        $this->layout = false;
        $phone = new PhoneContact();
        $typeInputs = ArrayHelper::map(TypeInput::find()
            ->orderBy('name')
            ->all(), 'id', 'name');

        return $this->render('extras/phoneForm', [
            'i' => $i,
            'phone' => $phone,
            'typeInputs' => $typeInputs,
        ]);
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
        $contact->delete();
        return $this->redirect('/');
    }
}
