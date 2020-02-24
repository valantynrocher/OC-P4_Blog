<?php

class CategoryManager extends Manager
{
    
    private $categoryObject = 'Category';

    /* =================================================================================================================================
        REQUESTS SETTERS
    ================================================================================================================================= */

    protected function selectAllCategories($categoryTable, $obj)
    {
        $this->getBdd();
        $var = [];
        $req = self::$bdd->query(
            "SELECT category_id, category_title, category_image 
            FROM $categoryTable 
            ORDER BY category_id 
            ASC"
        );

        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $var[] = new $obj($data);
        }
        return $var;
        $req->closeCursor();
    }

    protected function selectOneCategory($categoryTable, $obj, $categoryId)
    {
        $this->getBdd();
        $var = [];
        $req = self::$bdd->prepare(
            "SELECT category_id, category_title, category_image
            FROM $categoryTable
            WHERE category_id = ?"
        );
        $req->execute(array($categoryId));

        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $var[] = new $obj($data);
        }
        return $var;
        $req->closeCursor();
    }

    protected function countAllCategoriesNumber($categoryTable)
    {
        $this->getBdd();
        $req = self::$bdd->query("SELECT count(category_id) FROM $categoryTable");
        $count = (int)$req->fetch(PDO::FETCH_NUM)[0];

        return $count;
        $req->closeCursor();
    }

    protected function insertNewCategory($categoryTable, $categoryTitle, $categoryImage)
    {
        $this->getBdd();
        $req = self::$bdd->prepare(
            "INSERT INTO $categoryTable(category_title, category_image) 
            VALUES(?, ?)"
        );
        $affectedCategory = $req->execute(array(
            $categoryTitle,
            $categoryImage
        ));

        return $affectedCategory;
        $req->closeCursor();
    }

    protected function updateChangedCategory($categoryTable, $categoryId, $categoryTitle, $categoryImage)
    {
        $this->getBdd();
        $req = self::$bdd->prepare(
            "UPDATE $categoryTable
            SET category_title = :new_category_title, category_image = :new_category_image
            WHERE category_id = $categoryId"
        );
        $affectedCategory = $req->execute(array(
            'new_category_title' => $categoryTitle,
            'new_category_image' => $categoryImage
        ));

        return $affectedCategory;
    }

    protected function deleteCategoryDeleted($categoryTable, $categoryId)
    {
        $this->getBdd();
        $req = self::$bdd->prepare(
            "DELETE FROM $categoryTable
            WHERE category_id = ?"
        );
        $deletedCategory = $req->execute(array(
            $categoryId
        ));

        return $deletedCategory;
    }

    protected function selectLastFiveCategories($categoryTable, $obj)
    {
        $this->getBdd();
        $var = [];
        $req = self::$bdd->query(
            "SELECT category_title
            FROM $categoryTable 
            ORDER BY category_id 
            DESC
            LIMIT 0, 5"
        );

        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $var[] = new $obj($data);
        }
        return $var;
        $req->closeCursor();
    }

    protected function countCategoriesNumber($categoryTable)
    {
        $this->getBdd();
        $req = self::$bdd->query("SELECT count(category_id) FROM $categoryTable");
        $count = (int)$req->fetch(PDO::FETCH_NUM)[0];

        return $count;
        $req->closeCursor();
    }

    /* =================================================================================================================================
        REQUESTS GETTERS
    ================================================================================================================================= */
    
    public function getAllCategories()
    {
        return $this->selectAllCategories($this->categoryTable, $this->categoryObject);
    }

    public function getOneCategory($categoryId)
    {
        return $this->selectOneCategory($this->categoryTable, $this->categoryObject, $categoryId);
    }

    public function getAllCategoriesNumber()
    {
        return $this->countAllCategoriesNumber($this->categoryTable);
    }

    public function setNewCategory($categoryTitle, $categoryImage)
    {
        return $this->insertNewCategory($this->categoryTable, $categoryTitle, $categoryImage);
    }

    public function setChangedCategory($categoryId, $categoryTitle, $categoryImage)
    {
        return $this->updateChangedCategory($this->categoryTable, $categoryId, $categoryTitle, $categoryImage);
    }

    public function setCategoryDeleted($categoryId)
    {
        return $this->deleteCategoryDeleted($this->categoryTable, $categoryId);
    }

    public function getLastFiveCategories()
    {
        return $this->selectLastFiveCategories($this->categoryTable, $this->categoryObject);
    }

    public function getCategoriesNumber()
    {
        return $this->countCategoriesNumber($this->categoryTable);
    }
}
