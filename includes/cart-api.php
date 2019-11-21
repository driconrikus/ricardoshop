<?php
    include_once 'cart.php';

    if(isset($_GET['action']))
    {
        $action = $_GET['action'];
        $cart = new cart();
        //show, add, remove
        switch($action) 
        {
            case 'show':
                show($cart);
            break;

            case 'add':
                add($cart);
            break;

            case 'remove':
                remove($cart);
            break;

            default:
        }
    } 
    else
    {
        echo json_encode(['statuscode' => 404,
        'response' => 'Cannot process request']);
    }

    function show($cart)
    {
        // loads the array into the session
        // check database to update product values
        $cartItems = json_decode($cart->load(), 1);
        $fullItems = [];
        $total = 0;
        $totalItems = 0;
        foreach($cartItems as $cartItem)
        {   
            $httpRequest = file_get_contents('http://localhost/ricardoshop/includes/products-api.php?get-item=' . $cartItem['id']);
            $itemProduct = json_decode($httpRequest, 1)['item'];

            $itemProduct['quantity'] = $cartItem['quantity'];
            $itemProduct['subtotal'] = $itemProduct['quantity'] * $itemProduct['price'];
           

            $total += $itemProduct['subtotal'];
            $totalItems += $itemProduct['quantity'];

            array_push($fullItems, $itemProduct);
        }
        $resArray = array('info' => ['count' => $totalItems, 'total' => $total], 'items' =>$fullItems);

        echo json_encode($resArray);
    }

    function add($cart)
    {
        if(isset($_GET['id']))
        {
            $res = $cart->add($_GET['id']);
            echo $res;
        }
        else
        {
            //error
            echo json_encode(['statuscode' => 404,
            'response' => 'Your request could not be processed, id is empty']);
        }
    }

    
    function remove($cart){
        if(isset($_GET['id'])){
            $res = $cart->remove($_GET['id']);
            if($res)
            {
                echo json_encode(['statuscode' => 200]);
            } 
            else
            {
                echo json_encode(['statuscode' => 400]);
            }
        
        } else {
            echo json_encode(['statuscode' => 404,
            'response' => 'Your request could not be processed, id is empty']);
        }
    }
