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
            $this->setTemplateName($skill_entries['template_name']);
            $this->setSkillMod($skill_entries['skill_mod']);
            $this->setAbilityMod($skill_entries['ability_mod']);
            $this->setRanks($skill_entries['ranks']);
            $this->setMiscMod($skill_entries['misc_mod']);
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
         * @param mixed $misc_mod
         */
        public function setMiscMod($misc_mod)
        {
            if(!empty($misc_mod) && $misc_mod >= 0) {
                $this->misc_mod = $misc_mod;
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
         * @param mixed $ranks
         */
        public function setRanks($ranks)
        {
            if(!empty($ranks) && $ranks >= 0) {
                $this->ranks = $ranks;
            } else {
                $this->ranks = 0;
            }

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
            if(!empty($skill_mod) && $skill_mod >= 0) {
                $this->skill_mod = $skill_mod;
            } else {
                $this->skill_mod = 0;
            }

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
            if(!empty($template_name)) {
                $this->template_name = $template_name;
            } else {
                $this->template_name = 'Template Name';
            }

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