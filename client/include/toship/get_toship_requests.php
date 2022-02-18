<?php

session_start();

include $_SERVER['DOCUMENT_ROOT'].'/functions.php';

$userid = $_SESSION['user_id'];

$limit = 5;  
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
$start_from = ($page-1) * $limit;  
  
$sql = "SELECT * FROM requests WHERE `request_status` = 3 AND `useridfk` = $userid 
ORDER BY created DESC LIMIT $start_from, $limit";  
$rs_result = mysqli_query($conn, $sql);  

//echo $userid;
if($rs_result->num_rows == 0) echo '<p class="mt-4">No requests to ship...</p>';


?>
   
<?php  
while ($row = mysqli_fetch_array($rs_result)) {  
?>  


        <div class="single-order">
        <input type="hidden" class="request_id" name="request_id" value="<?php echo $row["id"]; ?>">
            <div class="single-order-header">
                <div class="header-details">
                    <h2 class="order-title"><?php echo $row['title']; ?></h2>
                    <div class="order-details">
                        <p><b>From</b> <?php echo $row['from_place']; ?></p>
                        <p><b>To</b> <?php echo $row['to_place']; ?></p>
                        <p><b>Available from</b> <?php echo substr($row['from_time'], 0, -3); ?></p>
                        <p><b>Delivered within</b> <?php echo substr($row['to_time'], 0, -3); ?></p>
                        <p>Offer Available Until <?php echo substr($row["valid_until"], 0, -3); ?></p>
                    </div>
                </div>
                <div class="header-controls">
                    <span class="order-status">TO SHIP</span>
                </div>
            </div> 
            <div class="live_request single-order-body">
                
                <?php

                //get blocked offers 
                $currentRequestId = $row["id"];
                $sql2 = "SELECT * FROM offers WHERE `offer_status` = 2 AND `requestidfk` = $currentRequestId";
                $rs_result2 = mysqli_query($conn, $sql2);  
                $offersArray = mysqli_fetch_all($rs_result2, MYSQLI_ASSOC)[0];

                //get user of the offer
                $offerUser = $offersArray['offer_useridfk'];
                $sql3 = "SELECT * FROM users WHERE `userid` = $offerUser";
                $rs_result3 = mysqli_query($conn, $sql3);  
                $user = mysqli_fetch_all($rs_result3, MYSQLI_ASSOC)[0];
                
                ?>

                <div class="single-offer">
                    <div class="offer-type">
                        <p><b>Name</b> <?php echo $user['name'] . ' ' . $user['surname']; ?></p>
                        <p><b>Email</b> <?php echo $user['email']; ?></p>
                        <p><b>Phone</b> <?php echo $user['phone']; ?></p>
                    </div>
                    <div class="offer-collection">
                        <p><b>Good Collection</b><br><?php echo substr($offersArray['collect_time'], 0, -3); ?></p>
                    </div>
                    <div class="offer-delivery">
                        <p><b>Good Delivery</b><br><?php echo substr($offersArray['deliver_time'], 0, -3); ?></p>
                    </div>
                    <div class="offer-price">
                        <h4>€ <?php echo $offersArray['price'] ?></h4>
                    </div>
                    <div class="offer-button">
                        <input type="hidden" class="offer_id" value="<?php echo $offersArray['offer_id'] ?>">
                        <a href="mailto:<?php echo $user['email']; ?>">
                            <button class="sendEmail" type="button">Send email</button>
                        </a>
                    </div>
                </div>
           

            </div>
        </div>

<?php  
};  
?>  

