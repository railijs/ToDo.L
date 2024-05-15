<?php require "../app/views/components/header.php" ?>
<?php require "../app/views/components/navbar.php" ?>

<div class="min-h-screen flex flex-col justify-center items-center bg-gray-200 text-gray-800">
    <h1 class="text-3xl font-semibold mt-10">
        Welcome, <?= isset($_SESSION["email"]) ? $_SESSION["email"] : "Guest"; ?>
    </h1>
</div>

<?php require "../app/views/components/footer.php" ?>