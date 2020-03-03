<?php 
require_once 'views/View.php';
require_once 'controllers/Controller.php';

class CategoriesController extends Controller
{
    /**
     * Action 'index' (default)
     * Generates view to list categories
     */
    public function index()
    {
        $this->generateView(array('categories' => $this->getCategories()));
    }

    /**
     * Action 'create'
     * Generates view for new category page
     */
    public function create()
    {
        $this->generateView(array());
    }

    /**
     * Action 'edit'
     * Generates view for edit category page
     */
    public function edit()
    {
        if (isset($_GET['categoryId'])) {
            $categoryId = htmlspecialchars(strip_tags((int)$_GET['categoryId']));

            if (filter_var($categoryId, FILTER_VALIDATE_INT)) {
                $categoryToUpdate = $this->getCategoryManager()->getOneCategory($categoryId);
                $this->generateView(array('categories' => $this->getCategories(), 'categoryToUpdate' => $categoryToUpdate));
            } else {
                throw new Exception($this->actionError);
            }
        } else {
            throw new Exception($this->actionError);
        }
    }

    /**
     * Action 'insert'
     * Call Category Manager to insert new category in databse
     * Redirect on index
     */
    public function insert()
    {
        if (isset($_POST['categoryTitle']) && isset($_POST['categoryImage'])) {
            $categoryTitle = htmlspecialchars(strip_tags($_POST['categoryTitle']));
            $categoryImage = htmlspecialchars(strip_tags($_POST['categoryImage']));
            $newCategory = $this->getCategoryManager()->setNewCategorysetNewCategory($categoryTitle, $categoryImage);
    
            if($newCategory === false) {
                throw new \Exception("Impossible d'ajouter la catégorie !");
            } else {
                header('Location: admin.php?url=categories');
                exit();
            }
        } else {
            throw new Exception($this->actionError);
        }
    }

    /**
     * Action 'update'
     * Call Category Manager to update one category in databse
     * Redirect on index
     */
    public function update()
    {
        if (isset($_GET['categoryId']) && isset($_POST['categoryTitle']) && isset($_POST['categoryImage'])) {
            $categoryId = htmlspecialchars(strip_tags((int)$_GET['categoryId']));
            $categoryTitle = htmlspecialchars(strip_tags($_POST['categoryTitle']));
            $categoryImage = htmlspecialchars(strip_tags($_POST['categoryImage']));

            if (filter_var($categoryId, FILTER_VALIDATE_INT)) {
                $affectedCategory = $this->getCategoryManager()->setChangedCategory($categoryId, $categoryTitle, $categoryImage);

                if($affectedCategory === false) {
                    throw new Exception("Impossible de mettre à jour la catégorie !");
                } else  {
                    header('Location: admin.php?url=categories');
                    exit();
                }
            } else {
                throw new Exception($this->actionError);
            }
        } else {
            throw new Exception($this->actionError);
        }
    }

    /**
     * Action 'delete'
     * Call Category Manager to delete one category in databse
     * Redirect on index
     */
    public function delete()
    {
        if (isset($_GET['categoryId'])) {
            $categoryId = htmlspecialchars(strip_tags((int)$_GET['categoryId']));

            if (filter_var($categoryId, FILTER_VALIDATE_INT)) {
                $deletedCategory = $this->getCategoryManager()->setCategoryDeleted($categoryId);

                if($deletedCategory === false) {
                    throw new \Exception("Impossible de supprimer la catégorie ! Vérifiez qu'aucun article n'est attribué à cette catégorie puis recommencez.");
                } else {
                    header('Location: admin.php?url=categories');
                    exit();
                }
            } else {
                throw new Exception($this->actionError);
            }
        } else {
            throw new Exception($this->actionError);
        }
    }
}