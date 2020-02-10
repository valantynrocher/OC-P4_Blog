<?php

/**
 * 
 */
class CategoryManager extends Manager
{
    
    // récupère toutes les catégories dans la bdd
    public function getCategories()
    {
        return $this->getAllCategories('category', 'Category');
    }

    // récupère une catégorie avec son id
    public function getCategory($catId)
    {
        return $this->getOneCategory('category', 'Category', $catId);
    }
}
