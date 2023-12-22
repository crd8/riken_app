
<nav class="bg-sky-600 dark:bg-gray-800">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <button type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-50 rounded bg-sky-700 dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-50 dark:text-gray-400" data-drawer-target="drawer-navigation" data-drawer-backdrop="false" data-drawer-show="drawer-navigation" aria-controls="drawer-navigation">
      <span class="sr-only">Open main menu</span>
      <svg class="w-6 h-6 text-gray-50" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
      </svg>
    </button>
    <div class="flex items-center md:order-2">
      <button id="theme-toggle" type="button" class="mr-4 text-gray-500 dark:text-gray-400 focus:outline-none rounded text-sm p-2.5">
        <svg id="theme-toggle-dark-icon" class="hidden w-6 h-6 text-gray-900" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
        <svg id="theme-toggle-light-icon" class="hidden w-6 h-6 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
      </button>
      <button type="button" class="flex mr-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
        <span class="sr-only">Open user menu</span>
        <img class="w-8 h-8 rounded-full" src="--https://source.unsplash.com/adult-brown-cat-Ah_QC2v2alE" alt="">
      </button>
      <!-- Dropdown menu -->
      <div class="z-50 hidden my-4 list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-900 dark:divide-gray-700" id="user-dropdown">
        <div class="px-4 py-3">
          <span class="block text-gray-600 text-left dark:text-white">{{ Auth::user()->name }}</span>
          <span class="block text-gray-400 text-left dark:text-gray-400">{{ Auth::user()->email }}</span>
        </div>
        <ul class="py-2" aria-labelledby="user-menu-button">
          <li>
              <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">{{ __('Profile') }}</a>
          </li>
          <li>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="block px-4 py-2 text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign out</a>
            </form>
          </li>
        </ul>
      </div> 
    </div>
  </div>
</nav>

<!-- drawer component -->
<div id="drawer-navigation" class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white w-64 dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-navigation-label">
  <h5 id="drawer-navigation-label" class="text-base font-semibold text-gray-500 uppercase dark:text-gray-400">Menu</h5>
  <button type="button" data-drawer-hide="drawer-navigation" aria-controls="drawer-navigation" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 right-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white" >
    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
    </svg>
    <span class="sr-only">Close menu</span>
  </button>
  <div class="py-4 overflow-y-auto">
    <ul class="space-y-2">
      <li>
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'flex items-center p-2 text-white rounded-lg dark:text-white bg-sky-700 dark:bg-sky-600 hover:bg-sky-700 dark:hover:bg-sky-600 group pointer-events-none' : 'flex items-center p-2 text-gray-600 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group' }} ">
          <svg class="{{ request()->routeIs('dashboard') ? 'w-5 h-5 text-gray-50 transition duration-75 dark:text-gray-50 group-hover:text-gray-50 dark:group-hover:text-white' : 'w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-500 dark:group-hover:text-white' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
            <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
            <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
          </svg>
          <span class="ml-3">Dashboard</span>
        </a>
      </li>
      <li>
        <button type="button" class="{{ request()->routeIs('permission.index', 'permission.create', 'permission.edit', 'permission.trash', 'role.index', 'role.create', 'role.edit', 'role.show', 'role.trash', 'user.index', 'user.create', 'user.edit', 'user.show', 'user.trash') ? 'flex items-center w-full p-2 text-base text-white transition duration-75 rounded-lg group bg-sky-700 dark:bg-sky-600 hover:bg-sky-700 dark:text-white dark:hover:bg-sky-600' : 'flex items-center w-full p-2 text-base text-gray-600 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700' }}" aria-controls="dropdown-administrator" data-collapse-toggle="dropdown-administrator">
          <svg class="{{ request()->routeIs('permission.index', 'permission.create', 'permission.edit', 'permission.trash', 'role.index', 'role.create', 'role.edit', 'role.show', 'role.trash', 'user.index', 'user.create', 'user.edit', 'user.show', 'user.trash') ? 'flex-shrink-0 w-5 h-5 text-white transition duration-75 group-hover:text-white dark:text-white dark:group-hover:text-white' : 'flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-500 dark:text-gray-400 dark:group-hover:text-white' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
            <path d="m17.351 3.063-8-3a1.009 1.009 0 0 0-.7 0l-8 3A1 1 0 0 0 0 4a19.394 19.394 0 0 0 8.47 15.848 1 1 0 0 0 1.06 0A19.394 19.394 0 0 0 18 4a1 1 0 0 0-.649-.937Zm-3.644 4.644-5 5A1 1 0 0 1 8 13c-.033 0-.065 0-.1-.005a1 1 0 0 1-.733-.44l-2-3a1 1 0 0 1 1.664-1.11l1.323 1.986 4.138-4.138a1 1 0 0 1 1.414 1.414h.001Z"/>
          </svg>
          <span class="flex-1 ml-3 text-left whitespace-nowrap">Administrator</span>
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
          </svg>
        </button>
        <ul id="dropdown-administrator" class="hidden py-2 space-y-2">
          <li>
            <a href="{{ route('permission.index') }}" class="{{ request()->routeIs('permission.index', 'permission.create', 'permission.edit', 'permission.trash') ? 'flex items-center w-full p-2 text-sky-700 transition duration-75 rounded-lg pl-10 group dark:text-sky-600 pointer-events-none' : 'flex items-center w-full p-2 text-gray-600 transition duration-75 rounded-lg pl-10 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700' }}">
              {{ __('Permissions') }}
            </a>
          </li>
          <li>
            <a href="{{ route('role.index') }}" class="{{ request()->routeIs('role.index', 'role.create', 'role.edit', 'role.show', 'role.trash') ? 'flex items-center w-full p-2 text-sky-700 transition duration-75 rounded-lg pl-10 group dark:text-sky-600 pointer-events-none' : 'flex items-center w-full p-2 text-gray-600 transition duration-75 rounded-lg pl-10 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700' }}">
              {{ __('Roles') }}
            </a>
          </li>
          <li>
            <a href="{{ route('user.index') }}" class="{{ request()->routeIs('user.index', 'user.create', 'user.edit', 'user.show', 'user.trash') ? 'flex items-center w-full p-2 text-sky-700 transition duration-75 rounded-lg pl-10 group dark:text-sky-600 pointer-events-none' : 'flex items-center w-full p-2 text-gray-600 transition duration-75 rounded-lg pl-10 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700' }}">
              {{ __('Users') }}
            </a>
          </li>
        </ul>
      </li>
      <li>
        <button type="button" class="{{ request()->routeIs('department.index', 'department.create', 'department.edit', 'department.show', 'department.trash', 'area.index', 'area.create', 'area.edit', 'area.show', 'area.trash') ? 'flex items-center w-full p-2 text-base text-white transition duration-75 rounded-lg group bg-sky-700 dark:bg-sky-600 hover:bg-sky-700 dark:text-white dark:hover:bg-sky-600' : 'flex items-center w-full p-2 text-base text-gray-600 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700' }}" aria-controls="dropdown-business-layout" data-collapse-toggle="dropdown-business-layout">
          <svg class="{{ request()->routeIs('department.index', 'department.create', 'department.edit', 'department.show', 'department.trash', 'area.index', 'area.create', 'area.edit', 'area.show', 'area.trash') ? 'flex-shrink-0 w-5 h-5 text-white transition duration-75 group-hover:text-white dark:text-white dark:group-hover:text-white' : 'flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-500 dark:text-gray-400 dark:group-hover:text-white' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
            <path d="M17 16h-1V2a1 1 0 1 0 0-2H2a1 1 0 0 0 0 2v14H1a1 1 0 0 0 0 2h16a1 1 0 0 0 0-2ZM5 4a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V4Zm0 5V8a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1Zm6 7H7v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3Zm2-7a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1Zm0-4a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1Z"/>
          </svg>
          <span class="flex-1 ml-3 text-left whitespace-nowrap">Business</span>
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
          </svg>
        </button>
        <ul id="dropdown-business-layout" class="hidden py-2 space-y-2">
          <li>
            <a href="{{ route('department.index') }}" class="{{ request()->routeIs('department.index', 'department.create', 'department.edit', 'department.show', 'department.trash') ? 'flex items-center w-full p-2 text-sky-700 transition duration-75 rounded-lg pl-10 group dark:text-sky-600 pointer-events-none' : 'flex items-center w-full p-2 text-gray-600 transition duration-75 rounded-lg pl-10 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700' }}">
              {{ __('Departments') }}
            </a>
          </li>
          <li>
            <a href="{{ route('area.index') }}" class="{{ request()->routeIs('area.index', 'area.create', 'area.edit', 'area.show', 'area.trash') ? 'flex items-center w-full p-2 text-sky-700 transition duration-75 rounded-lg pl-10 group dark:text-sky-600 pointer-events-none' : 'flex items-center w-full p-2 text-gray-600 transition duration-75 rounded-lg pl-10 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700' }}">
              {{ __('Areas') }}
            </a>
          </li>
        </ul>
      </li>

      <li>
        <button type="button" class="{{ request()->routeIs('location.index', 'location.create', 'location.edit', 'location.show', 'location.trash') ? 'flex items-center w-full p-2 text-base text-white transition duration-75 rounded-lg group bg-sky-700 dark:bg-sky-600 hover:bg-sky-700 dark:text-white dark:hover:bg-sky-600' : 'flex items-center w-full p-2 text-base text-gray-600 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700' }}" aria-controls="dropdown-mapping-layout" data-collapse-toggle="dropdown-mapping-layout">
          <svg class="{{ request()->routeIs('location.index', 'location.create', 'location.edit', 'location.show', 'location.trash') ? 'flex-shrink-0 w-5 h-5 text-white transition duration-75 group-hover:text-white dark:text-white dark:group-hover:text-white' : 'flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-500 dark:text-gray-400 dark:group-hover:text-white' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
            <path d="M8 0a7.992 7.992 0 0 0-6.583 12.535 1 1 0 0 0 .12.183l.12.146c.112.145.227.285.326.4l5.245 6.374a1 1 0 0 0 1.545-.003l5.092-6.205c.206-.222.4-.455.578-.7l.127-.155a.934.934 0 0 0 .122-.192A8.001 8.001 0 0 0 8 0Zm0 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z"/>
          </svg>
          <span class="flex-1 ml-3 text-left whitespace-nowrap">Mapping</span>
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
          </svg>
        </button>
        <ul id="dropdown-mapping-layout" class="hidden py-2 space-y-2">
          <li>
            <a href="{{ route('location.index') }}" class="{{ request()->routeIs('location.index', 'location.create', 'location.edit', 'location.show', 'location.trash') ? 'flex items-center w-full p-2 text-sky-700 transition duration-75 rounded-lg pl-10 group dark:text-sky-600 pointer-events-none' : 'flex items-center w-full p-2 text-gray-600 transition duration-75 rounded-lg pl-10 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700' }}">
              {{ __('Locations') }}
            </a>
          </li>
          <li>
            <a href="{{ route('spot.index') }}" class="{{ request()->routeIs('') ? 'flex items-center w-full p-2 text-sky-700 transition duration-75 rounded-lg pl-10 group dark:text-sky-600 pointer-events-none' : 'flex items-center w-full p-2 text-gray-600 transition duration-75 rounded-lg pl-10 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700' }}">
              {{ __('Spots') }}
            </a>
          </li>
        </ul>
      </li>
      {{-- <li>
        <a href="{{ route('department.index') }}" class="{{ request()->routeIs('department.index') ? 'flex items-center p-2 text-white rounded-lg dark:text-white bg-sky-700 dark:bg-sky-600 hover:bg-sky-700 dark:hover:bg-sky-600 group pointer-events-none' : 'flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group' }} ">
          <svg class="{{ request()->routeIs('department.index') ? 'flex-shrink-0 w-5 h-5 text-white transition duration-75 group-hover:text-white dark:text-white dark:group-hover:text-white' : 'flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 19">
            <path d="M14.5 0A3.987 3.987 0 0 0 11 2.1a4.977 4.977 0 0 1 3.9 5.858A3.989 3.989 0 0 0 14.5 0ZM9 13h2a4 4 0 0 1 4 4v2H5v-2a4 4 0 0 1 4-4Z"/>
            <path d="M5 19h10v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2ZM5 7a5.008 5.008 0 0 1 4-4.9 3.988 3.988 0 1 0-3.9 5.859A4.974 4.974 0 0 1 5 7Zm5 3a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm5-1h-.424a5.016 5.016 0 0 1-1.942 2.232A6.007 6.007 0 0 1 17 17h2a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5ZM5.424 9H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h2a6.007 6.007 0 0 1 4.366-5.768A5.016 5.016 0 0 1 5.424 9Z"/>
          </svg>
          <span class="ml-3">Department</span>
        </a>
      </li> --}}
      {{-- <li>
        <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
          <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
            <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/>
          </svg>
          <span class="flex-1 ml-3 whitespace-nowrap">Kanban</span>
          <span class="inline-flex items-center justify-center px-2 ml-3 text-sm text-gray-800 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-300">Pro</span>
        </a>
      </li> --}}
    </ul>
  </div>
</div>
  