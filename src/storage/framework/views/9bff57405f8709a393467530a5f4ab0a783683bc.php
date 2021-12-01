<div class="modal hidden h-screen w-full fixed left-0 top-0 flex justify-center items-center bg-black bg-opacity-50">
    <!-- modal -->
    <div class="bg-white rounded shadow-lg w-10/12 md:w-1/3">
        <!-- modal header -->
        <div class="border-b px-4 py-2 flex justify-between items-center p-3">
            <h3 class="font-semibold text-lg" id="author-name-lastname">Modal Title</h3>
            <button class="text-red-500 text-2xl close-modal">&#10005;</button>
        </div>
        <!-- modal body -->
        <div class="p-3">
            <div class="mb-3">
                <label for="author-biography" class="block mb-1 text-sm text-gray-500">Biografía:</label>
                <p id="author-biography" class="text-xs lg:text-base"></p>
            </div>

            <div class="mb-3">
                <label for="author-birth" class="block mb-1 text-sm text-gray-500">Nacimiento:</label>
                <p id="author-birth" class="text-xs lg:text-base"></p>
            </div>

            <div class="mb-3">
                <label for="" class="block mb-1 text-sm text-gray-500">Redes Sociales: </label>
                <div class="flex justify-evenly text-blue-500">
                    <a href="#" class="font-light block hover:text-blue-800" mr-6" target="_blank" id="author-facebook"> <small> Facebook </small> </a>
                    <a href="#" class="font-light block hover:text-blue-800" mr-6" target="_blank" id="author-youtube"> <small> Youtube </small> </a>
                    <a href="#" class="font-light block hover:text-blue-800" mr-6" target="_blank" id="author-instagram"> <small> Instagram </small> </a>
                </div>
            </div>

            <div class="mb-3">
                <label for="author-created-at" class="block mb-1 text-sm text-gray-500">Creado: </label>
                <p id="author-created-at" class="text-xs lg:text-base"></p>
            </div>

            <div class="mb-3">
                <label for="author-updated-at" class="block mb-1 text-sm text-gray-500">Actualizado: </label>
                <p id="author-updated-at" class="text-xs lg:text-base"></p>
            </div>
        </div>
        <div class="flex justify-end items-center w-100 border-t p-3">
            <!--<button class="bg-purple-600 hover:bg-purple-700 px-3 py-1 rounded text-white">Ok</button>-->
            <!--<button class="bg-red-600 hover:bg-red-700 px-3 py-1 rounded text-white mr-1 close-modal">Cancelar</button>-->
        </div>
    </div>
</div>
<?php /**PATH /var/www/resources/views/authors/modal.blade.php ENDPATH**/ ?>