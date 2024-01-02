<section class="ftco-section pricing">
    <div class="container">
      <div class=" text-center heading-section ftco-animate fadeInUp ftco-animated">

        <h2 class="mb-4">Membership plans</h2>
      </div>
      <div class="membership-plans row">
        <?php if($response) { foreach($response as $key=>$value){ ?>
        <div class="col-lg-4 mb-4">
          <div class="pricing-content">
            <div class="pricing-header">
              <?php $color ='' ;
              $border_color ='';
              if($value['name'] == 'Gold'){ 
                $color= '#226aff';
                $border_color= '#226aff';
                }
              
              elseif($value['name'] == 'Silver') { 
                $color= '#01c0a2'; 
                $border_color= '#01c0a2'; 
              } 

              elseif($value['name'] == 'Platinum') { 
                $color= '#ff6616'; 
                $border_color= '#ff6616'; 
              } 

              else{ 
                $color= '#01c0a2';
                $border_color= '#01c0a2';
               
                
                } ?>

              <h5 style="background: <?= $color ?>;  border-color: <?= $border_color ?> ;"><?= $value['name']  ?></h5>

            </div>
            <hr>
            <ul class="pricing-middle overflow">
            <?php  if($value['service']){ foreach($value['service'] as $key=>$service_value) { ?>
              <li class="pricng-middle-content">
                <?php $mark = '';
                 if($service_value['value'] == 'no')
                 { 
                  $mark = 'fa-solid fa-xmark'; 
                  } 
                  else 
                  { 
                    $mark = 'fa-solid fa-check';
                   } ?>
                <span style="display: flex;"> <span><i class="<?= $mark ?>"></i></span><?= $service_value['name']." " ?>(<?= $service_value['value'] ?>)</span>
              </li>
              <?php } } ?>

             


            </ul>
            <hr>
            <div class="pricing-footer">
              <h2><?= $value['price'] .' NGN'?></h2>
            </div>

          </div>

          
        </div>
        <?php } } ?>
        
      </div>

      

    </div>


  </section>