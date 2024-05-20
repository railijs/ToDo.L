<?php require "../app/views/components/header.php" ?>
<?php require "../app/views/components/navbar.php" ?>


<div class="min-h-screen flex flex-col justify-center items-center bg-gray-100 text-gray-800">
    <div class="bg-white shadow-lg rounded-lg p-6 w-full max-w-4xl mt-20">
        <h2 class="text-2xl font-semibold mb-4">Your Tasks</h2>
        <ul class="divide-y divide-gray-200">
            <?php foreach($tasks as $task) { ?>
                
                <li class="py-4">
                    <form action="/delete" method="POST">
                        <div class="grid grid-cols-4 gap-x-4 items-center">
                            <div>
                                <span class="text-gray-500 text-sm font-semibold">Title:</span>
                                <span class="text-gray-800 text-lg font-bold"><?= htmlspecialchars($task->title) ?></span>
                            </div>
                            <div>
                                <span class="text-gray-500 text-sm font-semibold">Deadline:</span>
                                <span class="text-red-600 text-lg font-bold"><?= htmlspecialchars($task->deadline) ?></span>
                            </div>
                            <div>
                                <a href="/show?id=<?= htmlspecialchars($task->id) ?>" class="bg-blue-600 text-white font-semibold py-2 px-4 rounded hover:bg-blue-700 focus:outline-none focus:bg-blue-700">Show Task</a>
                            </div>
                            <div>
                                <input type="checkbox" id="task_<?= htmlspecialchars($task->id) ?>" name="completed_task[]" value="<?= htmlspecialchars($task->id) ?>">
                                <label for="task_<?= htmlspecialchars($task->id) ?>" class="text-gray-500 text-sm font-semibold">Complete</label>
                            </div>
                            <div>
                                <button type="submit" class="bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-4 rounded transition-all duration-10 focus:outline-none focus:bg-red-800">
                                    Delete
                                </button>
                                <input type="hidden" name="task_id" value="<?= htmlspecialchars($task->id) ?>">
                            </div>
                        </div>
                    </form>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>

<?php require "../app/views/components/footer.php" ?>
