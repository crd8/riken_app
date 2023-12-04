<x-app-layout>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-8 text-gray-900 dark:text-gray-200">
          <section>
            <a class="text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 hover:bg-gray-200 focus:ring-4 focus:ring-gray-300 rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:hover:bg-gray-800 focus:outline-none dark:focus:ring-gray-700" href="{{ route('area.index') }}">
              {{ __('Back to All Area') }}
            </a>
            <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
            <header class="max-w-xl mb-8">
              <h2 class="text-gray-600 dark:text-gray-200">
                {{ __('View Area') }}
              </h2>
              <p class="mt-1 text-gray-400 dark:text-gray-400">
                {{ __('These are area informations.') }}
              </p>
            </header>
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
              <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                  <th scope="col" class="px-6 py-3">
                    {{ __('Code') }}
                  </th>
                  <th scope="col" class="px-6 py-3">
                    {{ __('Name') }}
                  </th>
                  <th scope="col" class="px-6 py-3">
                    {{ __('Address') }}
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr class="bg-gray-100 border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                  <td scope="row" class="px-6 py-4 dark:text-white">
                    {{ $area->code }}
                  </td>
                  <td scope="row" class="px-6 py-4 dark:text-white">
                    {{ $area->name }}
                  </td>
                  <td class="px-6 py-4">
                    {{ $area->address }}
                  </td>
                </tr>
              </tbody>
            </table>
          </section>
        </div>
      </div>
    </div>
  </div>
  
  
  @push('scripts')

  @endpush
</x-app-layout>