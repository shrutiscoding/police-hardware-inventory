<?php
  $page_title = 'Home Page';
  require_once('includes/load.php');
  if (!$session->isUserLoggedIn(true)) { redirect('index.php', false);}
?>
<?php include_once('layouts/header.php'); ?>

<style>
  body{
    background: url('libs/images/banner.jpg') no-repeat center center fixed;
    background-size: cover;
    height: 100vh; 
        
  }
    body::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to bottom, rgba(66, 65, 65, 0.6), rgba(76, 74, 74, 0.9));
    z-index: 0;
}

.panel {
 
    background: white ;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 5px;
    margin: 20px auto;
    width: 50%; /* Adjust the width to make it smaller */
    border-radius: 8px;
    border: 1px solid rgba(0, 0, 0, 0.6); /* Thinner border */
    opacity: 0;
    transform: translateY(-20px);
    animation: fadeIn 1s ease-out forwards;
}

.jumbotron {
    background: linear-gradient(rgb(88, 67, 172), rgb(136, 18, 18));
    color: white;
    border-radius: 8px;
    padding: 20px;
    text-align: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    opacity: 0;
    transform: scale(0.9);
    animation: zoomIn 1s ease-out forwards 0.5s;
}

.jumbotron h1 {
    font-size: 2rem;
    font-weight: bold;
}

.jumbotron p {
    font-size: 1rem;
    margin-top: 5px;
}

/* Animations */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes zoomIn {
    from {
        opacity: 0;
        transform: scale(0.9);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}
</style>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
 <div class="col-md-12">
    <div class="panel" style="margin-top: 170px;">
      <div class="jumbotron text-center">
         <h1>Welcome User <hr> Inventory Management System</h1>
         <p>Browes around to find out the pages that you can access!</p>
      </div>
    </div>
 </div>
</div>
<?php include_once('layouts/footer.php'); ?>
