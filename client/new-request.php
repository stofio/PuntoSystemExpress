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

        <form id="new_request_form">
            <div class="new-request-container row">
                <div class="col-md-6">
                    <label>Title request<br>
                        <input type="text" class="request_title" placeholder="Title request" value="Express Shipping" required/>
                    </label>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Available from<br>
                                <input type="text" class="request_available_from" placeholder="Available from" required/>
                            </label>
                        </div>
                        <div class="col-md-6">
                            <label>Delivered within<br>
                                <input type="text" class="request_delivered_withing" placeholder="Available within" required/>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label>From<br>
                        <input type="text" class="request_from" placeholder="From" required/>
                    </label>
                    <label>To<br>
                        <input type="text" class="request_to" placeholder="To" required/>
                    </label>
                </div>
                <div class="col-md-12">
                    <button type="submit">Send request</button>
                </div>
            </div>
        </form>

    
    </section>


    <script src="/vendor/bootstrap-datetimepicker-master/bootstrap-datetimepicker.min.js"></script>
    <script src="/client/js/new-request.js"></script>

<?php require_once 'include/footer.php'; ?>