<?php

use app\src\Router;
use app\controllers\FormController;

Router::get('/', [FormController::class, 'index']);

Router::get('/form', [FormController::class, 'signUpForm']);
Router::post('/save_form_entry', [FormController::class, 'save']);

Router::get('/entry_list', [FormController::class, 'entryList']);
Router::post('/delete_form_entry', [FormController::class, 'delete']);