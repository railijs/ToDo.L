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

.button {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  background-color: rgb(20, 20, 20);
  border: none;
  font-weight: 600;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.164);
  cursor: pointer;
  transition-duration: .3s;
  overflow: hidden;
  position: relative;
}

.svgIcon {
  width: 12px;
  transition-duration: .3s;
}

.svgIcon path {
  fill: white;
}

.button:hover {
  width: 140px;
  border-radius: 50px;
  transition-duration: .3s;
  background-color: rgb(255, 69, 69);
  align-items: center;
}

.button:hover .svgIcon {
  width: 50px;
  transition-duration: .3s;
  transform: translateY(60%);
}

.button::before {
  position: absolute;
  top: -20px;
  content: "Delete";
  color: white;
  transition-duration: .3s;
  font-size: 2px;
}

.button:hover::before {
  font-size: 13px;
  opacity: 1;
  transform: translateY(30px);
  transition-duration: .3s;
}
.checkbox-wrapper *,
  .checkbox-wrapper *::before,
  .checkbox-wrapper *::after {
  box-sizing: border-box;
}

.checkbox-wrapper label {
  display: block;
  width: 35px;
  height: 35px;
  cursor: pointer;
}

.checkbox-wrapper input {
  visibility: hidden;
  display: none;
}

.checkbox-wrapper input:checked ~ .checkbox {
  transform: rotate(45deg);
  width: 14px;
  margin-left: 12px;
  border-color: #000000;
  border-top-color: transparent;
  border-left-color: transparent;
  border-radius: 0;
}

.checkbox-wrapper .checkbox {
  display: block;
  width: inherit;
  height: inherit;
  border: 3px solid #434343;
  border-radius: 6px;
  transition: all 0.375s;
}


</style>