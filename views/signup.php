<section class="bg-gray-50">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                    Création de compte
                </h1>
                <form class="space-y-4 md:space-y-6" action="" method="post">
                    <div class="flex">
                        <div class="w-1/2 pr-1">
                            <label for="first-name" class="block mb-2 text-sm font-medium text-gray-900 ">Prénom</label>
                            <input type="text" name="first-name" id="first-name" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Prénom" required="">
                        </div>
                        <div class="w-1/2 pl-1">
                            <label for="last-name" class="block mb-2 text-sm font-medium text-gray-900 ">Nom</label>
                            <input type="text" name="last-name" id="last-name" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Nom" required="">
                        </div>
                    </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Email</label>
                        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="name@company.com" required="">
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Mot de passe</label>
                        <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required="">
                    </div>
                    <div class="flex items-center justify-between">
                    </div>
                    <button type="submit" class="w-full text-gray-900 bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Inscription</button>
                    <p class="text-sm font-light text-gray-500">
                        Vous avez un compte ? <a href="/login" class="font-medium text-primary-600 hover:underline">Connexion</a>
                    </p>
                    <?php
                    if (isset($_POST['first-name']) && isset($_POST['last-name']) && isset($_POST['email']) && isset($_POST['password'])) {
                        $uppercase = preg_match('@[A-Z]@', $_POST['password']);
                        $lowercase = preg_match('@[a-z]@', $_POST['password']);
                        $number    = preg_match('@[0-9]@', $_POST['password']);
                        $specialChars = preg_match('@[^\w]@', $_POST['password']);

                        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($_POST['password']) < 12) {
                            echo '<p style="color:red">Le mot de passe ne respecte pas les critères:';
                            echo '<br>- 12 caractères minimum';
                            echo '<br>- Une majuscule';
                            echo '<br>- Une minuscule';
                            echo '<br>- Un nombre';
                            echo '<br>- Un caractère spécial';
                        } else {
                            include "../database/data-source.php";

                            $fname = $_POST['first_name'];
                            $lame = $_POST['last_name'];
                            $mail = $_POST['email'];
                            $psw = md5($_POST['password']);

                            $database = new DataSource();

                            $result = $database->userAlreadyExist($mail);
                            if ($result == true) {
                                echo "aaaa";
                                $result = $database->createUser($mail, $psw, $fname, $lname);
                                echo $result;
                            } else {
                                echo '<p style="color:red">L\'adresse mail est déjà utilisée';
                            }
                        }
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>
</section>