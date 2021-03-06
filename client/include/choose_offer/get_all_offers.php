<?php


//get offers of this request
$currentRequestId = $reqId; //set on include

$sql2 = "SELECT * FROM offers WHERE `requestidfk` = $currentRequestId";
$rs_result2 = mysqli_query($conn, $sql2);   

if($rs_result2->num_rows == 0) echo '<p class="mt-4">Waiting for offers...</p>';

while ($row = mysqli_fetch_array($rs_result2)) {  

        //allert if dates are different
        $clientCollect = strtotime($currentRequestFromTime);
        $supplierCollect = strtotime($row['collect_time']);
        $clientDeliver = strtotime($currentRequestToTime);
        $supplierDeliver= strtotime($row['deliver_time']);
        $isDiffDate = false;

        if($supplierCollect < $clientCollect) {
            $isDiffDate = true;
        }
        if($supplierDeliver > $clientDeliver) {
            $isDiffDate = true;
        }
   
?>

<div class="single-offer choose-best">
    <?php $offerImages = unserialize($row["offer_attachments"]); //array of offerImages ?>
    <?php if(!empty($offerImages)) : ?>
    <div class="gallery-attach">
        <div class="imageGallery0<?php echo $currentRequestId ?>">

            <script src="/vendor/simpleLightbox/simpleLightbox.min.js"></script>
            <link href="/vendor/simpleLightbox/simpleLightbox.min.css" rel="stylesheet">

            
                <?php $i = 1; ?>
                <?php foreach($offerImages as $image) : ?>
                    <?php if($i == 1) : ?>
                        <?php $i++; ?>
                        <a href="/uploads/<?php echo $image; ?>">View images</a>
                    <?php else : ?>
                        <a href="/uploads/<?php echo $image; ?>"></a>
                    <?php endif; ?>
                <?php endforeach; ?>
            
            
            <script>
                $('.imageGallery0<?php echo $currentRequestId ?> a').simpleLightbox();
            </script>

        </div>
    </div>
    <?php endif; ?>

    <div class="off-err">
        <?php if($isDiffDate): ?>
            <p class="error-warn"><span>⚠</span> Attention: one of the two dates does not correspond to those requested, this is our best proposal.</p>
        <?php endif; ?>
    </div>    

    <div class="offer-collection">
        <p><b>Goods Collection</b><br><?php echo substr($row['collect_time'], 0, -3); ?></p>
    </div>
    <div class="offer-delivery">
        <p><b>Goods Delivery</b><br><?php echo substr($row['deliver_time'], 0, -3); ?></p>
    </div>
    <div class="offer-price">
        <?php if($discountInfo == null): ?>
            <h4>€ <?php echo getClientCommissionsCalculated($row['price'], $_SESSION['user_id']) ?></h4>
        <?php else: ?>
            <h4>€ <?php echo calculateDiscount(getClientCommissionsCalculated($row['price'], $_SESSION['user_id']), $discountInfo['disc_percent'] == null ? 0 : $discountInfo['disc_percent']) ?></h4> <p class="disc-under-price">-<?php echo $discountInfo["disc_percent"]; ?>% calculated</p>
        <?php endif; ?>
    </div>
    <div class="offer-button">
        <input type="hidden" class="offer_id" value="<?php echo $row['offer_id'] ?>">
        <button class="blockOffer" type="button">BOOK THE FREIGHT</button>
    </div>
</div>


<?php } ?>