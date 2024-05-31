<?php require "../app/views/components/header.php"; ?>
<?php require "../app/views/components/navbar.php"; ?>

<div class="min-h-screen flex flex-col justify-center items-center bg-gray-100 text-gray-800">
    <div class="bg-white shadow-lg rounded-lg p-6 w-full max-w-4xl mt-20">
        <?php if ($task): ?>
            <h2 class="text-2xl font-semibold mb-4"><?= htmlspecialchars($task->title); ?></h2>
            <p class="text-gray-700 mb-2">Description: <?= htmlspecialchars($task->description); ?></p>
            <p class="text-gray-700 mb-2">Deadline: <?= htmlspecialchars($task->deadline); ?></p>
            <!-- Display priority as star emojis -->
            <p class="text-gray-700 mb-2">Priority: <?= str_repeat('⭐️', $task->priority); ?></p>
            <a href="/" class="text-blue-600 hover:underline">Back to Tasks</a>
        <?php else: ?>
            <h2 class="text-2xl font-semibold mb-4">Task not found</h2>
        <?php endif; ?>
    </div>
</div>

<?php require "../app/views/components/footer.php"; ?>