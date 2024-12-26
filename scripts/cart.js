document.addEventListener('DOMContentLoaded', () => {
  const addToCartButtons = document.querySelectorAll('.add-to-cart-button');
  const removeFromCartButtons = document.querySelectorAll('.remove-from-cart');
  const cartCount = document.getElementById('cart-count');
  const cartDropdown = document.getElementById('cart-dropdown');

  function updateCartCount() {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    cartCount.innerText = cart.length;
  }

  function updateCartDropdown() {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    const cartItemsContainer = document.getElementById('cart-items');
    cartItemsContainer.innerHTML = '';

    if (cart.length === 0) {
      cartItemsContainer.innerHTML = '<li class="cart-item">Список пуст</li>';
      return;
    }

    cart.forEach(productId => {
      fetch(`get_product_info.php?id=${productId}`)
        .then(response => response.json())
        .then(product => {
          if (product) {
            const cartItem = document.createElement('li');
            cartItem.classList.add('cart-item');
            cartItem.innerHTML = `
                            <span class="cart-item-name">${product.name}</span>
                            <span class="cart-item-price">\$${product.price}</span>
                            <span class="remove-item" data-product-id="${product.id}">×</span>
                        `;
            cartItemsContainer.appendChild(cartItem);
          }
        })
        .catch(error => console.error('Error fetching product info:', error));
    });
  }

  document.addEventListener('click', function (event) {
    if (event.target.classList.contains('remove-item')) {
      const productId = event.target.dataset.productId;
      removeFromCart(productId);
    }
  });

  function addToCart(productId) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    if (!cart.includes(productId)) {
      cart.push(productId);
      localStorage.setItem('cart', JSON.stringify(cart));
      updateCartCount();
      updateCartDropdown();
    }
  }

  function removeFromCart(productId) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    const index = cart.indexOf(productId);
    if (index > -1) {
      cart.splice(index, 1);
      localStorage.setItem('cart', JSON.stringify(cart));
      updateCartCount();
      updateCartDropdown();
    }
  }

  addToCartButtons.forEach(button => {
    button.addEventListener('click', () => {
      const productId = button.dataset.productId;
      addToCart(productId);
    });
  });

  if (removeFromCartButtons) {
    removeFromCartButtons.forEach(button => {
      button.addEventListener('click', () => {
        const productId = button.dataset.productId;
        removeFromCart(productId);
      });
    });
  }

  updateCartCount();
  updateCartDropdown();
});