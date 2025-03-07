function hideProduct(productId) {
    const productElement = document.getElementById(`product-${productId}`);
    if (productElement) {
        productElement.style.display = 'none';
    }
}