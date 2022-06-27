<main id="main">

    <!-- ======= Services Section ======= -->
    <section class="section-services section-t8">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="title-wrap d-flex justify-content-between">
              <div class="title-box">
                <h2 class="title-a"><?php echo $heading;?></h2>
              </div>
              
            </div>
          </div>
        </div>
        <div class="row">

        <div class="table-responsive">
            <table id="property-messages-table" class="table">
             <thead>
               <tr>
                <th style="width:7%">Sr. No</th>
                <th style="width:10%">Name</th>
                <th style="width:10%">Username</th>
                <th style="width:10%">Mobile</th>
                <th style="width:10%">Email</th>
                <th style="width:10%">Property</th>
                <th style="width:10%">Message</th>
                <th style="width:10%">Date</th>
               </tr>
             </thead>
             <tbody> 
              <?php $i=0; 
               if(!empty($records)) {
                foreach($records as $record) { 
                  $i++;
                ?>
                <tr>
                    <td><?php echo $i?></td>
                    <td><?php echo $record->name;?></td>
                    <td><?php echo $record->user_name;?></td>
                    <td><?php echo $record->mobile;?></td>
                    <td><?php echo $record->user_email;?></td>
                    <td><?php echo $record->property_name;?></td>
                    <td><?php echo $record->message;?></td>
                    <td><?php echo $record->indate;?></td>
  
                </tr>

              <?php } } ?> 

             </tbody>
            </table>
        </div>


        </div>
      </div>
    </section><!-- End Services Section -->
</main><!-- End #main -->

<script>
  $(document).ready(function(){
    $("#property-messages-table").dataTable();
  })
</script>
  