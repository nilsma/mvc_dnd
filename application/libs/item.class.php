<?php
/**
 * A class file to represent an Item in the Inventory segment of the Character Sheet
 */ 
if(!class_exists('Item')) {
    
    class Item {
        
        protected $name;
        protected $weight;
        protected $quantity;
        
        public function __construct($entries) {
            $this->name = $entries['name'];
            $this->weight = $entries['weight'];
            $this->quantity = $entries['quantity'];
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
         * @param mixed $quantity
         */
        public function setQuantity($quantity)
        {
            $this->quantity = $quantity;
        }

        /**
         * @return mixed
         */
        public function getQuantity()
        {
            return $this->quantity;
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
        
    }
    
}