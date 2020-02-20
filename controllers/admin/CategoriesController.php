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
                $this->insertCategory($_POST['categoryTitle'], $_POST['categoryImage']);
                break;
            case 'edit':
                $this->editCategory($_GET['categoryId']);
                break;
            case 'update':
                $this->updateCategory($_GET['categoryId'], $_POST['categoryTitle'], $_POST['categoryImage']);
                break;
            case 'delete':
                $this->deleteCategory($_GET['categoryId']);
                break;
            default:
                throw new Exception('Action impossible');
        }
    }

    private function listCategories()
    {
        $this->categoryManager = new CategoryManager();
        $this->categories = $this->categoryManager->getAllCategories();

        $this->view = new View('categories');
        $this->view->generate(array('categories' => $this->categories));
    }

    private function createCategory()
    {
        $this->view = new View('createCategory');
        $this->view->generate(array());
    }

    private function insertCategory($categoryTitle, $categoryImage)
    {
        if (isset($categoryTitle) && isset($categoryImage)) {
            $this->categoryManager = new CategoryManager();
            $newCategory = $this->categoryManager->setNewCategorysetNewCategory($categoryTitle, $categoryImage);
    
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

    private function editCategory($categoryId)
    {
        if (isset($categoryId)) {
            $this->categoryManager = new CategoryManager();
            $categoryToUpdate = $this->categoryManager->getOneCategory($categoryId);
            $this->categories = $this->categoryManager->getAllCategories();

            $this->view = new View('categories');
            $this->view->generate(array('categories' => $this->categories, 'categoryToUpdate' => $categoryToUpdate));
        }
    }

    private function updateCategory($categoryId, $categoryTitle, $categoryImage)
    {
        if (isset($categoryId) && isset($categoryTitle) && isset($image)) {
            $this->categoryManager = new CategoryManager();
            $affectedCategory = $this->categoryManager->setChangedCategory($categoryId, $categoryTitle, $categoryImage);

            if($affectedCategory === false) {
                throw new Exception("Impossible de mettre à jour la catégorie !");
            } else  {
                header('Location: admin.php?url=categories&action=list');
                exit();
            }
        }
    }

    private function deleteCategory($categoryId)
    {
        if (isset($categoryId)) {
            $this->categoryManager = new CategoryManager();
            $deletedCategory = $this->categoryManager->setCategoryDeleted($categoryId);

            if($deletedCategory === false) {
                throw new \Exception("Impossible de supprimer la catégorie ! Vérifiez qu'aucun article n'est rattaché à cette catégorie puis recommencez.");
            } else {
                header('Location: admin.php?url=categories&action=list');
                exit();
            }
        }
    }
}