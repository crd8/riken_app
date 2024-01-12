<x-app-layout>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-gray-50 dark:bg-gray-800 overflow-hidden rounded-lg">
        <div class="p-8 text-gray-900 dark:text-gray-200">
          <section>
            <a class="text-sky-800 dark:text-gray-200 hover:border-b hover:border-b-sky-800 inline-flex items-center" href="{{ route('role.index') }}">
              <svg class="w-4 h-4 mt-1 mr-1 text-sky-800 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/>
              </svg>
              Back
            </a>
            <header class="max-w-xl mb-7 mt-5">
              <h2 class="text-gray-800 text-lg font-semibold dark:text-gray-200">
                {{ __('Create a new Role') }}
              </h2>
              <p class="text-sm text-gray-700 dark:text-gray-300">
                {{ __('The process of creating new roles in a system or app.') }}
              </p>
            </header>
            <form class="max-w-7xl" action="{{ route('role.store') }}" method="POST">
              @csrf
              <div class="mt-6">
                <label for="name" class="block mb-1.5 text-sm text-gray-800 dark:text-gray-200">Role Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" class="dark:bg-gray-700 text-sm w-4/12 text-gray-700 dark:text-gray-200 py-2 border-b-2 border-gray-400/30 dark:border-gray-600/30 border-b-gray-400 dark:border-b-gray-500 rounded focus:ring-0 focus:border-t-gray-400/30 focus:border-b-2 focus:border-b-sky-600 dark:focus:border-b-gray-200 focus:border-x-gray-400/30" required autofocus>
                @foreach ($errors->get('name') as $error)
                    <span class="block text-xs mt-0.5 text-red-600 dark:text-red-700">{{ $error }}</span>
                @endforeach
              </div>
              <div class="grid grid-cols-4 gap-4 text-sm mt-5">
                {{-- Area --}}
                <div class="mt-6">
                  <h3 class="text-base mb-2 text-gray-800 dark:text-gray-200">Area Permissions</h3>
                  <div class="grid grid-cols-1 gap-2">
                    @forelse ($permissions as $permission)
                      @if (str_contains($permission->name, 'area'))
                        <div class="flex bg-gray-200 dark:bg-gray-600 p-2 rounded items-center">
                          <label>
                            <input class="w-4 h-4 mb-1 text-sky-600 bg-gray-200 border-gray-500 rounded-sm text-xl focus:ring-sky-500 dark:focus:ring-sky-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-900 dark:border-gray-600" type="checkbox" name="permissions[]" value="{{ $permission->name }}" data-category="Area"> 
                            <span class="text-sm capitalize text-gray-700 dark:text-gray-200">
                              {{ $permission->name }}
                            </span>
                          </label>
                        </div>
                      @endif
                    @empty
                    ----
                    @endforelse
                  </div>
                </div>
                {{-- Asset --}}
                <div class="mt-6">
                  <h3 class="text-base mb-2 text-gray-800 dark:text-gray-200">Asset Permissions</h3>
                  <div class="grid grid-cols-1 gap-2">
                    @forelse ($permissions as $permission)
                      @if (str_contains($permission->name, 'asset') && !str_contains($permission->name, 'categorie'))
                        <div class="flex bg-gray-200 dark:bg-gray-600 p-2 rounded items-center">
                          <label>
                            <input class="w-4 h-4 mb-1 text-sky-600 bg-gray-200 border-gray-500 rounded-sm text-xl focus:ring-sky-500 dark:focus:ring-sky-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-900 dark:border-gray-600" type="checkbox" name="permissions[]" value="{{ $permission->name }}" data-category="Asset"> 
                            <span class="text-sm capitalize text-gray-700 dark:text-gray-200">
                              {{ $permission->name }}
                            </span>
                          </label>
                        </div>
                      @endif
                    @empty
                    ----
                    @endforelse
                  </div>
                </div>
                {{-- Asset Categorie --}}
                <div class="mt-6">
                  <h3 class="text-base mb-2 text-gray-800 dark:text-gray-200">Asset Categorie Permissions</h3>
                  <div class="grid grid-cols-1 gap-2">
                    @forelse ($permissions as $permission)
                      @if (str_contains($permission->name, 'asset categorie'))
                        <div class="flex bg-gray-200 dark:bg-gray-600 p-2 rounded items-center">
                          <label>
                            <input class="w-4 h-4 mb-1 text-sky-600 bg-gray-200 border-gray-500 rounded-sm text-xl focus:ring-sky-500 dark:focus:ring-sky-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-900 dark:border-gray-600" type="checkbox" name="permissions[]" value="{{ $permission->name }}" data-category="Asset Categorie"> 
                            <span class="text-sm capitalize text-gray-700 dark:text-gray-200">
                              {{ $permission->name }}
                            </span>
                          </label>
                        </div>
                      @endif
                    @empty
                    ----
                    @endforelse
                  </div>
                </div>
                {{-- Department --}}
                <div class="mt-6">
                  <h3 class="text-base mb-2 text-gray-800 dark:text-gray-200">Department Permissions</h3>
                  <div class="grid grid-cols-1 gap-2">
                    @forelse ($permissions as $permission)
                      @if (str_contains($permission->name, 'department'))
                        <div class="flex bg-gray-200 dark:bg-gray-600 p-2 rounded items-center">
                          <label>
                            <input class="w-4 h-4 mb-1 text-sky-600 bg-gray-200 border-gray-500 rounded-sm text-xl focus:ring-sky-500 dark:focus:ring-sky-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-900 dark:border-gray-600" type="checkbox" name="permissions[]" value="{{ $permission->name }}" data-category="Department"> 
                            <span class="text-sm capitalize text-gray-700 dark:text-gray-200">
                              {{ $permission->name }}
                            </span>
                          </label>
                        </div>
                      @endif
                    @empty
                    ----
                    @endforelse
                  </div>
                </div>
                {{-- Location --}}
                <div class="mt-6">
                  <h3 class="text-base mb-2 text-gray-800 dark:text-gray-200">Location Permissions</h3>
                  <div class="grid grid-cols-1 gap-2">
                    @forelse ($permissions as $permission)
                      @if (str_contains($permission->name, 'location'))
                        <div class="flex bg-gray-200 dark:bg-gray-600 p-2 rounded items-center">
                          <label>
                            <input class="w-4 h-4 mb-1 text-sky-600 bg-gray-200 border-gray-500 rounded-sm text-xl focus:ring-sky-500 dark:focus:ring-sky-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-900 dark:border-gray-600" type="checkbox" name="permissions[]" value="{{ $permission->name }}" data-category="Location"> 
                            <span class="text-sm capitalize text-gray-700 dark:text-gray-200">
                              {{ $permission->name }}
                            </span>
                          </label>
                        </div>
                      @endif
                    @empty
                    ----
                    @endforelse
                  </div>
                </div>
                {{-- Permission --}}
                <div class="mt-6">
                  <h3 class="text-base mb-2 text-gray-800 dark:text-gray-200">Permission Permissions</h3>
                  <div class="grid grid-cols-1 gap-2">
                    @forelse ($permissions as $permission)
                      @if (str_contains($permission->name, 'permission'))
                        <div class="flex bg-gray-200 dark:bg-gray-600 p-2 rounded items-center">
                          <label>
                            <input class="w-4 h-4 mb-1 text-sky-600 bg-gray-200 border-gray-500 rounded-sm text-xl focus:ring-sky-500 dark:focus:ring-sky-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-900 dark:border-gray-600" type="checkbox" name="permissions[]" value="{{ $permission->name }}" data-category="Pengguna"> 
                            <span class="text-sm capitalize text-gray-700 dark:text-gray-200">
                              {{ $permission->name }}
                            </span>
                          </label>
                        </div>
                      @endif
                    @empty
                    ----
                    @endforelse
                  </div>
                </div>
                {{-- Role --}}
                <div class="mt-6">
                  <h3 class="text-base mb-2 text-gray-800 dark:text-gray-200">Role Permissions</h3>
                  <div class="grid grid-cols-1 gap-2">
                    @forelse ($permissions as $permission)
                      @if (str_contains($permission->name, 'role'))
                        <div class="flex bg-gray-200 dark:bg-gray-600 p-2 rounded items-center">
                          <label>
                            <input class="w-4 h-4 mb-1 text-sky-600 bg-gray-200 border-gray-500 rounded-sm text-xl focus:ring-sky-500 dark:focus:ring-sky-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-900 dark:border-gray-600" type="checkbox" name="permissions[]" value="{{ $permission->name }}" data-category="Peran"> 
                            <span class="text-sm capitalize text-gray-700 dark:text-gray-200">
                              {{ $permission->name }}
                            </span>
                          </label>
                        </div>
                      @endif
                    @empty
                    ----
                    @endforelse
                  </div>
                </div>
                {{-- Spot --}}
                <div class="mt-6">
                  <h3 class="text-base mb-2 text-gray-800 dark:text-gray-200">Spot Permissions</h3>
                  <div class="grid grid-cols-1 gap-2">
                    @forelse ($permissions as $permission)
                      @if (str_contains($permission->name, 'spot'))
                        <div class="flex bg-gray-200 dark:bg-gray-600 p-2 rounded items-center">
                          <label>
                            <input class="w-4 h-4 mb-1 text-sky-600 bg-gray-200 border-gray-500 rounded-sm text-xl focus:ring-sky-500 dark:focus:ring-sky-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-900 dark:border-gray-600" type="checkbox" name="permissions[]" value="{{ $permission->name }}" data-category="Titik"> 
                            <span class="text-sm capitalize text-gray-700 dark:text-gray-200">
                              {{ $permission->name }}
                            </span>
                          </label>
                        </div>
                      @endif
                    @empty
                    ----
                    @endforelse
                  </div>
                </div>
                {{-- User --}}
                <div class="mt-6">
                  <h3 class="text-base mb-2 text-gray-800 dark:text-gray-200">User Permissions</h3>
                  <div class="grid grid-cols-1 gap-2">
                    @forelse ($permissions as $permission)
                      @if (str_contains($permission->name, 'user'))
                        <div class="flex bg-gray-200 dark:bg-gray-600 p-2 rounded items-center">
                          <label>
                            <input class="w-4 h-4 mb-1 text-sky-600 bg-gray-200 border-gray-500 rounded-sm text-xl focus:ring-sky-500 dark:focus:ring-sky-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-900 dark:border-gray-600" type="checkbox" name="permissions[]" value="{{ $permission->name }}" data-category="Pengguna"> 
                            <span class="text-sm capitalize text-gray-700 dark:text-gray-200">
                              {{ $permission->name }}
                            </span>
                          </label>
                        </div>
                      @endif
                    @empty
                    ----
                    @endforelse
                  </div>
                </div>
              </div>
              <button type="submit" class="mt-8 border border-gray-500/40 text-gray-700 dark:text-gray-200 hover:text-sky-600 dark:hover:text-sky-50 bg-gray-50 dark:bg-gray-600 focus:ring-2 ring-offset-2 ring-offset-gray-200 dark:ring-offset-gray-900 focus:ring-sky-500 rounded text-sm font-semibold px-5 py-2.5 mr-2 mb-2 focus:outline-none dark:focus:ring-gray-500 focus:transition focus:ease-in focus:duration-75">
                {{ __('Save Role') }}
              </button>
            </form>
          </section>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
