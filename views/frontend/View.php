<?php 

class View {

    private $_file;
    private $_t;

    function __construct($page) {
        $this->_file = 'views/frontend/' . $page . 'View.php';
    }

    // générer et envoyer la vue
    public function generate($data) {
        // définir le contenu à envoyer
        $content = $this->generateFile($this->_file, $data);

        // template
        $view = $this->generateFile('views/frontend/template.php', array('t' => $this->_t, 'content' => $content));
        echo $view;
    }

    private function generateFile($file, $data) {
        if(file_exists($file)) {
            extract($data);

            // commencer la temporisation
            ob_start();

            require $file;

            return ob_get_clean();
        }
        else {
            throw new \Exception('Le fichier ' . $file . ' est introuvable.', 1);
        }
    }
}