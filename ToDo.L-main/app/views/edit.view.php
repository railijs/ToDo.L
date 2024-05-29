<?php require "../app/views/components/header.php"; ?>
<?php require "../app/views/components/navbar.php"; ?>

<div class="min-h-screen flex justify-center items-center bg-gray-100 text-gray-800">
    <div class="bg-white shadow-lg rounded-lg p-6 w-full max-w-4xl mt-20">
        <h2 class="text-2xl font-semibold mb-4">Edit Task</h2>
        <form method="post" action="/edit" class="space-y-4">
            <input type="hidden" name="task_id" value="<?= htmlspecialchars($task['id'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
            <div>
                <label for="title" class="text-gray-500 text-sm font-semibold">Title:</label>
                <input type="text" id="title" name="title" class="border-gray-200 border rounded py-2 px-4 w-full" value="<?= htmlspecialchars($task['title'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
            </div>
            <div>
                <label for="description" class="text-gray-500 text-sm font-semibold">Description:</label>
                <textarea id="description" name="description" class="border-gray-200 border rounded py-2 px-4 w-full"><?= htmlspecialchars($task['description'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
            </div>
            <div>
                <label for="deadline" class="text-gray-500 text-sm font-semibold">Deadline:</label>
                <input type="date" id="deadline" name="deadline" class="border-gray-200 border rounded py-2 px-4 w-full" value="<?= htmlspecialchars($task['deadline'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
            </div>
            <button type="submit" class="bg-blue-600 text-white font-semibold py-2 px-4 rounded hover:bg-blue-700 focus:outline-none focus:bg-blue-700">Update Task</button>
        </form>
    </div>
</div>

<?php require "../app/views/components/footer.php"; ?>
