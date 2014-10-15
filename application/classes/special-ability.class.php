<?php
/**
 * a class file to represent an attribute in the attributes segment of the character sheet
 */

if(!class_exists('Special_Ability')) {

    class Special_Ability {

        protected $template_name;

        public function __construct($template_name) {
            $this->setTemplateName($template_name);
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