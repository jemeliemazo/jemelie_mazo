<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-gray-900 to-gray-800 min-h-screen flex items-center justify-center font-sans text-gray-100">

  <div class="bg-gray-800 p-8 rounded-2xl shadow-2xl w-full max-w-md animate-fadeIn">
    <h2 class="text-2xl font-semibold text-center text-cyan-400 mb-6">📝 Update Record</h2>

    <form action="<?=site_url('users/update/'.$user['id'])?>" method="POST" class="space-y-4">
      <!-- First Name -->
      <div>
        <label class="block text-gray-300 mb-1">First Name</label>
        <input type="text" name="first_name" value="<?= html_escape($user['first_name'])?>" required
               class="w-full px-4 py-3 border border-gray-700 rounded-xl bg-gray-900 text-gray-100 placeholder-gray-400
                      focus:ring-2 focus:ring-cyan-500 focus:outline-none">
      </div>

      <!-- Last Name -->
      <div>
        <label class="block text-gray-300 mb-1">Last Name</label>
        <input type="text" name="last_name" value="<?= html_escape($user['last_name'])?>" required
               class="w-full px-4 py-3 border border-gray-700 rounded-xl bg-gray-900 text-gray-100 placeholder-gray-400
                      focus:ring-2 focus:ring-cyan-500 focus:outline-none">
      </div>

      <!-- Email -->
      <div>
        <label class="block text-gray-300 mb-1">Email Address</label>
        <input type="email" name="email" value="<?= html_escape($user['email'])?>" required
               class="w-full px-4 py-3 border border-gray-700 rounded-xl bg-gray-900 text-gray-100 placeholder-gray-400
                      focus:ring-2 focus:ring-cyan-500 focus:outline-none">
      </div>

      <!-- Button -->
      <button type="submit"
              class="w-full bg-cyan-600 hover:bg-cyan-700 text-white font-medium py-3 rounded-xl shadow-md transition duration-200">
        Update
      </button>
    </form>
  </div>

  <!-- Small fade-in animation -->
  <style>
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeIn {
      animation: fadeIn 0.8s ease;
    }
  </style>
</body>
</html>