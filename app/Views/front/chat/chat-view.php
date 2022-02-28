
<?= $this->extend('front/chat/index')?>

<?=$this->section('content')?>
<div class="row d-flex" style="width:80%;margin:auto;height:100vh">
    <div class="col-3">
      <?= $this->include('front/chat/list-of-chats');?>  
    </div>
    <div class="col-9">
     <?= $this->include('front/chat/chat-area');?>    
    </div>
</div>
<?= $this->endSection();?>