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
        <div class="input-wrapper">
  <button class="icon"> 
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" height="25px" width="25px">
      <path stroke-linejoin="round" stroke-linecap="round" stroke-width="1.5" stroke="#fff" d="M11.5 21C16.7467 21 21 16.7467 21 11.5C21 6.25329 16.7467 2 11.5 2C6.25329 2 2 6.25329 2 11.5C2 16.7467 6.25329 21 11.5 21Z"></path>
      <path stroke-linejoin="round" stroke-linecap="round" stroke-width="1.5" stroke="#fff" d="M22 22L20 20"></path>
    </svg>
  </button>
  <input placeholder="Search for tasks..." class="input" name="query" type="text" require>
</div>
         

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
              <a href="/show?id=<?= $task->id ?>" class="btn">
  <svg class="svgIcon" viewBox="0 0 384 512">
    <path
      d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2V448c0 17.7 14.3 32 32 32s32-14.3 32-32V141.2L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z"
    ></path>
  </svg>
        </a>
                            <a href="/edit?task_id=<?= $task->id ?>" class="bg-green-600 hover:bg-green-800 text-white font-bold py-2 px-4 rounded transition-all duration-10 focus:outline-none focus:bg-green-800">Edit</a
                            <form action="/delete" method="POST">
                                <input type="hidden" name="id" value="<?= $task->id ?>">
                                <button type="submit" class="appearance-none bg-white border-none rounded-full shadow-inner text-black px-4 py-2 text-lg font-semibold transition duration-150 ease-in-out hover:bg-yellow-400 hover:text-black">Delete</button>
                            </form>
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
<style>
    .btn {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  background-color: rgb(20, 20, 20);
  border: none;
  font-weight: 600;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0px 0px 0px 4px rgba(180, 160, 255, 0.253);
  cursor: pointer;
  transition-duration: 0.3s;
  overflow: hidden;
  position: relative;
}

.svgIcon {
  width: 12px;
  transition-duration: 0.3s;
}

.svgIcon path {
  fill: white;
}

.btn:hover {
  width: 140px;
  border-radius: 50px;
  transition-duration: 0.3s;
  background-color: rgb(181, 160, 255);
  align-items: center;
}

.btn:hover .svgIcon {
  /* width: 20px; */
  transition-duration: 0.3s;
  transform: translateY(-200%);
}

.btn::before {
  position: absolute;
  bottom: -20px;
  content: "SHOW";
  color: white;
  /* transition-duration: .3s; */
  font-size: 0px;
}

.btn:hover::before {
  font-size: 13px;
  opacity: 1;
  bottom: unset;
  /* transform: translateY(-30px); */
  transition-duration: 0.3s;
}
.input-wrapper {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 15px;
  position: relative;
}

.input {
  border-style: none;
  height: 50px;
  width: 50px;
  padding: 10px;
  outline: none;
  border-radius: 50%;
  transition: .5s ease-in-out;
  background-color: #7e4fd4;
  box-shadow: 0px 0px 3px #f3f3f3;
  padding-right: 40px;
  color: #fff;
}

.input::placeholder,
.input {
  font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
  font-size: 17px;
}

.input::placeholder {
  color: #8f8f8f;
}

.icon {
  display: flex;
  align-items: center;
  justify-content: center;
  position: absolute;
  right: 0px;
  cursor: pointer;
  width: 50px;
  height: 50px;
  outline: none;
  border-style: none;
  border-radius: 50%;
  pointer-events: painted;
  background-color: transparent;
  transition: .2s linear;
}

.icon:focus ~ .input,
.input:focus {
  box-shadow: none;
  width: 250px;
  border-radius: 0px;
  background-color: transparent;
  border-bottom: 3px solid #7e4fd4;
  transition: all 500ms cubic-bezier(0, 0.110, 0.35, 2);
}



</style>