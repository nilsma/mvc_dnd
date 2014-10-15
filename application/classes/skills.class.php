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
            $this->setMaxRanksClass($entries['max_ranks_class']);
            $this->setMaxRanksCrossClass($entries['max_ranks_cross_class']);
            $this->setSkillArray($entries['skill_array']);
        }

        /**
         * @param mixed $max_ranks_class
         */
        public function setMaxRanksClass($max_ranks_class)
        {
            if(!empty($max_ranks_class) && $max_ranks_class >= 0) {
                $this->max_ranks_class = $max_ranks_class;
            } else {
                $this->max_ranks_class = 0;
            }

        }

        /**
         * @return mixed
         */
        public function getMaxRanksClass()
        {
            return $this->max_ranks_class;
        }

        /**
         * @param mixed $max_ranks_cross_class
         */
        public function setMaxRanksCrossClass($max_ranks_cross_class)
        {
            if(!empty($max_ranks_cross_class) && $max_ranks_cross_class >= 0) {
                $this->max_ranks_cross_class = $max_ranks_cross_class;
            } else {
                $this->max_ranks_cross_class = 0;
            }

        }

        /**
         * @return mixed
         */
        public function getMaxRanksCrossClass()
        {
            return $this->max_ranks_cross_class;
        }

        /**
         * @param mixed $skill_array
         */
        public function setSkillArray(Array $skill_array)
        {
            $this->skill_array = $skill_array;
        }

        /**
         * @return mixed
         */
        public function getSkillArray()
        {
            return $this->skill_array;
        }

    }

}