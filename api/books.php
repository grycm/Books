<?php
//tu łączymy ajax
$dir = dirname(__FILE__);

include($dir . '/src/Db.php');
include($dir . '/src/Book.php');

$conn = DB::connect();
//plik MUSI zwracać json!
header('Content-Type: application/json');

//sprawdzenie metody Requesta

//przypisanie do $data danych z żądania
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $data = $_GET;
    if (isset($_GET['id']) && intval($_GET['id'] > 0)) {
        //pojedyncza książka
        $books = Book::loadFromDb($conn, $_GET['id']);
    } else {
        //wszystkie książki
        $books = Book::loadFromDb($conn);
    } 
    
    //books jest zawsze tablicą
    
    echo json_encode($books);
    
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = $_POST;
} else if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    parse_str(file_get_contents('php://input'), $data);
} else if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    parse_str(file_get_contents('php://input'), $data);
    
    $id = $data['id'];
    
    Book::deleteFromDb($conn, $id);
    header('Location: ../index.php');
}