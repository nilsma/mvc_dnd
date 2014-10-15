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

        /**
         * A method to get suggestions on special abilities to choose for the user based on the users input,
         * puts the suggestions in an associative array where the special ability's template_name is the key
         * and the special ability's common_name is the value.
         * The method also trims any leading whitespaces, transforms the input to lower characters, and sorts
         * the suggestions of special abilities alphabetically.
         * @param $input - the user's input
         * @return array - and associative array of special abilities
         */
        public function getSpecialAbilitiesSuggestions($input) {
            $suggestions_array = array();
            $input = ltrim(strtolower($input));

            if(strlen($input) > 0) {
                $suggestions_array = $this->model->getSpecialAbilityTemplates($input);

                asort($suggestions_array);

            }

            return $suggestions_array;
        }

        public function getFeatSuggestions($input) {
            $suggestions_array = array();
            $input = ltrim(strtolower($input));

            if(strlen($input) > 0) {
                $suggestions_array = $this->model->getFeatTemplates($input);

                asort($suggestions_array);

            }

            return $suggestions_array;
        }

    }

}