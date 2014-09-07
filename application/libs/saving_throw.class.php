<?php
/**
 * A class file to represent a Saving Throw in the Saving Throws segment of the Character Sheet
 */
if(!class_exists('Saving_Throw')) {

    class Saving_Throw {

        protected $name;
        protected $key_ability;
        protected $total;
        protected $base_save;
        protected $ability_modifier;
        protected $magic_modifier;
        protected $misc_modifier;
        protected $temp_modifier;
        
        public function __construct($entries) {
            $this->name = $entries['name'];
            $this->key_ability = $entries['key_ability'];
            $this->total = $entries['total'];
            $this->base_save = $entries['base_save'];
            $this->ability_modifier = $entries['ability_modifier'];
            $this->magic_modifier = $entries['magic_modifier'];
            $this->misc_modifier = $entries['misc_modifier'];
            $this->temp_modifier = $entries['temp_modifier'];
        }

        /**
         * @param mixed $ability_modifier
         */
        public function setAbilityModifier($ability_modifier)
        {
            $this->ability_modifier = $ability_modifier;
        }

        /**
         * @return mixed
         */
        public function getAbilityModifier()
        {
            return $this->ability_modifier;
        }

        /**
         * @param mixed $base_save
         */
        public function setBaseSave($base_save)
        {
            $this->base_save = $base_save;
        }

        /**
         * @return mixed
         */
        public function getBaseSave()
        {
            return $this->base_save;
        }

        /**
         * @param mixed $key_ability
         */
        public function setKeyAbility($key_ability)
        {
            $this->key_ability = $key_ability;
        }

        /**
         * @return mixed
         */
        public function getKeyAbility()
        {
            return $this->key_ability;
        }

        /**
         * @param mixed $magic_modifier
         */
        public function setMagicModifier($magic_modifier)
        {
            $this->magic_modifier = $magic_modifier;
        }

        /**
         * @return mixed
         */
        public function getMagicModifier()
        {
            return $this->magic_modifier;
        }

        /**
         * @param mixed $misc_modifier
         */
        public function setMiscModifier($misc_modifier)
        {
            $this->misc_modifier = $misc_modifier;
        }

        /**
         * @return mixed
         */
        public function getMiscModifier()
        {
            return $this->misc_modifier;
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

        /**
         * @param mixed $temp_modifier
         */
        public function setTempModifier($temp_modifier)
        {
            $this->temp_modifier = $temp_modifier;
        }

        /**
         * @return mixed
         */
        public function getTempModifier()
        {
            return $this->temp_modifier;
        }

        /**
         * @param mixed $total
         */
        public function setTotal($total)
        {
            $this->total = $total;
        }

        /**
         * @return mixed
         */
        public function getTotal()
        {
            return $this->total;
        }

    }

}