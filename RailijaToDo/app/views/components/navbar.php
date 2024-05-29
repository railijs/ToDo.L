<?php require "../app/views/components/header.php" ?>

<header class="bg-gray-800 py-4 shadow-md fixed top-0 w-full z-50">
    <nav class="container mx-auto flex justify-between items-center px-4">
        <div class="flex items-center space-x-4">
            <a href="/" class="text-white text-lg font-semibold">Home</a>
            <a href="/create" class="text-white text-lg font-semibold">Create Task</a>
            <a href="/calendar" class="text-white text-lg font-semibold">Calendar</a>
        </div>

        <?php if (isset($_SESSION["email"])): ?>
            <div class="flex items-center space-x-4">
                <span class="text-white text-lg">Welcome, <?= htmlspecialchars($_SESSION["email"]) ?></span>
                <form method="POST" action="/logout">
                    <button type="submit" class="text-white text-lg font-semibold">Log Out</button>
                </form>
            </div>
        <?php else: ?>
            <a href="/login" class="text-white text-lg font-semibold">Login</a>
        <?php endif; ?>
    </nav>
</header>


<?php require "../app/views/components/footer.php" ?>