<?php 

class View
{

    private $file;
    private $title;

    function __construct($page)
    {
        $this->file = 'views/frontend/' . $page . 'View.php';
    }

    // générer et envoyer la vue
    public function generate($data, $categories = '')
    {
        // définir le contenu à envoyer
        $content = $this->generateFile($this->file, $data);

        // template
        $layout = $this->generateFile('views/frontend/template.php', array('title' => $this->title, 'categories' => $categories, 'content' => $content));
        echo $layout;
    }

    private function generateFile($file, $data)
    {
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