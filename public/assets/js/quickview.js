document.addEventListener('DOMContentLoaded', function() {
    // Get all quick view buttons
    const quickViewButtons = document.querySelectorAll('[data-bs-toggle="modal"][data-bs-target="#quickview"]');

    // Add click event listener to each button
    quickViewButtons.forEach(button => {
        button.addEventListener('click', async function(e) {
            e.preventDefault();

            // Get product data from the card/parent
            const productCard = this.closest('.product-item');
            const productId = productCard.dataset.productId;

            // Show loading state in modal
            document.querySelector('#quickview .modal-body').innerHTML = `
                <div class="text-center p-5">
                    <i class="fas fa-spinner fa-spin fa-3x"></i>
                    <p class="mt-3">Loading product details...</p>
                </div>
            `;

            try {
                const response = await fetch(`/quick-view/${productId}`);
                console.log(response);
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                const data = await response.json();
                if (data.success) {
                    updateQuickViewModal(data.product);
                } else {
                    showError();
                }
            } catch (error) {
                console.error('Error fetching product details:', error);
                showError();
            }
        });
    });

    // Function to update modal with product data
    function updateQuickViewModal(product) {
        const modal = document.getElementById('quickview');

        // Create star rating HTML
        let stars = '';
        const fullStars = Math.floor(product.rating);
        const hasHalfStar = product.rating % 1 >= 0.5;

        for (let i = 1; i <= 5; i++) {
            if (i <= fullStars) {
                stars += '<i class="fas fa-star"></i>';
            } else if (i === fullStars + 1 && hasHalfStar) {
                stars += '<i class="fas fa-star-half-alt"></i>';
            } else {
                stars += '<i class="far fa-star"></i>';
            }
        }

        // Update modal content
        modal.querySelector('.modal-body').innerHTML = `
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <div class="quickview-img">
                        <img src="${product.image}" alt="${product.name}">
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <div class="quickview-content">
                        <h4 class="quickview-title">${product.name}</h4>
                        <div class="quickview-rating">
                            ${stars}
                            <span class="rating-count"> (${product.review_count} Customer Reviews)</span>
                        </div>
                        <div class="quickview-price">
                            <h5>
                                ${product.discount ? `<del>$${product.price.toFixed(2)}</del>` : ''}
                                <span>$${product.final_price.toFixed(2)}</span>
                            </h5>
                        </div>
                        <ul class="quickview-list">
                            <li>Brand:<span>${product.brand || 'N/A'}</span></li>
                            <li>Category:<span>${product.category}</span></li>
                            <li>Stock:<span class="stock">${product.stock}</span></li>
                            <li>Code:<span>${product.code || 'N/A'}</span></li>
                        </ul>
                        <div class="quickview-cart">
                            <button class="theme-btn add-to-cart-btn" data-product-id="${product.id}">Add to cart</button>
                        </div>
                        // <div class="quickview-social">
                        //     <span>Share:</span>
                        //     <a href="#"><i class="fab fa-facebook-f"></i></a>
                        //     <a href="#"><i class="fab fa-x-twitter"></i></a>
                        //     <a href="#"><i class="fab fa-pinterest-p"></i></a>
                        //     <a href="#"><i class="fab fa-instagram"></i></a>
                        //     <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        // </div>
                    </div>
                </div>
            </div>
        `;

        // Add event listener for Add to Cart button in modal
        const addToCartBtn = modal.querySelector('.add-to-cart-btn');
        if (addToCartBtn) {
            addToCartBtn.addEventListener('click', function() {
                const productId = this.dataset.productId;
                addToCart(productId, 1); // Add 1 quantity of the product
            });
        }
    }

    // Show error in modal if fetching fails
    function showError() {
        document.querySelector('#quickview .modal-body').innerHTML = `
            <div class="text-center p-5">
                <i class="far fa-times-circle fa-3x text-danger"></i>
                <p class="mt-3">Sorry, we couldn't load the product details. Please try again.</p>
            </div>
        `;
    }

    // Function to add product to cart
    async function addToCart(productId, quantity) {
        try {
            const response = await fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: quantity
                })
            });
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const data = await response.json();
            if (data.success) {
                alert('Product added to cart successfully!');
                // Update cart count if available in the UI
                if (data.cartCount && document.querySelector('.cart-count')) {
                    document.querySelector('.cart-count').textContent = data.cartCount;
                }
            } else {
                alert(data.message || 'Failed to add product to cart.');
            }
        } catch (error) {
            console.error('Error adding to cart:', error);
            alert('An error occurred while adding the product to cart.');
        }
    }
});
