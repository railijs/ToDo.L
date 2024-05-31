<?php
require "../app/views/components/header.php";
require "../app/views/components/navbar.php";

// Assuming $tasks is your original tasks array

// Check if a search query is provided
if(isset($_GET['query']) && !empty($_GET['query'])) {
    $searchQuery = $_GET['query'];
    $searchResults = array_filter($tasks, function($task) use ($searchQuery) {
        return strpos(strtolower($task->title), strtolower($searchQuery)) !== false 
            || strpos(strtolower($task->description), strtolower($searchQuery)) !== false;
    });

    if(empty($searchResults)) {
        $noTasksFound = true;
    }
} else {
    // If no search query is provided, display all tasks
    $searchResults = $tasks;
}
?>

<div class="flex items-center justify-center min-h-screen bg-cover bg-center" style="background-image: url('iphone-background.jpg');">
    <div class="bg-white p-8 rounded-lg shadow-md w-full md:w-3/4 lg:w-2/3 xl:w-1/2">
        <h1 class="text-3xl font-bold mb-6 text-center">Your Tasks</h1>

        <!-- Search Bar -->
        <form action="/" method="GET" class="mt-6 flex">
            <input type="text" name="query" placeholder="Search for tasks..." class="border border-gray-300 rounded-md px-4 py-2 w-full mr-2" required>
            <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-md">Search</button>
        </form>

<<<<<<< HEAD
<<<<<<< HEAD
    <!-- Display tasks -->
    <?php if (isset($tasks) && !empty($tasks)) { ?>
      <ul class="mt-8">
        <?php foreach ($tasks as $task) { ?>
          <li class="mb-8 border-b pb-4 flex items-center justify-between">
          <div class="checkbox-wrapper">
  <label>
    <input type="checkbox">
    <span class="checkbox"></span>
  </label>
</div>
            <div>
              <h3 class="font-semibold text-lg"><?= htmlspecialchars($task->title) ?></h3>
              <p class="text-gray-600 mt-2"><?= htmlspecialchars($task->description) ?></p>
              <p class="text-gray-600 mt-2">Deadline: <?= htmlspecialchars($task->deadline) ?></p>
              <!-- Display priority as star emojis -->
              <p class="text-gray-600 mt-2">Priority:
                <?php 
                  $priorityStars = str_repeat('⭐️', $task->priority);
                  echo htmlspecialchars($priorityStars);
                ?>
              </p>
              
            </div>
            <div class="flex items-center space-x-4">
              <a href="/show?id=<?= $task->id ?>" class="btn">
  <svg class="svgIcon" viewBox="0 0 384 512">
    <path
      d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2V448c0 17.7 14.3 32 32 32s32-14.3 32-32V141.2L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z"
    ></path>
  </svg>
        </a>
              <form action="/delete" method="POST">
                <input type="hidden" name="id" value="<?= $task->id ?>">
                <button class="button">
  <svg viewBox="0 0 448 512" class="svgIcon"><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"></path></svg>
</button>
              </form>
              <a href="/edit?task_id=<?= $task->id ?>" class="bg-green-600 hover:bg-green-800 text-white font-bold py-2 px-4 rounded transition-all duration-10 focus:outline-none focus:bg-green-800">Edit</a>
            </div>
          </li>
=======
=======
>>>>>>> b7455c5c1e91e81b1ef482d6540d1b0e78629759
        <!-- Display tasks -->
        <?php if (isset($searchResults) && !empty($searchResults)) { ?>
            <ul class="mt-8">
                <?php foreach ($searchResults as $task) { ?>
                    <li class="mb-8 border-b pb-4 flex items-center justify-between">
                        <div>
                            <h3 class="font-semibold text-lg"><?= htmlspecialchars($task->title) ?></h3>
                            <p class="text-gray-600 mt-2"><?= htmlspecialchars($task->description) ?></p>
                            <p class="text-gray-600 mt-2">Deadline: <?= htmlspecialchars($task->deadline) ?></p>
                            <!-- Display priority as star emojis -->
                            <p class="text-gray-600 mt-2">Priority:
                                <?php 
                                $priorityStars = str_repeat('⭐️', $task->priority);
                                echo htmlspecialchars($priorityStars);
                                ?>
                            </p>
                        </div>
                        <div class="flex items-center space-x-4">
                            <a href="/show?id=<?= $task->id ?>" class="text-blue-600 hover:underline">Show</a>
<<<<<<< HEAD
                            <a href="/edit?task_id=<?= $task->id ?>" class="bg-green-600 hover:bg-green-800 text-white font-bold py-2 px-4 rounded transition-all duration-10 focus:outline-none focus:bg-green-800">Edit</a
=======
                            <a href="/edit?task_id=<?= $task->id ?>" class="bg-green-600 hover:bg-green-800 text-white font-bold py-2 px-4 rounded transition-all duration-10 focus:outline-none focus:bg-green-800">Edit</a>
>>>>>>> b7455c5c1e91e81b1ef482d6540d1b0e78629759
                            <form action="/delete" method="POST">
                                <input type="hidden" name="id" value="<?= $task->id ?>">
                                <button type="submit" class="appearance-none bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-4 rounded transition-all duration-10 focus:outline-none focus:bg-red-800">Delete</button>
                            </form>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        <?php } elseif (isset($noTasksFound) && $noTasksFound) { ?>
            <p class="text-center mt-8">No tasks were found matching the search criteria.</p>
        <?php } else { ?>
            <p class="text-center mt-8">You have no tasks.</p>
<<<<<<< HEAD
>>>>>>> 7e199f516a2769f5956b25dca3ee0c2a39ca32a1
=======
>>>>>>> b7455c5c1e91e81b1ef482d6540d1b0e78629759
        <?php } ?>

    </div>
</div>

<?php require "../app/views/components/footer.php" ?>