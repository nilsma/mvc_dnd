<?php

if(!class_exists('Attack')) {

    class Attack {

        protected $id;
        protected $name;
        protected $attack_bonus;
        protected $damage;
        protected $critical_floor;
        protected $critical_ceiling;
        protected $weapon_range;
        protected $type;
        protected $notes;
        protected $ammunition;

        public function __construct($entries, $id = NULL) {
            $this->setId($id);
            $this->setName($entries['attack_name']);
            $this->setAttackBonus($entries['attack_bonus']);
            $this->setDamage($entries['attack_damage']);
            $this->setCriticalFloor($entries['critical_floor']);
            $this->setCriticalCeiling($entries['critical_ceiling']);
            $this->setWeaponRange($entries['weapon_range']);
            $this->setType($entries['attack_type']);
            $this->setNotes($entries['attack_notes']);
            $this->setAmmunition($entries['ammunition']);
        }

        /**
         * @param mixed $id
         */
        public function setId($id)
        {
            $this->id = $id;
        }

        /**
         * @return mixed
         */
        public function getId()
        {
            return $this->id;
        }

        /**
         * @param mixed $ammunition
         */
        public function setAmmunition($ammunition)
        {
            if(!empty($ammunition) && $ammunition >= 0) {
                $this->ammunition = $ammunition;
            } else {
                $this->ammunition = 0;
            }

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
            if(!empty($attack_bonus) && $attack_bonus >= 0) {
                $this->attack_bonus = $attack_bonus;
            } else {
                $this->attack_bonus = 0;
            }

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
            if(!empty($critical_ceiling) && $critical_ceiling >= 0) {
                $this->critical_ceiling = $critical_ceiling;
            } else {
                $this->critical_ceiling = 0;
            }

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
            if(!empty($critical_floor) && $critical_floor >= 0) {
                $this->critical_floor = $critical_floor;
            } else {
                $this->critical_floor = 0;
            }

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
            if(!empty($damage) >= 0) {
                $this->damage = $damage;
            } else {
                $this->damage = 0;
            }

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
            if(!empty($name)) {
                $this->name = $name;
            } else {
                $this->name = 'Attack Name';
            }

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
            if(!empty($notes)) {
                $this->notes = $notes;
            } else {
                $this->notes = 'Attack Notes';
            }

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
            if(!empty($type)) {
                $this->type = $type;
            } else {
                $this->type = 'Attack Type';
            }

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
            if(!empty($weapon_range) && $weapon_range >= 0) {
                $this->weapon_range = $weapon_range;
            } else {
                $this->weapon_range = 0;
            }

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