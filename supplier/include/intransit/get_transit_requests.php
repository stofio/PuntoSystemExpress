<?php

session_start();

include $_SERVER['DOCUMENT_ROOT'].'/functions.php';

$userId = $_SESSION['user_id'];

$limit = 5;  
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
$start_from = ($page-1) * $limit;  



$sql = "SELECT *
FROM `requests` 
INNER JOIN `offers` on `requests`.`id` = `offers`.`requestidfk` 
INNER JOIN `users` on `users`.`userid` = `requests`.`useridfk`
WHERE `offers`.`offer_useridfk` = $userId AND `requests`.`request_status` = 4
ORDER BY created DESC LIMIT $start_from, $limit";
$rs_result = mysqli_query($conn, $sql);  

//if($rs_result->num_rows == 0) echo '<p class="mt-4">No in transit requests yet...</p>';

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
                        <p><b>Created</b> <?php echo $row["created"]; ?></p>
                        <p><b>From</b> <?php echo $row["from_place"]; ?></p>
                        <p><b>To</b> <?php echo $row["to_place"]; ?></p>
                        <p><b>Shipment Ref.</b> <?php echo $row["shipment_ref"]; ?></p>
                        <p><b>Commodity</b> <?php echo $row["commodity"]; ?></p>
                        <p><b>ADR</b> <?php echo $row["adr"] == 0 ? '✗' : '✓'; ?></p>
                        <p><b>Temp. Control</b> <?php echo $row["temp_cont"] == 0 ? '✗' : '✓'; ?></p>
                    </div>
                </div>
                <div class="header-controls">
                    <span class="order-status">IN TRANSIT</span>
                    <!-- <a href="mailto:<?php echo $row["email"]; ?>">
                        <button type="button">Send email</button>
                    </a> -->
                    <div class="offer-conclude">
                        <button class="sped_ritirata" type="button" style="float:right">Confirm delivered</button>
                        <form class="conclude_form" enctype="multipart/form-data" autocomplete="off">
                            <button class="sped_conclude" type="submit" style="float:right">Shipment completed</button><br>
                            <label class="mt-3"><b>POD</b> <br>
                                <input type="file" name="files[]" id="files" multiple />
                            </label>
                        </form>
                    </div>
                </div>
            </div>
            <div class="arrow-toggle"><span>❯</span></div>
            <div class="live_request single-order-body panel-collapse intransit">
                <div class="row" style="padding: 50px 25px;">
                    <div class="col-md-6 ml-5">
                        <h4>Request attachments</h4>
                    </div>
                    <?php if($row["request_status"] !== '0' ) : ?>
                    <div class="col-md-6">
                        <h4>Offer attachments</h4>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="mt-3" style="padding: 50px;">
                    <h4>Packing list</h4>
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
                <div class="single-offer">
                    <input type="hidden" class="offer_id" value="<?php echo $row["offer_id"]; ?>">
                    <div class="offer-type">
                        <span>MY OFFER</span>
                    </div>
                    <div class="offer-collection">
                        <p><b>Good Collection</b><br><?php echo substr($row["final_from_time"], 0, -3); ?></p>
                    </div>
                    <div class="offer-delivery">
                        <p><b>Good Delivery</b><br><?php echo substr($row["final_to_time"], 0, -3); ?></p>
                    </div>
                    <div class="offer-price">
                        <h4>€ <?php echo $row["price"]; ?></h4>
                    </div>
                </div>
            </div>
        </div>


<?php  
};  
?>  

