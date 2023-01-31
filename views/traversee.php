<div class="w-full lg:h-auto text-center">
    <h1 class="text-2xl font-bold text-blue-500 m-4">Voici la liste de nos liaison</h1>
    <?php
    include "./database/data-source.php";
    $database = new DataSource();
    $result = $database->collectRegion();
    foreach ($result as $value) {
        echo $value['nom'];
        $resulting = $database->collectLiaison($value['id']);
        foreach ($resulting as $value) {
            echo '<div class="flex justify-center">';
            echo '<div class="rounded-lg shadow-lg bg-white max-w-sm">';
            echo '<a href="#!">';
            echo '<img class="rounded-t-lg" src="' . $value->{'imglink'} . '" alt=""/>';
            echo '</a>';
            echo '<div class="p-6">';
            echo '<h5 class="text-gray-900 text-xl font-medium mb-2">' . $value->{'depart'} . ' - ' . $value->{'arrivee'} . '</h5>';
            echo '<a href="/reservation"><button type="button" class=" inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Réserver</button></a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    }
    ?>
</div>