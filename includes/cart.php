<?php
    include_once 'session.php';

    class cart extends session
    {
        function __construct()
        {
            parent::__construct('cart');
        }
        // this function loads the cart and initializes the session
         public function load()
        {
            if($this->getValue() == NULL)
            {
                return [];
            }

            return $this->getValue();
        }

    // This function adds items to the cart

        public function add($id)
        {
            if($this->getValue() == NULL)
            {
                $items = [];
            }
            else
            {
                $items = json_decode($this->getValue(), 1);

                for($i=0; $i < sizeof($items); $i++)
                {
                    if($items[$i]['id'] == $id)
                    {
                        $items[$i]['quantity']++;
                        $this->setValue(json_encode($items));

                        return $this->getValue();
                    }
                }
            }

            $item = ['id' => (int)$id, 'quantity' => 1];

            array_push($items, $item);
    
            $this->setValue(json_encode($items));
    
            return $this->getValue();
        }

        // This function removes items from the cart
       public function remove($id)
       {

               $items = json_decode($this->getValue(), 1);
               for($i = 0; $i < sizeof($items); $i++)
               {
                if($items[$i]['id'] == $id)
                {
                  $items[$i]['quantity']--;
                  
                  if($items[$i]['quantity'] == 0)
                  {
                      unset($items[$i]);
                      $items = array_values($items);
                  }

                  $this->setValue(json_encode($items));
                  return true;
                }
               }
           
       }
       

    }