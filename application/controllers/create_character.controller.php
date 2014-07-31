<?php
/**
 * a controller class file for the application's create_character page
 */


if(!class_exists('Create_Character_Controller')) {

    class Create_Character_Controller extends Base_Controller {

        public function __construct(Create_Character_Model $model) {
            $this->model = $model;
            parent::__construct($model);
        }

        public function registerCharacter($array) {

        }

    }

}