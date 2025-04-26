<div class="hidden md:flex md:flex-shrink-0">
  <div class="flex flex-col w-64 border-r border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 transition-all duration-300">
      <div class="flex items-center justify-center h-16 px-4 border-b border-gray-200 dark:border-gray-700 animate-slideIn">
          <div class="flex items-center">
              <i class="fas fa-cube text-xl mr-2 text-primary-blue"></i>
              <span class="text-xl font-semibold">GaaPos</span>
          </div>
      </div>
      <div class="flex flex-col flex-grow overflow-y-auto">
          <nav class="flex-1 px-2 py-4 space-y-1">
              @php
                $routings = Session::get('routings');
                // Kelompokin data berdasarkan 'group'
                $groupedRoutes = [];
                $rootRoute = [];

                foreach ($routings as $route) {
                    $group = $route['group'];

                    if (!empty($group)) {
                      if (!isset($groupedRoutes[$group])) {
                          $groupedRoutes[$group] = [
                              'icon' => $route['icon'] ?? 'fa-folder', // default icon
                              'routes' => [],
                          ];
                      }
                      $groupedRoutes[$group]['routes'][] = $route;
                    } else {
                      array_push($rootRoute, $route);
                    }
                }
            @endphp

            <!-- Dashboard -->
            <div class="animate-fadeIn" style="animation-delay: 0.1s;">
              <a id="DashboardSingleSideBar" href="/dashboard" class="flex items-center px-4 py-2 text-sm font-medium rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 sidebar-item">
                  <i class="fas fa-tachometer-alt mr-3"></i>
                  Dashboard
              </a>
            </div>

            @foreach ( $rootRoute as $root)
                @php
                    $icon = $groupData['icon'] ?? 'fa-folder';
                @endphp
              <div class="animate-fadeIn" style="animation-delay: 0.1s;">
                <a id="DashboardSingleSideBar" href="{{ $root['route'] }}" class="flex items-center px-4 py-2 text-sm font-medium rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 sidebar-item">
                    <i class="fas {{$icon}} mr-3"></i>
                    {{$root['name']}}
                </a>
              </div>
            @endforeach
            
            @foreach ($groupedRoutes as $groupName => $groupData)
                @php
                    $group_class = str_replace(" ", "-", strtolower($groupName));
                    $icon = $groupData['icon'] ?? 'fa-folder';
                @endphp
                <div class="sidebar-group animate-fadeIn" style="animation-delay: 0.2s;">
                    <button class="flex items-center w-full px-4 py-2 text-sm font-medium rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 sidebar-item">
                        <i class="fa {{ $icon }} mr-3"></i>
                        <span class="flex-1 text-left">{{ $groupName }}</span>
                        <i class="fas fa-chevron-down text-xs transition-transform duration-300"></i>
                    </button>
                    <div class="sidebar-group-items pl-4 mt-1 space-y-1">
                        @foreach ($groupData['routes'] as $route)
                            <a id="SideBarItem" href="{{ $route['route'] }}" class="block px-4 py-2 text-sm rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 sidebar-item">
                                {{ $route['name'] }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endforeach

              <!-- Group 1 -->
              {{-- <div class="sidebar-group animate-fadeIn" style="animation-delay: 0.2s;">
                  <button class="flex items-center w-full px-4 py-2 text-sm font-medium rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 sidebar-item">
                      <i class="fas fa-users mr-3"></i>
                      <span class="flex-1 text-left">User Management</span>
                      <i class="fas fa-chevron-down text-xs transition-transform duration-300"></i>
                  </button>
                  <div class="sidebar-group-items pl-4 mt-1 space-y-1">
                      <a id="UsersSidebar" href="/user" class="block px-4 py-2 text-sm rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 sidebar-item">Users</a>
                      <a id="InstructurSidebar" href="/instructor" class="block px-4 py-2 text-sm rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 sidebar-item">Instructur</a>
                      <a id="StudentSideBar" href="/student" class="block px-4 py-2 text-sm rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 sidebar-item">Student</a>
                  </div>
              </div> --}}

              <!-- Group 2 -->
              {{-- <div class="sidebar-group animate-fadeIn" style="animation-delay: 0.3s;">
                  <button class="flex items-center w-full px-4 py-2 text-sm font-medium rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 sidebar-item">
                      <i class="fas fa-database mr-3"></i>
                      <span class="flex-1 text-left">Master Data</span>
                      <i class="fas fa-chevron-down text-xs transition-transform duration-300"></i>
                  </button>
                  <div class="sidebar-group-items pl-4 mt-1 space-y-1">
                      <a id="RoleSideBar" href="/role" class="block px-4 py-2 text-sm rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 sidebar-item">Roles</a>
                      <a id="MajorSideBar" href="/major" class="block px-4 py-2 text-sm rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 sidebar-item">Majors</a>
                  </div>
              </div> --}}

              <!-- Single Item -->
              <div class="animate-fadeIn" style="animation-delay: 0.4s;">
                  <a href="#" class="flex items-center px-4 py-2 text-sm font-medium rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 sidebar-item">
                      <i class="fas fa-cog mr-3"></i>
                      Settings
                  </a>
              </div>
          </nav>
      </div>
      <div class="p-4 border-t border-gray-200 dark:border-gray-700 animate-fadeIn" style="animation-delay: 0.6s;">
          <div class="flex items-center">
              <img class="w-10 h-10 rounded-full object-cover ring-2 ring-primary-blue" src="https://randomuser.me/api/portraits/women/44.jpg" alt="User avatar">
              <div class="ml-3">
                  <p class="text-sm font-medium">Sarah Johnson</p>
                  <p class="text-xs text-gray-500 dark:text-gray-400">Admin</p>
              </div>
          </div>
      </div>
  </div>
</div>