<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title></title>
  <meta name="author" content="">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" rel="stylesheet">
  <link href="normalize.css" rel="stylesheet">
  <link href="main.css" rel="stylesheet">
  <script src="main.js" async></script>
</head>

<body>
  <?php 
      include_once 'layout/menu.php';
      ?>

      <main>
        <?php
       
          $response = json_decode(file_get_contents('http://localhost/ricardoshop/includes/products-api.php?category=store'), true);
        
          if($response['statuscode'] == 200)
          {
            foreach($response['items'] as $item)
            {
              include 'layout/items.php';
            }
          }  
          else
          {
            echo "error";
          }

          ?>
          </main>
          
          <p align="center">Note: still working on it! you might need to press ctrl+F5 to reload the cached js file</p>

</body>

</html>