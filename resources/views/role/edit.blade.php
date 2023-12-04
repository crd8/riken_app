<x-app-layout>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-8 text-gray-900 dark:text-gray-200">
          <section>
            <a class="text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 hover:bg-gray-200 focus:ring-4 focus:ring-gray-300 rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:hover:bg-gray-800 focus:outline-none dark:focus:ring-gray-700" href="{{ route('role.index') }}">
              {{ __('Back to All Roles') }}
            </a>
            <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
            <header class="max-w-xl">
              <h2 class="text-gray-600 dark:text-gray-200">
                {{ __('Update Role') }}
              </h2>
              <p class="mt-1 text-sm text-gray-400 dark:text-gray-400">
                {{ __('The process of updating roles in a system or app.') }}
              </p>
            </header>
            <form class="max-w-7xl" action="{{ route('role.update', $role->id) }}" method="POST">
              @csrf
              @method('PUT')
              <div class="mt-6">
                <x-input-label for="name" :value="__('Name')"/>
                <x-text-input class="max-w-sm" id="name" name="name" type="text" value="{{ old('name', $role->name) }}" required autofocus autocomplete="name"/>
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
              </div>
              @unless ($role->name == env('APP_SUPER_ADMIN', 'super-admin'))
              <hr class="h-px my-7 bg-gray-200 border-0 dark:bg-gray-700">
              <div class="grid grid-cols-5 gap-4 text-sm">
                {{-- Area --}}
                <div class="mt-6">
                  <h3 class="text-base mb-2 text-gray-600 dark:text-gray-200">Area Permissions</h3>
                  <div class="grid grid-cols-1 gap-2">
                    @forelse ($permissions as $permission)
                      @if (str_contains($permission->name, 'area'))
                        <div class="flex bg-gray-100 dark:bg-gray-600 p-2 rounded items-center">
                          <label>
                            <input class="w-4 h-4 text-sky-600 bg-gray-100 border-gray-400 rounded focus:ring-sky-500 dark:focus:ring-sky-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-900 dark:border-gray-600" type="checkbox" name="permissions[]" value="{{ $permission->name }}" {{ in_array($permission->id, $roleHasPermissions) ? 'checked' : '' }} data-category="Area"> 
                            <span class="text-sm capitalize text-gray-600 dark:text-gray-200">
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
                  <h3 class="text-base mb-2 text-gray-600 dark:text-gray-200">Department Permissions</h3>
                  <div class="grid grid-cols-1 gap-2">
                    @forelse ($permissions as $permission)
                      @if (str_contains($permission->name, 'department'))
                        <div class="flex bg-gray-100 dark:bg-gray-600 p-2 rounded items-center">
                          <label>
                            <input class="w-4 h-4 text-sky-600 bg-gray-100 border-gray-400 rounded focus:ring-sky-500 dark:focus:ring-sky-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-900 dark:border-gray-600" type="checkbox" name="permissions[]" value="{{ $permission->name }}" {{ in_array($permission->id, $roleHasPermissions) ? 'checked' : '' }} data-category="Department"> 
                            <span class="text-sm capitalize text-gray-600 dark:text-gray-200">
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
                  <h3 class="text-base mb-2 text-gray-600 dark:text-gray-200">Location Permissions</h3>
                  <div class="grid grid-cols-1 gap-2">
                    @forelse ($permissions as $permission)
                      @if (str_contains($permission->name, 'location'))
                        <div class="flex bg-gray-100 dark:bg-gray-600 p-2 rounded items-center">
                          <label>
                            <input class="w-4 h-4 text-sky-600 bg-gray-100 border-gray-400 rounded focus:ring-sky-500 dark:focus:ring-sky-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-900 dark:border-gray-600" type="checkbox" name="permissions[]" value="{{ $permission->name }}" {{ in_array($permission->id, $roleHasPermissions) ? 'checked' : '' }} data-category="Location"> 
                            <span class="text-sm capitalize text-gray-600 dark:text-gray-200">
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
                  <h3 class="text-base mb-2 text-gray-600 dark:text-gray-200">Permission Permissions</h3>
                  <div class="grid grid-cols-1 gap-2">
                    @forelse ($permissions as $permission)
                      @if (str_contains($permission->name, 'permission'))
                        <div class="flex bg-gray-100 dark:bg-gray-600 p-2 rounded items-center">
                          <label>
                            <input class="w-4 h-4 text-sky-600 bg-gray-100 border-gray-400 rounded focus:ring-sky-500 dark:focus:ring-sky-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-900 dark:border-gray-600" type="checkbox" name="permissions[]" value="{{ $permission->name }}" {{ in_array($permission->id, $roleHasPermissions) ? 'checked' : '' }} data-category="Pengguna"> 
                            <span class="text-sm capitalize text-gray-600 dark:text-gray-200">
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
                  <h3 class="text-base mb-2 text-gray-600 dark:text-gray-200">Role Permissions</h3>
                  <div class="grid grid-cols-1 gap-2">
                    @forelse ($permissions as $permission)
                      @if (str_contains($permission->name, 'role'))
                        <div class="flex bg-gray-100 dark:bg-gray-600 p-2 rounded items-center">
                          <label>
                            <input class="w-4 h-4 text-sky-600 bg-gray-100 border-gray-400 rounded focus:ring-sky-500 dark:focus:ring-sky-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-900 dark:border-gray-600" type="checkbox" name="permissions[]" value="{{ $permission->name }}" {{ in_array($permission->id, $roleHasPermissions) ? 'checked' : '' }} data-category="Peran"> 
                            <span class="text-sm capitalize text-gray-600 dark:text-gray-200">
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
                  <h3 class="text-base mb-2 text-gray-600 dark:text-gray-200">User Permissions</h3>
                  <div class="grid grid-cols-1 gap-2">
                    @forelse ($permissions as $permission)
                      @if (str_contains($permission->name, 'user'))
                        <div class="flex bg-gray-100 dark:bg-gray-600 p-2 rounded items-center">
                          <label>
                            <input class="w-4 h-4 text-sky-600 bg-gray-100 border-gray-400 rounded focus:ring-sky-500 dark:focus:ring-sky-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-900 dark:border-gray-600" type="checkbox" name="permissions[]" value="{{ $permission->name }}" {{ in_array($permission->id, $roleHasPermissions) ? 'checked' : '' }} data-category="Pengguna"> 
                            <span class="text-sm capitalize text-gray-600 dark:text-gray-200">
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
              @endunless
              
              <button type="submit" class="mt-6 text-white bg-sky-700 hover:bg-sky-800 focus:ring-4 focus:ring-sky-300 rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-sky-600 dark:hover:bg-sky-700 focus:outline-none dark:focus:ring-sky-800">
                {{ __('Save Role') }}
              </button>
            </form>
          </section>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
