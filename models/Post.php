<?php

class Post
{
    // from post table
    private $post_id;
    private $post_title;
    private $category_id;
    private $post_content;
    private $post_creation_date_fr;
    private $post_update_date_fr;
    private $post_status;
    // from category table
    private $category_title;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    // hydratation des données
    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    // setters
    public function setPost_id($post_id)
    {
        $post_id = (int) $post_id;
        if ($post_id > 0) {
            $this->post_id = $post_id;
        }
    }

    public function setPost_title($post_title)
    {
        if (is_string($post_title)) {
            $this->post_title = $post_title;
        }
    }

    public function setCategory_id($category_id)
    {
        $category_id = (int) $category_id;
        if ($category_id > 0) {
            $this->category_id = $category_id;
        }
    }

    public function setPost_content($post_content)
    {
        if (is_string($post_content)) {
            $this->post_content = $post_content;
        }
    }

    public function setPost_creation_date_fr($post_creation_date_fr)
    {
        $this->post_creation_date_fr = $post_creation_date_fr;
    }

    public function setPost_update_date_fr($post_update_date_fr)
    {
        $this->post_update_date_fr = $post_update_date_fr;
    }

    public function setPost_status($post_status) {
        if (is_string($post_status)) {
            if ($post_status === 'progress' || $post_status === 'public' || $post_status === 'trash')
            $this->post_status = $post_status;
        }
    }

    public function setCategory_title($category_title)
    {
        if (is_string($category_title)) {
            $this->category_title = $category_title;
        }
    }

    // getters
    public function postId()
    {
        return $this->post_id;
    }

    public function postTitle()
    {
        return $this->post_title;
    }

    public function categoryId()
    {
        return $this->category_id;
    }

    public function postContent()
    {
        return $this->post_content;
    }

    public function postCreationDateFr()
    {
        return $this->post_creation_date_fr;
    }

    public function postUpdateDateFr()
    {
        return $this->post_update_date_fr;
    }

    public function postStatus()
    {
        return $this->post_status;
    }

    public function categoryTitle()
    {
        return $this->category_title;
    }
}