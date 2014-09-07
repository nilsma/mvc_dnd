<?php
/**
 * A class file to represent the Feats segment of the Character Sheet
 */
if(!class_exists('Feats')) {

    class Feats {

        protected $feats;

        public function __construct($entries) {
            $this->feats = $entries['feats_array'];
        }

        /**
         * @param mixed $feats
         */
        public function setFeats($feats)
        {
            $this->feats = $feats;
        }

        /**
         * @return mixed
         */
        public function getFeats()
        {
            return $this->feats;
        }

    }

}