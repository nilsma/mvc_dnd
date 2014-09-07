<?php
/**
 * A class file to represent the character sheets range of skills in the application
 */

if(!class_exists('Skills')) {

    class Skills {

        protected $max_ranks_class;
        protected $max_ranks_cross_class;
        protected $skill_array;

        public function __construct($entries) {
            $this->max_ranks_class = $entries['max_ranks_class'];
            $this->max_ranks_cross_class = $entries['max_ranks_cross_class'];
            $this->skill_array = $entries['skill_array'];
        }

    }

}