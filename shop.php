<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link rel="stylesheet" href="style.css">
    <!--font awesome cdn link for icons-->
    <script src="https://kit.fontawesome.com/5fce70dfef.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<!-- shop.php -->
<?php include 'navbar.php'; ?>


<section id="page-header">
<h4>Shop By Category</h4>
<p>save more with coupons upto 70% off!</p> 
</section>

<!--


<section id="feature" class="section-p1">
    <div class="fea-box">
        <img src="Image/shipping.png" alt="">
        <h6>Free shipping</h6>

    </div>
</section>
-->
    <section id="product1" class="section-p1">
      
     
        <div class="pro-container">
            <div class="pro">
                <img src="Image/Products/CREW NECK JUMPER - BROWN - XS.jpeg">
                <div class="description">
                <span>sweatshirt</span>
                <h5> Crew Neck Sweatshirt</h5>
                <div class="star">
               
                </div>
                <h4>Rs 500</h4>
                    </div>
                    <div class="button-container">
                <form action="add_to_cart.php" method="POST" class="button-form">
                    <input type="hidden" name="product_id" value="1"> <!-- Replace with dynamic product ID -->
                    <input type="hidden" name="product_name" value="Crew Neck Sweatshirt">
                    <input type="hidden" name="product_price" value="500">
                    <button type="submit" class="btn add-to-cart">Add to Cart</button>
                </form>
            </div>
        
            </div>
            <div class="pro">
                <img src="Image/Products/Belle Poque Vintage Denim Skirts.jpeg">
                <div class="description">
                <span>skirt</span>
                <h5> Belle Poque Vintage Denim Skirt</h5>
                <div class="star">
            
                </div>
                <h4>Rs 800</h4>
                    </div>
                    <div class="button-container">
                <form action="add_to_cart.php" method="POST" class="button-form">
                    <input type="hidden" name="product_id" value="1"> <!-- Replace with dynamic product ID -->
                    <input type="hidden" name="product_name" value="Crew Neck Sweatshirt">
                    <input type="hidden" name="product_price" value="500">
                    <button type="submit" class="btn add-to-cart">Add to Cart</button>
                </form>
            </div>
        
            </div>
            <div class="pro">
                <img src="Image/Products/Women's woolen sweater.jpeg">
                <div class="description">
                <span>sweater</span>
                <h5> Women's woolen sweater</h5>
                <div class="star">
                
                </div>
                <h4>Rs 450</h4>
                    </div>
                    <div class="button-container">
                <form action="add_to_cart.php" method="POST" class="button-form">
                    <input type="hidden" name="product_id" value="1"> <!-- Replace with dynamic product ID -->
                    <input type="hidden" name="product_name" value="Crew Neck Sweatshirt">
                    <input type="hidden" name="product_price" value="500">
                    <button type="submit" class="btn add-to-cart">Add to Cart</button>
                </form>
            </div>
        
            </div>
            <div class="pro">
                <img src="Image/Products/California Sweatshirts.jpeg">
                <div class="description">
                <span>sweatshirt</span>
                <h5> California Sweatshirt</h5>
                <div class="star">
                
                </div>
                <h4>Rs 500</h4>
                    </div>
                    <div class="button-container">
                <form action="add_to_cart.php" method="POST" class="button-form">
                    <input type="hidden" name="product_id" value="1"> <!-- Replace with dynamic product ID -->
                    <input type="hidden" name="product_name" value="Crew Neck Sweatshirt">
                    <input type="hidden" name="product_price" value="500">
                    <button type="submit" class="btn add-to-cart">Add to Cart</button>
                </form>
            </div>
        
            </div>
            <div class="pro">
                <img src="Image/Products/DAZY Men Quarter Zipper Drop Shoulder Pullover.jpeg">
                <div class="description">
                <span>sweater</span>
                <h5> Zipper Drop Shoulder Pullover</h5>
                <div class="star">
                  
                </div>
                <h4>Rs 545</h4>
                    </div>
                    <div class="button-container">
                <form action="add_to_cart.php" method="POST" class="button-form">
                    <input type="hidden" name="product_id" value="1"> <!-- Replace with dynamic product ID -->
                    <input type="hidden" name="product_name" value="Crew Neck Sweatshirt">
                    <input type="hidden" name="product_price" value="500">
                    <button type="submit" class="btn add-to-cart">Add to Cart</button>
                </form>
            </div>
        
            </div>
            <div class="pro">
                <img src="Image/Products/Unisex Hoodie.jpeg">
                <div class="description">
                <span>hoodie</span>
                <h5> Unisex Hoodie</h5>
                <div class="star">
                 
                </div>
                <h4>Rs 455</h4>
                    </div>
                    <div class="button-container">
                <form action="add_to_cart.php" method="POST" class="button-form">
                    <input type="hidden" name="product_id" value="1"> <!-- Replace with dynamic product ID -->
                    <input type="hidden" name="product_name" value="Crew Neck Sweatshirt">
                    <input type="hidden" name="product_price" value="500">
                    <button type="submit" class="btn add-to-cart">Add to Cart</button>
                </form>
            </div>
            </div>
            <div class="pro">
                <img src="Image/Products/idkwhatthisis.jpeg">
                <div class="description">
                <span>jacket</span>
                <h5> Faux Fur-Trimmed Liner Jacket</h5>
                <div class="star">
            
                </div>
                <h4>Rs 700</h4>
                    </div>
                    <div class="button-container">
                <form action="add_to_cart.php" method="POST" class="button-form">
                    <input type="hidden" name="product_id" value="1"> <!-- Replace with dynamic product ID -->
                    <input type="hidden" name="product_name" value="Crew Neck Sweatshirt">
                    <input type="hidden" name="product_price" value="500">
                    <button type="submit" class="btn add-to-cart">Add to Cart</button>
                </form>
            </div>
            </div>
            <div class="pro">
                <img src="Image/Products/Womens High Waist Plaid Skirt.jpeg">
                <div class="description">
                <span>skirt</span>
                <h5> High Waist Plaid Mini-Skirt</h5>
                <div class="star">
                 
                </div>
                <h4>Rs 390</h4>
                    </div>
                    <div class="button-container">
                <form action="add_to_cart.php" method="POST" class="button-form">
                    <input type="hidden" name="product_id" value="1"> <!-- Replace with dynamic product ID -->
                    <input type="hidden" name="product_name" value="Crew Neck Sweatshirt">
                    <input type="hidden" name="product_price" value="500">
                    <button type="submit" class="btn add-to-cart">Add to Cart</button>
                </form>
            </div>
            </div>
    <div class="pro-container">
        <div class="pro">
            <img src="Image/Products/_ (7).jpeg">
            <div class="description">
            <span>tops</span>
            <h5> Full sleeved crop woolen top</h5>
            <div class="star">
              
            </div>
            <h4>Rs 400</h4>
                </div>
                <div class="button-container">
                <form action="add_to_cart.php" method="POST" class="button-form">
                    <input type="hidden" name="product_id" value="1"> <!-- Replace with dynamic product ID -->
                    <input type="hidden" name="product_name" value="Crew Neck Sweatshirt">
                    <input type="hidden" name="product_price" value="500">
                    <button type="submit" class="btn add-to-cart">Add to Cart</button>
                </form>
            </div>
    
        </div>
        <div class="pro">
            <img src="Image/Products/Formal straight pant.jpeg">
            <div class="description">
            <span>pant</span>
            <h5> Formal straight pant</h5>
            <div class="star">
        
            </div>
            <h4>Rs 550</h4>
                </div>
                <div class="button-container">
                <form action="add_to_cart.php" method="POST" class="button-form">
                    <input type="hidden" name="product_id" value="1"> <!-- Replace with dynamic product ID -->
                    <input type="hidden" name="product_name" value="Crew Neck Sweatshirt">
                    <input type="hidden" name="product_price" value="500">
                    <button type="submit" class="btn add-to-cart">Add to Cart</button>
                </form>
            </div>
    
        </div>
        <div class="pro">
            <img src="Image/Products/Winter puffer Jacket.jpeg">
            <div class="description">
            <span>jacket</span>
            <h5>Unisex puffer jacket</h5>
            <div class="star">
      
            </div>
            <h4>Rs 850</h4>
                </div>
                <div class="button-container">
                <form action="add_to_cart.php" method="POST" class="button-form">
                    <input type="hidden" name="product_id" value="1"> <!-- Replace with dynamic product ID -->
                    <input type="hidden" name="product_name" value="Crew Neck Sweatshirt">
                    <input type="hidden" name="product_price" value="500">
                    <button type="submit" class="btn add-to-cart">Add to Cart</button>
                </form>
            </div>
        </div>
        <div class="pro">
            <img src="Image/Products/winter Coat.jpeg">
            <div class="description">
            <span>coat</span>
            <h5>Stylish winter long-fur coat</h5>
            <div class="star">
              
            </div>
            <h4>Rs 900</h4>
                </div>
                <div class="button-container">
                <form action="add_to_cart.php" method="POST" class="button-form">
                    <input type="hidden" name="product_id" value="1"> <!-- Replace with dynamic product ID -->
                    <input type="hidden" name="product_name" value="Crew Neck Sweatshirt">
                    <input type="hidden" name="product_price" value="500">
                    <button type="submit" class="btn add-to-cart">Add to Cart</button>
                </form>
            </div>
        </div>
        <div class="pro">
            <img src="Image/Products/Cotton_Flannel.jpeg">
            <div class="description">
            <span>shirt</span>
            <h5> Olive green Cotton Flannel</h5>
            <div class="star">
            
            </div>
            <h4>Rs 545</h4>
                </div>
                <div class="button-container">
                <form action="add_to_cart.php" method="POST" class="button-form">
                    <input type="hidden" name="product_id" value="1"> <!-- Replace with dynamic product ID -->
                    <input type="hidden" name="product_name" value="Crew Neck Sweatshirt">
                    <input type="hidden" name="product_price" value="500">
                    <button type="submit" class="btn add-to-cart">Add to Cart</button>
                </form>
            </div>
    
        </div>
        <div class="pro">
            <img src="Image/Products/Red scarf.jpeg">
            <div class="description">
            <span>scarfs</span>
            <h5> Red Woolen Scarf</h5>
            <div class="star">
         
            </div>
            <h4>Rs 455</h4>
                </div>
                <div class="button-container">
                <form action="add_to_cart.php" method="POST" class="button-form">
                    <input type="hidden" name="product_id" value="1"> <!-- Replace with dynamic product ID -->
                    <input type="hidden" name="product_name" value="Crew Neck Sweatshirt">
                    <input type="hidden" name="product_price" value="500">
                    <button type="submit" class="btn add-to-cart">Add to Cart</button>
                </form>
            </div>
        </div>
        <div class="pro">
            <img src="Image/Products/Men's Retro Straight Wide Leg Jeans.jpeg">
            <div class="description">
            <span>pant</span>
            <h5>Men's Retro Straight Wide Leg Jeans</h5>
            <div class="star">
            
            </div>
            <h4>Rs 790</h4>
                </div>
                <div class="button-container">
                <form action="add_to_cart.php" method="POST" class="button-form">
                    <input type="hidden" name="product_id" value="1"> <!-- Replace with dynamic product ID -->
                    <input type="hidden" name="product_name" value="Crew Neck Sweatshirt">
                    <input type="hidden" name="product_price" value="500">
                    <button type="submit" class="btn add-to-cart">Add to Cart</button>
                </form>
            </div>
    
        </div>
        <div class="pro">
            <img src="Image/Products/Woolen Split Knit Midi Skirt - M - Khaki.jpeg">
            <div class="description">
            <span>skirt</span>
            <h5> Woolen Split Knit Midi Skirt</h5>
            <div class="star">
            
            </div>
            <h4>Rs 590</h4>
                </div>
                <div class="button-container">
                <form action="add_to_cart.php" method="POST" class="button-form">
                    <input type="hidden" name="product_id" value="1"> <!-- Replace with dynamic product ID -->
                    <input type="hidden" name="product_name" value="Crew Neck Sweatshirt">
                    <input type="hidden" name="product_price" value="500">
                    <button type="submit" class="btn add-to-cart">Add to Cart</button>
                </form>
            </div>
    
        </div>

    </div>
</div>
</section>
<section id="pagination" class="section-p1">
<a href="#">1</a>
<a href="#">2</a>
<a href="#"><i class="fa-solid fa-arrow-right"></i></a>

</section>

<hr>
<?php include 'footer.php'; ?>
    <script src="script.js"></script>
</body>
</html>