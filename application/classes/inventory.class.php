<?php
/**
 * A class file to represent the Inventory segment of the Character Sheet
 */

if(!class_exists('Inventory')) {

    class Inventory {

        protected $light_load;
        protected $medium_load;
        protected $heavy_load;
        protected $lift_over_head;
        protected $lift_off_ground;
        protected $push_or_drag;
        protected $items;

        public function __construct($entries) {
            $this->setLightLoad($entries['light_load']);
            $this->setMediumLoad($entries['medium_load']);
            $this->setHeavyLoad($entries['heavy_load']);
            $this->setLiftOverHead($entries['lift_over_head']);
            $this->setLiftOffGround($entries['lift_off_ground']);
            $this->setPushOrDrag($entries['push_or_drag']);
            $this->setItems($entries['items']);
        }

        /**
         * @param mixed $items
         */
        public function setItems(Array $items)
        {
            $this->items = $items;
        }

        /**
         * @return mixed
         */
        public function getItems()
        {
            return $this->items;
        }

        /**
         * @param mixed $heavy_load
         */
        public function setHeavyLoad($heavy_load)
        {
            if(!empty($heavy_load) && $heavy_load >=0) {
                $this->heavy_load = $heavy_load;
            } else {
                $this->heavy_load = 0;
            }

        }

        /**
         * @return mixed
         */
        public function getHeavyLoad()
        {
            return $this->heavy_load;
        }

        /**
         * @param mixed $lift_off_ground
         */
        public function setLiftOffGround($lift_off_ground)
        {
            if(!empty($lift_off_ground) && $lift_off_ground >=0) {
                $this->lift_off_ground = $lift_off_ground;
            } else {
                $this->lift_off_ground = 0;
            }

        }

        /**
         * @return mixed
         */
        public function getLiftOffGround()
        {
            return $this->lift_off_ground;
        }

        /**
         * @param mixed $lift_over_head
         */
        public function setLiftOverHead($lift_over_head)
        {
            if(!empty($lift_over_head) && $lift_over_head >= 0) {
                $this->lift_over_head = $lift_over_head;
            } else {
                $this->lift_over_head = 0;
            }

        }

        /**
         * @return mixed
         */
        public function getLiftOverHead()
        {
            return $this->lift_over_head;
        }

        /**
         * @param mixed $light_load
         */
        public function setLightLoad($light_load)
        {
            if(!empty($light_load) && $light_load >=0) {
                $this->light_load = $light_load;
            } else {
                $this->light_load = 0;
            }

        }

        /**
         * @return mixed
         */
        public function getLightLoad()
        {
            return $this->light_load;
        }

        /**
         * @param mixed $medium_load
         */
        public function setMediumLoad($medium_load)
        {
            if(!empty($medium_load) && $medium_load >= 0) {
                $this->medium_load = $medium_load;
            } else {
                $this->medium_load = 0;
            }

        }

        /**
         * @return mixed
         */
        public function getMediumLoad()
        {
            return $this->medium_load;
        }

        /**
         * @param mixed $push_or_drag
         */
        public function setPushOrDrag($push_or_drag)
        {
            if(!empty($push_or_drag) && $push_or_drag >= 0) {
                $this->push_or_drag = $push_or_drag;
            } else {
                $this->push_or_drag = 0;
            }

        }

        /**
         * @return mixed
         */
        public function getPushOrDrag()
        {
            return $this->push_or_drag;
        }

    }

}