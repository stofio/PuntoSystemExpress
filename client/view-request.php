<?php $page_title = 'View Request'; ?>
<?php require_once 'include/header.php'; ?>

<?php  

require_once $_SERVER['DOCUMENT_ROOT'].'/functions.php';


$requestid = $_GET['i'];
$userid = $_SESSION['user_id'];

//get request, if null redirect
$sql = "SELECT * FROM requests WHERE `id` = $requestid AND `useridfk` = $userid";
$result = mysqli_query($conn, $sql);

if($result->num_rows == 0) {
    echo "<script>location='/client/my-requests'</script>";
    exit();
} 
else {
    $row = mysqli_fetch_array($result);
}

//get status name
$sql2 = "SELECT * FROM request_status WHERE statusid = " . $row["request_status"];
$result2 = mysqli_query($conn, $sql2);
$status_name = mysqli_fetch_assoc($result2)['statusname'];

//if status live redirect
if(  $row['request_status'] == 1 && !$row['is_manual'] ) {
    echo "<script>location='/client/my-requests'</script>";
    header('Location: /client/my-requests');
}

//check for discount
$discountInfo = getDiscountinfo($userid, $requestid);
  
?>

<?php

//get offers of this request
$currentRequestId = $row["id"];
$sql2 = "SELECT * FROM offers WHERE `requestidfk` = $currentRequestId AND `offer_status` not in (1)";
$rs_result2 = mysqli_query($conn, $sql2);  

$offer = mysqli_fetch_assoc($rs_result2);

?>

<div class="container">
    <input type="hidden" class="req_id" value="<?php echo $row["id"]; ?>" />
    <div class="my-5">
        <div class="d-flex choose-offer-details" style="justify-content: space-between">
            <div class="header-details" style="width: 100%">
                <h2 class="order-title">ID #<?php echo $row["id"]; ?> - Status <span style="color:#e6342a"><?php echo $status_name ?></span>
                <?php if($row['request_status'] == 2) : //if is BOOKED ?>
                    <span>(waiting admin approval)</span>
                <?php elseif($row['request_status'] == 3) : //if is APPROVED ?>
                    <span>(Waiting Truck Details)</span>
                <?php endif; ?>
                </h2>
                
                <div class="order-details row">
                    <div class="col-md-6">
                        <p><b>From</b> <?php echo $row["from_place"]; ?>, <?php echo $row["loading_point"]; ?></p>
                        <p><b>To</b> <?php echo $row["to_place"]; ?>, <?php echo $row["discharge_point"]; ?></p>
                        <p><b>Available</b> <?php echo substr($row["from_time"], 0, -3); ?></p>
                        <p><b>Delivered</b> <?php echo substr($row["to_time"], 0, -3); ?></p>
                        <p><b>Note</b> <?php echo $row["note"]; ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><b>Commodity</b> <?php echo $row["commodity"]; ?></p>
                        <p><b>ADR</b> <?php echo $row["adr"] == 0 ? '✗' : '✓'; ?></p>
                        <p><b>Temp. Control</b> <?php echo $row["temp_cont"] == 0 ? '✗' : '✓'; ?></p>
                        <p><b>Shipment Ref.</b> <?php echo $row["shipment_ref"]; ?></p>
                        <p><b>PuntoSystem Ref.</b> {<?php echo $row["beone_ref"]; ?>}</p>
                    </div>
                </div>
                <div class="row mt-5 mb-5">
                    <div class="col-md-6 ml-5">
                        <p><b>Request attachments</b></p>
                        <div class="gallery-attach">
                            <div class="imageGallery1">

                                <script src="/vendor/simpleLightbox/simpleLightbox.min.js"></script>
                                <link href="/vendor/simpleLightbox/simpleLightbox.min.css" rel="stylesheet">

                                <?php $images = unserialize($row["attachments"]); //array of images ?>


                                <?php foreach($images as $image) : ?>
                                    <a href="/uploads/<?php echo $image; ?>"><img src="/uploads/<?php echo $image; ?>"/></a>
                                <?php endforeach; ?>

                                <script>
                                    $('.imageGallery1 a').simpleLightbox();
                                </script>


                            </div>
                        </div> 
                    </div>
                    <?php if($row["is_manual"] == 0 ) : ?>
                    <div class="col-md-6">
                        <p><b>Offer attachments</b></p>
                        <div class="gallery-attach">
                            <div class="imageGallery2">

                                <script src="/vendor/simpleLightbox/simpleLightbox.min.js"></script>
                                <link href="/vendor/simpleLightbox/simpleLightbox.min.css" rel="stylesheet">

                                <?php $images = unserialize($offer["offer_attachments"]); //array of images ?>


                                <?php foreach($images as $image) : ?>
                                    <a href="/uploads/<?php echo $image; ?>"><img src="/uploads/<?php echo $image; ?>"/></a>
                                <?php endforeach; ?>

                                <script>
                                    $('.imageGallery2 a').simpleLightbox();
                                </script>


                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-5">
                        <p><b>POD</b></p>
                        <div class="gallery-attach">
                            <div class="imageGallery3">
                                <?php if($row["POD"] != ''): ?>

                                    <script src="/vendor/simpleLightbox/simpleLightbox.min.js"></script>
                                    <link href="/vendor/simpleLightbox/simpleLightbox.min.css" rel="stylesheet">

                                    <?php $images = unserialize($row["POD"]); //array of images 

                                    ?>


                                    <?php foreach($images as $image) : ?>
                                        <a href="/uploads/<?php echo $image; ?>"><img src="/uploads/<?php echo $image; ?>"/></a>
                                    <?php endforeach; ?>

                                    <script>
                                        $('.imageGallery3 a').simpleLightbox();
                                    </script>

                                <?php endif; ?>
                                
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div> 
                <div class="mt-4">
                <p><b>Packing list</b></p>
                <?php 
                    $jsonColli = $row["colli"];

                    $colli = unserialize($jsonColli);
                    //var_dump($colli['colli']);
                    foreach ($colli['colli'] as $c) {
                        $n = $c['name'];
                        $le = $c['lenght'];
                        $wi = $c['width'];
                        $hi = $c['height'];
                        $we = $c['weight'];
                        $st = $c['stack'] == 1 ? '✓' : '✗';
                        echo "<p><b>$n</b> - [ Lenght: $le cm ], [ Width: $wi cm ], [ Height: $hi cm ], [ Weight: $we Kg ], [ Stackable: $st ]</p>";
                        }
                    
                    ?>
                </div>  

                <?php if($discountInfo !== null): ?>
                    <div class="discount mt-5">
                        <p>You have used the discount code <?php echo $discountInfo["disc_code"]; ?> for this request and you are eligible for a <span style="color: green; font-weight: bold"> <?php echo $discountInfo["disc_percent"]; ?>% discount </span></p>
                    </div>
                <?php endif; ?>

                <div class="mt-5">
                

                    <?php if( !$row['is_manual'] ) : ?>
                    <div class="single-offer">
                        <div class="offer-type">
                            <span>BOOKED OFFER</span>
                        </div>
                        <div class="offer-collection">
                            <p><b>Goods Collection</b><br><?php echo substr($offer['collect_time'], 0, -3); ?></p>
                        </div>
                        <div class="offer-delivery">
                            <p><b>Goods Delivery</b><br><?php echo substr($offer['deliver_time'], 0, -3); ?></p>
                        </div>
                        <div class="offer-price">
                        <?php if($discountInfo == null): ?>
                            <h4>€ <?php echo getClientCommissionsCalculated($offer['price'], $_SESSION['user_id']) ?></h4>
                        <?php else: ?>
                            <h4>€ <?php echo calculateDiscount(getClientCommissionsCalculated($offer['price'], $_SESSION['user_id']), $discountInfo['disc_percent'] == null ? 0 : $discountInfo['disc_percent']) ?></h4> <p class="disc-under-price">-<?php echo $discountInfo["disc_percent"]; ?>% calculated</p>
                        <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                </div>
            </div>     
        </div>
        
    </div>

</div> <!-- container -->



<?php include $_SERVER['DOCUMENT_ROOT'].'/include/footer.php'; ?>  