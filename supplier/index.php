<?php $page_title = 'Express'; ?>
<?php require_once 'include/header.php'; ?>

<h1>Supplier dashboard</h1>

<ul>
    <li><a href="/supplier/today">Discover and apply to today shipping requests</a></li>
    <li><a href="/supplier/offers">See your active offers and confirm shipping</a></li>
    <li><a href="/supplier/shipped">See your shipped shipments</a></li>
    <li><a href="/supplier/account">Edit your account</a></li>
</ul>

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/include/footer.php'; ?>