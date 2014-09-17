<?php

if(!class_exists('Armor_Class')) {

    class Armor_Class {

        protected $ac_total;
        protected $ac_base;
        protected $ac_armor_bonus;
        protected $ac_shield_bonus;
        protected $ac_dex_mod;
        protected $ac_size_mod;
        protected $ac_natural_armor;
        
        public function __construct($entries) {
            $this->ac_total = $entries['ac_total'];
            $this->ac_base = $entries['ac_base'];
            $this->ac_armor_bonus = $entries['ac_armor_bonus'];
            $this->ac_shield_bonus = $entries['ac_shield_bonus'];
            $this->ac_dex_mod = $entries['ac_dex_mod'];
            $this->ac_size_mod = $entries['ac_size_mod'];
            $this->ac_natural_armor = $entries['ac_natural_armor'];
        }

        /**
         * @param mixed $armor_bonus
         */
        public function setAcArmorBonus($armor_bonus)
        {
            $this->ac_armor_bonus = $armor_bonus;
        }

        /**
         * @return mixed
         */
        public function getAcArmorBonus()
        {
            return $this->ac_armor_bonus;
        }

        /**
         * @param mixed $base
         */
        public function setAcBase($base)
        {
            $this->ac_base = $base;
        }

        /**
         * @return mixed
         */
        public function getAcBase()
        {
            return $this->ac_base;
        }

        /**
         * @param mixed $dex_mod
         */
        public function setAcDexMod($dex_mod)
        {
            $this->ac_dex_mod = $dex_mod;
        }

        /**
         * @return mixed
         */
        public function getAcDexMod()
        {
            return $this->ac_dex_mod;
        }

        /**
         * @param mixed $natural_armor
         */
        public function setAcNaturalArmor($natural_armor)
        {
            $this->ac_natural_armor = $natural_armor;
        }

        /**
         * @return mixed
         */
        public function getAcNaturalArmor()
        {
            return $this->ac_natural_armor;
        }

        /**
         * @param mixed $shield_bonus
         */
        public function setAcShieldBonus($shield_bonus)
        {
            $this->ac_shield_bonus = $shield_bonus;
        }

        /**
         * @return mixed
         */
        public function getAcShieldBonus()
        {
            return $this->ac_shield_bonus;
        }

        /**
         * @param mixed $size_mod
         */
        public function setAcSizeMod($size_mod)
        {
            $this->ac_size_mod = $size_mod;
        }

        /**
         * @return mixed
         */
        public function getAcSizeMod()
        {
            return $this->ac_size_mod;
        }

        /**
         * @param mixed $total
         */
        public function setAcTotal($total)
        {
            $this->ac_total = $total;
        }

        /**
         * @return mixed
         */
        public function getAcTotal()
        {
            return $this->ac_total;
        }

    }

}