<div id="createUserModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 modal">
    <div
        class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-md transform transition-all duration-300 scale-95">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
            <h3 class="text-lg font-semibold">Create User</h3>
            <button id="close-modal"
                class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 transition-colors eg-close-modal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="px-6 py-4">
            <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1" for="role">Role</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user text-gray-400"></i>
                        </div>
                        <select name="role_id" id="role"
                            class="input-focus w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg dark:border-gray-700 focus:outline-none focus:ring-2 focus:ring-primary-blue dark:bg-gray-700 ransition-all duration-200 input-focus">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
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
                        <input id="name" name="name" type="text" placeholder="Input Name"
                            class="input-focus w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg dark:border-gray-700 focus:outline-none focus:ring-2 focus:ring-primary-blue dark:bg-gray-700 ransition-all duration-200 input-focus">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium mb-1">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                        <input type="email" id="email" name="email"
                            class="input-focus w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg dark:border-gray-700 focus:outline-none focus:ring-2 focus:ring-primary-blue dark:bg-gray-700 ransition-all duration-200 input-focus"
                            placeholder="example@email.com" required />
                    </div>
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium  mb-1">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input type="password" id="password" name="password"
                            class="input-focus w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg dark:border-gray-700 focus:outline-none focus:ring-2 focus:ring-primary-blue dark:bg-gray-700 ransition-all duration-200 input-focus"
                            placeholder="••••••••" required />
                        <button type="button" id="hide-password"
                            class="absolute right-3 top-3 text-gray-400 hover:text-gray-600">
                            <i class="fas fa-eye"></i>
                        </button>
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
