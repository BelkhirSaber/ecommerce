<div class="row settings">
  <div class="col-12 d-flex justify-content-between pb-3">
    <h4 class="text-custom-color"><i class='bx bx-cog bx-sm px-2'></i>Settings</h4>
  </div>

  <!-- General Settings
Store Name: The official name of the store.
Store Logo: Logo upload field for brand identity.
Store Description: A brief description of the store, visible to customers.
Store Address: Physical address of the store or headquarters.
Contact Information: Phone number and email address.
Language: Select the default language and enable multilingual support.
Currency: Set the default currency for transactions. -->

  <div class="col-md-12">
    <div class="card card-custom-bg mb-3 border-0">
      <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
          <!-- General Settings -->
          <h6 class="mb-5">General Settings</h6>
          <div class="row mb-3">
            <label for="" class="col-sm-12 col-md-2 form-label">Store Name</label>
            <div class="col-sm-12 col-md-10">
              <input type="text" name="store_name" class="form-control" placeholder="store name"/>
            </div>
          </div>

          <div class="row mb-3">
            <label for="" class="col-sm-12 col-md-2 form-label">Store Logo</label>
            <div class="col-sm-12 col-md-10">
              <input type="file" src="" alt="" name="logo" class="form-control">
            </div>
          </div>

          <div class="row mb-3">
            <label for="" class="col-sm-12 col-md-2 form-label">Store Description</label>
            <div class="col-sm-12 col-md-10">
              <textarea name="description" id="" rows="5" class="form-control" placeholder="Lorem ipsum dolor, sit amet consectetur adipisicing elit. Distinctio nihil sit"></textarea>
            </div>
          </div>

          <div class="row mb-3">
            <label for="" class="col-sm-12 col-md-2 form-label">Language</label>
            <div class="col-sm-12 col-md-10">
              <select name="store_lang" id="" class="form-select">
                <option value="">Arabic</option>
                <option value="">French</option>
                <option value="">Anglais</option>
              </select>
            </div>
          </div>

          <div class="row mb-3">
            <label for="" class="col-sm-12 col-md-2 form-label">Currency</label>
            <div class="col-sm-12 col-md-10">
              <input type="text" name="currency" class="form-control" placeholder="TND"/>
            </div>
          </div>

          <div class="row mb-3">
            <label for="" class="col-sm-12 col-md-2 form-label">Tax</label>
            <div class="col-sm-12 col-md-10">
              <input type="number" name="tax" class="form-control" placeholder="10"/>
            </div>
          </div>

          <h6 class="my-5">Contact Information</h6>
          <div class="row mb-3">
            <label for="" class="col-sm-12 col-md-2 form-label">Email</label>
            <div class="col-sm-12 col-md-10">
              <input type="email" name="email" class="form-control" placeholder="exaple@shop.com"/>
            </div>
          </div>

          <div class="row mb-3">
            <label for="" class="col-sm-12 col-md-2 form-label">Phone 1</label>
            <div class="col-sm-12 col-md-10">
              <input type="text" name="phone1" class="form-control" placeholder="+21699000300"/>
            </div>
          </div>

          <div class="row mb-3">
            <label for="" class="col-sm-12 col-md-2 form-label">Phone 2</label>
            <div class="col-sm-12 col-md-10">
              <input type="text" name="phone2" class="form-control" placeholder="+21699000400"/>
            </div>
          </div>

          <div class="row mt-5">
            <div class="d-flex justify-content-end">
              <button type="submit" class="btn btn-outline-primary">Save</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <!-- ./card -->
  </div>
</div>
<!-- ./row -->



