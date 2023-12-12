<x-app-layout>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-gray-50 dark:bg-gray-800 overflow-hidden rounded-lg">
        <div class="p-8 text-gray-900 dark:text-gray-200">
          <section>
            <a class="text-sky-800 dark:text-gray-200 hover:border-b hover:border-b-sky-800 inline-flex items-center" href="{{ route('user.index') }}">
              <svg class="w-4 h-4 mt-1 mr-1 text-sky-800 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/>
              </svg>
              Back
            </a>
            <div>
              <header class="max-w-xl mb-7 mt-5">
                <h2 class="text-gray-800 text-lg font-semibold dark:text-gray-200">
                  {{ __('View User') }}
                </h2>
                <p class="text-sm text-gray-700 dark:text-gray-300">
                  {{ __('These are user informations.') }}
                </p>
              </header>
            </div>
            <table class="border border-gray-500/30 dark:border-gray-600 w-full text-sm text-left bg-gray-100 text-gray-700 dark:text-gray-400">
              <thead class="text-sm border-b border-gray-500/30 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                  <th scope="col" class="px-6 py-3 whitespace-nowrap">
                    {{ __('Name') }}
                  </th>
                  <th scope="col" class="px-6 py-3 whitespace-nowrap">
                    {{ __('Email') }}
                  </th>
                  <th scope="col" class="px-6 py-3 whitespace-nowrap">
                    {{ __('Department') }}
                  </th>
                  <th scope="col" class="px-6 py-3 whitespace-nowrap">
                    {{ __('Created at') }}
                  </th>
                  <th scope="col" class="px-6 py-3 whitespace-nowrap">
                    {{ __('Modified at') }}
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr class="border-b border-gray-500/30 dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-200/50 dark:hover:bg-gray-800/90">
                  <td scope="row" class="px-6 py-3 whitespace-nowrap">
                    {{ $user->name }}
                  </td>
                  <td scope="row" class="px-6 py-3 whitespace-nowrap">
                    {{ $user->email }}
                  </td>
                  <td scope="row" class="px-6 py-3 whitespace-nowrap">
                    {{ $user->department->name }}
                  </td>
                  <td class="px-6 py-3 whitespace-nowrap">
                    {{ Carbon\Carbon::parse($user->created_at)->format('l, d F Y, H:i A') }}
                  </td>
                  <td class="px-6 py-3 whitespace-nowrap">
                    {{ Carbon\Carbon::parse($user->updated_at)->format('l, d F Y, H:i A') }}
                  </td>
                </tr>
              </tbody>
            </table>
            <div class="grid grid-cols-1 gap-4 text-sm">
              <div class="mt-6">
                <h3 class="text-base mb-2 font-semibold text-gray-900">Roles</h3>
                <div class="grid grid-cols-6 gap-2">
                  @forelse ($roles as $role)
                      <div class="flex {{ in_array($role->id, $userHasRoles) ? 'bg-sky-400 dark:bg-sky-700' : 'bg-gray-200 dark:bg-gray-600' }} p-2 rounded items-center">
                        <label>
                          <input class="w-4 h-4 mb-1 text-sky-600 bg-gray-200 border-gray-500 rounded-xl text-xl focus:ring-sky-500 dark:focus:ring-sky-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-900 dark:border-gray-600" type="radio" name="roles[]" value="{{ $role->name }}" {{ in_array($role->id, $userHasRoles) ? 'checked' : '' }} disabled data-category="Peran"> 
                          <span class="text-sm capitalize text-gray-700 dark:text-gray-200 {{ in_array($role->id, $userHasRoles) ? 'text-sky-950 font-semibold dark:text-gray-200' : ''}}">
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