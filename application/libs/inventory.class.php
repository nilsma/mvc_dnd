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
            $this->light_load = $entries['light_load'];
            $this->medium_load = $entries['medium_load'];
            $this->heavy_load = $entries['heavy_load'];
            $this->lift_over_head = $entries['lift_over_head'];
            $this->lift_off_ground = $entries['lift_off_ground'];
            $this->push_or_drag = $entries['push_or_drag'];
            $this->items = $entries['items'];
        }

        /**
         * @param mixed $items
         */
        public function setItems($items)
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
            $this->heavy_load = $heavy_load;
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
            $this->lift_off_ground = $lift_off_ground;
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
            $this->lift_over_head = $lift_over_head;
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
            $this->light_load = $light_load;
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
            $this->medium_load = $medium_load;
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
            $this->push_or_drag = $push_or_drag;
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