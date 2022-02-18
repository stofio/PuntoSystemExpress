<?php

session_start();

include $_SERVER['DOCUMENT_ROOT'].'/functions.php';

$userId = $_SESSION['user_id'];

$limit = 5;  
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
$start_from = ($page-1) * $limit;  


//get requestidfk from offers where useridfk = $userID
$sql = "SELECT *
FROM `requests` 
INNER JOIN `offers` on `requests`.`id` = `offers`.`requestidfk` 
INNER JOIN `users` on `users`.`userid` = `offers`.`offer_useridfk`
WHERE `requests`.`useridfk` = $userId 
AND `requests`.`request_status` = 4 
AND `offers`.`offer_status` = 3
ORDER BY `requests`.`created` DESC LIMIT $start_from, $limit";
$rs_result = mysqli_query($conn, $sql);  
 
if($rs_result->num_rows == 0) echo '<p class="mt-4">No shipped requests yet...</p>';

?>
   
<?php  
while ($row = mysqli_fetch_array($rs_result)) {  
    
?>  

        <div class="single-order">
            <input type="hidden" class="request_id" value="<?php echo $row["id"]; ?>">
            <div class="single-order-header">
                <div class="header-details">
                    <h2 class="order-title"><?php echo $row["title"]; ?></h2>
                    <div class="order-details">
                        <p><b>From</b> <?php echo $row["from_place"]; ?></p>
                        <p><b>To</b> <?php echo $row["to_place"]; ?></p>
                        <p><b>Available from</b> <?php echo substr($row["from_time"], 0, -3); ?></p>
                        <p><b>Delivered within</b> <?php echo substr($row["to_time"], 0, -3); ?></p>
                        <p>Offer Available Until <?php echo substr($row["valid_until"], 0, -3); ?></p>
                    </div>
                </div>
                <div class="header-controls">
                    <span class="order-status">SHIPPED</span>
                </div>
            </div>
            <div class="live_request single-order-body">
                <div class="single-offer">
                    <input type="hidden" class="offer_id" value="<?php echo $row["offer_id"]; ?>">
                    <div class="offer-type">
                        <p><b>Name</b> <?php echo $row['name'] . ' ' . $row['surname']; ?></p>
                        <p><b>Email</b> <?php echo $row['email']; ?></p>
                        <p><b>Phone</b> <?php echo $row['phone']; ?></p>
                    </div>
                    <div class="offer-collection">
                        <p><b>Good Collection</b><br><?php echo substr($row["collect_time"], 0, -3); ?></p>
                    </div>
                    <div class="offer-delivery">
                        <p><b>Good Delivery</b><br><?php echo substr($row["deliver_time"], 0, -3); ?></p>
                    </div>
                    <div class="offer-price">
                        <h4>€ <?php echo $row["price"]; ?></h4>
                    </div>
                    <div class="contact-supplier">
                        <a href="mailto:<?php echo $row["email"]; ?>">
                            <button type="button">Send email</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>


<?php  
};  
?>  

