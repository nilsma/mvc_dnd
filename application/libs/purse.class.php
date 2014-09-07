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
            $this->gold = $purse_entries['gold'];
            $this->silver = $purse_entries['silver'];
            $this->copper = $purse_entries['copper'];
        }

        /**
         * @param mixed $copper
         */
        public function setCopper($copper)
        {
            $this->copper = $copper;
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
            $this->gold = $gold;
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
            $this->silver = $silver;
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