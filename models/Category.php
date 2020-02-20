<?php

class Category
{
    // from category table
    private $category_id;
    private $category_title;
    private $category_image;

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
    public function setCategory_id($category_id)
    {
        $category_id = (int) $category_id;
        if ($category_id > 0) {
            $this->category_id = $category_id;
        }
    }

    public function setCategory_title($category_title)
    {
        if (is_string($category_title)) {
            $this->category_title = $category_title;
        }
    }

    public function setCategory_image($category_image)
    {
        if (is_string($category_image)) {
            $this->category_image = $category_image;
        }
    }

    // getters
    public function categoryId()
    {
        return $this->category_id;
    }

    public function categoryTitle()
    {
        return $this->category_title;
    }

    public function categoryImage()
    {
        return $this->category_image;
    }
}