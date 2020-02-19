<?php 
require_once 'views/admin/View.php';

class CategoriesController
{

    private $categoryManager;
    public $categories;
    private $view;

    public function __construct()
    {
        $action = $_GET['action'];

        switch ($action) {
            case 'list':
                $this->listCategories();
                break;
            case 'create':
                $this->createCategory();
                break;
            case 'insert':
                $this->insertCategory($_POST['name'], $_POST['image']);
                break;
            case 'edit':
                $this->editCategory($_GET['id']);
                break;
            case 'update':
                $this->updateCategory($_GET['id'], $_POST['name'], $_POST['image']);
                break;
            case 'delete':
                $this->deleteCategory($_GET['id']);
                break;
            default:
                throw new Exception('Action inconnue');
        }
    }

    private function listCategories()
    {
        $this->categoryManager = new CategoryManager();
        $this->categories = $this->categoryManager->getCategories();

        $this->view = new View('categories');
        $this->view->generate(array('categories' => $this->categories));
    }

    private function createCategory()
    {
        $this->view = new View('createCategory');
        $this->view->generate(array());
    }

    private function insertCategory($name, $image)
    {
        if (isset($name) && isset($image)) {
            $this->categoryManager = new CategoryManager();
            $newCategory = $this->categoryManager->setNewCategory($name, $image);
    
            if($newCategory === false) {
                throw new \Exception("Impossible d'ajouter la catégorie !");
            } else {
                header('Location: admin.php?url=categories&action=list');
                exit();
            }
        } else {
            throw new \Exception("Impossible d'ajouter la catégorie !");
        }
    }

    private function editCategory($id)
    {
        if (isset($id)) {
            $this->categoryManager = new CategoryManager();
            $categoryToUpdate = $this->categoryManager->getCategory($id);
            $this->categories = $this->categoryManager->getCategories();

            $this->view = new View('categories');
            $this->view->generate(array('categories' => $this->categories, 'categoryToUpdate' => $categoryToUpdate));
        }
    }

    private function updateCategory($id, $name, $image)
    {
        if (isset($id) && isset($name) && isset($image)) {
            $this->categoryManager = new CategoryManager();
            $affectedCategory = $this->categoryManager->setUpdateCategory($id, $name, $image);

            if($affectedCategory === false) {
                throw new Exception("Impossible de mettre à jour la catégorie !");
            } else  {
                header('Location: admin.php?url=categories&action=list');
                exit();
            }
        }
    }

    private function deleteCategory($id)
    {
        if (isset($id)) {
            $this->categoryManager = new CategoryManager();
            $deletedCategory = $this->categoryManager->setDeleteCategory($id);

            if($deletedCategory === false) {
                throw new \Exception("Impossible de supprimer la catégorie ! Vérifiez qu'aucun article n'est rattaché à cette catégorie puis recommencez.");
            } else {
                header('Location: admin.php?url=categories&action=list');
                exit();
            }
        }
    }
}