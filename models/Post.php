<?php

class Post
{

    private $id;
    private $title;
    private $category_id;
    private $content;
    private $creation_date_fr;
    private $update_date_fr;
    private $status;
    private $chapter;

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
    public function setId($id)
    {
        $id = (int) $id;
        if ($id > 0) {
            $this->id = $id;
        }
    }

    public function setTitle($title)
    {
        if (is_string($title)) {
            $this->title = $title;
        }
    }

    public function setCategoryId($category_id)
    {
        $category_id = (int) $category_id;
        if ($category_id > 0) {
            $this->category_id = $category_id;
        }
    }

    public function setContent($content)
    {
        if (is_string($content)) {
            $this->content = $content;
        }
    }

    public function setCreation_date_fr($creation_date_fr)
    {
        $this->creation_date_fr = $creation_date_fr;
    }

    public function setUpdate_date_fr($update_date_fr)
    {
        $this->update_date_fr = $update_date_fr;
    }

    public function setStatus($status) {
        if (is_string($status)) {
            if ($status === 'progress' || $status === 'public' || $status === 'trash')
            $this->status = $status;
        }
    }

    public function setChapter($chapter)
    {
        if (is_string($chapter)) {
            $this->chapter = $chapter;
        }
    }

    // getters
    public function id()
    {
        return $this->id;
    }

    public function title()
    {
        return $this->title;
    }

    public function categoryId()
    {
        return $this->category_id;
    }

    public function content()
    {
        return $this->content;
    }

    public function creationDateFr()
    {
        return $this->creation_date_fr;
    }

    public function updateDateFr()
    {
        return $this->update_date_fr;
    }

    public function status()
    {
        return $this->status;
    }

    public function chapter()
    {
        return $this->chapter;
    }
}