<?php
if(!class_exists('Stats')) {

    class Stats {

        protected $hp;
        protected $wounds;
        protected $non_lethal;
        protected $armor_class;
        protected $touch_ac;
        protected $flat_footed;
        protected $initiative_mod;
        protected $spell_resistance;
        protected $speed;
        protected $damage_reduction;
        
        public function __construct($entries) {
            $this->hp = $entries['hp'];
            $this->wounds = $entries['wounds'];
            $this->non_lethal = $entries['non_lethal'];
            $this->armor_class = $entries['armor_class'];
            $this->touch_ac = $entries['touch_ac'];
            $this->flat_footed = $entries['flat_footed'];
            $this->initiative_mod = $entries['initiative_mod'];
            $this->spell_resistance = $entries['spell_resistance'];
            $this->speed = $entries['speed'];
            $this->damage_reduction = $entries['damage_reduction'];
        }

        /**
         * @param mixed $armor_class
         */
        public function setArmorClass($armor_class)
        {
            $this->armor_class = $armor_class;
        }

        /**
         * @return mixed
         */
        public function getArmorClass()
        {
            return $this->armor_class;
        }

        /**
         * @param mixed $damage_reduction
         */
        public function setDamageReduction($damage_reduction)
        {
            $this->damage_reduction = $damage_reduction;
        }

        /**
         * @return mixed
         */
        public function getDamageReduction()
        {
            return $this->damage_reduction;
        }

        /**
         * @param mixed $flat_footed
         */
        public function setFlatFooted($flat_footed)
        {
            $this->flat_footed = $flat_footed;
        }

        /**
         * @return mixed
         */
        public function getFlatFooted()
        {
            return $this->flat_footed;
        }

        /**
         * @param mixed $hp
         */
        public function setHp($hp)
        {
            $this->hp = $hp;
        }

        /**
         * @return mixed
         */
        public function getHp()
        {
            return $this->hp;
        }

        /**
         * @param mixed $initiative_mod
         */
        public function setInitiativeMod($initiative_mod)
        {
            $this->initiative_mod = $initiative_mod;
        }

        /**
         * @return mixed
         */
        public function getInitiativeMod()
        {
            return $this->initiative_mod;
        }

        /**
         * @param mixed $non_lethal
         */
        public function setNonLethal($non_lethal)
        {
            $this->non_lethal = $non_lethal;
        }

        /**
         * @return mixed
         */
        public function getNonLethal()
        {
            return $this->non_lethal;
        }

        /**
         * @param mixed $speed
         */
        public function setSpeed($speed)
        {
            $this->speed = $speed;
        }

        /**
         * @return mixed
         */
        public function getSpeed()
        {
            return $this->speed;
        }

        /**
         * @param mixed $spell_resistance
         */
        public function setSpellResistance($spell_resistance)
        {
            $this->spell_resistance = $spell_resistance;
        }

        /**
         * @return mixed
         */
        public function getSpellResistance()
        {
            return $this->spell_resistance;
        }

        /**
         * @param mixed $touch_ac
         */
        public function setTouchAc($touch_ac)
        {
            $this->touch_ac = $touch_ac;
        }

        /**
         * @return mixed
         */
        public function getTouchAc()
        {
            return $this->touch_ac;
        }

        /**
         * @param mixed $wounds
         */
        public function setWounds($wounds)
        {
            $this->wounds = $wounds;
        }

        /**
         * @return mixed
         */
        public function getWounds()
        {
            return $this->wounds;
        }

    }

}