<?php
/**
 * A view class file for the member page
 */
if(!class_exists('Member_View')) {

    class Member_View extends Base_View {

        protected $page_id;
        protected $model;

        public function __construct(Member_Model $model, $controller, $title, $page_id) {
            $this->page_id = $page_id;
            $this->model = $model;
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
            $html .= $this->buildCharactersOverview();
            $html .= $this->buildGamemastersOverview();
            $html .= '</div> <!-- end #mode_chooser -->' . "\n";

            $html .= '<div id="logout">' . "\n";
            $html .= '<p><a href="logout.php">Logout</a></p>' . "\n";
            $html .= '</div>' . "\n";

            return $html;
        }

        public function buildCharactersOverview() {
            $html = '';

            $html .= '<div id="characters_overview" class="guv">' . "\n";
            $html .= '<h2>Characters</h2>' . "\n";

            $sheet_ids = $this->model->getAvailableCharacters($_SESSION['user_id']);

            if(count($sheet_ids) >= 1) {
                $html .= '<form name="character_mode" action="' . $_SERVER['PHP_SELF'] . '" method="GET">' . "\n";

                foreach($sheet_ids as $sheet_id) {
                    $sheet_overview = $this->model->getCharacterSheetOverview($sheet_id);
                    $html .= '<input type="radio" name="character" value="' . $sheet_overview['name'] . '">';
                    $html .= '<label for="character">' . ucwords($sheet_overview['name']) . ' (' . ucwords($sheet_overview['class']) . ' ' . $sheet_overview['level'] . ')</label><br/>' . "\n";
                }

                $html .= '<input type="submit" name="submit_character" value="Load Character">' . "\n";
                $html .= '</form>' . "\n";
            } else {
                $html .= '<p class="guv">You havent created any sheets yet!</p>' . "\n";
            }

            $html .= '<p class="gui"><a href="create_character.php">Create New Character</a></p>' . "\n";
            $html .= '</div> <!-- end #characters_overview -->' . "\n";

            return $html;
        }

        public function buildGamemastersOverview() {
            $html = '';

            $html .= '<div id="gamemasters_overview" class="guv">' . "\n";
            $html .= '<h2>Gamemasters</h2>' . "\n";

            $screen_ids = $this->model->getAvailableGamemasters($_SESSION['user_id']);

            if(count($screen_ids) >= 1) {
                $html .= '<form name="gamemaster_mode" action="' . $_SERVER['PHP_SELF'] . '" method="GET">' . "\n";

                foreach($screen_ids as $screen_id) {
                    $screen_overview = $this->model->getGamemasterScreenOverview($screen_id);
                    $html .= '<input type="radio" name="gamemaster" value="' . $screen_overview['alias'] . '">';
                    $html .= '<label for="gamemaster">'. ucwords($screen_overview['alias']) . ' ("' . ucwords($screen_overview['title']) . '")</label><br/>' . "\n";
                }

                $html .= '<input type="submit" name="submit_gamemaster" value="Load Gamemaster">' . "\n";
                $html .= '</form>' . "\n";
            } else {
                $html .= '<p class="guv">You havent created any gamemaster screens yet!</p>' . "\n";
            }

            $html .= '<p class="gui"><a href="create_gamemaster.php">Create New Gamemaster</a></p>' . "\n";
            $html .= '</div> <!-- end #gamemasters_overview -->' . "\n";

            return $html;
        }

    }

}