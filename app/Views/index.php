<?= $this->extends('layout/main');?>

<?=$this->section('content');?>
<div class="card" style="width: 18rem;">
  <img class="card-img-top" src="https://cdn.vox-cdn.com/thumbor/qVjMPtyFVT5Dtwl_jSOCj4Y33TM=/1400x1400/filters:format(jpeg)/cdn.vox-cdn.com/uploads/chorus_asset/file/15980837/elon_musk_tesla_3036.jpg" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>
<?= $this->endSection();?>