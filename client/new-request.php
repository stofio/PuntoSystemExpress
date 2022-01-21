<?php $page_title = 'New Request'; ?>
<?php require_once 'include/header.php'; ?>
<link href="/vendor/bootstrap-datetimepicker-master/bootstrap-datetimepicker.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

 
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

                    <label>Contact Person<br>
                        <input type="text" name="contact_person" class="contact_person" placeholder="Contact Person" required/>
                    </label>

                    <label>Delivered within<br>
                        <input type="text" name="to_time" class="request_delivered_within" placeholder="Available within" required/>
                    </label>
                    <label>From<br>
                        <!-- <input type="text" name="from_place" class="request_from" placeholder="From" required/> -->
                        <select name="from_place" class="request_from" required>
                            <optgroup label="EU" class="request_from_eu_group"></optgroup>
                            <!-- <optgroup label="extra-EU" class="request_from_non_eu_group"></optgroup> -->
                        </select>
                    </label>

                    <label>Loading Point<br>
                        <input type="text" name="loading_point" class="loading_point" placeholder="Loading Point" required/>
                    </label>
                </div>

                <div class="col-md-4">
                    <label>Internal Ref. Number<br>
                        <input type="text" name="internal_ref_number" class="internal_ref_number" placeholder="Internal Ref. Number" required/>
                    </label>

                    <label>Valid until<br>
                        <input type="text" name="valid_until" class="request_expire" placeholder="Valid until" required/>
                    </label>
                    <label>To<br>
                        <!-- <input type="text" name="to_place" class="request_to" placeholder="To" required/> -->
                        <select name="to_place" class="request_to" required>
                            <optgroup label="EU" class="request_to_eu_group"></optgroup>
                            <optgroup label="extra-EU" class="request_to_non_eu_group"></optgroup>
                        </select>
                    </label>

                    <label>Discharge Point<br>
                        <input type="text" name="discharge_point" class="discharge_point" placeholder="Discharge Point" required/>
                    </label>
                </div>

                <div class="col-md-12">
                    <label>Colli
                        <div class="colli-container">
                            <div class="collo-single">
                                <span class="coll-nu">1</span>
                                <label>Weight</label><input type="text" class="collo-kg" placeholder="In KG, E.g. 350" required>
                                <label>Lenght</label><input type="text" class="collo-l" placeholder="In m, E.g. 5" required>
                                <label>Width</label><input type="text" class="collo-w" placeholder="In m, E.g. 1.2" required>
                                <label>Height</label><input type="text" class="collo-h" placeholder="In m, E.g. 2.4" required>
                            </div>
                            <span id="new-collo">+ Add new</span>
                        </div>
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
                    <div class="error-container"></div>
                    <button name="send_request" type="submit">Send request</button>
                </div>
            </div>
        </form>

    
    </section>


    <script src="/vendor/bootstrap-datetimepicker-master/bootstrap-datetimepicker.min.js"></script>
    <script src="/client/js/new-request.js"></script>

<?php require_once 'include/footer.php'; ?>