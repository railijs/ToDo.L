<?php require "../app/views/components/header.php"; ?>
<?php require "../app/views/components/navbar.php"; ?>

<div class="min-h-screen flex justify-center items-center bg-gray-100 text-gray-800">
    <div class="bg-white shadow-lg rounded-lg p-6 w-full max-w-4xl mt-20">
        <h2 class="text-2xl font-semibold mb-4">Edit Task</h2>
        
        <form method="post" action="/edit" class="space-y-4">
            <!-- Ensure that task_id, title, description, and deadline are passed from the controller -->
            <input type="hidden" name="task_id" value="<?= htmlspecialchars($taskDetails->id ?? '', ENT_QUOTES, 'UTF-8') ?>">
            
            <div>
                <label for="title" class="text-gray-500 text-sm font-semibold">Title:</label>
                <input type="text" id="title" name="title" class="border-gray-200 border rounded py-2 px-4 w-full" value="<?= htmlspecialchars($taskDetails->title ?? '', ENT_QUOTES, 'UTF-8') ?>">
                <?php if (isset($errors['title'])): ?>
                    <p class="text-red-500 text-sm mt-1"><?= htmlspecialchars($errors['title'], ENT_QUOTES, 'UTF-8') ?></p>
                <?php endif; ?>
            </div>
            
            <div>
                <label for="description" class="text-gray-500 text-sm font-semibold">Description:</label>
                <textarea id="description" name="description" class="border-gray-200 border rounded py-2 px-4 w-full"><?= htmlspecialchars($taskDetails->description ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
                <?php if (isset($errors['description'])): ?>
                    <p class="text-red-500 text-sm mt-1"><?= htmlspecialchars($errors['description'], ENT_QUOTES, 'UTF-8') ?></p>
                <?php endif; ?>
            </div>
            
            <div>
                <label for="deadline" class="text-gray-500 text-sm font-semibold">Deadline:</label>
                <input type="date" id="deadline" name="deadline" class="border-gray-200 border rounded py-2 px-4 w-full" value="<?= htmlspecialchars($taskDetails->deadline ?? '', ENT_QUOTES, 'UTF-8') ?>">
                <?php if (isset($errors['deadline'])): ?>
                    <p class="text-red-500 text-sm mt-1"><?= htmlspecialchars($errors['deadline'], ENT_QUOTES, 'UTF-8') ?></p>
                <?php endif; ?>
            </div>
            
            <div class="mb-4">
                <label for="priority" class="block text-gray-700 text-sm font-semibold mb-2">Priority</label>
                <select id="priority" name="priority" class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-blue-500">
                    <option value="1" <?= ($taskDetails->priority ?? '') == 1 ? 'selected' : '' ?>>⭐</option>
                    <option value="2" <?= ($taskDetails->priority ?? '') == 2 ? 'selected' : '' ?>>⭐⭐</option>
                    <option value="3" <?= ($taskDetails->priority ?? '') == 3 ? 'selected' : '' ?>>⭐⭐⭐</option>
                    <option value="4" <?= ($taskDetails->priority ?? '') == 4 ? 'selected' : '' ?>>⭐⭐⭐⭐</option>
                    <option value="5" <?= ($taskDetails->priority ?? '') == 5 ? 'selected' : '' ?>>⭐⭐⭐⭐⭐</option>
                </select>
                <?php if (isset($errors['priority'])): ?>
                    <p class="text-red-500 text-sm mt-1"><?= htmlspecialchars($errors['priority'], ENT_QUOTES, 'UTF-8') ?></p>
                <?php endif; ?>
            </div>
            
            <button type="submit" class="bg-blue-600 text-white font-semibold py-2 px-4 rounded hover:bg-blue-700 focus:outline-none focus:bg-blue-700">Update Task</button>
        </form>
    </div>
</div>

<?php require "../app/views/components/footer.php"; ?>