<div class="article">
    <input type="hidden" id="id" value="<?php echo $item['id']; ?>">
    <div class="image"><img src="<?php echo $item['image']; ?>" /></div>
    <div class="title"><?php echo $item['name']; ?></div>
    <div class="description"><?php echo $item['description']; ?></div>
    <div class="rating"><?php for($i = 0; $i < $item['rating']; $i++){
                   echo "<i class='fas fa-star' aria-hidden='true'></i>";
    } ?></div>
    <div class="price"><?php echo $item['price']; ?>$</div>
    <div class="buttons">
        <button class='btn-add'><i class="fas fa-shopping-cart"></i>Add to cart</button>
        </div>
</div> 