<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $pageTitle ?? "SHOP";?></title>
  <!-- Google Font Poppins -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <!-- FontAwesome -->
  <link rel="stylesheet" href="<?php echo $utility::assets('fontawesome/css/all.min.css')?>">
  <!-- Jquery ui -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.3/themes/base/jquery-ui.min.css" integrity="sha512-8PjjnSP8Bw/WNPxF6wkklW6qlQJdWJc/3w/ZQPvZ/1bjVDkrrSqLe9mfPYrMxtnzsXFPc434+u4FHLnLjXTSsg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.3/themes/base/theme.min.css" integrity="sha512-XutDejX3PkIxnMh/xEu11qZ9+jn3lh+SrEnbtXny8dhr7Jk+lBkr2ujwco0Bx4LJ500XibluwyXc0kOJ+oY51Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Bootstrap -->
  <link rel="stylesheet" href="<?php echo $utility::assets('css/bootstrap/bootstrap.min.css')?>">
  <!-- boxicons -->
  <link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css">
  <!-- upload image plugin -->
  <link rel="stylesheet" href="<?php echo $utility::assets('plugin/ajax-file-uploader/css/jquery.uploader.css"')?>">
  <!-- Custom Css -->
  <link rel="stylesheet" href="<?php echo $utility::assets('css/main.css')?>">
</head>
<body>

  <!-- Include progress bar load page -->

  <?php include 'includes/_progress-bar.php'; ?>

  <!-- Page Content -->

  <div class="wrapper-content">

    <!-- Sidebar -->
    <?php include_once 'includes/_sidebar.php';?>

    <!-- main -->
    <main id="main">
      <!-- Header Navbar -->
      <?php include_once 'includes/_header.php';?>

      <!-- Container-Fluid -->
      <div id="content" class="container-fluid pt-3 admin-content" >

        <?php echo $content;?>

      </div>
      <!-- ./Container-Fluid -->
    </main>
    <!-- ./main -->

    <!-- Footer -->
    <?php include_once 'includes/_footer.php';?>

  </div>

  <!-- Jquery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- Jquery ui -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.3/jquery-ui.min.js" integrity="sha512-Ww1y9OuQ2kehgVWSD/3nhgfrb424O3802QYP/A5gPXoM4+rRjiKrjHdGxQKrMGQykmsJ/86oGdHszfcVgUr4hA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- FontAwesome JS -->
  <script src="<?php echo $utility::assets('fontawesome/js/all.min.js')?>"></script>
  <!-- Bootstrap JS -->
  <script src="<?php echo $utility::assets('js/bootstrap/bootstrap.bundle.min.js') ?>"></script>
  <!-- Global Module -->
  <script type="module" src="<?php echo $utility::assets('js/global_module.js')?>"></script>
  <!-- Admin Sidebar JS -->
  <script src="<?php echo $utility::assets('js/admin/sidebar.js') ?>"></script>
  <!-- Admin Main JS -->
  <script src="<?php echo $utility::assets('js/admin/main.js') ?>"></script>
  <!-- upload image plugin -->
  <script src="<?php echo $utility::assets('plugin/ajax-file-uploader/dist/jquery.uploader.min.js') ?>"></script>
  <!-- Main JS -->
  <script src="<?php echo $utility::assets('js/main.js') ?>"></script>
</html>