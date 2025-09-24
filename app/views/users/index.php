<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Directory</title>
  <link rel="stylesheet" href="<?=base_url();?>public/style.css">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-gray-100 font-sans">

  <!-- Navbar -->
  <nav class="bg-gradient-to-r from-gray-800 to-gray-700 shadow-md">
    <div class="max-w-7xl mx-auto px-6 py-4">
      <a href="#" class="text-white font-semibold text-xl tracking-wide">🔧 User Management</a>
    </div>
  </nav>

  <!-- Main Content -->
  <div class="max-w-6xl mx-auto mt-10 px-4">
    <div class="bg-gray-800 shadow-2xl rounded-2xl p-6">
      <!-- Header -->
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-white">🧑‍🤝‍🧑 User Directory</h1>
      </div>

      <!-- Table -->
      <div class="overflow-x-auto rounded-xl shadow">
        <table class="w-full text-center border-collapse">
          <thead>
            <tr class="bg-gradient-to-r from-gray-700 to-gray-600 text-white">
              <th class="py-3 px-4">ID</th>
              <th class="py-3 px-4">Lastname</th>
              <th class="py-3 px-4">Firstname</th>
              <th class="py-3 px-4">Email</th>
              <th class="py-3 px-4">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach(html_escape($users) as $user): ?>
              <tr class="hover:bg-gray-700 transition duration-200">
                <td class="py-3 px-4"><?=($user['id']);?></td>
                <td class="py-3 px-4"><?=($user['last_name']);?></td>
                <td class="py-3 px-4"><?=($user['first_name']);?></td>
                <td class="py-3 px-4">
                  <span class="bg-gray-700 text-cyan-400 text-sm font-medium px-3 py-1 rounded-full">
                    <?=($user['email']);?>
                  </span>
                </td>
                <td class="py-3 px-4">
                  <a href ="<?=site_url('users/update/'.$user['id']);?>" 
                     class="text-yellow-400 hover:underline">Update</a> | 
                  <a href ="<?=site_url('users/delete/'.$user['id']);?>"
                     onclick="return confirm('Are you sure you want to delete this record?');"
                     class="text-red-400 hover:underline">Delete</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>

      <!-- Button -->
      <div class="mt-5">
        <a href="<?=site_url('users/create')?>"
           class="inline-block bg-green-600 hover:bg-green-700 text-white font-medium px-5 py-2 rounded-full shadow transition duration-200">
          ➕ Create New User
        </a>
      </div>
    </div>
  </div>

</body>
</html>