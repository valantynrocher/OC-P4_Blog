<?php

class Category
{

    private $id;
    private $chapter;
    private $image;

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

    public function setChapter($chapter)
    {
        if (is_string($chapter)) {
            $this->chapter = $chapter;
        }
    }

    public function setImage($image)
    {
        if (is_string($image)) {
            $this->image = $image;
        }
    }

    // getters
    public function id()
    {
        return $this->id;
    }

    public function chapter()
    {
        return $this->chapter;
    }

    public function image()
    {
        return $this->image;
    }
}