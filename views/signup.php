<?php
$error = false;

define("PASSWORD_REGEX", "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*\W).{12,}$/");
define("EMAIL_REGEX", "/^[\w\-\.]+@([\w-]+\.)+[\w-]{2,4}$/");

if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['password'])) {
  var_dump($_POST["email"]);
  var_dump(preg_match(EMAIL_REGEX, $_POST["email"]));
  if (!preg_match(PASSWORD_REGEX, $_POST["password"]) || !preg_match(EMAIL_REGEX, $_POST["email"])) {
    $error = true;
  } else {
    include_once __DIR__ . "/../controllers/user.php";
    include_once __DIR__ . "/../controllers/utils.php";

    $checkUser = User::findByEmail($_POST["email"]);
    if ($checkUser) {
      $error = true;
    } else {
      User::create($_POST["email"], $_POST["password"], $_POST["first_name"], $_POST["last_name"]);
      addUserIdOnReservations($_POST["email"]);
      header("Location: /signin");
    }
  }
}
?>


<div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
  <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
      <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
        Création de compte
      </h1>

      <?php if ($error) : ?>
        <p class="font-medium text-red-500">
          Vos identifiants sont incorrects.
        </p>
      <?php endif; ?>

      <form class="space-y-4 md:space-y-6" method="post">
        <div class="flex">
          <div class="w-1/2 pr-1">
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 ">Prénom</label>
            <input type="text" name="first_name" id="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Prénom" required value="<?= $_POST["first_name"] ?? '' ?>">
          </div>

          <div class="w-1/2 pl-1">
            <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 ">Nom</label>
            <input type="text" name="last_name" id="last_name" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Nom" required value="<?= $_POST["last_name"] ?? '' ?>">
          </div>
        </div>

        <div>
          <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Email</label>
          <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="name@company.com" required value="<?= $_POST["email"] ?? '' ?>">
        </div>

        <div>
          <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Mot de passe</label>
          <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required value="<?= $_POST["password"] ?? '' ?>">
        </div>
        <div class="flex items-center justify-between">
        </div>

        <button type="submit" class="w-full text-gray-900 bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Inscription</button>

        <p class="text-sm font-light text-gray-500">
          Vous avez un compte ? <a href="/signin" class="font-medium text-primary-600 hover:underline">Connexion</a>
        </p>
      </form>
    </div>
  </div>
</div>