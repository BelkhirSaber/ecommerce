<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $pageTitle ?? "SHOP";?></title>
  <!-- FontAwesome -->
  <link rel="stylesheet" href="<?php echo $utility::assets('fontawesome/css/all.min.css')?>">
  <!-- Bootstrap -->
  <link rel="stylesheet" href="<?php echo $utility::assets('css/bootstrap/bootstrap.min.css')?>">
  <!-- Custom Css -->
  <link rel="stylesheet" href="<?php echo $utility::assets('css/main.css')?>">
</head>
<body>

  <div class="wrapper-content">

    <!-- Sidebar -->
    <?php include_once 'includes/_sidebar.php';?>

    <!-- main -->
    <main id="main">
      <!-- Header Navbar -->
      <?php include_once 'includes/_header.php';?>

      <!-- Container-Fluid -->
      <div class="container-fluid">

        <?php echo $content;?>

      </div>
      <!-- ./Container-Fluid -->
    </main>
    <!-- ./main -->

    <!-- Footer -->
    <?php include_once 'includes/_footer.php';?>

  </div>

  <!-- FontAwesome JS -->
  <script src="<?php echo $utility::assets('fontawesome/js/all.min.js')?>"></script>
  <!-- Bootstrap JS -->
  <script src="<?php echo $utility::assets('js/bootstrap/bootstrap.bundle.min.js') ?>"></script>
  <!-- Custom JS -->
  <script src="<?php echo $utility::assets('js/main.js') ?>"></script>

</body>
</html>