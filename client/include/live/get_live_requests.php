<?php
/**
 * page with CLIENT current requests/quotes
 */ 

session_start();

include $_SERVER['DOCUMENT_ROOT'].'/functions.php';

$userid = $_SESSION['user_id'];



$limit = 5;  
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
$start_from = ($page-1) * $limit;  
  
$sql = "SELECT * FROM requests WHERE `request_status` in (1) AND `useridfk` = $userid 
ORDER BY id DESC LIMIT $start_from, $limit";       
$rs_result = mysqli_query($conn, $sql);   


if($rs_result->num_rows == 0) echo '<p class="mt-4">No live requests...</p>';

?>
   
<?php  
while ($row = mysqli_fetch_array($rs_result)) {  
?>  

         <div class="single-order">
            <input type="hidden" class="request_id" name="request_id" value="<?php echo $row["id"]; ?>">
            <div class="single-order-header">
                <div class="header-details" style="width:80%">
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
                </div>
                <div class="header-controls">
                    <span class="order-status">
                        
                        <?php
                            $time_limit = 180; //600 = 10 min
                            $now = time();
                            $created = strtotime($row["created"]);
                            $time_passed = $now - $created;
                            //$time_passed = date('i:s', $now - $created);
                            $remaining_time = $time_limit - $time_passed;

                            if($row["is_manual"] == 1) { //if its manual 
                                $time_remaining = 'MANUAL 
                                    <div class="offer-button view-button mt-3">
                                        <button class="greybtn archiveRequest" type="button">Move to archive</button>
                                    </div>
                                    <div class="offer-button view-button mt-3">
                                        <a class="view-request viewRequest" type="button">View request</a>
                                    </div>
                                    ';
                            }
                            else {
                                if ($remaining_time <=0) {
                                    $time_remaining = 'BOOKABLE 
                                        <div class="offer-button view-button mt-3">
                                            <button class="viewQuote" type="button">View the quote</button>
                                        </div>';
                                }
                                else {
                                    $time_remaining = 'Processing quote <br><span class="the-time">' . date('i:s', $remaining_time) . '</span>';
                                }
                            }
        
                        ?>
                        <span 
                        data-time-limit="<?php echo $time_limit; ?>" 
                        class="time-passed">
                            <?php echo $time_remaining; ?>
                        </span>
                                            
                    </span>
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
            </div>
        </div>

<?php  
};  
?>  

