<?php

if(!class_exists('Attack')) {

    class Attack {

        protected $name;
        protected $attack_bonus;
        protected $damage;
        protected $critical_floor;
        protected $critical_ceiling;
        protected $weapon_range;
        protected $type;
        protected $notes;
        protected $ammunition;

        public function __construct($entries) {
            $this->name = $entries['attack_name'];
            $this->attack_bonus = $entries['attack_bonus'];
            $this->damage = $entries['attack_damage'];
            $this->critical_floor = $entries['critical_floor'];
            $this->critical_ceiling = $entries['critical_ceiling'];
            $this->weapon_range = $entries['weapon_range'];
            $this->type = $entries['attack_type'];
            $this->notes = $entries['attack_notes'];
            $this->ammunition = $entries['ammunition'];
        }

        /**
         * @param mixed $ammunition
         */
        public function setAmmunition($ammunition)
        {
            $this->ammunition = $ammunition;
        }

        /**
         * @return mixed
         */
        public function getAmmunition()
        {
            return $this->ammunition;
        }

        /**
         * @param mixed $attack_bonus
         */
        public function setAttackBonus($attack_bonus)
        {
            $this->attack_bonus = $attack_bonus;
        }

        /**
         * @return mixed
         */
        public function getAttackBonus()
        {
            return $this->attack_bonus;
        }

        /**
         * @param mixed $critical_ceiling
         */
        public function setCriticalCeiling($critical_ceiling)
        {
            $this->critical_ceiling = $critical_ceiling;
        }

        /**
         * @return mixed
         */
        public function getCriticalCeiling()
        {
            return $this->critical_ceiling;
        }

        /**
         * @param mixed $critical_floor
         */
        public function setCriticalFloor($critical_floor)
        {
            $this->critical_floor = $critical_floor;
        }

        /**
         * @return mixed
         */
        public function getCriticalFloor()
        {
            return $this->critical_floor;
        }

        /**
         * @param mixed $damage
         */
        public function setDamage($damage)
        {
            $this->damage = $damage;
        }

        /**
         * @return mixed
         */
        public function getDamage()
        {
            return $this->damage;
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
         * @param mixed $notes
         */
        public function setNotes($notes)
        {
            $this->notes = $notes;
        }

        /**
         * @return mixed
         */
        public function getNotes()
        {
            return $this->notes;
        }

        /**
         * @param mixed $type
         */
        public function setType($type)
        {
            $this->type = $type;
        }

        /**
         * @return mixed
         */
        public function getType()
        {
            return $this->type;
        }

        /**
         * @param mixed $weapon_range
         */
        public function setWeaponRange($weapon_range)
        {
            $this->weapon_range = $weapon_range;
        }

        /**
         * @return mixed
         */
        public function getWeaponRange()
        {
            return $this->weapon_range;
        }

    }

}