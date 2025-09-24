<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Cute User</title>
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
      background: rgba(255, 255, 255, 0.9);
      border-radius: 25px;
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
      padding: 12px 15px;
      font-family: 'Comic Sans MS', cursive, sans-serif;
      font-size: 16px;
    }
    .cute-input:focus {
      outline: none;
      border-color: #feca57;
      box-shadow: 0 0 10px rgba(255, 202, 87, 0.5);
    }
    @keyframes bounceIn {
      0% { opacity: 0; transform: scale(0.3); }
      50% { opacity: 1; transform: scale(1.05); }
      70% { transform: scale(0.9); }
      100% { opacity: 1; transform: scale(1); }
    }
    .animate-bounceIn {
      animation: bounceIn 0.8s ease;
    }
  </style>
</head>
<body class="min-h-screen flex items-center justify-center py-8">

  <!-- Header with GIF -->
  <div class="text-center mb-8">
    <h1 class="text-3xl font-bold text-pink-600 mb-4">🌸 Add New Cute User 🌸</h1>
    <img src="https://media.giphy.com/media/3o7TKz9bX9Z8LxQ8q8/giphy.gif" alt="Cute animation" class="mx-auto rounded-full w-24 h-24 cute-shadow">
  </div>

  <div class="bubble cute-shadow p-8 w-full max-w-md animate-bounceIn">
    <h2 class="text-2xl font-bold text-center text-purple-600 mb-6">📝 Create Account</h2>

    <form action="<?=site_url('users/create')?>" method="POST" class="space-y-6">
      <?=csrf_field()?>
      <!-- First Name -->
      <div>
        <label class="block text-purple-700 font-bold mb-2">👩 First Name</label>
        <input type="text" name="first_name" placeholder="Enter your cute first name" required
               class="w-full cute-input bg-white">
      </div>

      <!-- Last Name -->
      <div>
        <label class="block text-purple-700 font-bold mb-2">👨 Last Name</label>
        <input type="text" name="last_name" placeholder="Enter your cute last name" required
               class="w-full cute-input bg-white">
      </div>

      <!-- Email -->
      <div>
        <label class="block text-purple-700 font-bold mb-2">📧 Email Address</label>
        <input type="email" name="email" placeholder="Enter your email" required
               class="w-full cute-input bg-white">
      </div>

      <!-- Button -->
      <button type="submit"
              class="w-full cute-button py-3 text-lg">
        ✨ Create Cute User ✨
      </button>
    </form>

    <div class="mt-6 text-center">
      <a href="<?=site_url()?>" class="text-pink-600 hover:text-pink-800 font-bold">⬅️ Back to Directory</a>
    </div>
  </div>
</body>
</html>
