<?php

include 'config.php';

if (session_status() === PHP_SESSION_NONE) { session_start(); }

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>about us</h3>
   <p> <a href="home.php">home</a> / about </p>
</div>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="image/about-img-new.webp" alt="">
      </div>

      <div class="content">
    <h3>why choose us?</h3>
    <p>At <?php echo isset($STORE_NAME) ? $STORE_NAME : (getenv('STORE_NAME') ?: 'MerchHub'); ?>, we curate a diverse lineup of quality merch: apparel, accessories, collectibles, and limited drops. Whether you're into minimalist streetwear or bold fandom pieces, there's something for every style.</p>
    <p>We believe in building a vibrant community of creators and fans. We focus on premium materials, ethical sourcing, and fast fulfillment.</p>
    <p>Choose <?php echo isset($STORE_NAME) ? $STORE_NAME : (getenv('STORE_NAME') ?: 'MerchHub'); ?> for a personalized, high-quality merch experience. Thanks for being part of the journey!</p>
         <a href="contact.php" class="btn">contact us</a>
      </div>

   </div>

</section>

<section class="reviews">

   <h1 class="title">customer reviews</h1>

   <div class="box-container">

      <div class="box">
         <img src="image/brands/customer-1.jpeg" alt="customer avatar">
         <p>Quality exceeded expectations. Fabric feels premium and packaging was neat. Will order again.</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Arjun Mehta</h3>
      </div>

   <div class="box">
   <img src="image/brands/customer-2.jpeg" alt="customer avatar">
      
         <p>Checkout was fast and my hoodie arrived earlier than estimated. Fit was perfect.</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Rohan Iyer</h3>
      </div>

      <div class="box">
         <img src="image/brands/customer-3.webp" alt="customer avatar">
         <p>Love the curation. Easy to discover new limited drops without scrolling forever.</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Aisha Kapoor</h3>
      </div>

      <div class="box">
         <img src="image/brands/customer-4.jpeg" alt="customer avatar">
         <p>Seasonal discounts helped me grab two tees for the price of one. Great value.</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Priya Nair</h3>
      </div>

      <div class="box">
         <img src="image/brands/customer-5.jpeg" alt="customer avatar">
         <p>The collectible pin set was nicely detailed. Packaging kept everything protected.</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Sneha Patel</h3>
      </div>

      <div class="box">
         <img src="image/brands/customer-6.jpeg" alt="customer avatar">
         <p>Ordering process was smooth and tracking updates were accurate. Will recommend.</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Vikram Singh</h3>
      </div>

   </div>

</section>

<section class="brands">

   <h1 class="title">featured brands</h1>

   <div class="box-container">

      <div class="box">
         <img src="image/brands/delhi-street-co.png" alt="Delhi Street Co. brand image">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>Delhi Street Co.</h3>
      </div>

      <div class="box">
         <img src="image/brands/bengal-looms.jpeg" alt="Bengal Looms brand image">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>Bengal Looms</h3>
      </div>

      <div class="box">
         <img src="image/brands/mumbai-minimal.webp" alt="Mumbai Minimal brand image">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>Mumbai Minimal</h3>
      </div>

      <div class="box">
         <img src="image/brands/goa-collective.jpeg" alt="Goa Collective brand image">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>Goa Collective</h3>
      </div>

      <div class="box">
         <img src="image/brands/himalaya-gear.png" alt="Himalaya Gear brand image">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>Himalaya Gear</h3>
      </div>

      <div class="box">
         <img src="image/brands/hyderabad-crafts.jpeg" alt="Hyderabad Crafts brand image">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>Hyderabad Crafts</h3>
      </div>

   </div>

</section>







<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>