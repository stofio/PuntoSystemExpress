<?php $page_title = 'Archive'; ?>
<?php require_once 'include/header.php'; ?>




<section class="text-center hero-section"> 
    <div class="breadcrumbs container">
        <span><a href="/client">Admin</a></span> » 
        <span><?php echo $page_title; ?></span>
    </div>
    <div class="row align-items-center">
        <div>
            <h1><?php echo $page_title; ?></h1>
            <p>Archived requests: Approved and Manual</p>
        </div>
    </div>
</section>

<div id="toapprove_requests" class="container">


    <div id="target-content">loading...</div>

    <div class="clearfix">
        <ul class="pagination"> <?php include 'include/archive/pagination.php'; ?> </ul>
    </div>


</div>



<script>
    $(document).on("click", ".arrow-toggle", function(e) {
        var $_target = $(e.currentTarget);
        var $_panelBody = $_target.next(".panel-collapse");
        if ($_panelBody) {
            //$_panelBody.slideToggle('fast');
        }
        if ($_panelBody.css('display') !== 'none') {
            $_panelBody.slideUp(300);
            $_target.find('span').css({ 'transform': 'rotate(90deg)' });
        } else {
            $_panelBody.slideDown(300);
            $_target.find('span').css({ 'transform': 'rotate(-90deg)' });
        }
    })

    $("#target-content").load("include/archive/get_archived.php?page=1");
    $(".page-link.page-link").click(function() {
        var id = $(this).attr("data-id");
        var select_id = $(this).parent().attr("id");

        $.ajax({
        url: "include/archive/get_archived.php",
        type: "GET",
        data: {
            page: id
        },
        cache: false,
        success: function(dataResult) {
            $("#target-content").html(dataResult);
            $(".pageitem").removeClass("active");
            $("#" + select_id).addClass("active");
        }
        });
    });


</script>

<?php include $_SERVER['DOCUMENT_ROOT'].'/include/footer.php'; ?>  