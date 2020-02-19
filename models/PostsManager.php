<?php

class PostsManager extends Manager
{

    private $postTable = 'post';
    private $categoryTable = 'category';
    private $postObject = 'Post';

    public function getPosts()
    {
        return $this->getAllPosts($this->postTable, $this->categoryTable, $this->postObject);
    }
    
    public function getPostsPages($postPerPage, $offset)
    {
        return $this->getAllPostsPages($this->postTable, $this->categoryTable, $this->postObject, $postPerPage, $offset);
    }

    public function getPost($id)
    {
        return $this->getOnePost($this->postTable, $this->categoryTable, $this->postObject, $id);
    }

    public function getCategoryPosts($catId)
    {
        return $this->getPostsByCategory($this->postTable, $this->categoryTable, $this->postObject, $catId);
    }

    public function getPostsNumber()
    {
        return $this->countPosts($this->postTable);
    }

    public function setUpdatePost($id, $title, $categoryId, $content)
    {
        return $this->updatePost($this->postTable, $id, $title, $categoryId, $content);
    }

    public function setDeletePost($id)
    {
        return $this->deletePost($this->postTable, $id);
    }

    public function setNewPost($title, $categoryId, $content)
    {
        return $this->insertPost($this->postTable, $title, $categoryId, $content);
    }
}
