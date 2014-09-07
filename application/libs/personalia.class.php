<?php
if(!class_exists('Personalia')) {

    class Personalia {

        protected $name;
        protected $class;
        protected $level;
        protected $size;
        protected $age;
        protected $gender;
        protected $height;
        protected $weight;
        protected $eyes;
        protected $hair;
        protected $skin;
        protected $race;
        protected $alignment;
        protected $deity;
        protected $xp;
        protected $next_level;

        public function __construct($entries) {
            $this->name = $entries['name'];
            $this->class = $entries['class'];
            $this->level = $entries['level'];
            $this->size = $entries['size'];
            $this->age = $entries['age'];
            $this->gender = $entries['gender'];
            $this->height = $entries['height'];
            $this->weight = $entries['weight'];
            $this->eyes = $entries['eyes'];
            $this->hair = $entries['hair'];
            $this->skin = $entries['skin'];
            $this->race = $entries['race'];
            $this->alignment = $entries['alignment'];
            $this->deity = $entries['deity'];
            $this->xp = $entries['xp'];
            $this->next_level = $entries['next_level'];
        }

        /**
         * @param mixed $age
         */
        public function setAge($age)
        {
            $this->age = $age;
        }

        /**
         * @return mixed
         */
        public function getAge()
        {
            return $this->age;
        }

        /**
         * @param mixed $alignment
         */
        public function setAlignment($alignment)
        {
            $this->alignment = $alignment;
        }

        /**
         * @return mixed
         */
        public function getAlignment()
        {
            return $this->alignment;
        }

        /**
         * @param mixed $class
         */
        public function setClass($class)
        {
            $this->class = $class;
        }

        /**
         * @return mixed
         */
        public function getClass()
        {
            return $this->class;
        }

        /**
         * @param mixed $deity
         */
        public function setDeity($deity)
        {
            $this->deity = $deity;
        }

        /**
         * @return mixed
         */
        public function getDeity()
        {
            return $this->deity;
        }

        /**
         * @param mixed $eyes
         */
        public function setEyes($eyes)
        {
            $this->eyes = $eyes;
        }

        /**
         * @return mixed
         */
        public function getEyes()
        {
            return $this->eyes;
        }

        /**
         * @param mixed $gender
         */
        public function setGender($gender)
        {
            $this->gender = $gender;
        }

        /**
         * @return mixed
         */
        public function getGender()
        {
            return $this->gender;
        }

        /**
         * @param mixed $hair
         */
        public function setHair($hair)
        {
            $this->hair = $hair;
        }

        /**
         * @return mixed
         */
        public function getHair()
        {
            return $this->hair;
        }

        /**
         * @param mixed $height
         */
        public function setHeight($height)
        {
            $this->height = $height;
        }

        /**
         * @return mixed
         */
        public function getHeight()
        {
            return $this->height;
        }

        /**
         * @param mixed $level
         */
        public function setLevel($level)
        {
            $this->level = $level;
        }

        /**
         * @return mixed
         */
        public function getLevel()
        {
            return $this->level;
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
         * @param mixed $next_level
         */
        public function setNextLevel($next_level)
        {
            $this->next_level = $next_level;
        }

        /**
         * @return mixed
         */
        public function getNextLevel()
        {
            return $this->next_level;
        }

        /**
         * @param mixed $race
         */
        public function setRace($race)
        {
            $this->race = $race;
        }

        /**
         * @return mixed
         */
        public function getRace()
        {
            return $this->race;
        }

        /**
         * @param mixed $size
         */
        public function setSize($size)
        {
            $this->size = $size;
        }

        /**
         * @return mixed
         */
        public function getSize()
        {
            return $this->size;
        }

        /**
         * @param mixed $skin
         */
        public function setSkin($skin)
        {
            $this->skin = $skin;
        }

        /**
         * @return mixed
         */
        public function getSkin()
        {
            return $this->skin;
        }

        /**
         * @param mixed $weight
         */
        public function setWeight($weight)
        {
            $this->weight = $weight;
        }

        /**
         * @return mixed
         */
        public function getWeight()
        {
            return $this->weight;
        }

        /**
         * @param mixed $xp
         */
        public function setXp($xp)
        {
            $this->xp = $xp;
        }

        /**
         * @return mixed
         */
        public function getXp()
        {
            return $this->xp;
        }

    }

}