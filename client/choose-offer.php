<?php $page_title = 'Choose Offer'; ?>
<?php require_once 'include/header.php'; ?>

<?php  

require_once $_SERVER['DOCUMENT_ROOT'].'/functions.php';


$requestid = $_GET['i'];
$userid = $_SESSION['user_id'];

$sql = "SELECT * FROM requests WHERE `id` = $requestid AND `request_status` = 1 AND `useridfk` = $userid";
//get request, if null redirect
$result = mysqli_query($conn, $sql);

if($result->num_rows == 0) {
   echo "<script>location='/client/my-requests'</script>";
   exit();
} 
else {
    $row = mysqli_fetch_array($result);
}

?>

<div class="container single-req">
    <input type="hidden" class="req_id" value="<?php echo $row["id"]; ?>" />
    <div class="my-5">
        <div class="d-flex choose-offer-details" style="justify-content: space-between">
            <div class="header-details" style="width: 100%">
                <h2 class="order-title">ID #<?php echo $row["id"]; ?></h2>
                <div class="order-details row">
                    <div class="col-md-6">
                        <p><b>From</b> <?php echo $row["from_place"]; ?>, <?php echo $row["loading_point"]; ?></p>
                        <p><b>To</b> <?php echo $row["to_place"]; ?>, <?php echo $row["discharge_point"]; ?></p>
                        <p><b>Available</b> <?php echo substr($row["from_time"], 0, -3); ?></p>
                        <p><b>Delivered</b> <?php echo substr($row["to_time"], 0, -3); ?></p>
                        <p><b>Note</b> <?php echo $row["note"]; ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><b>Shipment Ref.</b> <?php echo $row["shipment_ref"]; ?></p>
                        <p><b>Commodity</b> <?php echo $row["commodity"]; ?></p>
                        <p><b>ADR</b> <?php echo $row["adr"] == 0 ? '✗' : '✓'; ?></p>
                        <p><b>Temp. Control</b> <?php echo $row["temp_cont"] == 0 ? '✗' : '✓'; ?></p>
                    </div>
                </div>
                <div class="mt-5">
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
                </div>   
            </div>     
        </div>

        <div class="live_request single-order-body mt-5">
            <h2 class="mt-4">Choose the best option for you</h2>
            <?php
                $reqId = $row['id'];
                include 'include/choose_offer/get_all_offers.php'; 
            ?>

        </div>
    </div>

</div> <!-- container -->


<script src="/client/js/choose-offer.js"></script>

<?php include $_SERVER['DOCUMENT_ROOT'].'/include/footer.php'; ?>  