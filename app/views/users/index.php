<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cute User Directory</title>
  <link rel="stylesheet" href="<?=base_url();?>public/style.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background: linear-gradient(135deg, #ffeaa7 0%, #fab1a0 100%);
      font-family: 'Comic Sans MS', cursive, sans-serif;
    }
    .cute-shadow {
      box-shadow: 0 10px 30px rgba(255, 182, 193, 0.3);
    }
    .bubble {
      background: rgba(255, 255, 255, 0.8);
      border-radius: 20px;
      backdrop-filter: blur(10px);
    }
    .cute-button {
      background: linear-gradient(45deg, #ff9ff3, #feca57);
      border: none;
      border-radius: 25px;
      color: white;
      font-weight: bold;
      transition: all 0.3s ease;
    }
    .cute-button:hover {
      transform: scale(1.05);
      box-shadow: 0 5px 15px rgba(255, 159, 243, 0.4);
    }
    .cute-input {
      border-radius: 20px;
      border: 2px solid #ff9ff3;
      padding: 10px 15px;
      font-family: 'Comic Sans MS', cursive, sans-serif;
    }
    .cute-table {
      border-radius: 15px;
      overflow: hidden;
    }
    .cute-table th {
      background: linear-gradient(45deg, #74b9ff, #a29bfe);
      color: white;
    }
    .cute-table td {
      background: rgba(255, 255, 255, 0.9);
    }
    .cute-pagination {
      background: rgba(255, 255, 255, 0.8);
      border-radius: 25px;
      padding: 10px;
    }
  </style>
</head>
<body class="min-h-screen">

  <!-- Header with GIF -->
  <div class="text-center py-8">
    <h1 class="text-4xl font-bold text-pink-600 mb-4">🌈 Cute User Directory 🌈</h1>
    <img src="https://media.giphy.com/media/3o7TKz9bX9Z8LxQ8q8/giphy.gif" alt="Cute animation" class="mx-auto rounded-full w-32 h-32 cute-shadow">
    <div class="mt-4">
      <a href="<?=site_url('logout')?>" class="cute-button px-6 py-2 inline-block">🚪 Logout</a>
    </div>
  </div>

  <!-- Main Content -->
  <div class="max-w-6xl mx-auto px-4">
    <div class="bubble cute-shadow p-8">
      <!-- Header -->
      <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-purple-600">🧸 Manage Your Users 🧸</h2>
      </div>

      <!-- Search -->
      <div class="mb-8 text-center">
        <form method="get" class="inline-flex">
          <input type="text" name="search" value="<?=$search?>" placeholder="🔍 Search by name or email" class="cute-input mr-2">
          <button type="submit" class="cute-button px-6 py-2">Search</button>
        </form>
      </div>

      <!-- Table -->
      <div class="overflow-x-auto cute-table cute-shadow mb-8">
        <table class="w-full text-center border-collapse">
          <thead>
            <tr class="cute-table th">
              <th class="py-4 px-6 text-lg">🆔 ID</th>
              <th class="py-4 px-6 text-lg">👨 Lastname</th>
              <th class="py-4 px-6 text-lg">👩 Firstname</th>
              <th class="py-4 px-6 text-lg">📧 Email</th>
              <th class="py-4 px-6 text-lg">🎯 Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach(html_escape($users) as $user): ?>
              <tr class="cute-table td hover:bg-pink-100 transition duration-300">
                <td class="py-4 px-6 text-purple-700 font-bold"><?=$user['id']?></td>
                <td class="py-4 px-6 text-blue-600"><?=$user['last_name']?></td>
                <td class="py-4 px-6 text-green-600"><?=$user['first_name']?></td>
                <td class="py-4 px-6">
                  <span class="bg-gradient-to-r from-pink-400 to-purple-400 text-white text-sm font-medium px-4 py-2 rounded-full">
                    <?=$user['email']?>
                  </span>
                </td>
                <td class="py-4 px-6">
                  <button onclick="toggleUpdateForm(<?=$user['id']?>)"
                          class="text-yellow-600 hover:text-yellow-800 font-bold mr-2">✏️ Update</button>
                  <a href ="<?=site_url('users/delete/'.$user['id'])?>"
                     onclick="return confirm('Are you sure you want to delete this cute user? 🥺');"
                     class="text-red-500 hover:text-red-700 font-bold">🗑️ Delete</a>
                </td>
              </tr>
              <!-- Inline Update Form (Hidden by default) -->
              <tr id="updateForm<?=$user['id']?>" class="hidden">
                <td colspan="5" class="py-4 px-6">
                  <div class="bubble cute-shadow p-4">
                    <h4 class="text-lg font-bold text-purple-600 mb-3">✨ Update User ✨</h4>
                    <form method="post" class="space-y-3">
                      <input type="hidden" name="user_id" value="<?=$user['id']?>">
                      <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                        <div>
                          <label class="block text-sm font-medium text-purple-700 mb-1">👨 First Name</label>
                          <input type="text" name="first_name" required
                                 class="cute-input w-full"
                                 value="<?=$user['first_name']?>">
                        </div>
                        <div>
                          <label class="block text-sm font-medium text-purple-700 mb-1">👩 Last Name</label>
                          <input type="text" name="last_name" required
                                 class="cute-input w-full"
                                 value="<?=$user['last_name']?>">
                        </div>
                        <div>
                          <label class="block text-sm font-medium text-purple-700 mb-1">📧 Email</label>
                          <input type="email" name="email" required
                                 class="cute-input w-full"
                                 value="<?=$user['email']?>">
                        </div>
                      </div>
                      <div class="text-center pt-2">
                        <button type="submit" class="cute-button px-6 py-2 text-sm mr-3">
                          💾 Update User
                        </button>
                        <button type="button" onclick="toggleUpdateForm(<?=$user['id']?>)" class="cute-button px-6 py-2 text-sm bg-gray-400 hover:bg-gray-500">
                          ❌ Cancel
                        </button>
                      </div>
                    </form>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      <div class="mt-8 flex justify-center">
        <?php if ($pagination['last_page'] > 1): ?>
          <div class="cute-pagination cute-shadow inline-flex space-x-2">
            <?php if ($page > 1): ?>
              <a href="?page=<?=($page - 1)?>&search=<?=$search?>" class="cute-button px-4 py-2 text-sm">⬅️ Previous</a>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $pagination['last_page']; $i++): ?>
              <a href="?page=<?=$i?>&search=<?=$search?>"
                 class="px-4 py-2 rounded-full font-bold transition duration-300 <?=$i == $page ? 'bg-gradient-to-r from-pink-500 to-purple-500 text-white' : 'bg-white text-purple-600 hover:bg-pink-100'?>">
                <?=$i?>
              </a>
            <?php endfor; ?>
            <?php if ($page < $pagination['last_page']): ?>
              <a href="?page=<?=($page + 1)?>&search=<?=$search?>" class="cute-button px-4 py-2 text-sm">Next ➡️</a>
            <?php endif; ?>
          </div>
        <?php endif; ?>
      </div>

      <!-- Add User Form (Hidden by default) -->
      <div id="addUserForm" class="mt-8 hidden">
        <div class="bubble cute-shadow p-6 mb-6">
          <h3 class="text-2xl font-bold text-purple-600 mb-4 text-center">✨ Add New Cute User ✨</h3>
          <form method="post" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
              <div>
                <label class="block text-sm font-medium text-purple-700 mb-2">👨 First Name</label>
                <input type="text" name="first_name" required
                       class="cute-input w-full"
                       placeholder="Enter first name">
              </div>
              <div>
                <label class="block text-sm font-medium text-purple-700 mb-2">👩 Last Name</label>
                <input type="text" name="last_name" required
                       class="cute-input w-full"
                       placeholder="Enter last name">
              </div>
              <div>
                <label class="block text-sm font-medium text-purple-700 mb-2">📧 Email</label>
                <input type="email" name="email" required
                       class="cute-input w-full"
                       placeholder="Enter email">
              </div>
            </div>
            <div class="text-center pt-4">
              <button type="submit" class="cute-button px-8 py-3 text-lg mr-4">
                💾 Save User
              </button>
              <button type="button" onclick="toggleForm()" class="cute-button px-8 py-3 text-lg bg-gray-400 hover:bg-gray-500">
                ❌ Cancel
              </button>
            </div>
          </form>
        </div>
      </div>

      <!-- Toggle Button -->
      <div class="mt-8 text-center">
        <button onclick="toggleForm()" id="toggleBtn"
                class="cute-button inline-block px-8 py-3 text-lg">
          ➕ Add New Cute User
        </button>
      </div>
    </div>
  </div>

  <script>
    function toggleForm() {
      const form = document.getElementById('addUserForm');
      const btn = document.getElementById('toggleBtn');

      if (form.classList.contains('hidden')) {
        form.classList.remove('hidden');
        btn.innerHTML = '➖ Hide Add Form';
        btn.classList.add('bg-red-400', 'hover:bg-red-500');
        btn.classList.remove('bg-gradient-to-r', 'from-pink-400', 'to-yellow-400');
      } else {
        form.classList.add('hidden');
        btn.innerHTML = '➕ Add New Cute User';
        btn.classList.remove('bg-red-400', 'hover:bg-red-500');
        btn.classList.add('bg-gradient-to-r', 'from-pink-400', 'to-yellow-400');
      }
    }

    function toggleUpdateForm(userId) {
      const form = document.getElementById('updateForm' + userId);
      if (form.classList.contains('hidden')) {
        form.classList.remove('hidden');
      } else {
        form.classList.add('hidden');
      }
    }
  </script>

</body>
</html>
