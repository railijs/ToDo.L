<?php require "../app/views/components/header.php" ?>
<?php require "../app/views/components/navbar.php" ?>

<div class="flex items-center justify-center min-h-screen bg-cover bg-center" style="background-image: url('iphone-background.jpg');">
  <div class="bg-white p-8 rounded-lg shadow-md w-full md:w-3/4 lg:w-2/3 xl:w-1/2">
    <h1 class="text-3xl font-bold mb-6 text-center">Your Tasks</h1>

    <!-- Search Bar -->
    <form action="/" method="GET" class="mt-6 flex">
      <input type="text" name="query" placeholder="Search for tasks..." class="border border-gray-300 rounded-md px-4 py-2 w-full mr-2" required>
      <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-md">Search</button>
    </form>

    <!-- Display tasks -->
    <?php if (isset($tasks) && !empty($tasks)) { ?>
      <ul class="mt-8">
        <?php foreach ($tasks as $task) { ?>
          <li class="mb-8 border-b pb-4 flex items-center justify-between">
            <div>
              <h3 class="font-semibold text-lg"><?= htmlspecialchars($task->title) ?></h3>
              <p class="text-gray-600 mt-2"><?= htmlspecialchars($task->description) ?></p>
              <p class="text-gray-600 mt-2">Deadline: <?= htmlspecialchars($task->deadline) ?></p>
            </div>
            <div class="flex items-center space-x-4">
              <a href="/show?id=<?= $task->id ?>" class="text-blue-600 hover:underline">Show</a>
              <form action="/delete" method="POST">
                <input type="hidden" name="id" value="<?= $task->id ?>">
                <button type="submit" class="text-red-600 hover:underline">Delete</button>
              </form>
            </div>
          </li>
        <?php } ?>
      </ul>
    <?php } else { ?>
      <p class="text-center mt-8">You have no tasks.</p>
    <?php } ?>

    <!-- Output search results if available -->
    <?php if (isset($searchResults)) { ?>
      <?php if (!empty($searchResults)) { ?>
        <h2 class="text-3xl font-bold mt-8 mb-6 text-center">Search Results</h2>
        <ul>
          <?php foreach ($searchResults as $result) { ?>
            <li class="mb-8 border-b pb-4">
              <h3 class="font-semibold text-lg"><?= htmlspecialchars($result->title) ?></h3>
              <p class="text-gray-600 mt-2"><?= htmlspecialchars($result->description) ?></p>
            </li>
          <?php } ?>
        </ul>
      <?php } else { ?>
        <p class="text-center mt-8">No tasks found matching the search criteria.</p>
      <?php } ?>
    <?php } ?>

  </div>
</div>

<?php require "../app/views/components/footer.php" ?>