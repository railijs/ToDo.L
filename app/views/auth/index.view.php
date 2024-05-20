<?php require "../app/views/components/header.php" ?>
<?php require "../app/views/components/navbar.php" ?>

<div class="min-h-screen flex flex-col justify-center items-center bg-gray-100 text-gray-800">


    <div class="bg-white shadow-lg rounded-lg p-6 w-full max-w-4xl mt-20">
        <h2 class="text-2xl font-semibold mb-4">Your Tasks</h2>
        <ul class="divide-y divide-gray-200">
            <?php foreach($tasks as $task) { ?>
                <li class="py-4 flex justify-between items-center">
                    <span class="text-gray-600">ID: <?= htmlspecialchars($task->id) ?></span>
                    <span class="text-gray-600">Description: <?= htmlspecialchars($task->description) ?></span>
                    <span class="text-gray-600">Deadline: <?= htmlspecialchars($task->deadline) ?></span>
                    <span class="text-gray-600">User ID: <?= htmlspecialchars($task->user_id) ?></span>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>

<?php require "../app/views/components/footer.php" ?>