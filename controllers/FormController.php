<?php

namespace app\controllers;

use app\models\FormModel;
use app\src\Form;

class FormController extends BaseController
{
    private FormModel $formModel;

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        $this->formModel = new FormModel();
    }

    /**
     * @return int
     */
    public function signUpForm(): int
    {
        return $this->renderView('form');
    }

    /**
     * @return int
     */
    public function entryList(): int
    {
        $formEntryCollection = $this->formModel->getCollection();
        return $this->renderView('entryList', ['formEntryCollection' => $formEntryCollection]);
    }

    /**
     * @return void
     */
    public function save(): void
    {
        if ($this->request->isPost()) {
            if (Form::validate('submit_form', $_POST)) {
                $this->formModel->insertEntry($_POST);
                echo true;
            } else {
                echo json_encode(Form::getErrors());
            }
        }
    }

    /**
     * @return void
     */
    public function delete(): void
    {
        $id = $_POST['id'];
        $this->formModel->deleteEntry($id);

        echo true;
    }
}
