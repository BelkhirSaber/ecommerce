<!-- Styles -->
<link rel="stylesheet" href="<?php echo $utility::assets('css/product/styles.css')?>">
<!-- Scripts -->
<script src="<?php echo $utility::assets('js/product/main.js') ?>"></script>

<!-- Page content -->
<div class="row add-product">

  <div class="col-12 d-flex justify-content-between pb-3">
    <h4 class="text-custom-color"><i class='bx bxs-purchase-tag bx-sm px-2'></i>Add New Product</h4>
    <div class="">
      <button class="btn btn-primary rounded-5" type="button" form="product" onclick="addProduct(event, this)">Save</button>
    </div>
  </div>

  <!-- Info product -->
  <div class="col-md-12 col-lg-8">
    <form action="" method="post" id="product">
      <!-- General Info -->
      <div class="card border-0 card-custom-bg mb-3">
        <div class="card-body">
          <h5 class="card-title text-custom-color">General Information</h5>

          <div class="mb-3">
            <label for="productSlug" class="form-label">Slug</label>
            <input type="text" class="form-control input-custom-bg py-3 border-0" id="productSlug" placeholder="t-shirt-ref-0021">
          </div>
          <div class="mb-3">
            <label for="productSlug" class="form-label">Name Product</label>
            <input type="text" class="form-control input-custom-bg py-3 border-0" id="productSlug" placeholder="t-shirt black">
          </div>
          <div class="mb-3">
            <label for="productDesc" class="form-label">Description</label>
            <textarea class="form-control input-custom-bg py-3 border-0" id="productDesc" rows="3" placeholder="Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam eaque consequuntur qui praesentium facere atque amet beatae similique consequatur, nam quae corporis iure, cupiditate dolorum illum, iste nulla nostrum veritatis."></textarea>
          </div>
          <div class="mb-3 d-flex column-gap-5 flex-wrap">
            <!-- Size -->
              <div class="mb-3">
              <h5 class="mb-1 text-custom-color">Size</h5>
              <small class="text-muted fw-light">Pick Available Size</small>
              <div class="size d-flex gap-2 mt-2">

                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="sizeXS" value="xs">
                  <label class="form-check-label" for="sizeXS">XS</label>
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="sizeS" value="s">
                  <label class="form-check-label" for="sizeS">S</label>
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="sizeM" value="M">
                  <label class="form-check-label" for="sizeM">M</label>
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="sizeXL" value="XL">
                  <label class="form-check-label" for="sizeXL">XL</label>
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="sizeXXL" value="XXL">
                  <label class="form-check-label" for="sizeXXL">XXL</label>
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="sizeStandard" value="STANDARD">
                  <label class="form-check-label" for="sizeStandard">NO</label>
                </div>

              </div>
              </div>
            <!-- Gender -->
            <div>
              <h5 class="mb-1 text-custom-color">Gender</h5>
              <small class="text-muted fw-light">Pick Available Gender</small>
              <div class="gender d-flex gap-2 mt-2">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="gender" id="gender1" checked>
                  <label class="form-check-label" for="gender1">
                    Men
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="gender" id="gender2">
                  <label class="form-check-label" for="gender2">
                    Women
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="gender" id="gender3">
                  <label class="form-check-label" for="gender3">
                    Unisex
                  </label>
                </div>
              </div>
            </div>
            
          </div>

        </div>
      </div>

      <!-- Price & Stock -->
      <div class="card border-0 card-custom-bg mb-3">
        <div class="card-body">
          <h5 class="card-title text-custom-color">Price And Stock</h5>
          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="productSlug" class="form-label">Base Price</label>
              <div class="input-group">
                <span class="input-group-text" id="basic-addon1">DT</span>
                <input type="text" class="form-control input-custom-bg py-3 border-0" id="productSlug" placeholder="00.0">
              </div>
            </div>
            <div class="mb-3 col-md-6">
              <label for="productSlug" class="form-label">Stock</label>
              <input type="text" class="form-control input-custom-bg py-3 border-0" id="productSlug" placeholder="100">
            </div>
          </div>

          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="productSlug" class="form-label">Discount</label>
              <div class="input-group">
                <span class="input-group-text">&percnt;</span>
                <input type="text" class="form-control input-custom-bg py-3 border-0" id="productSlug" placeholder="100">
              </div>
            </div>

            <div class="mb-3 col-md-6">
              <label for="productSlug" class="form-label">Discount Category</label>
              <select class="form-select input-custom-bg py-3 border-0" aria-label="Category of discount">
                <option selected>None</option>
                <option value="1">New Year Discount</option>
              </select>
            </div>

          </div>

        </div>
      </div>

    </form>

  </div>

  <!-- Image product -->
  <div class="col-md-12 col-lg-4">
    <div class="card card-custom-bg border-0">
      <div class="card-body">

        <!-- Show images -->
        <h5>Upload Product Images</h5>
        <div class="main-preview" id="mainPreview">
        </div>

        <!-- Add Images -->
        <div class="image-list" id="imageList">
          <label class="file-input-wrapper" for="imageInput">
            <i class="fa-regular fa-image"></i>
          </label>
        </div>
        <input type="file" id="imageInput" multiple accept="image/*" form="product">
      </div>
    </div>
  </div>
</div>