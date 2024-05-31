<?php require "../app/views/components/header.php"; ?>
<?php require "../app/views/components/navbar.php"; ?>

<div class="min-h-screen flex flex-col justify-center items-center bg-gray-100 text-gray-800">
    <div class="bg-white shadow-lg rounded-lg p-6 w-full max-w-4xl mt-20">
        <h2 class="text-2xl font-semibold mb-4">Your Tasks</h2>
        <div class="mt-6 mb-6">
            <form method="GET" action="/search" class="flex items-center">
                <input type="text" name="query" placeholder="Search tasks..." class="border-gray-200 border rounded py-2 px-4 w-64" value="<?php echo isset($_GET['query']) ? htmlspecialchars($_GET['query']) : ''; ?>">
                <button type="submit" class="ml-4 bg-blue-600 text-white font-semibold py-2 px-4 rounded hover:bg-blue-700 focus:outline-none focus:bg-blue-700">Search</button>
            </form>
        </div>
        <ul class="divide-y divide-gray-200">
            <?php foreach($tasks as $task) { ?>
                <li class="py-4">
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
                            <form method="POST" action="/delete" class="inline">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($task->id) ?>">
                                <button type="submit" class="bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-4 rounded transition-all duration-10 focus:outline-none focus:bg-red-800">
                                    Delete
                                </button>
                            </form>
                            <a href="/edit?task_id=<?= $task->id ?>" class="bg-green-600 hover:bg-green-800 text-white font-bold py-2 px-4 rounded transition-all duration-10 focus:outline-none focus:bg-green-800">Edit</a>
                        </div>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>

<?php require "../app/views/components/footer.php"; ?>
