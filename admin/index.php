<?php $page_title = 'Admin'; ?>
<?php require_once 'include/header.php'; ?>

<div class="container pt-5">
<h1>Admin dashboard</h1>

    <ul>
        <li class="nav-item"><a href="/admin" class="nav-link" aria-current="page">Home</a></li>
        <li class="nav-item"><a href="/admin/waiting-approval" class="nav-link">Waiting approval</a></li>
        <li class="nav-item"><a href="/admin/manual" class="nav-link">Manual</a></li>
        <li class="nav-item"><a href="/admin/archive" class="nav-link">Archive</a></li>
        <li class="nav-item"><a href="/admin/commissions" class="nav-link">Commissions</a></li>
        <li class="nav-item"><a href="/logout" class="nav-link">Log out</a></li>
    </ul>

</div>

<?php include $_SERVER['DOCUMENT_ROOT'].'/include/footer.php'; ?>  