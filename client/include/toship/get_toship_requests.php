<?php

session_start();

include $_SERVER['DOCUMENT_ROOT'].'/functions.php';

$userid = $_SESSION['user_id'];

$limit = 5;  
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
$start_from = ($page-1) * $limit;  
  
$sql = "SELECT * FROM requests 
INNER JOIN `offers` on `requests`.`id` = `offers`.`requestidfk` 
WHERE `request_status` in (4,5) AND `useridfk` = $userid 
ORDER BY created DESC LIMIT $start_from, $limit";  
$rs_result = mysqli_query($conn, $sql);  

//echo $userid;
if($rs_result->num_rows == 0) echo '<p class="mt-4">No requests in transit...</p>';


?> 
   
<?php  
while ($row = mysqli_fetch_array($rs_result)) {  
?>  


<div class="single-order">
            <input type="hidden" class="request_id" value="<?php echo $row["id"]; ?>">
            <div class="single-order-header">
                <div class="header-details">
                <h2 class="order-title">ID #<?php echo $row["id"]; ?></h2>
                    <div class="order-details">
                        <div class="row">
                            <div class="col-md-6">
                                <p><b>From</b> <?php echo $row["from_place"]; ?></p>
                                <p><b>To</b> <?php echo $row["to_place"]; ?></p>
                                <p><b>Time of arrival for loading</b> <?php echo substr($row["final_from_time"], 0, -3); ?></p>
                                <p><b>Estimated time unloading</b> <?php echo substr($row["final_to_time"], 0, -3); ?></p>
                            </div>
                            <div class="col-md-6">
                                <p><b>Driver name</b> <?php echo $row["driver_name"]; ?></p>
                                <p><b>Vehicle num.</b> <?php echo $row["vehicle_num"]; ?></p>
                                <p><b>BeOne ref.</b> <?php echo $row["beone_ref"]; ?></p>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="header-controls">
                    <?php if($row["request_status"] == 4) : //if is IN TRANSIT ?> 
                        <span class="order-status">IN TRANSIT</span>
                    <?php elseif($row["request_status"] == 5) ://if is DELIVERED ?>
                        <span class="order-status">DELIVERED</span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="arrow-toggle"><span>❯</span></div>
            <div class="live_request single-order-body panel-collapse intransit">
                <div class="row mb-5">
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
                    <?php if($row["request_status"] !== '0' ) : ?>
                    <div class="col-md-6">
                        <p><b>Offer attachments</b></p>
                        <div class="gallery-attach">
                            <div class="imageGallery2">

                                <script src="/vendor/simpleLightbox/simpleLightbox.min.js"></script>
                                <link href="/vendor/simpleLightbox/simpleLightbox.min.css" rel="stylesheet">

                                <?php $images = unserialize($row["offer_attachments"]); //array of images ?>


                                <?php foreach($images as $image) : ?>
                                    <a href="/uploads/<?php echo $image; ?>"><img src="/uploads/<?php echo $image; ?>"/></a>
                                <?php endforeach; ?>

                                <script>
                                    $('.imageGallery2 a').simpleLightbox();
                                </script>


                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="mt-3" >
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
                <div class="single-offer">
                    <input type="hidden" class="offer_id" value="<?php echo $row["offer_id"]; ?>">
                    <div class="offer-type">
                        <span>BOOKED OFFER</span>
                    </div>
                    <div class="offer-collection">
                        <p><b>Good Collection</b><br><?php echo substr($row["final_from_time"], 0, -3); ?></p>
                    </div>
                    <div class="offer-delivery">
                        <p><b>Good Delivery</b><br><?php echo substr($row["final_to_time"], 0, -3); ?></p>
                    </div>
                    <div class="offer-price">
                        <h4>€ <?php echo $row["final_price_with_comm"]; ?></h4>
                    </div>
                </div>
            </div>
        </div>

<?php  
};  
?>  

