<?php

/**
 * 
 */
class CategoryManager extends Manager
{
    private $categoryTable = 'category';
    private $categoryObject = 'Category';
    
    public function getCategories()
    {
        return $this->getAllCategories($this->categoryTable, $this->categoryObject);
    }

    public function getCategory($catId)
    {
        return $this->getOneCategory($this->categoryTable, $this->categoryObject, $catId);
    }

    public function getCategoriesNumber()
    {
        return $this->countCategories($this->categoryTable);
    }

    public function setNewCategory($name, $image)
    {
        return $this->insertCategory($this->categoryTable, $name, $image);
    }

    public function setUpdateCategory($id, $name, $image)
    {
        return $this->updateCategory($this->categoryTable, $id, $name, $image);
    }

    public function setDeleteCategory($id)
    {
        return $this->deleteCategory($this->categoryTable, $id);
    }
}
