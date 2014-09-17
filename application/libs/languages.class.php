<?php
/**
 * A class file to represent the Languages segment of the Character Sheet
 * in the application
 */

if(!class_exists('Languages')) {

    class Languages {

        protected $max_number_of_languages;
        protected $languages_array;

        public function __construct($entries) {
            $this->max_number_of_languages = $entries['max_no_of_languages'];
            $this->languages_array = $entries['languages'];
        }

        /**
         * @param mixed $languages
         */
        public function setLanguagesArray($languages)
        {
            $this->languages_array = $languages;
        }

        /**
         * @return mixed
         */
        public function getLanguagesArray()
        {
            return $this->languages_array;
        }

        /**
         * @param mixed $max_number_of_languages
         */
        public function setMaxNumberOfLanguages($max_number_of_languages)
        {
            $this->max_number_of_languages = $max_number_of_languages;
        }

        /**
         * @return mixed
         */
        public function getMaxNumberOfLanguages()
        {
            return $this->max_number_of_languages;
        }

    }

}