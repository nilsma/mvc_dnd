<?php
if(!class_exists('Stats')) {

    class Stats {

        protected $hp;
        protected $wounds;
        protected $non_lethal;
        protected $initiative_mod;
        protected $spell_resistance;
        protected $speed;
        protected $damage_reduction;
        
        public function __construct($entries) {
            $this->setHp($entries['stats_hp']);
            $this->setWounds($entries['stats_wounds']);
            $this->setNonLethal($entries['stats_non_lethal']);
            $this->setInitiativeMod($entries['stats_initiative_mod']);
            $this->setSpellResistance($entries['stats_spell_resistance']);
            $this->setSpeed($entries['stats_speed']);
            $this->setDamageReduction($entries['stats_damage_reduction']);
        }

        /**
         * @param mixed $damage_reduction
         */
        public function setDamageReduction($damage_reduction)
        {
            if(!empty($damage_reduction) && $damage_reduction >= 0) {
                $this->damage_reduction = $damage_reduction;
            } else {
                $this->damage_reduction = 0;
            }

        }

        /**
         * @return mixed
         */
        public function getDamageReduction()
        {
            return $this->damage_reduction;
        }

        /**
         * @param mixed $hp
         */
        public function setHp($hp)
        {
            if(!empty($hp) && $hp >= -10) {
                $this->hp = $hp;
            } else {
                $this->hp = 1;
            }

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
            if(!empty($initiative_mod) && $initiative_mod >= 0) {
                $this->initiative_mod = $initiative_mod;
            } else {
                $this->initiative_mod = 0;
            }

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
            if(!empty($non_lethal) && $non_lethal >= 0) {
                $this->non_lethal = $non_lethal;
            } else {
                $this->non_lethal = 0;
            }

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
            if(!empty($speed) && $speed >= 0) {
                $this->speed = $speed;
            } else {
                $this->speed = 0;
            }

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
            if(!empty($spell_resistance) && $spell_resistance >= 0) {
                $this->spell_resistance = $spell_resistance;
            } else {
                $this->spell_resistance = 0;
            }

        }

        /**
         * @return mixed
         */
        public function getSpellResistance()
        {
            return $this->spell_resistance;
        }

        /**
         * @param mixed $wounds
         */
        public function setWounds($wounds = 0)
        {
            if(!empty($wounds) && $wounds >= 0) {
                $this->wounds = $wounds;
            } else {
                $this->wounds = 0;
            }

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