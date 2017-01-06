<?php
include("service/ui/common/header.php"); 

$paypal_url = ($package_settings[0]['sandbox_mode']==1) ? 'https://www.sandbox.paypal.com/cgi-bin/webscr' : 'https://www.paypal.com/cgi-bin/webscr';
$paypal_id = $package_settings[0]['paypal_merchant_account_email_id'];
?>

<div class="container section_wrapper">
    <?php //print_r($packages);?>
    <div class="col-md-12 col-sm-12 col-xs-12 package_lists">
        <?php foreach ($packages as $key => $value) { ?>
        <div class="col-md-4 col-sm-4 col-xs-12 package_list">
            <div class="package_name"><?php echo $value['package_name'];?></div>
            <div class="package_price">
                <p class="price_tag">$<?php echo $value['price'];?></p>
                <p class="duration_tag"><?php echo $value['duration'];?></p>
            </div>
            <ul class="package_desc_list">
                <li class="package_desc"><?php echo $value['description_line_1'];?></li>
                <li class="package_desc"><?php echo $value['description_line_2'];?></li>
                <li class="package_desc"><?php echo $value['description_line_3'];?></li>
            </ul> 
            <form action="<?php echo $paypal_url; ?>" method="post">

        <!-- Identify your business so that you can collect the payments. -->
        <input type="hidden" name="business" value="<?php echo $paypal_id; ?>">
        
        <!-- Specify a Buy Now button. -->
        <input type="hidden" name="cmd" value="_xclick">
        
        <!-- Specify details about the item that buyers will purchase. -->
        <input type="hidden" name="item_name" value="<?php echo $value['package_name']; ?>">
        <input type="hidden" name="item_number" value="<?php echo $value['id']; ?>">
        <input type="hidden" name="user_id" value="<?php echo $_SESSION['userID']; ?>">
        <input type="hidden" name="username" value="<?php echo $_SESSION['name']; ?>">
        <input type="hidden" name="amount" value="<?php echo $value['price']; ?>">
        <input type="hidden" name="currency_code" value="USD">
        
        <!-- Specify URLs -->
        <input type='hidden' name='cancel_return' value='<?php echo WEB_ROOT;?>index.php/payment_package'>
        <input type='hidden' name='return' value='<?php echo WEB_ROOT;?>index.php/payment_success'>

        
        <!-- Display the payment button. -->
        
    
  
            <div class="col-md-offset-3 col-md-6 col-sm-offset-3 col-sm-6  col-xs-offset-1 col-xs-11  padding-0 buy_block"><input type="submit" class="buy_now" value="Buy Now" /></div>
              </form>
        </div>  
        <?php } ?>
    </div>
</div>
<?php 
      include("service/ui/common/footer.php"); 
      ?>