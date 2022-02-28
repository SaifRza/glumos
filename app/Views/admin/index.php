<?= $this->extend('layout/main')?>

<?=$this->section('content')?>
 <div class="d-flex justify-content-start flex-grow">
      
      <div class="col-3 bg-info text-white p-5 m-3 rounded-5">
          <h5>Total Subscriptions</h5>
          <h3>12</h3>
          
      </div>
      
      <div class="col-3 bg-primary text-white p-5 m-3 rounded-5">
          <h5>Total Employers</h5>
          <h3>12</h3> 
      </div>
      
      <div class="col-3 bg-warning text-white p-5 m-3 rounded-5">
          <h5>Total Jobseekers</h5>
          <h3>12</h3>
      </div>
      
      
  </div>

<?= $this->endSection();?>