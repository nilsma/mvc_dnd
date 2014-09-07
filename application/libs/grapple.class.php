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
            $this->grapple_total = $entries['grapple_total'];
            $this->grapple_bab = $entries['grapple_bab'];
            $this->grapple_str_mod = $entries['grapple_str_mod'];
            $this->grapple_size_mod = $entries['grapple_size_mod'];
            $this->grapple_misc_mod = $entries['grapple_misc_mod'];
        }

        /**
         * @param mixed $grapple_bab
         */
        public function setGrappleBab($grapple_bab)
        {
            $this->grapple_bab = $grapple_bab;
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
            $this->grapple_misc_mod = $grapple_misc_mod;
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
            $this->grapple_size_mod = $grapple_size_mod;
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
            $this->grapple_str_mod = $grapple_str_mod;
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
            $this->grapple_total = $grapple_total;
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