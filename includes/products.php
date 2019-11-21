<?php
    include_once 'db.php';

    class products extends db 
    {
       function __construct()
       {
           parent::__construct();
       }
       
       // Here we fetch a single item from our database
       public function get($id)
       {
           $query = $this->connect()->prepare('SELECT * FROM items WHERE id = :id LIMIT 0,12');
           $query->execute(['id' => $id]);

           $row = $query->fetch();
           return [
               'id'             => $row['id'],
               'name'           => $row['name'],
               'description'    => $row['description'],
               'rating'         => $row['rating'],
               'price'          => $row['price'],
               'image'          => $row['image'],
               'category'       => $row['category'],
           ];
           
       }

       // Here we fetch all of our items belonging to a single category
           public function getItemsByCategory($category)
       {
        $query = $this->connect()->prepare('SELECT * FROM items WHERE category = :cat LIMIT 0,12');
        $query->execute(['cat' => $category]);

        $items = [];

        while($row = $query->fetch(PDO::FETCH_ASSOC))
        {
            $item =  [
                'id'             => $row['id'],
                'name'           => $row['name'],
                'description'    => $row['description'],
                'rating'         => $row['rating'],
                'price'          => $row['price'],
                'image'          => $row['image'],
                'category'       => $row['category'],
            ];
            array_push($items, $item);
        }
        
        
        return $items;
       }
      
    }
