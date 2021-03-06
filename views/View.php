<?php

namespace JeanForteroche\Views;

class View
{
    private $viewSide;
    private $file;
    private $title;

    public function __construct(string $action, string $viewSide , string $controller = '')
    {
        $this->viewSide = $viewSide;
        $this->file = 'Views/'.$this->viewSide.'/'.$controller.'/'. $action.'.php';
    }

    // générer et envoyer la vue
    public function generate(array $data, $categories)
    {
        // définir le contenu à envoyer
        $content = $this->generateFile($this->file, $data);

        // template
        $layout = $this->generateFile('Views/'.$this->viewSide.'/layout/template.php', array(
            'title' => $this->title,
            'categories' => $categories,
            'content' => $content
        ));
        echo $layout;
    }

    private function generateFile(string $file, array $data)
    {
        if(file_exists($file)) {
            extract($data);

            // commencer la temporisation
            ob_start();

            require $file;

            return ob_get_clean();
        }
        else {
            throw new \Exception('Le fichier de vue ' . $file . ' est introuvable.', 1);
        }
    }
}