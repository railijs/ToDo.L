<header class="bg-gray-100 py-4 shadow-sm">
    <nav class="container mx-auto flex justify-between items-center px-4">
        <div class="flex items-center space-x-4">
            <a href="/" class="text-gray-800 text-lg font-semibold">Home</a>
            <a href="/login" class="text-gray-800 text-lg font-semibold">Login</a>
            <a href="/register" class="text-gray-800 text-lg font-semibold">Register</a>
        </div>
        
        <?php if (isset($_SESSION["user"])): ?>
            <form method="POST" action="/logout">
                <button type="submit" class="text-gray-800 text-lg font-semibold">Log Out</button>
            </form>
        <?php endif; ?>
    </nav>
</header>