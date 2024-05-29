<?php require "../app/views/components/header.php" ?>
<?php require "../app/views/components/navbar.php" ?>

<div class="min-h-screen flex flex-col justify-center items-center bg-gray-100 text-gray-800">
    <div class="bg-white shadow-lg rounded-lg p-6 w-full max-w-4xl mt-20">
        <h2 class="text-2xl font-semibold mb-4">Your Tasks</h2>
        <ul class="divide-y divide-gray-200">
            <?php foreach($tasks as $task) { ?>
                <li class="py-4">
                    <div class="grid grid-cols-4 gap-x-4 items-center">
                        <div>
                            <label class="custom-checkbox">
                                <input id="checkbox-<?= htmlspecialchars($task->id) ?>" name="dummy" type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                            <span class="text-gray-500 text-sm font-semibold">Title:</span>
                            <span class="text-gray-800 text-lg font-bold"><?= htmlspecialchars($task->title) ?></span>
                        </div>
                        <div>
                            <span class="text-gray-500 text-sm font-semibold">Deadline:</span>
                            <span class="text-red-600 text-lg font-bold"><?= htmlspecialchars($task->deadline) ?></span>
                        </div>
                        <div>
                            <a href="/show?id=<?= htmlspecialchars($task->id) ?>" class="button">show</a>
                        </div>
                        <div>
                            <form method="POST" action="/delete">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($task->id) ?>">
                                <button type="submit" class="bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-4 rounded transition-all duration-10 focus:outline-none focus:bg-red-800">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>

<?php require "../app/views/components/footer.php" ?>

<style>
 /* The existing CSS styles here */
 .button {
  width: 110px;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: flex-start;
  gap: 10px;
  background-color: rgb(161, 255, 20);
  border-radius: 30px;
  color: rgb(19, 19, 19);
  font-weight: 600;
  border: none;
  position: relative;
  cursor: pointer;
  transition-duration: .2s;
  box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.116);
  padding-left: 8px;
  transition-duration: .5s;
}

.svgIcon {
  height: 25px;
  transition-duration: 1.5s;
}

.bell path {
  fill: rgb(19, 19, 19);
}

.button:hover {
  background-color: rgb(192, 255, 20);
  transition-duration: .5s;
}

.button:active {
  transform: scale(0.97);
  transition-duration: .2s;
}

.button:hover .svgIcon {
  transform: rotate(250deg);
  transition-duration: 1.5s;
}


/* Hide the default checkbox */
.container input {
 position: absolute;
 opacity: 0;
 cursor: pointer;
 height: 0;
 width: 0;
}

.container {
 display: block;
 position: relative;
 cursor: pointer;
 font-size: 20px;
 user-select: none;
}

/* Create a custom checkbox */
.checkmark {
 position: relative;
 top: 0;
 left: 0;
 height: 1.3em;
 width: 1.3em;
 background-color: #343434;
 border-radius: 5px;
 transition: all 0.5s;
}

/* When the checkbox is checked, add a blue background */
.container input:checked ~ .checkmark {
 background-color: #f0f0f0;
 border: 2px solid #343434;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
 content: "";
 position: absolute;
 display: none;
 filter: drop-shadow(0 0 10px #888);
}

/* Show the checkmark when checked */
.container input:checked ~ .checkmark:after {
 display: block;
}

/* Style the checkmark/indicator */
.container .checkmark:after {
 left: 0.3em;
 top: 0.05em;
 width: 0.3em;
 height: 0.65em;
 border: solid #343434;
 border-width: 0 0.2em 0.2em 0;
 border-radius: 4px;
 transform: rotate(45deg);
 animation: bounceFadeIn 0.5s cubic-bezier(0.165, 0.84, 0.44, 1);
}

@keyframes bounceFadeIn {
 from {
  transform: translate(0, -10px) rotate(45deg);
  opacity: 0;
 }

 to {
  transform: translate(0, 0) rotate(45deg);
  opacity: 1;
 }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const checkboxes = document.querySelectorAll('input[type="checkbox"][id^="checkbox-"]');
    
    checkboxes.forEach(checkbox => {
        const checkboxId = checkbox.id;
        
        // Load checkbox state from localStorage
        const isChecked = localStorage.getItem(checkboxId) === 'true';
        checkbox.checked = isChecked;

        // Save checkbox state to localStorage on change
        checkbox.addEventListener('change', function () {
            localStorage.setItem(checkboxId, checkbox.checked);
        });
    });
});
</script>
