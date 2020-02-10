<?php 

class View
{

    private $file;
    private $t;

    public function __construct($page)
    {
        $this->file = 'views/admin/' . $page . 'View.php';
    }

    // générer et envoyer la vue
    public function generate($data)
    {
        // définir le contenu à envoyer
        $content = $this->generateFile($this->file, $data);

        // template
        $view = $this->generateFile('views/admin/template.php', array('t' => $this->t, 'content' => $content));
        echo $view;
    }

    private function generateFile($file, $data)
    {
        if(file_exists($file)) {
            extract($data);

            // commencer la temporisation
            ob_start();

            require $file;

            return ob_get_clean();
        } else {
            throw new \Exception('Le fichier ' . $file . ' est introuvable.', 1);
        }
    }
}