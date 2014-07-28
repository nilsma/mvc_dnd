<?php
/**
 * base controller class for the application's other controller classes
 */
if(!class_exists('Base_Controller')) {

    class Base_Controller {

        public $model;

        public function __construct(Base_Model $model) {
            $this->model = $model;
        }

    }

}