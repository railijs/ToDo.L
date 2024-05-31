<?php
require "../app/views/components/header.php";
require "../app/views/components/navbar.php";

// Assuming $tasks is your original tasks array

// Check if a search query is provided
if(isset($_GET['query'])) {
    $searchQuery = $_GET['query'];
    if(!empty($searchQuery)) {
        $searchResults = array_filter($tasks, function($task) use ($searchQuery) {
            return strpos(strtolower($task->title), strtolower($searchQuery)) !== false 
                || strpos(strtolower($task->description), strtolower($searchQuery)) !== false;
        });

        if(empty($searchResults)) {
            $noTasksFound = true;
        }
    } else {
        // If search query is empty, display all tasks
        $searchResults = $tasks;
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
            <input type="text" name="query" placeholder="Search for tasks..." class="border border-gray-300 rounded-md px-4 py-2 w-full mr-2" value="<?php echo isset($_GET['query']) ? htmlspecialchars($_GET['query']) : '' ?>">
            <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-md">Search</button>
        </form>
        

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
                            <form action="/delete" method="POST">
                                <input type="hidden" name="id" value="<?= $task->id ?>">
                                <button type="submit" class="appearance-none bg-white border-none rounded-full shadow-inner text-black px-4 py-2 text-lg font-semibold transition duration-150 ease-in-out hover:bg-yellow-400 hover:text-black">Delete</button>
                              </form>
                              <a href="/edit?task_id=<?= $task->id ?>" class="bg-green-600 hover:bg-green-800 text-white font-bold py-2 px-4 rounded transition-all duration-10 focus:outline-none focus:bg-green-800">Edit</a>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        <?php } elseif (isset($noTasksFound) && $noTasksFound) { ?>
            <p class="text-center mt-8">No tasks were found matching the search criteria.</p>
        <?php } else { ?>
            <p class="text-center mt-8">You have no tasks.</p>
        <?php } ?>

    </div>
</div>

<?php require "../app/views/components/footer.php" ?>