<?php $page_title = 'View Request'; ?>
<?php require_once 'include/header.php'; ?>

<?php  

require_once $_SERVER['DOCUMENT_ROOT'].'/functions.php';


$requestid = $_GET['i'];
$userid = $_SESSION['user_id'];

//get request, if null redirect
$sql = "SELECT * FROM requests WHERE `id` = $requestid AND `useridfk` = $userid";
if ($result = mysqli_query($conn, $sql)) {
    $row = mysqli_fetch_array($result);
    //redirect
    if($row == null) {
        header('Location: /client/my-requests');
    }
}

//get statuses
$sql2 = "SELECT * FROM request_status WHERE statusid = " . $row["request_status"];
$result2 = mysqli_query($conn, $sql2);
$status = mysqli_fetch_assoc($result2);

//if status live redirect
if($status['statusname'] == 'LIVE') header('Location: /client/my-requests');
  

?>

<div class="container single-order">
    <input type="hidden" class="req_id" value="<?php echo $row["id"]; ?>" />
    <div class="my-5">
        <div class="d-flex choose-offer-details" style="justify-content: space-between">
            <div class="header-details" style="width: 100%">
                <h2 class="order-title">ID #<?php echo $row["id"]; ?> - Status <span style="color:#e6342a"><?php echo $status['statusname'] ?></span></h2>
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
                <div class="mt-4">
                    <p><b>Note</b></p>
                    <p><?php echo $row["note"] ?></p>
                </div>  

                <div class="mt-5">
                <?php

                    //get offers of this request
                    $currentRequestId = $row["id"];
                    $sql2 = "SELECT * FROM offers WHERE `requestidfk` = $currentRequestId AND `offer_status` not in (1)";
                    $rs_result2 = mysqli_query($conn, $sql2);  

                    $offer = mysqli_fetch_assoc($rs_result2);

                ?>


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
                </div>
                
            </div>     
        </div>
    </div>

</div> <!-- container -->



<?php include $_SERVER['DOCUMENT_ROOT'].'/include/footer.php'; ?>  