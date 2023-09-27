<x-app-layout>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-8 text-gray-900 dark:text-gray-200">
          <section>
            <a class="text-sky-700 dark:text-white bg-sky-200 hover:bg-sky-100 focus:ring-4 focus:ring-sky-100 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-sky-900 dark:hover:bg-sky-800 focus:outline-none dark:focus:ring-sky-900" href="{{ route('role.index') }}">
              {{ __('Back to All Roles') }}
            </a>
            <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
            <header class="max-w-xl">
              <h2 class="text-lg font-medium text-gray-900 dark:text-gray-200">
                {{ __('Create a new Role') }}
              </h2>
              <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('The process of creating new roles in a system or app.') }}
              </p>
            </header>
            <form class="max-w-7xl" action="{{ route('role.store') }}" method="POST">
              @csrf
              <div class="mt-6">
                <x-input-label for="name" :value="__('Name')"/>
                <x-text-input class="max-w-sm" id="name" name="name" type="text" value="{{ old('name') }}" required autofocus autocomplete="name"/>
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
              </div>
              <div class="grid grid-cols-5 gap-4 text-sm">
                <div class="mt-6">
                  <h3 class="text-base mb-2 font-semibold text-gray-900">Department Permissions</h3>
                  <div class="grid grid-cols-1 gap-2">
                    @forelse ($permissions as $permission)
                      @if (str_contains($permission->name, 'department'))
                        <div class="flex bg-gray-100 p-2 rounded items-center">
                          <label>
                            <input class="w-4 h-4 text-sky-600 bg-gray-100 border-gray-300 rounded focus:ring-sky-500 dark:focus:ring-sky-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="permissions[]" value="{{ $permission->name }}" data-category="Department"> 
                            <span class="capitalize text-gray-800">
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
                <div class="mt-6">
                  <h3 class="text-base mb-2 font-semibold text-gray-900">Permission Permissions</h3>
                  <div class="grid grid-cols-1 gap-2">
                    @forelse ($permissions as $permission)
                      @if (str_contains($permission->name, 'permission'))
                        <div class="flex bg-gray-100 p-2 rounded items-center">
                          <label>
                            <input class="w-4 h-4 text-sky-600 bg-gray-100 border-gray-300 rounded focus:ring-sky-500 dark:focus:ring-sky-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="permissions[]" value="{{ $permission->name }}" data-category="Pengguna"> 
                            <span class="capitalize text-gray-800">
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
                <div class="mt-6">
                  <h3 class="text-base mb-2 font-semibold text-gray-900">Role Permissions</h3>
                  <div class="grid grid-cols-1 gap-2">
                    @forelse ($permissions as $permission)
                      @if (str_contains($permission->name, 'role'))
                        <div class="flex bg-gray-100 p-2 rounded items-center">
                          <label>
                            <input class="w-4 h-4 text-sky-600 bg-gray-100 border-gray-300 rounded focus:ring-sky-500 dark:focus:ring-sky-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="permissions[]" value="{{ $permission->name }}" data-category="Peran"> 
                            <span class="capitalize text-gray-800">
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
                <div class="mt-6">
                  <h3 class="text-base mb-2 font-semibold text-gray-900">User Permissions</h3>
                  <div class="grid grid-cols-1 gap-2">
                    @forelse ($permissions as $permission)
                      @if (str_contains($permission->name, 'user'))
                        <div class="flex bg-gray-100 p-2 rounded items-center">
                          <label>
                            <input class="w-4 h-4 text-sky-600 bg-gray-100 border-gray-300 rounded focus:ring-sky-500 dark:focus:ring-sky-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="permissions[]" value="{{ $permission->name }}" data-category="Pengguna"> 
                            <span class="capitalize text-gray-800">
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
              <button type="submit" class="mt-6 text-white bg-sky-700 hover:bg-sky-800 focus:ring-4 focus:ring-sky-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-sky-600 dark:hover:bg-sky-700 focus:outline-none dark:focus:ring-sky-800">
                {{ __('Save Role') }}
              </button>
            </form>
          </section>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
