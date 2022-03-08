<?php

session_start();

include $_SERVER['DOCUMENT_ROOT'].'/functions.php';

$userId = $_SESSION['user_id'];

$limit = 5;  
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
$start_from = ($page-1) * $limit;  
  
//get all LIVE requests
$sql = "SELECT * FROM requests INNER JOIN offers
ON requests.id = offers.requestidfk
WHERE `request_status` = 1 ORDER BY created DESC LIMIT $start_from, $limit";  
$rs_result = mysqli_query($conn, $sql);  

//get offers of current user 
// $sql2 = "SELECT `requestidfk` FROM offers WHERE `offer_useridfk` = $userId";  
// $offers_result = mysqli_query($conn, $sql2);  
// $offers_result_array = mysqli_fetch_all($offers_result);


// $offers_array = array_column($offers_result_array, 0);


if($rs_result->num_rows == 0) echo '<p class="mt-4">No currently active requests...</p>';

?>
   
<?php  
while ($row = mysqli_fetch_array($rs_result)) {  

    // skip if there is an offer already
    //if(in_array($row["id"], $offers_array)) continue;
    
?>  

        <div class="single-order">
            <div class="single-order-header">
                <div class="header-details" style="width:80%">
                    <h2 class="order-title">ID #<?php echo $row["id"]; ?></h2>
                    <div class="order-details row">
                        <div class="col-md-6">
                            <p><b>From</b> <?php echo $row["from_place"]; ?>, <?php echo $row["loading_point"]; ?></p>
                            <p><b>To</b> <?php echo $row["to_place"]; ?>, <?php echo $row["discharge_point"]; ?></p>
                            <p><b>Available</b> <?php echo substr($row["from_time"], 0, -3); ?></p>
                            <p><b>Delivered</b> <?php echo substr($row["to_time"], 0, -3); ?></p>
                        </div>
                        <div class="col-md-6">
                            <p><b>Shipment Ref.</b> <?php echo $row["shipment_ref"]; ?></p>
                            <p><b>Commodity</b> <?php echo $row["commodity"]; ?></p>
                            <p><b>ADR</b> <?php echo $row["adr"] == 0 ? '✗' : '✓'; ?></p>
                            <p><b>Temp. Control</b> <?php echo $row["temp_cont"] == 0 ? '✗' : '✓'; ?></p>
                        </div>
                    </div>
                   
                </div> 
                <div class="header-controls">
                    <span class="order-status">LIVE</span>
                </div>
            </div>
            <div class="arrow-toggle"><span>❯</span></div>
            <div class="make-offer live_request single-order-body panel-collapse">
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
                <form class="offer_form" enctype="multipart/form-data" autocomplete="off">
                    <input type="hidden" class="request_id" name="request_id" value="<?php echo $row["id"]; ?>">
                    <div class="single-offer">
                        <div class="offer-type">
                            <span>MAKE YOUR OFFER</span>
                        </div>
                        
                        <div class="offer-delivery">
                            <p class="mb-3">
                                <b>Good Delivery Time</b><br>
                                <input size="16" type="text" placeholder="dd-mm-yyyy hh:ii" class="good_delivery" name="good_delivery" required>
                            </p>
                            <p class="mb-3">
                                <b>Good Collection Time</b><br>
                                <input size="16" type="text" placeholder="dd-mm-yyyy hh:ii" class="good_collection" name="good_collection" required>
                            </p>
                            <p>
                                <b>Offer valid until</b><br>
                                <input size="16" type="text" placeholder="dd-mm-yyyy hh:ii" class="offer_active_until" name="offer_active_until" required>
                            </p>
                        </div>
                        <div class="offer-price">
                            <p class="mb-3">
                                <b>Note (optional)</b><br>
                                <textarea placeholder="Note" name="note" class="note_area"></textarea>
                            </p>
                            <p>
                                <b>Attachments (optional)</b><br>
                                <input type="file" name="files[]" id="files" multiple />
                            </p>
                        </div>
                        <div class="offer-button send-offer">
                            <p><b>Price</b></p>
                            <h4>€ 
                                <input type="text" class="offer_price" name="offer_price" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required>
                            </h4><br>
                            <button type="submit" style="float:right">Send Offer</button>
                        </div>
                    </div>
                    <div class="note_attachm row">
                        
                    </div>
                </form>
            </div>
        </div>

<?php  
};  
?>  

