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
                if (isset($_POST['categoryTitle']) && isset($_POST['categoryImage'])) {
                    $this->insertCategory($_POST['categoryTitle'], $_POST['categoryImage']);
                } else {
                    throw new Exception('Des données n\'ont pas pu être récupérées');
                }
                break;
            case 'edit':
                if (isset($_GET['categoryId'])) {
                    $this->editCategory($_GET['categoryId']);
                } else {
                    throw new Exception('Des données n\'ont pas pu être récupérées');
                }
                break;
            case 'update':
                if (isset($_GET['categoryId']) && isset($_POST['categoryTitle']) && isset($_POST['categoryImage'])) {
                    $this->updateCategory($_GET['categoryId'], $_POST['categoryTitle'], $_POST['categoryImage']);
                } else {
                    throw new Exception('Des données n\'ont pas pu être récupérées');
                }
                break;
            case 'delete':
                if (isset($_GET['categoryId'])) {
                    $this->deleteCategory($_GET['categoryId']);
                } else {
                    throw new Exception('Des données n\'ont pas pu être récupérées');
                }
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
        $this->categoryManager = new CategoryManager();
        $newCategory = $this->categoryManager->setNewCategorysetNewCategory($categoryTitle, $categoryImage);
    
        if($newCategory === false) {
            throw new \Exception("Impossible d'ajouter la catégorie !");
        } else {
            header('Location: admin.php?url=categories&action=list');
            exit();
        }
    }

    private function editCategory($categoryId)
    {
        $this->categoryManager = new CategoryManager();
        $categoryToUpdate = $this->categoryManager->getOneCategory($categoryId);
        $this->categories = $this->categoryManager->getAllCategories();

        $this->view = new View('categories');
        $this->view->generate(array('categories' => $this->categories, 'categoryToUpdate' => $categoryToUpdate));
    }

    private function updateCategory($categoryId, $categoryTitle, $categoryImage)
    {
        $this->categoryManager = new CategoryManager();
        $affectedCategory = $this->categoryManager->setChangedCategory($categoryId, $categoryTitle, $categoryImage);

        if($affectedCategory === false) {
            throw new Exception("Impossible de mettre à jour la catégorie !");
        } else  {
            header('Location: admin.php?url=categories&action=list');
            exit();
        }
    }

    private function deleteCategory($categoryId)
    {
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