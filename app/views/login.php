<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="<?=base_url();?>public/style.css">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-gray-100 font-sans flex items-center justify-center min-h-screen">
  <div class="bg-gray-800 shadow-2xl rounded-2xl p-8 w-full max-w-md">
    <h1 class="text-2xl font-semibold text-white text-center mb-6">🔐 Login</h1>
    <?php if (isset($error)): ?>
      <div class="bg-red-600 text-white p-3 rounded mb-4"><?=$error?></div>
    <?php endif; ?>
    <form action="<?=site_url('login/authenticate')?>" method="post">
      <?=csrf_field()?>
      <div class="mb-4">
        <label class="block text-gray-300 mb-2">Username</label>
        <input type="text" name="username" class="w-full px-3 py-2 bg-gray-700 text-white rounded" required>
      </div>
      <div class="mb-6">
        <label class="block text-gray-300 mb-2">Password</label>
        <input type="password" name="password" class="w-full px-3 py-2 bg-gray-700 text-white rounded" required>
      </div>
      <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 rounded">Login</button>
    </form>
  </div>
</body>
</html>
