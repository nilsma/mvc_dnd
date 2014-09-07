<?php
/**
 * A view class file for the member page
 */
require_once 'base.view.php';

if(!class_exists('Member_View')) {

    class Member_View extends Base_View {

        protected $page_id;

        public function __construct($model, $controller, $title, $page_id) {
            $this->page_id = $page_id;
            parent::__construct($model, $controller, $title, $page_id);
        }

        public function render() {
            include '../application/templates/head.html';

            $html = '' . "\n";
            $html .= $this->buildHeader($this->page_id);
            $html .= $this->buildModeChooser();

            echo $html;

            include '../application/templates/footer.html';
        }

        public function buildModeChooser() {
            $html = '';

            $html .= '<div id="mode_chooser">' . "\n";
            $html .= '<div>' . "\n";
            $html .= '<h2 class="gui">Characters (<a href="create-character.php">Create Character</a>)</h2>' . "\n";
            $html .= '<div id="available_characters">' . "\n";

            $character_sheets = $this->model->getAvailableCharacters();
            if(count($character_sheets) > 1) {
                $html .= '<p class="gui">You have created sheets!</p>' . "\n";
            } else {
                $html .= '<p class="guv">You havent created any sheets yet!</p>' . "\n";
            }

            $html .= '</div> <!-- end #available_characters -->' . "\n";
            $html .= '<h2 class="gui">Gamemasters (<a href="create-gamemaster.php">Create Gamemaster</a>)</h2>' . "\n";
            $gamemaster_screens = $this->model->getAvailableGamemasters($_SESSION['user_id']);
            if(count($gamemaster_screens) > 1) {
                $html .= '<p class="gui">You have created gamemaster screens!</p>' . "\n";
            } else {
                $html .= '<p class="guv">You havent created any gamemaster screens yet!</p>' . "\n";
            }

            $html .= '<div id="available_gamemasters">' . "\n";
            $html .= '</div> <!-- end #available_gamemasters -->' . "\n";
            $html .= '</div> <!-- end #mode_chooser -->' . "\n";

            $html .= '<div id="logout">' . "\n";
            $html .= '<p><a href="logout.php">Logout</a></p>' . "\n";
            $html .= '</div>' . "\n";

            return $html;
        }

    }

}