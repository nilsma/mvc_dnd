<?php
/**
 * A class file to represent a skill in the application
 */

if(!class_exists('Skill')) {

    class Skill {

        protected $template_name;
        protected $skill_mod;
        protected $ability_mod;
        protected $ranks;
        protected $misc_mod;

        public function __construct($skill_entries) {
            $this->template_name = $skill_entries['template_name'];
            $this->skill_mod = $skill_entries['skill_mod'];
            $this->ability_mod = $skill_entries['ability_mod'];
            $this->ranks = $skill_entries['ranks'];
            $this->misc_mod = $skill_entries['misc_mod'];
        }

        /**
         * @param mixed $ability_mod
         */
        public function setAbilityMod($ability_mod)
        {
            $this->ability_mod = $ability_mod;
        }

        /**
         * @return mixed
         */
        public function getAbilityMod()
        {
            return $this->ability_mod;
        }

        /**
         * @param mixed $misc_mod
         */
        public function setMiscMod($misc_mod)
        {
            $this->misc_mod = $misc_mod;
        }

        /**
         * @return mixed
         */
        public function getMiscMod()
        {
            return $this->misc_mod;
        }

        /**
         * @param mixed $ranks
         */
        public function setRanks($ranks)
        {
            $this->ranks = $ranks;
        }

        /**
         * @return mixed
         */
        public function getRanks()
        {
            return $this->ranks;
        }

        /**
         * @param mixed $skill_mod
         */
        public function setSkillMod($skill_mod)
        {
            $this->skill_mod = $skill_mod;
        }

        /**
         * @return mixed
         */
        public function getSkillMod()
        {
            return $this->skill_mod;
        }

        /**
         * @param mixed $template_name
         */
        public function setTemplateName($template_name)
        {
            $this->template_name = $template_name;
        }

        /**
         * @return mixed
         */
        public function getTemplateName()
        {
            return $this->template_name;
        }

    }

}