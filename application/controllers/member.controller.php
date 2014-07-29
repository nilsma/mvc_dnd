<?php
/**
 * A controller class file for the member page
 */

if(!class_exists('Member_Controller')) {

    class Member_Controller extends Base_Controller {

        public function __construct(Member_Model $model) {
            $this->model = $model;
            parent::__construct($model);
        }

    }

}