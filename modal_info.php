<?php
//identify language of user
if(isset($_GET['lang'])){
  $lang = $_GET['lang'];

  if($lang == 'en'){
      include 'languages/en.php';
  }

}else{
  //Idioma principal
  include 'languages/pt_br.php';
}
?>

<!-- Modal -->
<div class="modal fade" id="walletmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?=$text['how_help']?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

      <img class="d-block mx-auto mb-4" src="https://pngimg.com/uploads/paw/paw_PNG21.png" alt="" width="100" height="100">

      <div class="col-lg-12 mt-4">
      <p><?=$text['description_modal']?></p>
            <center><p><b><?=$text['wallet_brbtc']?></b>
            0x173359ca4a44dfcd55da5826caff797ada4c24dd</p></center>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><?=$text['close']?></button>
      </div>
    </div>
  </div>
</div>
