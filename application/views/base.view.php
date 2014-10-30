<?php
/**
 * a base view class which all of the application's other views extends
 */
if(!class_exists('Base_View')) {

    class Base_View {

        protected $model;
        private $ctrl;
        private $title;
        private $page_id;

        public function __construct(Base_Model $model, Base_Controller $ctrl, $title, $page_id) {
            $this->model = $model;
            $this->ctrl = $ctrl;
            $this->title = $title;
            $this->page_id = $page_id;
        }

        public function render() { }

        public function buildHeader($page_id) {
            $html = '';
            $html .= '<meta name="viewport" content="width=device-width, user-scalable=yes">' . "\n";
            //$html .= '<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.15/angular.min.js"></script>' . "\n";
            //$html .= '<link rel="stylesheet" href="../../public/css/main.css">' . "\n";
            //$html .= '<link rel="stylesheet" href="../../public/css/navigation.css">' . "\n";
            //$html .= '<link rel="stylesheet" href="../../public/css/' . $page_id . '.css">' . "\n";

            if(isset($_SESSION['auth'])) {
                $html .= '<script src="javascript/' . $page_id . '.js"></script>' . "\n";
            }

            $html .= '<title>DNDHelper</title>' . "\n";
            $html .= '</head>' . "\n";
            $html .= '<body id="' . $page_id . '">' . "\n";
            $html .= '<div id="main_container">' . "\n";
            $html .= '<header>' . "\n";

            if(isset($_SESSION['auth']) && $page_id != 'index' && $page_id != 'login' && $page_id != 'register') {
                $html .= '<div id="welcome">' . "\n";
                $html .= '<p>Logged in as <span>' . $_SESSION['username'] . '</span></p>' . "\n";
                $html .= '</div>' . "\n";
                $html .= '<div id="logo">' . "\n";
                $html .= '<div id="logo_inner">' . "\n";
                $html .= '<h1><a href="member.php">DNDHelper</a></h1>' . "\n";
                //$html .= '<img id="hamburger" src="../../public/images/hamburger_black_small.png" alt="menu trigger image"/>' . "\n";
                $html .= '</div> <!-- end #logo_inner -->' . "\n";
                $html .= '</div> <!-- end #logo -->' . "\n";
                //$html .= $this->buildNavigation();
            } else {
                $html .= '<h1><a href="index.php">DNDHelper</a></h1>' . "\n";
            }

            $html .= '</header>' . "\n";

            $html .= '<div id="inner_container" class="guv">' . "\n";

            return $html;
        }

            public function buildErrors($errors) {
            $html = '';
            $html .= '<div id="errors">' . "\n";
            $html .= '<p>The following errors occured: </p>' . "\n";
            $html .= '<ul>' . "\n";

            foreach($errors as $error) {
                $html .= '<li>' . $error . '</li>' . "\n";
            }

            $html .= '</ul>' . "\n";
            $html .= '</div> <!-- end #errors -->' . "\n";

            return $html;
        }

        public function buildSuccess($success) {
            $html = '';
            $html .= '<div id="success">' . "\n";
            $html .= '<ul>' . "\n";

            foreach($success as $succeed) {
                $html .= '<li>' . $succeed . '</li>' . "\n";
            }

            $html .= '</ul>' . "\n";
            $html .= '</div> <!-- end #success -->' . "\n";

            return $html;
        }

        public function getFeatSuggestionsHTML($suggestions_array) {
            $data = '';
            $data .= '<ul id="feat_sugggestions_list">' . "\n";

            if(count($suggestions_array) < 1) {
                $data .= '<li>No suggestions!</li>' . "\n";
            } else {
                foreach($suggestions_array as $key => $val) {
                    $data .= '<li class="gui offered_suggestion" onClick="chooseFeatTemplate(\'' . $key . '\', \'' . ucwords($val) .'\');"><a href="javascript:void()">' . ucwords($val) . '</a></li>' . "\n";
                }
            }

            $data .= '</ul>' . "\n";

            header('Content-type: application/json');
            echo json_encode($data, JSON_FORCE_OBJECT);

        }

        /**
         * a function to get the description of the special ability template and echo it as a
         * string representation of HTML
         * @param $template_name
         */
        public function getSkillInfo($template_name) {
            $info = $this->model->getSkillInfo($template_name);

            $data = '';
            $data .= '<div>' . "\n";
            $data .= '<p>' . $info . '</p>' . "\n";
            $data .= '</div>' . "\n";
            $data .= '<p><a class="gui close_skill_info" href="javascript:void()" onClick="closeSkillInfo();">Close</a></p>' . "\n";

            echo $data;
        }

        /**
         * a function to get the description of the special ability template and echo it as a
         * string representation of HTML
         * @param $common_name
         */
        public function getSpecialAbilityInfo($common_name) {
            $info = $this->model->getSpecialAbilityInfo($common_name);

            $data = '';
            $data .= '<p>' . $info . '</p>' . "\n";
            $data .= '<p><a class="gui close_special_ability_info" href="javascript:void()" onClick="closeSpecialAbilityInfo();">Close</a></p>' . "\n";

            echo $data;
        }

        public function getFeatInfo($common_name) {
            $info = $this->model->getFeatInfo($common_name);

            $data = '';
            $data .= '<p>' . $info . '</p>' . "\n";
            $data .= '<p><a class="gui close_feat_info" href="javascript:void()" onClick="closeFeatInfo();">Close</a></p>' . "\n";

            echo $data;
        }

        public function getSpecialAbilitySuggestionsHTML($suggestions_array) {
            $data = '';
            $data .= '<ul id="suggestions_list">' . "\n";

            if(count($suggestions_array) < 1) {
                $data .= '<li>No suggestions!</li>' . "\n";
            } else {
                foreach($suggestions_array as $suggestion) {
                    $base_class = $suggestion['base_class'];
                    $template_name = $suggestion['template_name'];
                    $common_name = $suggestion['common_name'];

                    $data .= '<li class="gui offered_suggestion" onClick="chooseTemplate(\'' . $base_class . '\', \'' . $template_name . '\', \'' . ucwords($common_name) .'\');"><a href="javascript:void()">' . ucwords($common_name) . '</a> (' . ucwords($base_class) . ')</li>' . "\n";
                }
            }

            $data .= '</ul>' . "\n";

            header('Content-type: application/json');
            echo json_encode($data, JSON_FORCE_OBJECT);
        }

    }

}
