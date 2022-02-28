<?php


//get offers of this request
$currentRequestId = $reqId; //set on include

$sql2 = "SELECT * FROM offers WHERE `requestidfk` = $currentRequestId";
$rs_result2 = mysqli_query($conn, $sql2);   

while ($row = mysqli_fetch_array($rs_result2)) {  
   // var_dump($row);
    
?>

<div class="single-offer">
    <div class="offer-collection">
        <p><b>Good Collection</b><br><?php echo substr($row['collect_time'], 0, -3); ?></p>
    </div>
    <div class="offer-delivery">
        <p><b>Good Delivery</b><br><?php echo substr($row['deliver_time'], 0, -3); ?></p>
    </div>
    <div class="offer-price">
        <h4>€ <?php echo getClientCommissionsCalculated($row['price'], $_SESSION['user_id']) ?></h4>
    </div>
    <div class="offer-button">
        <input type="hidden" class="offer_id" value="<?php echo $row['offer_id'] ?>">
        <button class="blockOffer" type="button">Block Offer</button>
    </div>
</div>


<?php } ?>