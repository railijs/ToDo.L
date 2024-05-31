<?php require "../app/views/components/header.php" ?>
<?php require "../app/views/components/navbar.php" ?>

<div class="flex items-center justify-center min-h-screen bg-cover bg-center" style="background-image: url('iphone-background.jpg');">
  <div class="bg-white p-8 rounded-lg shadow-md">
    <h1 class="text-3xl font-bold mb-6 text-center">Create a Task</h1>
    <form class="text-center" method="POST">
      <div class="mb-4">
        <label for="title" class="block text-gray-700 text-sm font-semibold mb-2">Title</label>
        <input type="text" id="title" name="title" value="<?= $_GET["title"] ?? "" ?>" class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-blue-500" required>
        <?php if(isset($errors["title"])) { ?>
          <p class="text-red-500 text-sm"><?= $errors["title"] ?></p>
        <?php } ?>
      </div>
      <div class="mb-4">
        <label for="description" class="block text-gray-700 text-sm font-semibold mb-2">Description</label>
        <textarea id="description" name="description" class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-blue-500" required><?= $_GET["description"] ?? "" ?></textarea>
        <?php if(isset($errors["description"])) { ?>
          <p class="text-red-500 text-sm"><?= $errors["description"] ?></p>
        <?php } ?>
      </div>
      <div class="mb-4">
        <label for="deadline" class="block text-gray-700 text-sm font-semibold mb-2">Deadline</label>
        <input type="date" id="deadline" name="deadline" value="<?= $_GET["deadline"] ?? "" ?>" class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-blue-500" required>
        <?php if(isset($errors["deadline"])) { ?>
          <p class="text-red-500 text-sm"><?= $errors["deadline"] ?></p>
        <?php } ?>
      </div>
      <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 focus:outline-none focus:bg-blue-700">Create</button>
    </form>
  </div>
</div>

<?php require "../app/views/components/footer.php" ?>