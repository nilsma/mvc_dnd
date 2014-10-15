<?php
/**
 * A class file to represent the Character Sheet's purse
 */

if(!class_exists('Purse')) {

    class Purse {

        protected $gold;
        protected $silver;
        protected $copper;

        public function __construct($purse_entries) {
            $this->setGold($purse_entries['gold']);
            $this->setSilver($purse_entries['silver']);
            $this->setCopper($purse_entries['copper']);
        }

        /**
         * @param mixed $copper
         */
        public function setCopper($copper)
        {
            if(!empty($copper) && $copper >= 0) {
                $this->copper = $copper;
            } else {
                $this->copper = 0;
            }

        }

        /**
         * @return mixed
         */
        public function getCopper()
        {
            return $this->copper;
        }

        /**
         * @param mixed $gold
         */
        public function setGold($gold)
        {
            if(!empty($gold) && $gold >= 0) {
                $this->gold = $gold;
            } else {
                $this->gold = 0;
            }

        }

        /**
         * @return mixed
         */
        public function getGold()
        {
            return $this->gold;
        }

        /**
         * @param mixed $silver
         */
        public function setSilver($silver)
        {
            if(!empty($silver) && $silver >= 0) {
                $this->silver = $silver;
            } else {
                $this->silver = 0;
            }

        }

        /**
         * @return mixed
         */
        public function getSilver()
        {
            return $this->silver;
        }

    }

}