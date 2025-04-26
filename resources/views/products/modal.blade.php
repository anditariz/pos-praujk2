<div id="createProductModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 modal">
    <div
        class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-md transform transition-all duration-300 scale-95">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
            <h3 class="text-lg font-semibold">Create Product</h3>
            <button id="close-modal"
                class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 transition-colors eg-close-modal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="px-6 py-4">
            <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1" for="category">Categories</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user text-gray-400"></i>
                        </div>
                        <select name="category_id" id="category"
                            class="input-focus w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg dark:border-gray-700 focus:outline-none focus:ring-2 focus:ring-primary-blue dark:bg-gray-700 ransition-all duration-200 input-focus">
                            @foreach ($categories as $categorie)
                                <option value="{{ $categorie->id }}">{{ $categorie->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1" for="name">Name</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-font text-gray-400"></i>
                        </div>
                        <input id="product_name" name="product_name" type="text" placeholder="Input Name"
                            class="input-focus w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg dark:border-gray-700 focus:outline-none focus:ring-2 focus:ring-primary-blue dark:bg-gray-700 ransition-all duration-200 input-focus">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-white" for="product_photo">
                      Photo
                    </label>
                    
                    <label
                      for="product_photo"
                      class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-800 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-300"
                    >
                      <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                        <p class="mb-1 text-sm text-gray-500 dark:text-gray-300">
                          <span class="font-semibold">Click to upload</span> or drag and drop
                        </p>
                        <p class="text-xs text-gray-500 dark:text-gray-300">PNG, JPG, JPEG up to 5MB</p>
                      </div>
                      <input id="product_photo" name="product_photo" type="file" class="hidden" />
                    </label>
                  </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1" for="price">Price</label>
                    <input id="price" type="number" name="product_price" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-blue focus:border-primary-blue dark:bg-gray-700 transition-all duration-200 input-focus">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1" for="description">Description</label>
                    <textarea id="description" name="product_description" rows="3" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-blue focus:border-primary-blue dark:bg-gray-700 transition-all duration-200 input-focus"></textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label block mb-2 font-semibold ">Status</label>

                    <div class="flex items-center space-x-6">
                        <!-- Aktif -->
                        <label for="aktif" class="relative cursor-pointer flex items-center space-x-2">
                            <input type="radio" name="is_active" id="aktif" value="aktif"
                                class="peer hidden" />
                            <div
                                class="w-5 h-5 rounded-full border-2 border-primary-blue peer-checked:bg-primary-blue peer-checked:border-primary-blue transition-all duration-200 ease-in-out relative overflow-hidden">
                                <!-- Ripple -->
                                <span
                                    class="absolute inset-0 bg-blue-200 opacity-0 peer-active:opacity-100 peer-active:scale-150 transition transform duration-300 rounded-full"></span>
                            </div>
                            <span class="">Aktif</span>
                        </label>

                        <!-- Nonaktif -->
                        <label for="nonaktif" class="relative cursor-pointer flex items-center space-x-2">
                            <input type="radio" name="is_active" id="nonaktif" value="nonaktif"
                                class="peer hidden" />
                            <div
                                class="w-5 h-5 rounded-full border-2 border-primary-blue peer-checked:bg-primary-blue peer-checked:border-primary-blue transition-all duration-200 ease-in-out relative overflow-hidden">
                                <!-- Ripple -->
                                <span
                                    class="absolute inset-0 bg-blue-200 opacity-0 peer-active:opacity-100 peer-active:scale-150 transition transform duration-300 rounded-full"></span>
                            </div>
                            <span class="">Nonaktif</span>
                        </label>
                    </div>
                </div>

        </div>
        <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 flex justify-end space-x-3">
            <button id="cancel-modal"
                class="px-4 py-2 text-sm border border-gray-300 rounded-md hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors eg-close-modal">Cancel</button>
            <button type="submit"
                class="px-4 py-2 text-sm bg-primary-blue text-white rounded-md hover:bg-opacity-90 transition-colors transform hover:scale-105">Save
                Item</button>
        </div>
        </form>
    </div>
</div>
