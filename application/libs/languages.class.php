<?php
/**
 * A class file to represent the Languages segment of the Character Sheet
 * in the application
 */

if(!class_exists('Languages')) {

    class Languages {

        protected $max_number_of_languages;
        protected $languages;

        public function __construct($entries) {
            $this->max_number_of_languages = $entries['max_no_of_languages'];
            $this->languages = $entries['languages'];
        }

        /**
         * @param mixed $languages
         */
        public function setLanguages($languages)
        {
            $this->languages = $languages;
        }

        /**
         * @return mixed
         */
        public function getLanguages()
        {
            return $this->languages;
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