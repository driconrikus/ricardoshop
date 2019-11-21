<?php
    include_once 'products.php';

    if(isset($_GET['category']))
    {
        $category = $_GET['category'];
        
        if($category == '')
        {
            echo json_encode(['statuscode' => 400, 'response' => 'This category does not exist']);
        }
        else
        {

            $products = new products();
            $items = $products->getItemsByCategory($category);

            echo json_encode(['statuscode' => 200, 'items' => $items]);
        }
    }
    else if(isset($_GET['get-item']))
    {
        $id = $_GET['get-item'];

        if($id == '')
        {
            echo json_encode(['statuscode' => 400, 'response' => 'No value for id']);
        } 
        else
        {
            $products = new products();
            $item = $products->get($id);
            echo json_encode(['statuscode' => 200, 'item' => $item]);
        }
    }
     else
      {
        echo json_encode(['statuscode' => 400, 'response' => 'No action']);
    }