<!-- header -->
<header class="">
  <nav class="navbar text-capitalize h-100">
    <div class="container-fluid justify-content-between">
      <!-- <a class="navbar-brand" href="#">Navbar</a> -->
      <span id="openSidebar" class="me-3 d-lg-none"><i class="fa-solid fa-bars fs-4"></i></span>

      <form class="d-md-flex d-none" role="search">
        <div class="input-group">
          <input class="form-control" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </div>
      </form>

      <div class="nav align-items-center justify-content-end">
        <span class="nav-link nav-link-search d-md-none">
          <e class="fa-solid fa-magnifying-glass fs-4 "></e>
        </span>

        <div class="position-relative px-2">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <div class="position-relative d-inline-block">
              <i class='bx bxs-comment-dots text-custom-color'></i>
              <span class="position-absolute top-0 start-100 translate-middle p-1 rounded-circle bg-danger">
                <span class="visually-hidden">unread messages</span>
              </span>
            </div>
            <span class="ms-1 d-none d-md-inline text-custom-color text-capitalize">message</span>
            
          </a>
          <ul class="dropdown-menu end-0">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </div>

        <div class="position-relative px-2">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <div class="position-relative d-inline-block">
              <i class='bx bxs-bell text-custom-color' ></i>
              <span class="position-absolute top-0 start-100 translate-middle p-1 rounded-circle bg-danger">
                <span class="visually-hidden">unread notification</span>
              </span>
            </div>
            <span class="ms-1 d-none d-md-inline text-custom-color text-capitalize">notification</span>
          </a>
          <ul class="dropdown-menu end-0">
            <li><a class="dropdown-item" href="#">Action notification</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </div>

        <div class="position-relative">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <div class="position-relative d-inline-block">
              <i class='bx bxs-user-circle text-custom-color'></i>
              <span>
                <span class="visually-hidden">unread profile</span>
              </span>
            </div>
            <span class="ms-1 d-none d-md-inline text-custom-color text-capitalize">profile</span>
          </a>
          <!-- <a class="nav-link dropdown-toggle position-relative text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> -->
            <!-- <img src="<?php //echo $utility::assets('images/default/admin_dash/default_admin_user.png')?>" alt="user profile" width="28" height="28"> -->
            <!-- <i class='bx bxs-user-circle text-white'></i>
            <span class="ms-1 d-none d-md-inline" style="vertical-align: -webkit-baseline-middle;">profile</span>
          </a> -->
          <ul class="dropdown-menu end-0">
            <li><a class="dropdown-item" href="#">Action profile</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </div>
      </div>


    </div>
  </nav>
</header>
<!-- ./header -->

