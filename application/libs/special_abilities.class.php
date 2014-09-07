<?php
/**
 * A class file to represent the Character's special abilities segment
 */
if(!class_exists('Special_Abilities')) {

    class Special_Abilities {

        protected $special_abilities;

        public function __construct($entries) {
            $this->special_abilities = $entries['special_abilities_array'];
        }

        /**
         * @param mixed $special_abilities
         */
        public function setSpecialAbilities($special_abilities)
        {
            $this->special_abilities = $special_abilities;
        }

        /**
         * @return mixed
         */
        public function getSpecialAbilities()
        {
            return $this->special_abilities;
        }

    }

}