<?php
/**
 * A class file to represent the Saving Throws segment of the Character Sheet
 */
if(!class_exists('Saving_Throws')) {

    class Saving_Throws {

        protected $saving_throws;

        public function __construct($array) {
            $this->setSavingThrows($array);
        }

        /**
         * @param mixed $saving_throws
         */
        public function setSavingThrows(Array $saving_throws)
        {
            $this->saving_throws = $saving_throws;
        }

        /**
         * @return mixed
         */
        public function getSavingThrows()
        {
            return $this->saving_throws;
        }

    }

}