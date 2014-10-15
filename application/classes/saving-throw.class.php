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
        protected $ability_mod;
        protected $magic_mod;
        protected $misc_mod;
        protected $temp_mod;
        
        public function __construct($entries) {
            $this->setName($entries['name']);
            $this->setKeyAbility($entries['name']);
            $this->setTotal($entries['total']);
            $this->setBaseSave($entries['base_save']);
            $this->setAbilityMod($entries['ability_mod']);
            $this->setMagicMod($entries['magic_mod']);
            $this->setMiscMod($entries['misc_mod']);
            $this->setTempMod($entries['temp_mod']);
        }

        /**
         * @param mixed $ability_mod
         */
        public function setAbilityMod($ability_mod)
        {
            if(!empty($ability_mod) && $ability_mod >= 0) {
                $this->ability_mod = $ability_mod;
            } else {
                $this->ability_mod = 0;
            }

        }

        /**
         * @return mixed
         */
        public function getAbilityMod()
        {
            return $this->ability_mod;
        }

        /**
         * @param mixed $base_save
         */
        public function setBaseSave($base_save)
        {
            if(!empty($base_save) && $base_save >= 0) {
                $this->base_save = $base_save;
            } else {
                $this->base_save = 0;
            }

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
        public function setKeyAbility($name)
        {
            $name = strtolower($name);
            switch($name) {
                case "fortitude":
                    $this->key_ability = strtoupper('con');
                    break;

                case "reflex":
                    $this->key_ability = strtoupper('dex');
                    break;

                case "will":
                    $this->key_ability = strtoupper('wis');
                    break;
            }
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
        public function setMagicMod($magic_modifier)
        {
            if(!empty($magic_modifier) && $magic_modifier >= 0) {
                $this->magic_mod = $magic_modifier;
            } else {
                $this->magic_mod = 0;
            }

        }

        /**
         * @return mixed
         */
        public function getMagicMod()
        {
            return $this->magic_mod;
        }

        /**
         * @param mixed $misc_modifier
         */
        public function setMiscMod($misc_modifier)
        {
            if(!empty($misc_modifier) && $misc_modifier >= 0) {
                $this->misc_mod = $misc_modifier;
            } else {
                $this->misc_mod = 0;
            }

        }

        /**
         * @return mixed
         */
        public function getMiscMod()
        {
            return $this->misc_mod;
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
        public function setTempMod($temp_modifier)
        {
            if(!empty($temp_modifier) && $temp_modifier >= 0) {
                $this->temp_mod = $temp_modifier;
            } else {
                $this->temp_mod = 0;
            }

        }

        /**
         * @return mixed
         */
        public function getTempMod()
        {
            return $this->temp_mod;
        }

        /**
         * @param mixed $total
         */
        public function setTotal($total)
        {
            if(!empty($total) && $total >= 0) {
                $this->total = $total;
            } else {
                $this->total = $total;
            }

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