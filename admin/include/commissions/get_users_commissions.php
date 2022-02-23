<?php
/**
 * ADMIN page with requests to approve
 */

include_once $_SERVER['DOCUMENT_ROOT'].'/functions.php';


//get users and commissions
$sql = "SELECT `users`.`userid`, `users`.`name`, `users`.`surname`, `commissions`.`commid`, `commissions`.`min_commission`, `commissions`.`mol_percent` FROM `users` LEFT JOIN `commissions` ON `users`.`userid` = `commissions`.`userid_FK` WHERE roleidfk = 2 ORDER BY `users`.`name` ASC";  
$result = mysqli_query($conn, $sql); 



while ($user = mysqli_fetch_array($result)) :
?>
    <!-- template -->

    <?php //echo $request["id"] ?>

    <form class="user_comm_form" enctype="multipart/form-data" autocomplete="off">
        <input type="hidden" name="commid" value="<?php echo $user['commid'] ?>">
        <input type="hidden" name="userid" value="<?php echo $user['userid'] ?>">
        <div class="commissions-box">
            <div class="c-name"><b><?php echo $user['name'] . ' ' . $user['surname'] ?></b></div>
            <div class="c-values">
                <label class="me-5"> Min Commission = 
                    <input type="text" name="min_commission" class="only-numb" placeholder="I.e. 300" value="<?php echo $user['min_commission']; ?>" /> €
                </label>
                <label class="me-5"> MOL = 
                    <input type="text" name="mol_percent" class="only-numb" placeholder="I.e. 30" value="<?php echo $user['mol_percent']; ?>"/> %
                </label>
            </div>
            <button type="submit">Save</button>
        </div>
    </form>


<?php  
endwhile;



//DEFAULTS
$minComm = $commissionsArr['min_commission']; //euro
$molPerc = $commissionsArr['mol_perc']; //%






?>