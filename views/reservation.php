<script src="./scripts/reservation.js"></script>
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<div class="flex items-center justify-center p-8 z-10">
    <div class="mx-auto w-full max-w-[550px]">
        <form method="POST" action="">
            <div class="-mx-3 flex flex-wrap">
                <div class="w-full px-3 sm:w-1/2">
                    <div class="mb-5">
                        <label for="fName" class="mb-3 block text-base font-medium text-[#07074D]">
                            Nom
                        </label>
                        <input type="text" name="fName" id="fName" placeholder="Nom" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                    </div>
                </div>
                <div class="w-full px-3 sm:w-1/2">
                    <div class="mb-5">
                        <label for="lName" class="mb-3 block text-base font-medium text-[#07074D]">
                            Prénom
                        </label>
                        <input type="text" name="lName" id="lName" placeholder="Prénom" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                    </div>
                </div>
            </div>
            <div class="w-full mb-5">
                <label for="adress" class="mb-3 block text-base font-medium text-[#07074D]">
                    Votre adresse
                </label>
                <input type="text" name="adress" id="adress" placeholder="Adresse" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
            </div>
            <div class="-mx-3 flex flex-wrap">
                <div class="w-full px-3 sm:w-1/2">
                    <div class="mb-5">
                        <label for="city" class="mb-3 block text-base font-medium text-[#07074D]">
                            Ville
                        </label>
                        <input type="text" name="city" id="city" placeholder="Ville" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                    </div>
                </div>
                <div class="w-full px-3 sm:w-1/2">
                    <div class="mb-5">
                        <label for="cp" class="mb-3 block text-base font-medium text-[#07074D]">
                            Code Postal
                        </label>
                        <input type="" name="cp" id="cp" placeholder="CP" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                    </div>
                </div>
            </div>
            <div class="mb-5">
                <label for="regiondispo" class="block mb-3 text-base font-medium text-[#07074D]">
                    Les régions
                </label>
                <select id="region" onchange="dispo()" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                    <option selected disabled>Choisissez une région</option>
                    <?php
                    include "./database/data-source.php";
                    $database = new DataSource();
                    $result = $database->collectRegion();

                    foreach ($result as $value) {
                        echo "<option value=" . $value['id'] . ">" . $value['nom'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div id="liaisondispo" class="mb-5 hidden">
                <label for="liaison" class="block mb-3 text-base font-medium text-[#07074D]">
                    Liaisons disponibles
                </label>
                <select id="liaison" onchange="traverseedispo()" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                    <option selected disabled value="none">Choisissez une liaison</option>
                </select>
            </div>

            <div id="traverseedispo" class="mb-5 hidden">
                <label for="traversee" class="block mb-3 text-base font-medium text-[#07074D]">
                    Traversée disponibles
                </label>
                <select id="traversee" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                    <option selected disabled value="none">Choisissez une traversée</option>
                </select>
            </div>
            <div class="mb-5">
                <div class="flex -mx-3 mt-3 mb-3">
                    <div class="w-full px-3 sm:w-1/3">
                        <div class="mb-5">
                            <label for="adult" class="mb-3 block text-base font-medium text-[#07074D]">
                                Adulte
                            </label>
                            <input type="number" name="adult" id="adult" placeholder="Adulte" min="0" value="0" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                        </div>
                    </div>
                    <div class="w-full px-3 sm:w-1/3">
                        <div class="mb-5">
                            <label for="junior" class="mb-3 block text-base font-medium text-[#07074D]">
                                Junior 8 à 18ans
                            </label>
                            <input type="number" name="junior" id="junior" placeholder="Junior" min="0" value="0" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                        </div>
                    </div>
                    <div class="w-full px-3 sm:w-1/3">
                        <div class="mb-5">
                            <label for="baby" class="mb-3 block text-base font-medium text-[#07074D]">
                                Enfant 0 à 7ans
                            </label>
                            <input type="number" name="baby" id="baby" placeholder="Enfant" min="0" value="0" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-5 text-center">
                <label class="mb-3 block text-base font-medium text-[#07074D]">
                    Possèdez-vous un ou plusieurs véhicule ?
                </label>
                <div class="flex items-center space-x-6 justify-center mb-4">
                    <div class="flex items-center">
                        <input type="radio" name="radio1" id="car-yes" onchange="howManyCar(this)" class="h-5 w-5" />
                        <label for="radioButton1" class="pl-3 text-base font-medium text-[#07074D]">
                            Oui
                        </label>
                    </div>
                    <div class="flex items-center">
                        <input type="radio" name="radio1" id="car-no" onchange="howManyCar(this)" class="h-5 w-5" />
                        <label for="radioButton2" class="pl-3 text-base font-medium text-[#07074D]">
                            Non
                        </label>
                    </div>
                </div>
                <div class="hidden mt-3" id="howmanycar">
                    <label for="fourgon" class="mb-3 block text-base font-medium text-[#07074D]">
                        Fourgon
                    </label>
                    <input type="number" name="fourgon" id="fourgon" placeholder="0" min="0" value="0" class="w-32 appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                    <label for="cc" class="mb-3 block text-base font-medium text-[#07074D]">
                        Camping Car
                    </label>
                    <input type="number" name="cc" id="cc" placeholder="0" min="0" value="0" class="w-32 appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                    <label for="camion" class="mb-3 block text-base font-medium text-[#07074D]">
                        Camion
                    </label>
                    <input type="number" name="camion" id="camion" placeholder="0" min="0" value="0" class="w-32 appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                    <label for="voiture4" class="mb-3 block text-base font-medium text-[#07074D]">
                        Voiture long.inf.4m
                    </label>
                    <input type="number" name="voiture4" id="voiture4" placeholder="0" min="0" value="0" class="w-32 appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                    <label for="voiture5" class="mb-3 block text-base font-medium text-[#07074D]">
                        Voiture long.inf.5m
                    </label>
                    <input type="number" name="voiture5" id="voiture5" placeholder="0" min="0" value="0" class="w-32 appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                </div>
                <label class="mb-3 mt-3 block text-base font-medium text-[#07074D]">
                    Possèdez-vous un ou plusieurs animaux ?
                </label>
                <div class="flex items-center space-x-6 justify-center">
                    <div class="flex items-center">
                        <input type="radio" name="radio3" id="pets-yes" onchange="howManyPets(this)" class="h-5 w-5" />
                        <label for="radioButton3" class="pl-3 text-base font-medium text-[#07074D]">
                            Oui
                        </label>
                    </div>
                    <div class="flex items-center">
                        <input type="radio" name="radio3" id="pets-no" onchange="howManyPets(this)" class="h-5 w-5" />
                        <label for="radioButton4" class="pl-3 text-base font-medium text-[#07074D]">
                            Non
                        </label>
                    </div>
                </div>
                <div class="hidden mt-3" id="howmanypets">
                    <label for="animals" class="mb-3 block text-base font-medium text-[#07074D]">
                        Combien ?
                    </label>
                    <input type="number" name="animals" id="animals" placeholder="0" min="0" value="0" class="w-32 appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                </div>
            </div>
            <div class="flex justify-center">
                <button type="submit" class="hover:shadow-form rounded-md bg-[#6A64F1] py-3 px-8 text-center text-base font-semibold text-white outline-none">
                    Continuer ma reservation
                </button>
            </div>
            <?php
            if (isset($_POST['fName']) && isset($_POST['lName']) && isset($_POST['adress']) && isset($_POST['city']) && isset($_POST['cp']) && isset($_POST['region']) && isset($_POST['liaison']) && isset($_POST['traversee']) && isset($_POST['adult']) && isset($_POST['junior']) && isset($_POST['baby']) && isset($_POST['fourgon']) && isset($_POST['cc']) && isset($_POST['camion']) && isset($_POST['voiture4']) && isset($_POST['voiture5']) && isset($_POST['animals'])) {
                echo 'test';
                header('Location: /tarif');
            }
            ?>
        </form>
    </div>
</div>