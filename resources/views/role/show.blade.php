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
            <header class="max-w-xl mb-8">
              <h2 class="text-lg font-medium text-gray-900 dark:text-gray-200">
                {{ __('View Role') }}
              </h2>
              <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('These are roles and with permissions.') }}
              </p>
            </header>
            <div class="relative overflow-x-auto sm:rounded-lg mt-8">
              <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                  <tr>
                    <th scope="col" class="px-6 py-3">
                      {{ __('Role Name') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                      {{ __('Created at') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                      {{ __('Modified at') }}
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="bg-gray-100 border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                      {{ $role->name }}
                    </th>
                    <td class="px-6 py-4">
                      {{ Carbon\Carbon::parse($role->created_at)->format('l, d F Y, H:i A') }}
                    </td>
                    <td class="px-6 py-4">
                      {{ Carbon\Carbon::parse($role->updated_at)->format('l, d F Y, H:i A') }}
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            @unless ($role->name == env('APP_SUPER_ADMIN', 'super-admin'))
            <div class="grid grid-cols-5 gap-4 text-sm">
              {{-- Department Permissions --}}
              <div class="mt-6">
                <h3 class="text-base mb-2 text-gray-600">Department Permissions</h3>
                <div class="grid grid-cols-1 gap-2">
                  @forelse ($permissions as $permission)
                    @if (str_contains($permission->name, 'department'))
                      <div class="flex {{ in_array($permission->id, $roleHasPermissions) ? 'bg-sky-200' : 'bg-gray-100 dark:bg-gray-400' }} p-2 rounded items-center">
                        <label>
                          <input class="w-4 h-4 text-sky-600 bg-gray-100 border-gray-300 rounded focus:ring-sky-500 dark:focus:ring-sky-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="permissions[]" value="{{ $permission->name }}" {{ in_array($permission->id, $roleHasPermissions) ? 'checked' : '' }} disabled data-category="Department"> 
                          <span class="text-sm capitalize text-gray-600 {{ in_array($permission->id, $roleHasPermissions) ? 'text-sky-700' : ''}}">
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
              {{-- Permission Permissions --}}
              <div class="mt-6">
                <h3 class="text-base mb-2 text-gray-600">Permission Permissions</h3>
                <div class="grid grid-cols-1 gap-2">
                  @forelse ($permissions as $permission)
                    @if (str_contains($permission->name, 'permission'))
                      <div class="flex {{ in_array($permission->id, $roleHasPermissions) ? 'bg-sky-200' : 'bg-gray-100 dark:bg-gray-400' }} p-2 rounded items-center">
                        <label>
                          <input class="w-4 h-4 text-sky-600 bg-gray-100 border-gray-300 rounded focus:ring-sky-500 dark:focus:ring-sky-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="permissions[]" value="{{ $permission->name }}" {{ in_array($permission->id, $roleHasPermissions) ? 'checked' : '' }} disabled data-category="Pengguna"> 
                          <span class="text-sm capitalize text-gray-600 {{ in_array($permission->id, $roleHasPermissions) ? 'text-sky-700' : ''}}">
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
              {{-- Role Permissions --}}
              <div class="mt-6">
                <h3 class="text-base mb-2 text-gray-600">Role Permissions</h3>
                <div class="grid grid-cols-1 gap-2">
                  @forelse ($permissions as $permission)
                    @if (str_contains($permission->name, 'role'))
                      <div class="flex {{ in_array($permission->id, $roleHasPermissions) ? 'bg-sky-200' : 'bg-gray-100 dark:bg-gray-400' }} p-2 rounded items-center">
                        <label>
                          <input class="w-4 h-4 text-sky-600 bg-gray-100 border-gray-300 rounded focus:ring-sky-500 dark:focus:ring-sky-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="permissions[]" value="{{ $permission->name }}" {{ in_array($permission->id, $roleHasPermissions) ? 'checked' : '' }} disabled data-category="Peran"> 
                          <span class="text-sm capitalize text-gray-600 {{ in_array($permission->id, $roleHasPermissions) ? 'text-sky-700' : ''}}">
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
              {{-- User Permissions --}}
              <div class="mt-6">
                <h3 class="text-base mb-2 text-gray-600">User Permissions</h3>
                <div class="grid grid-cols-1 gap-2">
                  @forelse ($permissions as $permission)
                    @if (str_contains($permission->name, 'user'))
                      <div class="flex {{ in_array($permission->id, $roleHasPermissions) ? 'bg-sky-200' : 'bg-gray-100 dark:bg-gray-400' }} p-2 rounded items-center">
                        <label>
                          <input class="w-4 h-4 text-sky-600 bg-gray-100 border-gray-300 rounded focus:ring-sky-500 dark:focus:ring-sky-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="permissions[]" value="{{ $permission->name }}" {{ in_array($permission->id, $roleHasPermissions) ? 'checked' : '' }} disabled data-category="Pengguna"> 
                          <span class="text-sm capitalize text-gray-600 {{ in_array($permission->id, $roleHasPermissions) ? 'text-sky-700' : ''}}">
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
          </section>
        </div>
      </div>
    </div>
  </div>
  
  
  @push('scripts')

  @endpush
</x-app-layout>