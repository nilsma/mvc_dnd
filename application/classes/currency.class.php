<?php
/**
 * A class file for the character-sheet representing a
 * Currency in the application
 */

if(!class_exists('Currency')) {

    class Currency {

        protected $label;
        protected $name;
        protected $amount;

        public function __construct($entries) {
            $this->label = $entries['label'];
            $this->name = $entries['name'];
            $this->amount = $entries['amount'];
        }

        /**
         * @param mixed $label
         */
        public function setLabel($label)
        {
            $this->label = $label;
        }

        /**
         * @return mixed
         */
        public function getLabel()
        {
            return $this->label;
        }

        /**
         * @param mixed $amount
         */
        public function setAmount($amount)
        {
            $this->amount = $amount;
        }

        /**
         * @return mixed
         */
        public function getAmount()
        {
            return $this->amount;
        }

        /**
         * @param mixed $name
         */
        public function setName($name)
        {
            $this->name = $name;
        }

        /**
         * @return mixed
         */
        public function getName()
        {
            return $this->name;
        }

    }

}