<main id="main">

    <!-- ======= Services Section ======= -->
    <section class="section-services section-t8">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="title-wrap d-flex justify-content-between">
              <div class="title-box">
                <h2 class="title-a">Search Property</h2>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
        <form class="form-a" action="<?php echo base_url("properties/property_search")?>">
        <div class="row">
          

        <div class="col-md-6 mb-2">
            <div class="form-group mt-3">
              <label class="pb-2" for="city">Building Name</label>
              <input type="text" class="form-control" placeholder="Enter Building Name" id="building_name" name="building_name">
                
            </div>
          </div>

          
          <div class="col-md-6 mb-2">
            <div class="form-group mt-3">
              <label class="pb-2" for="city">City</label>
              <select class="form-control form-select form-control-a" name="city" id="city">
                <option value="">All City</option>
                <?php if (!empty($cityRecords)  ) {
                  foreach($cityRecords as $city_record) {  
                ?>
                <option value="<?php echo $city_record->city;?>"><?php echo $city_record->city;?></option>
                <?php }  } ?>
              </select>
            </div>
          </div>
          <div class="col-md-6 mb-2">
            <div class="form-group mt-3">
              <label class="pb-2" for="bedrooms">Bedrooms</label>
              <select class="form-control form-select form-control-a" name="bedroom"  id="bedroom">
                <option value="">Any</option>
                <?php if (!empty($bedroomRecords)  ) {
                  foreach($bedroomRecords as $bedroom_record) {  
                ?>
                <option value="<?php echo $bedroom_record->bedroom;?>"><?php echo $bedroom_record->bedroom;?></option>
                <?php }  } ?>
              </select>
            </div>
          </div>
          
          <div class="col-md-6 mb-2">
            <div class="form-group mt-3">
              <label class="pb-2" for="price">Max Price</label>
              <select class="form-control form-select form-control-a" name="price" id="price">
                <option value="">Unlimite</option>
                <?php if (!empty($priceRecords)  ) {
                  foreach($priceRecords as $price_record) {  
                ?>
                <option value="<?php echo $price_record->price;?>"><?php echo $price_record->price;?></option>
                <?php }  } ?>
              </select>
            </div>
          </div>
          <div class="col-md-12 text-center mb-5 mt-5">
            <button type="submit" class="btn btn-success">Search Property</button>
          </div>
        </div>
      </form>
         
        </div>
      </div>
    </section><!-- End Services Section -->

   
   
   
   
  </main><!-- End #main -->