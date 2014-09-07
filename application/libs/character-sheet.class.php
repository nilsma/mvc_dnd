<?php
/**
 * A class file for the character-sheet representing the
 * character sheet in the application
 */

if(!class_exists('Character_Sheet')) {

    class Character_Sheet {

        protected $personalia;
        protected $stats;
        protected $attributes;
        protected $attacks;
        protected $skills;
        protected $purse;
        protected $languages;
        protected $special_abilities;
        protected $feats;
        protected $inventory;
        protected $saving_throws;
        protected $armors;

        public function __construct ($segments) {
            $this->personalia = $segments['personalia'];
            $this->stats = $segments['stats'];
            $this->attributes = $segments['attributes'];
            $this->attacks = $segments['attacks'];
            $this->skills = $segments['skills'];
            $this->purse = $segments['purse'];
            $this->languages = $segments['languages'];
            $this->special_abilities = $segments['special_abilities'];
            $this->feats = $segments['feats'];
            $this->inventory = $segments['inventory'];
            $this->inventory = $segments['saving_throws'];
            $this->armors = $segments['armors'];
        }

        /**
         * @param mixed $armors
         */
        public function setArmors($armors)
        {
            $this->armors = $armors;
        }

        /**
         * @return mixed
         */
        public function getArmors()
        {
            return $this->armors;
        }

        /**
         * @param mixed $inventory
         */
        public function setInventory($inventory)
        {
            $this->inventory = $inventory;
        }

        /**
         * @return mixed
         */
        public function getInventory()
        {
            return $this->inventory;
        }

        /**
         * @param mixed $saving_throws
         */
        public function setSavingThrows($saving_throws)
        {
            $this->saving_throws = $saving_throws;
        }

        /**
         * @return mixed
         */
        public function getSavingThrows()
        {
            return $this->saving_throws;
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

        /**
         * @param mixed $languages
         */
        public function setLanguages($languages)
        {
            $this->languages = $languages;
        }

        /**
         * @return mixed
         */
        public function getLanguages()
        {
            return $this->languages;
        }

        /**
         * @param mixed $purse
         */
        public function setPurse($purse)
        {
            $this->purse = $purse;
        }

        /**
         * @return mixed
         */
        public function getPurse()
        {
            return $this->purse;
        }

        /**
         * @param mixed $skills
         */
        public function setSkills($skills)
        {
            $this->skills = $skills;
        }

        /**
         * @return mixed
         */
        public function getSkills()
        {
            return $this->skills;
        }

        /**
         * @param mixed $attacks
         */
        public function setAttacks($attacks)
        {
            $this->attacks = $attacks;
        }

        /**
         * @return mixed
         */
        public function getAttacks()
        {
            return $this->attacks;
        }

        /**
         * @param mixed $attributes
         */
        public function setAttributes($attributes)
        {
            $this->attributes = $attributes;
        }

        /**
         * @return mixed
         */
        public function getAttributes()
        {
            return $this->attributes;
        }

        /**
         * @param mixed $personalia
         */
        public function setPersonalia($personalia)
        {
            $this->personalia = $personalia;
        }

        /**
         * @return mixed
         */
        public function getPersonalia()
        {
            return $this->personalia;
        }

        /**
         * @param mixed $stats
         */
        public function setStats($stats)
        {
            $this->stats = $stats;
        }

        /**
         * @return mixed
         */
        public function getStats()
        {
            return $this->stats;
        }

    }

}