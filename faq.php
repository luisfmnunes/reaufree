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


<div class="accordion p-3 mt-5" id="faq" style="font-weight: initial">

  <h2><?=$text['faq']?></h2>

  <div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
      <?=$text['faq_title_1']?>
      </button>
    </h2>
    <div id="collapseOne" class="collapse">
      <div class="accordion-body">
        <?=$text['faq_descr_1']?>
      </div>
    </div>
  </div>
  
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingTwo">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
      <?=$text['faq_title_2']?>
      </button>
    </h2>
    <div id="collapseTwo" class="collapse">
      <div class="accordion-body">
        <?=$text['faq_descr_2']?>
      </div>
    </div>
  </div>
  
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingThree">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
      <?=$text['faq_title_3']?>
      </button>
    </h2>
    <div id="collapseThree" class="collapse">
      <div class="accordion-body">
        <?=$text['faq_descr_3']?>

        <table style="width:100%">
        <tr>
            <th><?=$text['faq_mark_3']?></th>
            <th><?=$text['faq_distr_value']?></th>
        </tr>
        <tr>
            <td>> 100.000.000 (milhões)</td>
            <td>0.00031000 * (10<sup>6</sup>)</td>
        </tr>

        <tr>
            <td>> 1.000.000.000 (bilhão)</td>
		    <td>0.00062000 * (10<sup>6</sup>) </td>
        </tr>

        <tr>
        <td>> 10.000.000.000 (bilhões)</td>
            <td>0.00125000 * (10<sup>6</sup>) </td>
        </tr>

        <tr>
        <td>> 100.000.000.000 (bilhões)</td>
            <td>0.00250000 * (10<sup>6</sup>) </td>
        </tr>

        <tr>
        <td>> 1.000.000.000.000 (trilhões)</td>
            <td>0.00500000 * (10<sup>6</sup>) </td>
        </tr>

      <tr>
      <td>> 2.000.000.000.000 (trilhões)</td>
            <td>0.01000000 * (10<sup>6</sup>) </td>
      </tr>


        </tr>

        </table>

      </div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="headingFour">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
      <?=$text['faq_title_4']?>
      </button>
    </h2>
    <div id="collapseFour" class="collapse">
      <div class="accordion-body">
        <?=$text['faq_descr_4']?>
      </div>
    </div>
  </div>

</div>
