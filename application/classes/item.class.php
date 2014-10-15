<?php
/**
 * A class file to represent an Item in the Inventory segment of the Character Sheet
 */ 
if(!class_exists('Item')) {
    
    class Item {

        protected $id;
        protected $name;
        protected $weight;
        protected $quantity;
        
        public function __construct($entries, $id = NULL) {
            $this->setId($id);
            $this->setName($entries['item_name']);
            $this->setWeight($entries['item_weight']);
            $this->setQuantity($entries['item_quantity']);
        }

        /**
         * @param mixed $id
         */
        public function setId($id)
        {
            $this->id = $id;
        }

        /**
         * @return mixed
         */
        public function getId()
        {
            return $this->id;
        }

        /**
         * @param mixed $name
         */
        public function setName($name)
        {
            if(!empty($name)) {
                $this->name = $name;
            } else {
                $this->name = '';
            }

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
            if(!empty($quantity) && $quantity >= 0) {
                $this->quantity = $quantity;
            } else {
                $this->quantity = '';
            }

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
            if(!empty($weight) && $weight >=0) {
                $this->weight = $weight;
            } else {
                $this->weight = '';
            }

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