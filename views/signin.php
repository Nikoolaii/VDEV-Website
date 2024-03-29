<?php
$error = false;

if (isset($_POST["email"]) && isset($_POST["password"])) {
  include_once __DIR__ . "/../controllers/user.php";

  $result = User::findByEmail($_POST["email"]);

  if ($result != false) {
    if (password_verify($_POST["password"], $result->{'password'})) {
      $_SESSION["user"] = $result;
      header("Location: /");
      exit();
    } else {
      $error = true;
    }
  } else {
    $error = true;
  }
}
?>

<div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
  <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
    <form method="POST" class="p-6 space-y-4 md:space-y-6 sm:p-8">
      <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
        Accédez à votre compte
      </h1>

      <?php if ($error) : ?>
        <p class="font-medium text-red-500">
          Vos identifiants sont incorrects.
        </p>
      <?php endif; ?>

      <div>
        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Email</label>
        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="name@company.com" required value="<?= $_POST["email"] ?? '' ?>">
      </div>

      <div>
        <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Mot de passe</label>
        <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
      </div>

      <button type="submit" class="w-full text-gray-900 bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Connexion</button>

      <p class="text-sm font-light text-gray-500">
        Vous n'avez pas de compte ? <a href="/signup" class="font-medium text-primary-600 hover:underline">Inscription</a>
      </p>

    </form>
  </div>
</div>