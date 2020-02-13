<?php

class PostsManager extends Manager
{

    private $postTable = 'post';
    private $categoryTable = 'category';
    private $postObject = 'Post';

    // tous les articles
    public function getPosts()
    {
        return $this->getAllPosts($this->postTable, $this->categoryTable, $this->postObject);
    }
    
    // tous les articles avec pagination
    public function getPostsPages($postPerPage, $offset)
    {
        return $this->getAllPostsPages($this->postTable, $this->categoryTable, $this->postObject, $postPerPage, $offset);
    }

    // un article selon un id
    public function getPost($id)
    {
        return $this->getOnePost($this->postTable, $this->categoryTable, $this->postObject, $id);
    }

    // articles de la catégorie selon un id
    public function getCategoryPosts($catId)
    {
        return $this->getPostsByCategory($this->postTable, $this->categoryTable, $this->postObject, $catId);
    }

    // comptage d'articles
    public function getPostsNumber()
    {
        return $this->countPost($this->postTable);
    }

    // modification d'un article
    public function setUpdatePost($id, $title, $categoryId, $content)
    {
        return $this->updatePost($this->postTable, $id, $title, $categoryId, $content);
    }

    // supprimer un article
    public function setDeletePost($id)
    {
        return $this->deletePost($this->postTable, $id);
    }

    // ajout d'un nouvel article
    public function setNewPost($title, $categoryId, $content)
    {
        return $this->insertPost($this->postTable, $title, $categoryId, $content);
    }
}
