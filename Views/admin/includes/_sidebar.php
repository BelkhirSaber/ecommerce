<?php

// use Model\Options;

// $options = new Options();

// $statement = $options->sql_query("SELECT * FROM t_b3s_options WHERE S_NAME_OPTION = :S_NAME_OPTION", array('S_NAME_OPTION' => 'sidebar_expand'));

// if($statement != false)  $sidebarExpand = $statement->fetchObject();

?>
<!-- sidebar -->
<section id="sidebar" class="py-3 ">
  <div class="navbar-brand p-3 pt-0 d-flex flex-nowrap align-items-center">
    <div class="d-inline-block brand-left" >
      <i class='bx bx-md bx-infinite' style="vertical-align: bottom;"></i>
      <span class="ms-2 fs-4">Admin</span>
    </div>
    <span class="p-1 d-none d-lg-inline-block ms-2" id="reduceSidebar"><i class='bx bx-menu fs-3'  style="vertical-align: bottom;"></i></span>
    <span class="p-1 d-lg-none ms-auto" id="closeSidebar"><i class='bx bxs-arrow-to-left fs-3' style="vertical-align: bottom;"></i></span>
  </div>

  <!-- Links -->
  <ul class="nav flex-column px-3">
    <li class="nav-item mb-1">
      <a href="/dashboard" class="nav-link p-2 d-flex align-items-center">
        <i class='bx bxs-dashboard px-2'></i>
        <span class="d-inline-block">Dashboard</span></a>
    </li>

    <li class="nav-item btn-group dropend mb-1">
      <a href="#" class="nav-link dropdown-toggle p-2 d-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
        <i class='bx bxs-package px-2'></i>
        <span class="d-inline-block">Orders</span></a>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="#">Menu item</a></li>
        <li><a class="dropdown-item" href="#">Menu item</a></li>
        <li><a class="dropdown-item" href="#">Menu item</a></li>
      </ul>
    </li>

    <li class="nav-item btn-group dropend mb-1">
      <a href="#" class="nav-link dropdown-toggle p-2 d-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
        <i class='bx bxs-purchase-tag px-2'></i>
        <span class="d-inline-block">Products</span></a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="/new-product">New Product</a></li>
          <li><a class="dropdown-item" href="#">List Product</a></li>
          <li><a class="dropdown-item" href="#">New Category</a></li>
      </ul>
    </li>
    <li class="nav-item mb-1">
      <a href="#" class="nav-link p-2 d-flex align-items-center">
        <i class='bx bxs-cart-add px-2'></i>
        <span class="d-inline-block">Upsells</span></a>
    </li>
    <li class="nav-item mb-1">
      <a href="#" class="nav-link p-2 d-flex align-items-center">
        <i class='bx bxs-coupon px-2'></i>
        <span class="d-inline-block">Coupons</span></a>
    </li>
    <li class="nav-item mb-1">
      <a href="#" class="nav-link p-2 d-flex align-items-center">
        <i class='bx bxs-user-account px-2'></i>
        <span class="d-inline-block">Customers</span></a>
    </li>
    <li class="nav-item mb-1">
      <a href="#" class="nav-link p-2 d-flex align-items-center">
        <i class='bx bx-store px-2'></i>
        <span class="d-inline-block">Store</span></a>
    </li>
    <li class="nav-item mb-1">
      <a href="#" class="nav-link p-2 d-flex align-items-center">
        <i class='bx bx-support px-2' ></i>
        <span class="d-inline-block">Support</span></a>
    </li>
    <li class="nav-item mb-1">
      <a href="/settings" class="nav-link p-2 d-flex align-items-center">
        <i class='bx bxs-cog px-2' ></i>
        <span class="d-inline-block">Settings</span></a>
    </li>
  </ul>
</section>
<div id="sidebarBackground"></div>
<!-- ./sidebar -->