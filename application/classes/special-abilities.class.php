<?php
/**
 * A class file to represent the Character's special abilities segment
 */
if(!class_exists('Special_Abilities')) {

    class Special_Abilities {

        protected $special_abilities_array;

        public function __construct($entries) {
            $this->setSpecialAbilitiesArray($entries['special_abilities_array']);
        }

        /**
         * @param mixed $special_abilities
         */
        public function setSpecialAbilitiesArray(Array $special_abilities)
        {
            $this->special_abilities_array = $special_abilities;
        }

        /**
         * @return mixed
         */
        public function getSpecialAbilitiesArray()
        {
            return $this->special_abilities_array;
        }

    }

}