<?php
/**
 * get archived requests for ADMIN (that are approved or manual)
 */  
 

include $_SERVER['DOCUMENT_ROOT'].'/functions.php';


$limit = 20;  
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
$start_from = ($page-1) * $limit;  
  
$sql = "SELECT * FROM requests WHERE `request_status` not IN (1,2) AND is_manual != 1 ORDER BY created DESC";  
$rs_result = mysqli_query($conn, $sql);  




if($rs_result->num_rows == 0) echo '<p class="mt-4">No requests to approve...</p>';

?>
   
<?php  
while ($request = mysqli_fetch_array($rs_result)) {  

    //get client 
    $sql2 = "SELECT * FROM users WHERE `userid` =" . $request["useridfk"]; //get the client that made the offer
    $result2 = mysqli_query($conn, $sql2);  
    $client = mysqli_fetch_assoc($result2);


    if($request["is_manual"] == 0 ) :
        //get offer
        $sql3 = "SELECT * FROM offers WHERE `requestidfk` =" . $request["id"] . " AND `offer_status` in (2,3,4)"; //get the offer thats booked  
        $result3 = mysqli_query($conn, $sql3);  
        $offer = mysqli_fetch_assoc($result3);
        
        //get supplier
        $sql4 = "SELECT * FROM users WHERE `userid` =" . $offer["offer_useridfk"];  
        $result4 = mysqli_query($conn, $sql4);  
        $supplier = mysqli_fetch_assoc($result4);
    endif;

    //check for discount
    $discountInfo = getDiscountinfo($request["useridfk"], $request["id"]);


?>  

         <div class="single-order admin-approval">
            <input type="hidden" class="request_id" name="request_id" value="<?php echo $request["id"]; ?>">
            <div class="single-order-header">
                <div class="header-details" style="width:80%">
                    <h2 class="order-title">ID #<?php echo $request["id"]; ?></h2>
                    <div class="order-details row">
                        <div class="col-md-4">
                            <h3>Request</h3>
                            <p><b>Created</b> <?php echo $request["created"]; ?></p>
                            <p><b>Name</b> <?php echo $request["name"]; ?></p>
                            <p><b>Phone</b> <?php echo $request["phone"]; ?></p>
                            <p><b>Email</b> <?php echo $request["email"]; ?></p>
                            <p><b>From</b> <?php echo $request["from_place"]; ?>, <?php echo $request["loading_point"]; ?></p>
                            <p><b>To</b> <?php echo $request["to_place"]; ?>, <?php echo $request["discharge_point"]; ?></p>
                            <p><b>Note</b> <?php echo $request["note"]; ?></p> 
                        </div>
                        <div class="col-md-4">
                            <h3 style="opacity:0">_</h3>
                            <p><b>Available</b> <?php echo substr($request["from_time"], 0, -3); ?></p>
                            <p><b>Delivered</b> <?php echo substr($request["to_time"], 0, -3); ?></p>
                            <p><b>Shipment Ref.</b> <?php echo $request["shipment_ref"]; ?></p>
                            <p><b>Commodity</b> <?php echo $request["commodity"]; ?></p>
                            <p><b>ADR</b> <?php echo $request["adr"] == 0 ? '???' : '???'; ?></p>
                            <p><b>Temp. Control</b> <?php echo $request["temp_cont"] == 0 ? '???' : '???'; ?></p>
                        </div>
                        <?php if($request["request_status"] !== '0' ) : ?>
                        <div class="col-md-4 supp-offer">
                            <h3>Offer</h3> 
                            <p><b>Price</b> <?php echo $offer["price"]; ?> ???</p>
                            <p><b>Price (+commission)</b> <?php echo getClientCommissionsCalculated($offer['price'], $request["id"]) ?> ???</p>
                            <?php if($discountInfo !== null): ?>
                                <p><b>Price (<span style="color:green"> -<?php echo $discountInfo['disc_percent']; ?> discount </span>)</b> <?php echo calculateDiscount(getClientCommissionsCalculated($offer['price'], $request["useridfk"]), $discountInfo['disc_percent'] == null ? 0 : $discountInfo['disc_percent']) ?> ???</p>
                            <?php endif; ?>
                            <p><b>Collect time</b> <?php echo substr($offer["collect_time"], 0, -3); ?></p>
                            <p><b>Deliver time</b> <?php echo substr($offer["deliver_time"], 0, -3); ?></p>
                            <p><b>Valid ultil</b> <?php echo substr($offer["valid_until"], 0, -3); ?></p>
                            <p><b>Created</b> <?php echo substr($offer["offer_created"], 0, -3); ?></p>
                            <p><b>Note</b> <?php echo $offer["offer_note"]; ?></p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="header-controls">
                    <span class="order-status">
                        <?php echo $request["request_status"] == '0' ? 'MANUAL' : '<span title="Ref. n. BeOne">Ref. '. $request["beone_ref"] .'</span>' ?>                                   
                    </span>
                </div>
            </div>
            <div class="arrow-toggle"><span>???</span></div>
            <div class="live_request single-order-body panel-collapse">
                <div class="row mb-5">
                    <div class="col-md-6 ml-5">
                        <p><b>Request attachments</b></p>
                        <div class="gallery-attach">
                            <div class="imageGallery1">

                                <script src="/vendor/simpleLightbox/simpleLightbox.min.js"></script>
                                <link href="/vendor/simpleLightbox/simpleLightbox.min.css" rel="stylesheet">

                                <?php $images = unserialize($request["attachments"]); //array of images ?>


                                <?php foreach($images as $image) : ?>
                                    <a href="/uploads/<?php echo $image; ?>"><img src="/uploads/<?php echo $image; ?>"/></a>
                                <?php endforeach; ?>

                                <script>
                                    $('.imageGallery1 a').simpleLightbox();
                                </script>


                            </div>
                        </div> 
                    </div>
                    <?php if($request["is_manual"] == 0 ) : ?>
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

                                <script src="/vendor/simpleLightbox/simpleLightbox.min.js"></script>
                                <link href="/vendor/simpleLightbox/simpleLightbox.min.css" rel="stylesheet">

                                <?php $images = unserialize($request["POD"]); //array of images ?>


                                <?php foreach($images as $image) : ?>
                                    <a href="/uploads/<?php echo $image; ?>"><img src="/uploads/<?php echo $image; ?>"/></a>
                                <?php endforeach; ?>

                                <script>
                                    $('.imageGallery3 a').simpleLightbox();
                                </script>


                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="mt-3" >
                    <p><b>Packing list</b></p>
                    <?php 
                        $jsonColli = $request["colli"];

                        $colli = unserialize($jsonColli);
                        //var_dump($colli['colli']);
                        foreach ($colli['colli'] as $c) {
                            $n = $c['name'];
                            $le = $c['lenght'];
                            $wi = $c['width'];
                            $hi = $c['height'];
                            $we = $c['weight'];
                            $st = $c['stack'] == 1 ? '???' : '???';
                            echo "<p><b>$n</b> - [ Lenght: $le cm ], [ Width: $wi cm ], [ Height: $hi cm ], [ Weight: $we Kg ], [ Stackable: $st ]</p>";
                            }
                        
                        ?>
                </div>
                <form class="offer_form" enctype="multipart/form-data" autocomplete="off">
                    <input type="hidden" class="request_id" name="request_id" value="<?php echo $request["id"]; ?>">
                    <input type="hidden" class="offer_id" name="offer_id" value="<?php echo $offer["offer_id"]; ?>">
                    <div class="single-offer">
                        <div class="order-details row">
                            <div class="col-md-6 ml-5">
                                <h3>Client info</h3>
                                <p><b>Name</b> <?php echo $client["name"]; ?> <?php echo $client["surname"]; ?></p>
                                <p><b>Company</b> <?php echo $client["company_name"]; ?></p>
                                <p><b>Email</b> <?php echo $client["email"]; ?></p>
                                <p><b>Contact Email</b> <?php echo $client["contact_email"]; ?></p>
                                <p><b>Phone</b> <?php echo $client["phone"]; ?></p>
                            </div>
                            <?php if($request["request_status"] !== '0' ) : ?>
                            <div class="col-md-6 pe-5">
                                <h3>Supplier info</h3>
                                <p><b>Name</b> <?php echo $supplier["name"]; ?> <?php echo $supplier["surname"]; ?></p>
                                <p><b>Company</b> <?php echo $supplier["company_name"]; ?></p>
                                <p><b>Email</b> <?php echo $supplier["email"]; ?></p>
                                <p><b>Contact Email</b> <?php echo $supplier["contact_email"]; ?></p>
                                <p><b>Phone</b> <?php echo $supplier["phone"]; ?></p>
                            </div>
                            <?php endif; ?>
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

