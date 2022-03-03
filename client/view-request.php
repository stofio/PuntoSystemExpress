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
                    <span>(waiting supplier info)</span>
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
                        <p><b>Shipment Ref.</b> <?php echo $row["shipment_ref"]; ?></p>
                        <p><b>Commodity</b> <?php echo $row["commodity"]; ?></p>
                        <p><b>ADR</b> <?php echo $row["adr"] == 0 ? '✗' : '✓'; ?></p>
                        <p><b>Temp. Control</b> <?php echo $row["temp_cont"] == 0 ? '✗' : '✓'; ?></p>
                    </div>
                </div>
                <div class="row mt-5 mb-5">
                    <div class="col-md-6 ml-5">
                        <p><b>Request attachments</b></p>
                    </div>
                    <?php if($row["request_status"] !== '0' ) : ?>
                    <div class="col-md-6">
                        <p><b>Offer attachments</b></p>
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
                        $we = $c['weight'];
                        $le = $c['lenght'];
                        $wi = $c['width'];
                        $hi = $c['height'];
                        $st = $c['stack'] == 1 ? '✓' : '✗';
                        echo "<p><b>$n</b> - [ Weight: $we Kg ], [ Lenght: $le m ], [ Width: $wi m ], [ Height: $hi m ], [ Stackable: $st ]</p>";
                        }
                    
                    ?>
                </div>  

                <div class="mt-5">
                <?php

                    //get offers of this request
                    $currentRequestId = $row["id"];
                    $sql2 = "SELECT * FROM offers WHERE `requestidfk` = $currentRequestId AND `offer_status` not in (1)";
                    $rs_result2 = mysqli_query($conn, $sql2);  

                    $offer = mysqli_fetch_assoc($rs_result2);

                ?>

                    <?php if( !$row['is_manual'] ) : ?>
                    <div class="single-offer">
                        <div class="offer-type">
                            <span>BOOKED OFFER</span>
                        </div>
                        <div class="offer-collection">
                            <p><b>Good Collection</b><br><?php echo substr($offer['collect_time'], 0, -3); ?></p>
                        </div>
                        <div class="offer-delivery">
                            <p><b>Good Delivery</b><br><?php echo substr($offer['deliver_time'], 0, -3); ?></p>
                        </div>
                        <div class="offer-price">
                         <h4>€ <?php echo getClientCommissionsCalculated($offer['price'], $_SESSION['user_id']) ?></h4>
                        </div>
                    </div>
                    <?php endif; ?>

                </div>
            </div>     
        </div>
        
    </div>

</div> <!-- container -->



<?php include $_SERVER['DOCUMENT_ROOT'].'/include/footer.php'; ?>  