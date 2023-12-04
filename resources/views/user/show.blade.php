<x-app-layout>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-8 text-gray-900 dark:text-gray-200">
          <section>
            <a class="text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 hover:bg-gray-200 focus:ring-4 focus:ring-gray-300 rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:hover:bg-gray-800 focus:outline-none dark:focus:ring-gray-700" href="{{ route('user.index') }}">
              {{ __('Back to All Users') }}
            </a>
            <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
            <header class="max-w-xl mb-8">
              <h2 class="text-gray-600 dark:text-gray-200">
                {{ __('View User') }}
              </h2>
              <p class="mt-1 text-gray-400 dark:text-gray-400">
                {{ __('These are user informations.') }}
              </p>
            </header>
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
              <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                  <th scope="col" class="px-6 py-3">
                    {{ __('Name') }}
                  </th>
                  <th scope="col" class="px-6 py-3">
                    {{ __('Email') }}
                  </th>
                  <th scope="col" class="px-6 py-3">
                    {{ __('Department') }}
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
                  <td scope="row" class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $user->name }}
                  </td>
                  <td scope="row" class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $user->email }}
                  </td>
                  <td scope="row" class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $user->department->name }}
                  </td>
                  <td class="px-6 py-4">
                    {{ Carbon\Carbon::parse($user->created_at)->format('l, d F Y, H:i A') }}
                  </td>
                  <td class="px-6 py-4">
                    {{ Carbon\Carbon::parse($user->updated_at)->format('l, d F Y, H:i A') }}
                  </td>
                </tr>
              </tbody>
            </table>
            <div class="grid grid-cols-1 gap-4 text-sm">
              <div class="mt-6">
                <h3 class="text-base mb-2 font-semibold text-gray-900">Roles</h3>
                <div class="grid grid-cols-5 gap-2">
                  @forelse ($roles as $role)
                      <div class="flex {{ in_array($role->id, $userHasRoles) ? 'bg-sky-300' : 'bg-gray-100 dark:bg-gray-400' }} p-2 rounded items-center">
                        <label>
                          <input class="w-4 h-4 text-sky-600 bg-gray-100 border-gray-300 rounded focus:ring-sky-500 dark:focus:ring-sky-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="roles[]" value="{{ $role->name }}" {{ in_array($role->id, $userHasRoles) ? 'checked' : '' }} disabled data-category="Peran"> 
                          <span class="capitalize text-gray-800">
                            {{ $role->name }}
                          </span>
                        </label>
                      </div>
                  @empty
                  ----
                  @endforelse
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
  
  
  @push('scripts')

  @endpush
</x-app-layout>