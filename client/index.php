<?php $page_title = 'Express'; ?>
<?php require_once 'include/header.php'; ?> 

<div class="container mt-5">

<h1 style="text-align: center;">Client dashboard</h1>

    <div class="dashboard-box mt-5">

        <div class="row">
            <div class="col-md-8">
                <a href="/client/new-request">
                    <span>New Request</span>
                    Compile the form and send a new shipping request
                </a>
            </div>
            <div class="col-md-4">
                <a href="/client/my-requests">
                    <span>My quotes</span>
                    See your active quotes and processing one
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <a href="/client/archived">
                    <span>Archive</span>
                    See your archived/completed quotes
                </a>
            </div>
            <div class="col-md-4">
                <a href="/client/account">
                    <span>My account</span>
                    Edit your profile info
                </a>
            </div>
            <div class="col-md-4">
                <a href="/logout"><span>Logout</span></a>
            </div>
        </div>

    </div>

</div>
<?php include $_SERVER['DOCUMENT_ROOT'].'/include/footer.php'; ?> 