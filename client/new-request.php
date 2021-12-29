<?php $page_title = 'New Request'; ?>
<?php require_once 'include/header.php'; ?>
<link href="/vendor/bootstrap-datetimepicker-master/bootstrap-datetimepicker.min.css" rel="stylesheet">
 
    <section class="text-center hero-section">
        <div class="breadcrumbs">
            <span><a href="/client">Client dashboard</a></span> » 
            <span><?php echo $page_title; ?></span>
        </div>
        <div class="row align-items-center">
            <div>
                <h1><?php echo $page_title; ?></h1>
                <p>Request a new shipping</p>
            </div>
        </div>
    </section>

    <section id="new_request">

        <form id="new_request_form" enctype="multipart/form-data" autocomplete="off">
            <div class="new-request-container row">

                <div class="col-md-4">
                    <label>Shipment title<br>
                        <input type="text" name="title" class="request_title" placeholder="Shipment title" value="Express Shipping" required/>
                    </label>
                    <label>Available from<br>
                        <input type="text" name="from_time" class="request_available_from" placeholder="Available from" required/>
                    </label>


                </div>

                <div class="col-md-4">
                    <label>From<br>
                        <input type="text" name="from_place" class="request_from" placeholder="From" required/>
                    </label>
                    <label>Delivered within<br>
                        <input type="text" name="to_time" class="request_delivered_within" placeholder="Available within" required/>
                    </label>
                </div>

                <div class="col-md-4">
                    <label>To<br>
                        <input type="text" name="to_place" class="request_to" placeholder="To" required/>
                    </label>
                    <label>Valid until<br>
                        <input type="text" name="valid_until" class="request_expire" placeholder="Valid until" required/>
                    </label>
                </div>

                <div class="col-md-12">
                    <label>Note<br>
                        <textarea placeholder="Note" name="note"></textarea>
                    </label>
                </div>
                <div class="col-md-12">
                    <label>Attachments (files larger then 50MB will not be uploaded)<br>
                        <input type="file" name="files[]" id="files" multiple />
                    </label>
                </div>
                <div class="col-md-12">
                    <button name="send_request" type="submit">Send request</button>
                </div>
            </div>
        </form>

    
    </section>


    <script src="/vendor/bootstrap-datetimepicker-master/bootstrap-datetimepicker.min.js"></script>
    <script src="/client/js/new-request.js"></script>

<?php require_once 'include/footer.php'; ?>