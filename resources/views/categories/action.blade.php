@foreach ($datas as $data)
    <div id="editCategoriesModal{{$data->id}}" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 modal">
        <div
            class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-md transform transition-all duration-300 scale-95">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                <h3 class="text-lg font-semibold">Edit Categories</h3>
                <button id="close-modal"
                    class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 transition-colors eg-close-modal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="px-6 py-4">
                <form method="POST" action="{{ route('categories.update', $data->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1" for="name">Name</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-font text-gray-400"></i>
                            </div>
                            <input value="{{$data->category_name}}" id="category_name" name="category_name" type="text" placeholder="Input Name"
                                class="input-focus w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg dark:border-gray-700 focus:outline-none focus:ring-2 focus:ring-primary-blue dark:bg-gray-700 ransition-all duration-200 input-focus">
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


    <div id="deleteCategoriesModal{{$data->id}}" class="fixed inset-0 z-50 flex items-center justify-center modal bg-black bg-opacity-50 transition-opacity">
        {{-- <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity"></div> --}}
        
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-md transform transition-all duration-300 scale-95">
          <!-- Modal header -->
          <div class="flex items-start justify-between p-4 border-b border-gray-200 rounded-t">
            <h3 class="text-xl font-semibold text-gray-900">Delete Confirmation</h3>
            <button type="button" class="text-gray-400 hover:text-gray-500 eg-close-modal">
              <span class="sr-only">Close</span>
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
              </svg>
            </button>
          </div>
          
          <!-- Modal body -->
          <div class="p-6 space-y-4">
            <div class="flex items-center justify-center text-red-500 mb-4">
              <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
              </svg>
            </div>
            <p class="text-center text-gray-700">Are you sure you want to delete this item?</p>
            <p class="text-center text-sm text-red-600 font-medium">This action cannot be undone. All data will be permanently removed.</p>
          </div>
          
          <!-- Modal footer -->
          <div class="flex items-center justify-end p-6 space-x-3 border-t border-gray-200 rounded-b">
            <button type="button" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 eg-close-modal">
              Cancel
            </button>
            
            <form action="{{ route('categories.destroy', $data->id) }}" method="POST" style="display:inline;">
                @csrf @method('DELETE')
                <button id="confirmDeleteBtn" type="submit" class="px-4 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Delete
                </button>
            </form>
          </div>
        </div>
      </div>
@endforeach
