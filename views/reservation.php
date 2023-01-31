<script src="./scripts/reservation.js"></script>
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<div class="flex items-center justify-center p-8 z-10">
    <div class="mx-auto w-full max-w-[550px]">
        <form method="POST">
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
                <label for="guest" class="mb-3 block text-base font-medium text-[#07074D]">
                    Votre adresse
                </label>
                <input type="text" name="fName" id="fName" placeholder="Adresse" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
            </div>
            <div class="-mx-3 flex flex-wrap">
                <div class="w-full px-3 sm:w-1/2">
                    <div class="mb-5">
                        <label for="fName" class="mb-3 block text-base font-medium text-[#07074D]">
                            Ville
                        </label>
                        <input type="text" name="fName" id="fName" placeholder="Ville" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                    </div>
                </div>
                <div class="w-full px-3 sm:w-1/2">
                    <div class="mb-5">
                        <label for="lName" class="mb-3 block text-base font-medium text-[#07074D]">
                            Code Postal
                        </label>
                        <input type="" name="lName" id="lName" placeholder="CP" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                    </div>
                </div>
            </div>
            <div class="mb-5">
                <label for="trajet" class="block mb-3 text-base font-medium text-[#07074D]">
                    Les régions
                </label>
                <select id="traversees" onchange="dispo()" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                    <option selected disabled>Choisissez une région</option>
                    <?php
                    include "./database/data-source.php";
                    $database = new DataSource();
                    $result = $database->collectRegion();

                    foreach ($result as $value) {
                        echo "<option value=" . $value['id_secteur'] . ">" . $value['libelle'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div id="trajetdispo" class="mb-5 hidden">
                <label for="trajet" class="block mb-3 text-base font-medium text-[#07074D]">
                    Traversées disponibles
                </label>
                <select id="traversees" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                    <option selected disabled>Choisissez une traversée</option>
                    <?php
                    include "./database/data-source.php";
                    $database = new DataSource();
                    $result = $database->collectTraversee($idRegion);
                    
                    foreach ($result as $value) {
                        echo "<option value=" . $value['id_traversee'] . ">" . $value['libelle'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-5">
                <div class="flex -mx-3 mt-3 mb-3">
                    <div class="w-full px-3 sm:w-1/3">
                        <div class="mb-5">
                            <label for="fName" class="mb-3 block text-base font-medium text-[#07074D]">
                                Adulte
                            </label>
                            <input type="number" name="fName" id="fName" placeholder="Adulte" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                        </div>
                    </div>
                    <div class="w-full px-3 sm:w-1/3">
                        <div class="mb-5">
                            <label for="lName" class="mb-3 block text-base font-medium text-[#07074D]">
                                Junior 8 à 18ans
                            </label>
                            <input type="number" name="lName" id="lName" placeholder="Junior" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                        </div>
                    </div>
                    <div class="w-full px-3 sm:w-1/3">
                        <div class="mb-5">
                            <label for="lName" class="mb-3 block text-base font-medium text-[#07074D]">
                                Enfant 0 à 7ans
                            </label>
                            <input type="number" name="lName" id="lName" placeholder="Enfant" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
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
                    <label for="number" class="mb-3 block text-base font-medium text-[#07074D]">
                        Fourgon
                    </label>
                    <input type="number" name="guest" id="guest" placeholder="0" min="0" class="w-32 appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                    <label for="number" class="mb-3 block text-base font-medium text-[#07074D]">
                        Camping Car
                    </label>
                    <input type="number" name="guest" id="guest" placeholder="0" min="0" class="w-32 appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                    <label for="number" class="mb-3 block text-base font-medium text-[#07074D]">
                        Camion
                    </label>
                    <input type="number" name="guest" id="guest" placeholder="0" min="0" class="w-32 appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                    <label for="number" class="mb-3 block text-base font-medium text-[#07074D]">
                        Voiture long.inf.4m
                    </label>
                    <input type="number" name="guest" id="guest" placeholder="0" min="0" class="w-32 appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                    <label for="number" class="mb-3 block text-base font-medium text-[#07074D]">
                        Voiture long.inf.5m
                    </label>
                    <input type="number" name="guest" id="guest" placeholder="0" min="0" class="w-32 appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
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
                    <label for="number" class="mb-3 block text-base font-medium text-[#07074D]">
                        Combien ?
                    </label>
                    <input type="number" name="guest" id="guest" placeholder="0" min="0" class="w-32 appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                </div>
            </div>
            <div class="flex justify-center">
                <button class="hover:shadow-form rounded-md bg-[#6A64F1] py-3 px-8 text-center text-base font-semibold text-white outline-none">
                    Continuer ma reservation
                </button>
            </div>
        </form>
    </div>
</div>