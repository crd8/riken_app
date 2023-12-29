<x-app-layout>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-gray-50 dark:bg-gray-800 overflow-hidden rounded-lg">
        <div class="p-8 text-gray-900 dark:text-gray-200">
          <section>
            <a class="text-sky-800 dark:text-gray-200 hover:border-b hover:border-b-sky-800 inline-flex items-center" href="{{ route('spot.index') }}">
              <svg class="w-4 h-4 mt-1 mr-1 text-sky-800 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/>
              </svg>
              Back
            </a>
            <div>
              <header class="max-w-xl mb-7 mt-5">
                <h2 class="text-gray-800 text-lg font-semibold dark:text-gray-200">
                  {{ __('View Spot') }}
                </h2>
                <p class="text-sm text-gray-700 dark:text-gray-300">
                  {{ __('These are Spot available in system.') }}
                </p>
              </header>
            </div>
            <div class="relative overflow-x-auto rounded mt-5">
              <table class="border border-gray-500/30 dark:border-gray-600 w-full text-sm text-left bg-gray-100 text-gray-700 dark:text-gray-400">
                <thead class="text-sm border-b border-gray-500/30 dark:bg-gray-700 dark:text-gray-400">
                  <tr>
                    <th scope="col" class="px-6 py-3">
                      {{ __('Code') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                      {{ __('Spot Name') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                      {{ __('Area') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                      {{ __('Location') }}
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
                  <tr class="border-b border-gray-500/30 dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-200/50 dark:hover:bg-gray-800/90">
                    <td class="px-6 py-3 whitespace-nowrap">
                      {{ $spot->code }}
                    </td>
                    <td class="px-6 py-3 whitespace-nowrap">
                      {{ $spot->name }}
                    </td>
                    <td class="px-6 py-3 whitespace-nowrap">
                      @if ($spot->area)
                          {{ $spot->area->name }}
                      @else
                          lokasi ini belum memilikki area nya
                      @endif
                    </td>
                    <td class="px-6 py-3 whitespace-nowrap">
                      @if ($spot->location)
                          {{ $spot->location->name }}
                      @else
                          lokasi ini belum memilikki location nya
                      @endif
                    </td>
                    <td class="px-6 py-3">
                      {{ Carbon\Carbon::parse($spot->created_at)->format('l, d F Y, H:i A') }}
                    </td>
                    <td class="px-6 py-3">
                      {{ Carbon\Carbon::parse($spot->updated_at)->format('l, d F Y, H:i A') }}
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>            
          </section>
        </div>
      </div>
    </div>
  </div>
  
  
  @push('scripts')

  @endpush
</x-app-layout>