<x-app-layout>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-gray-50 dark:bg-gray-800 overflow-hidden rounded-lg">
        <div class="p-8 text-gray-900 dark:text-gray-200">
          <section>
            <a class="text-sky-800 dark:text-gray-200 hover:border-b hover:border-b-sky-800 inline-flex items-center" href="{{ route('area.index') }}">
              <svg class="w-4 h-4 mt-1 mr-1 text-sky-800 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/>
              </svg>
              Back
            </a>
            <header class="max-w-xl mb-7 mt-5">
              <h2 class="text-gray-800 text-lg font-semibold dark:text-gray-200">
                {{ __('View Area') }}
              </h2>
              <p class="text-sm text-gray-700 dark:text-gray-300">
                {{ __('These are area informations.') }}
              </p>
            </header>
            <table class="border border-gray-500/30 dark:border-gray-600 w-full text-sm text-left bg-gray-100 text-gray-700 dark:text-gray-400">
              <thead class="text-sm border-b border-gray-500/30 dark:bg-gray-700 dark:text-gray-400">
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
                  <td scope="row" class="px-6 py-3 dark:text-white">
                    {{ $area->code }}
                  </td>
                  <td scope="row" class="px-6 py-3 dark:text-white">
                    {{ $area->name }}
                  </td>
                  <td class="px-6 py-3">
                    {{ $area->address }}
                  </td>
                  <td class="px-6 py-3">
                    {{ Carbon\Carbon::parse($area->created_at)->format('l, d F Y, H:i A') }}
                  </td>
                  <td class="px-6 py-3">
                    {{ Carbon\Carbon::parse($area->updated_at)->format('l, d F Y, H:i A') }}
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