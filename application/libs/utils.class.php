<?php
/**
 * A static class for the application's shared utility functions
 */
if(!class_exists('Utils')) {

    class Utils {

        private static $initialized = false;

        private static function initialize() {
            if(self::initialized) {
                return;
            }
            self::$initialized = true;
        }

        public static function orderAttributesArray($attributes) {
            $order = array('strength', 'constitution', 'dexterity', 'intelligence', 'wisdom', 'charisma');
            $ordered = array();
            foreach($order as $entry) {
                foreach($attributes as $attribute) {
                    if(strtolower($attribute->getName()) == $entry) {
                        array_push($ordered, $attribute);
                    }
                }
            }

            return $ordered;
        }

        public static function endsWith($haystack, $needle) {
            return $needle === "" || substr($haystack, -strlen($needle)) === $needle;
        }

        public static function washInput($string) {
            $string = htmlspecialchars(strtolower(strip_tags(trim($string))), REPLACE_FLAGS, CHARSET);
            return $string;
        }

        /**
         * A function to handle replacing of parameters for the htmlspecialchars function
         * Credits to Mike Robinson [http://php.net/htmlspecialchars]
         * @param string $string - the string to wash
         * @return string - the washed string
         */
        public static function html($string) {
            return htmlspecialchars($string, REPLACE_FLAGS, CHARSET);
        }

        public static function washArray($array) {
            $washed = array();
            foreach($array as $key => $val) {
                $newVal = Utils::html($val);
                $washed[$key] = $newVal;
            }

            return $washed;
        }

    }

}
