<?php require "../app/views/components/header.php" ?>
<?php require "../app/views/components/navbar.php" ?>


<div class="min-h-screen flex flex-col justify-center items-center bg-gray-100 text-gray-800">
    <div class="bg-white shadow-lg rounded-lg p-6 w-full max-w-4xl mt-20">
        <h2 class="text-2xl font-semibold mb-4">Your Tasks</h2>
        <ul class="divide-y divide-gray-200">
            <?php foreach($tasks as $task) { ?>
                
                <li class="py-4">
                    <div class="grid grid-cols-3 gap-x-4">
                        <div>
                            <span class="text-gray-500 text-sm font-semibold">Title:</span>
                            <span class="text-gray-800 text-lg font-bold"><?= htmlspecialchars($task->title) ?></span>
                        </div>
                        <div>
                            <span class="text-gray-500 text-sm font-semibold">Deadline:</span>
                            <span class="text-red-600 text-lg font-bold"><?= htmlspecialchars($task->deadline) ?></span>
                        </div>
                        <div>
                            <a href="/task/<?= htmlspecialchars($task->id) ?>" class="bg-blue-600 text-white font-semibold py-2 px-4 rounded hover:bg-blue-700 focus:outline-none focus:bg-blue-700">Show Task</a>
                        </div>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>

<?php require "../app/views/components/footer.php" ?>
