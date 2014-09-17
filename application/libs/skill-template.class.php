<?php
/**
 * A class file to represent a skill template in the application
 */
if(!class_exists('Skill_Template')) {

    class Skill_Template {

        protected $template_name;
        protected $common_name;
        protected $key_ability;
        protected $description;

        public function __construct($template_name, $common_name, $key_ability, $description) {
            $this->template_name = $template_name;
            $this->common_name = $common_name;
            $this->key_ability = $key_ability;
            $this->description = $description;
        }

        /**
         * @param mixed $common_name
         */
        public function setCommonName($common_name)
        {
            $this->common_name = $common_name;
        }

        /**
         * @return mixed
         */
        public function getCommonName()
        {
            return $this->common_name;
        }

        /**
         * @param mixed $description
         */
        public function setDescription($description)
        {
            $this->description = $description;
        }

        /**
         * @return mixed
         */
        public function getDescription()
        {
            return $this->description;
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