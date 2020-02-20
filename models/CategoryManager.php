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

    public function setNewCategory($chapter, $image)
    {
        return $this->insertCategory($this->categoryTable, $chapter, $image);
    }

    public function setUpdateCategory($id, $chapter, $image)
    {
        return $this->updateCategory($this->categoryTable, $id, $chapter, $image);
    }

    public function setDeleteCategory($id)
    {
        return $this->deleteCategory($this->categoryTable, $id);
    }
}
