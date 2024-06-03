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
            </div>
            <div>
                <label for="description" class="text-gray-500 text-sm font-semibold">Description:</label>
                <textarea id="description" name="description" class="border-gray-200 border rounded py-2 px-4 w-full"><?= htmlspecialchars($taskDetails->description ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
            </div>
            <div>
                <label for="deadline" class="text-gray-500 text-sm font-semibold">Deadline:</label>
                <input type="date" id="deadline" name="deadline" class="border-gray-200 border rounded py-2 px-4 w-full" value="<?= htmlspecialchars($taskDetails->deadline ?? '', ENT_QUOTES, 'UTF-8') ?>">
            </div>
            
            <button type="submit" class="cssbuttons-io-button">
 Update task
  <div class="icon">
    <svg
      height="24"
      width="24"
      viewBox="0 0 24 24"
      xmlns="http://www.w3.org/2000/svg"
    >
      <path d="M0 0h24v24H0z" fill="none"></path>
      <path
        d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"
        fill="currentColor"
      ></path>
    </svg>
  </div>
</button>
        </form>
    </div>
</div>

<?php require "../app/views/components/footer.php"; ?>