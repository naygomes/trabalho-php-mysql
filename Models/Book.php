<?php
namespace Models;
require_once "DB.php";

class Book{
    public int $ISBN;
    public string $bookName;
    public string $releaseYear;
    public string $publisher;
    public string $aid;

    static public function create(\Request $request):Book{
            $pdo = \DB::connect();
            $stm = $pdo->prepare("INSERT INTO books (`ISBN`,`bookName`,`releaseYear`,`publisher`,`aid`) VALUES (?,?,?,?,?)");
            $stm->execute([$request->ISBN,$request->bookName,$request->releaseYear,$request->publisher,$request->aid]);
            $stm->closeCursor();
            return self::find($request->ISBN);
        }

    static public function all():array{
        $pdo = \DB::connect();
        $stm = $pdo->prepare("Select `ISBN`,`bookName`,`releaseYear`,`publisher`,`name`,`surname` from books LEFT JOIN Authors ON books.aid = authors.aid");
        $stm->execute();
        $books = $stm->fetchAll(\PDO::FETCH_ASSOC);
        return $books;
    }

    static public function find($ISBN):Book{
        $pdo = \DB::connect();
        $stm = $pdo->prepare("Select `ISBN`,`bookName`,`releaseYear`,`publisher`,`name`,`surname` from books LEFT JOIN Authors ON books.aid = authors.aid where ISBN=?");
        
        $stm->setFetchMode(\PDO::FETCH_CLASS, 'Models\Book');
        $stm->execute([$ISBN]);
        $book = $stm->fetch();
        $stm->closeCursor();
        return $book;
    }

    static public function update(\Request $request):Book{
        $pdo = \DB::connect();
        $query = "UPDATE books SET " ;
        $arr = [];
        $parameters = [];
        if($request->bookName){
            array_push($parameters,'`bookName`=? ');
            array_push($arr,$request->bookName);
        }
        if($request->releaseYear){
            array_push($parameters,'`releaseYear`=? ');
            array_push($arr,$request->releaseYear);
        }
        if($request->publisher){
            array_push($parameters,'`publisher`=? ');
            array_push($arr,$request->publisher);
        }
        if($request->aid){
            array_push($parameters,'`aid`=? ');
            array_push($arr,$request->aid);
        }
        $query .= implode(',',$parameters) . 'where `ISBN`=?';
        array_push($arr,$request->ISBN);
        $stm = $pdo->prepare($query);
        $stm->execute($arr);
        return self::find($request->ISBN);
    }

    static public function delete(\Request $request):int{
        $pdo = \DB::connect();
        $stm = $pdo->prepare("Delete from books where ISBN=?");
        $stm->execute([$request->ISBN]);
        //$stm->closeCursor();
        echo 'Deletado com Sucesso!';
        return $stm->rowCount();

    }

   
}