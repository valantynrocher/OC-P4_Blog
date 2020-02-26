<?php 
require_once 'views/admin/View.php';

class CategoriesController
{

    private $categoryManager;
    public $categories;
    private $view;
    public $actionError = 'Action impossible : des données n\'ont pas été transmises';

    public function __construct()
    {
        $this->categoryManager = new CategoryManager();

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
                    throw new Exception($this->actionError);
                }
                break;
            case 'edit':
                if (isset($_GET['categoryId'])) {
                    $this->editCategory($_GET['categoryId']);
                } else {
                    throw new Exception($this->actionError);
                }
                break;
            case 'update':
                if (isset($_GET['categoryId']) && isset($_POST['categoryTitle']) && isset($_POST['categoryImage'])) {
                    $this->updateCategory($_GET['categoryId'], $_POST['categoryTitle'], $_POST['categoryImage']);
                } else {
                    throw new Exception($this->actionError);
                }
                break;
            case 'delete':
                if (isset($_GET['categoryId'])) {
                    $this->deleteCategory($_GET['categoryId']);
                } else {
                    throw new Exception($this->actionError);
                }
                break;
            default:
                throw new Exception('Action impossible !');
        }
    }

    private function listCategories()
    {
        $this->categories = $this->categoryManager->getAllCategories();

        $this->view = new View('categories/listCategories');
        $this->view->generate(array('categories' => $this->categories));
    }

    private function createCategory()
    {
        $this->view = new View('categories/createCategory');
        $this->view->generate(array());
    }

    private function insertCategory($categoryTitle, $categoryImage)
    {
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
        $categoryToUpdate = $this->categoryManager->getOneCategory($categoryId);
        $this->categories = $this->categoryManager->getAllCategories();

        $this->view = new View('categories/editCategory');
        $this->view->generate(array('categories' => $this->categories, 'categoryToUpdate' => $categoryToUpdate));
    }

    private function updateCategory($categoryId, $categoryTitle, $categoryImage)
    {
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
        $deletedCategory = $this->categoryManager->setCategoryDeleted($categoryId);

        if($deletedCategory === false) {
            throw new \Exception("Impossible de supprimer la catégorie ! Vérifiez qu'aucun article n'est attribué à cette catégorie puis recommencez.");
        } else {
            header('Location: admin.php?url=categories&action=list');
            exit();
        }
    }
}