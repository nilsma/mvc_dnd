<?php
/**
 * A class file to represent the grapple section of the character sheet
 */

if(!class_exists('Grapple')) {

    class Grapple {

        protected $grapple_total;
        protected $grapple_bab;
        protected $grapple_str_mod;
        protected $grapple_size_mod;
        protected $grapple_misc_mod;

        public function __construct($entries) {
            $this->setGrappleTotal($entries['grapple_total']);
            $this->setGrappleBab($entries['grapple_bab']);
            $this->setGrappleStrMod($entries['grapple_str_mod']);
            $this->setGrappleSizeMod($entries['grapple_size_mod']);
            $this->setGrappleMiscMod($entries['grapple_misc_mod']);
        }

        /**
         * @param mixed $grapple_bab
         */
        public function setGrappleBab($grapple_bab)
        {
            if(!empty($grapple_bab) && $grapple_bab >= 0) {
                $this->grapple_bab = $grapple_bab;
            } else {
                $this->grapple_bab = 0;
            }

        }

        /**
         * @return mixed
         */
        public function getGrappleBab()
        {
            return $this->grapple_bab;
        }

        /**
         * @param mixed $grapple_misc_mod
         */
        public function setGrappleMiscMod($grapple_misc_mod)
        {
            if(!empty($grapple_misc_mod) && $grapple_misc_mod >= 0) {
                $this->grapple_misc_mod = $grapple_misc_mod;
            } else {
                $this->grapple_misc_mod = 0;
            }

        }

        /**
         * @return mixed
         */
        public function getGrappleMiscMod()
        {
            return $this->grapple_misc_mod;
        }

        /**
         * @param mixed $grapple_size_mod
         */
        public function setGrappleSizeMod($grapple_size_mod)
        {
            if(!empty($grapple_size_mod) && $grapple_size_mod >= 0) {
                $this->grapple_size_mod = $grapple_size_mod;
            } else {
                $this->grapple_size_mod = 0;
            }

        }

        /**
         * @return mixed
         */
        public function getGrappleSizeMod()
        {
            return $this->grapple_size_mod;
        }

        /**
         * @param mixed $grapple_str_mod
         */
        public function setGrappleStrMod($grapple_str_mod)
        {
            if(!empty($grapple_str_mod) && $grapple_str_mod >= 0) {
                $this->grapple_str_mod = $grapple_str_mod;
            } else {
                $this->grapple_str_mod = 0;
            }

        }

        /**
         * @return mixed
         */
        public function getGrappleStrMod()
        {
            return $this->grapple_str_mod;
        }

        /**
         * @param mixed $grapple_total
         */
        public function setGrappleTotal($grapple_total)
        {
            if(!empty($grapple_total) && $grapple_total >= 0) {
                $this->grapple_total = $grapple_total;
            } else {
                $this->grapple_total = 0;
            }

        }

        /**
         * @return mixed
         */
        public function getGrappleTotal()
        {
            return $this->grapple_total;
        }

    }

}