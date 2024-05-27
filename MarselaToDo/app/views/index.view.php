<?php require "../app/views/components/header.php" ?>
<?php require "../app/views/components/navbar.php" ?>

<div class="flex items-center justify-center min-h-screen bg-cover bg-center" style="background-image: url('iphone-background.jpg');">
  <div class="bg-white p-8 rounded-lg shadow-md">
    <h1 class="text-3xl font-bold mb-6 text-center">Your Tasks</h1>

    <!-- Search Bar -->
    <form action="/" method="GET" class="mt-6">
      <input type="text" name="query" placeholder="Search for tasks..." class="border border-gray-300 rounded-md px-4 py-2 w-full" required>
      <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-md ml-2">Search</button>
    </form>

    <?php if (isset($tasks) && !empty($tasks)) { ?>
      <ul class="list-disc list-inside">
        <?php foreach ($tasks as $task) { ?>
          <li class="mb-4">
            <h3 class="font-semibold"><?= htmlspecialchars($task->title) ?></h3>
            <p><?= htmlspecialchars($task->description) ?></p>
            <p>Deadline: <?= htmlspecialchars($task->deadline) ?></p>
          </li>
        <?php } ?>
      </ul>
    <?php } else { ?>
      <p class="text-center">You have no tasks.</p>
    <?php } ?>

    <!-- Output search results if available -->
    <?php if (isset($searchResults)) { ?>
      <?php if (!empty($searchResults)) { ?>
        <h2 class="text-3xl font-bold mb-6 text-center">Search Results</h2>
        <ul class="list-disc list-inside">
          <?php foreach ($searchResults as $result) { ?>
            <li class="mb-4">
              <h3 class="font-semibold"><?= htmlspecialchars($result->title) ?></h3>
              <p><?= htmlspecialchars($result->description) ?></p>
            </li>
          <?php } ?>
        </ul>
      <?php } else { ?>
        <p class="text-center">No tasks found matching the search criteria.</p>
      <?php } ?>
    <?php } ?>

  </div>
</div>

<?php require "../app/views/components/footer.php" ?>
