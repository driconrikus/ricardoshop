document.addEventListener('DOMContentLoaded', event =>{
    const cookies = document.cookie.split(';');
    let cookie = null;
    cookies.forEach(item =>{
        if(item.indexOf('items') > -1){
            cookie = item;
        }
    });

    if(cookie != null){
        const count = cookie.split('=')[1];
        console.log(count);
        document.querySelector('balance').innerHTML = balance;
        document.querySelector('.btn-cart').innerHTML = `(${data.info.count}) <i class="fas fa-shopping-cart"></i> Shopping Cart`;
    }
});

const bCart = document.querySelector('.btn-cart');

bCart.addEventListener('click', event =>{
    const cartContainer = document.querySelector('#cart-container');

    if(cartContainer.style.display == ''){
        cartContainer.style.display = 'block';
        updateCartUI();
    } else {
        cartContainer.style.display = '';
    }
});

function updateCartUI(){
    fetch('http://localhost/ricardoshop/includes/cart-api.php?action=show')
    .then(response => response.json())
    .then(data => {
        console.log(data);

        let tableCont = document.querySelector('#table');
        let balance = 100;
        let count = `${data.info.count}`;
        let finalPrice = `${data.info.total}`;
        let html = '';
        let balanceUI = `<p><i class="fas fa-dollar-sign"></i> Balance: ${balance.toFixed(2)} USD</p><hr/>`;

        let shipping = `<div class='shipping'>
        <p><i class="fas fa-truck"></i>Shipping options</p>
        <form>
          <input type='radio' id='pickup' name='shipping' value='free'>Pick-up (FREE)
          <input type='radio' id='ups' name='shipping'  value='ups'> UPS ($5.00)
          <button class='btn-checkout'><i class="fas fa-dollar-sign" aria-hidden="true"></i>Checkout</button>
    </form>
        </div>`;

      
        
        if(count > 0)
        {
        data.items.forEach(element =>{
            html += `
                <div class='row'>
                    <div class='image'>
                        <img src='${element.image}' width='100' />
                        </div>

                        <div class='info'>
                            <input type='hidden' value='${element.id}' />
                            <div class='nombre'>${element.name}</div>
                            <div>${element.quantity} items of $${element.price}</div>
                            <div>Subtotal: $${element.subtotal.toFixed(2)}</div>
                            <hr/>
                            <div class='buttons'><button class='btn-remove'><i class="fa fa-trash" aria-hidden="true"></i>Remove 1 from cart</button>
                            </div>
                        </div>
                    </div>
            `;
        });


        finalPrice = `<hr/><p>Total: $${data.info.total.toFixed(2)}</p><hr/>`;
        tableCont.innerHTML = balanceUI + html + finalPrice + shipping;
        
    } else {
        tableCont.innerHTML = balanceUI + '<p>Your cart is empty</p>';
    }

        document.cookie = `items=${data.info.count}`;

        bCart.innerHTML = `(${data.info.count}) <i class="fas fa-shopping-cart"></i> Shopping Cart`;

        document.querySelectorAll('.btn-remove').forEach(boton =>{
            boton.addEventListener('click', e =>{
                const id = boton.parentElement.parentElement.children[0].value;

                removeItemFromCart(id);
            });
        });
    });
}

const buttons = document.querySelectorAll('.btn-add');

buttons.forEach(boton =>{
    const id = boton.parentElement.parentElement.children[0].value;

    boton.addEventListener('click', e =>{
        addItemToCart(id);
    });
});



function removeItemFromCart(id){
    fetch('http://localhost/ricardoshop/includes/cart-api.php?action=remove&id=' + id)
    .then(res => res.json())
    .then(data =>{
        console.log(data.status);
        updateCartUI();
    });
}

function addItemToCart(id){
    fetch('http://localhost/ricardoshop/includes/cart-api.php?action=add&id=' + id)
    .then(res => res.json())
    .then(data =>{
        console.log(data.status);
        updateCartUI();
    });
}