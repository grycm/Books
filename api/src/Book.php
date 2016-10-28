<?php

class Book implements JsonSerializable
{
    private $id;
    private $title;
    private $author;
    private $description;
    
    function __construct()
    {
        $this->id = -1;
        $this->title = '';
        $this->author = '';
        $this->description = '';
    }
    
    public function create(mysqli $conn)
    {
        
    }
    
    public function update(mysqli $conn, $id)
    {
        
    }

    public static function loadFromDb(mysqli $conn, $id = null)
    {
        //sprawdzenie, czy chcemy jedną książkę, czy wszystkie
        if (!is_null($id)) {
            $result = $conn->query('SELECT * FROM books WHERE id=' . intval($id));
        } else {
            $result = $conn->query('SELECT * FROM books');
        }
        $bookList = [];
        
        if ($result && $result->num_rows > 0) {
            foreach ($result as $row) {
                $dbBook = new Book();
                $dbBook->id = $row['id'];
                $dbBook->title = $row['title'];
                $dbBook->author = $row['author'];
                $dbBook->description = $row['description'];
                
                $bookList[] = json_encode($dbBook);
            }
        }
        
        return $bookList; //Zawsze zwracamy tablicę, nawet dla jednego elementu
        
    }
    
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'author' => $this->author,
            'description' => $this->description
        ];
    }
    
    public static function deleteFromDb(mysqli $conn, $id)
    {
        if (!is_null($id)) {
            $result = $conn->query('DELETE FROM books WHERE id=' . intval($id));
        }
        
        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setAuthor($author)
    {
        $this->author = $author;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }


}