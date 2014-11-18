<?php
/**
 * a view class for the application's login page
 */

require_once 'base.view.php';

if(!class_exists('About_View')) {

    class About_View extends Base_View {

        protected $page_id;

        public function __construct($model, $controller, $title, $page_id) {
            $this->page_id = $page_id;
            parent::__construct($model, $controller, $title, $page_id);
        }

        public function render() {
            include '../application/templates/head.html';

            $html = '';
            $html .= $this->buildHeader($this->page_id);
            $html .= '<div id="about">' . "\n";
            $html .= '<p>DNDHelper is a simple and basic application for storing and accessing your DND 3.5 characters.</p>';
            $html .= '<p>DNDHelper is a personal programming project essentially made for programming practice, ';
            $html .= 'but anyone is welcome to try or use the application for free!</p>' . "\n";
            $html .= '<p>However, you should be aware that the application is subject to continual changes ';
            $html .= 'and I cannot guarantee uptime, backups, or longevity of the project.</p>' . "\n";
            $html .= '<p>So you would probably not want to rely on DNDHelper as a permanent storage of ';
            $html .= 'your characters - not yet anyway</p>' . "\n";
            $html .= '<p>Any feedback about the application is most welcome at <a id="email" href="mailto:dnd%40nima-design%2enet?subject=DNDHelper" title="Send me an email">dnd@nima-design.net</a></p>';
            $html .= '<p><a href="register.php">Register</a> or <a href="login.php">login</a> to start using DNDHelper.</p>' . "\n";
            $html .= '</div>' . "\n";

            echo $html;

            include '../application/templates/footer.html';
        }
    }
}
