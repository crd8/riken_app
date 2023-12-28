<x-app-layout>
  <div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-gray-50 dark:bg-gray-800 overflow-hidden rounded-lg">
        <div class="p-8 text-gray-900 dark:text-gray-200">
          <section>
            <a class="text-sky-800 dark:text-gray-200 hover:border-b hover:border-b-sky-800 inline-flex items-center" href="{{ route('spot.index') }}">
              <svg class="w-4 h-4 mt-1 mr-1 text-sky-800 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/>
              </svg>
              Back
            </a>
            <header class="max-w-xl mb-7 mt-5">
              <h2 class="text-gray-800 text-lg font-semibold dark:text-gray-200">
                {{ __('Create a new spot') }}
              </h2>
              <p class="text-sm text-gray-700 dark:text-gray-300">
                {{ __('The process of creating new spot in a system or app.') }}
              </p>
            </header>
            <div>
              @if (session()->has('message'))
              <div id="toast-success" class="z-20 fixed bottom-5 right-5 flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
                <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-sky-500 bg-sky-100 rounded-lg dark:bg-sky-800 dark:text-sky-200">
                  <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                  </svg>
                  <span class="sr-only">Check icon</span>
                </div>
                <div class="ml-3 text-sm font-normal">{!! session()->get('message') !!}</div>
                <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
                  <span class="sr-only">Close</span>
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                  </svg>
                </button>
              </div>
              @endif
            </div>
            <form action="{{ route('spot.store') }}" method="POST" x-data="{ areas: {{ $areas->toJson() }}, locations: [] }">
              @csrf
              <div class="mt-6">
                <label for="code" class="block mb-1.5 text-sm text-gray-800 dark:text-gray-200">Location Code</label>
                <input type="text" id="code" name="code" value="{{ old('code') }}" class="dark:bg-gray-700 text-sm w-6/12 text-gray-700 dark:text-gray-200 py-2 border-b-2 border-gray-400/30 dark:border-gray-600/30 border-b-gray-400 dark:border-b-gray-500 rounded focus:ring-0 focus:border-t-gray-400/30 focus:border-b-2 focus:border-b-sky-600 dark:focus:border-b-gray-200 focus:border-x-gray-400/30" required autofocus>
                @foreach ($errors->get('code') as $error)
                  <span class="block text-xs mt-0.5 text-red-600 dark:text-red-700">{{ $error }}</span>
                @endforeach
              </div>
              <div class="mt-6">
                <label for="name" class="block mb-1.5 text-sm text-gray-800 dark:text-gray-200">Location Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" class="dark:bg-gray-700 text-sm w-6/12 text-gray-700 dark:text-gray-200 py-2 border-b-2 border-gray-400/30 dark:border-gray-600/30 border-b-gray-400 dark:border-b-gray-500 rounded focus:ring-0 focus:border-t-gray-400/30 focus:border-b-2 focus:border-b-sky-600 dark:focus:border-b-gray-200 focus:border-x-gray-400/30" required autofocus>
                @foreach ($errors->get('name') as $error)
                  <span class="block text-xs mt-0.5 text-red-600 dark:text-red-700">{{ $error }}</span>
                @endforeach
              </div>
              <div class="grid grid-cols-2 gap-2 mt-6">
                <div>
                  <label for="area_id" class="block mb-1.5 text-sm text-gray-800 dark:text-gray-200">Select Area</label>
                  <select id="area_id" name="area_id" x-model="selectedArea" class="w-full dark:bg-gray-700 text-sm text-gray-700 dark:text-gray-200 py-2 border-b-2 border-gray-400/30 dark:border-gray-600/30 border-b-gray-400 dark:border-b-gray-500 rounded focus:ring-0 focus:border-t-gray-400/30 focus:border-b-2 focus:border-b-sky-600 dark:focus:border-b-gray-200 focus:border-x-gray-400/30">
                    <option value="">Pilih</option>
                    <template x-for="area in areas" :key="area.id">
                      <option x-bind:value="area.id" x-text="area.code + ' | ' + area.name"></option>
                    </template>
                  </select>
                </div>
                <div>
                  <label for="location_id" class="block mb-1.5 text-sm text-gray-800 dark:text-gray-200">Select location</label>
                  <select id="location_id" name="location_id" x-model="selectedLocation" class="w-full dark:bg-gray-700 text-sm text-gray-700 dark:text-gray-200 py-2 border-b-2 border-gray-400/30 dark:border-gray-600/30 border-b-gray-400 dark:border-b-gray-500 rounded focus:ring-0 focus:border-t-gray-400/30 focus:border-b-2 focus:border-b-sky-600 dark:focus:border-b-gray-200 focus:border-x-gray-400/30">
                    <template x-for="location in locations[selectedArea]" :key="location.id">
                      <option x-bind:value="location.id" x-text="location.name"></option>
                    </template>
                  </select>
                </div>
              </div>
              <div class="mt-6">
                <label for="description" class="block mb-1.5 text-sm text-gray-800 dark:text-gray-200">Description</label>
                <textarea name="description" id="description" rows="4" class="dark:bg-gray-700 text-sm w-11/12 text-gray-700 dark:text-gray-200 py-2 border-b-2 border-gray-400/30 dark:border-gray-600/30 border-b-gray-400 dark:border-b-gray-500 rounded focus:ring-0 focus:border-t-gray-400/30 focus:border-b-2 focus:border-b-sky-600 dark:focus:border-b-gray-200 focus:border-x-gray-400/30" required>{{ old('description') }}</textarea>
                <x-input-error class="mt-2" :messages="$errors->get('description')" />
              </div>
              <button type="submit" class="mt-6 border border-gray-500/40 text-gray-700 dark:text-gray-200 hover:text-sky-600 dark:hover:text-sky-50 bg-gray-50 dark:bg-gray-600 focus:ring-2 ring-offset-2 ring-offset-gray-200 dark:ring-offset-gray-900 focus:ring-sky-500 rounded text-sm font-semibold px-5 py-2.5 mr-2 mb-2 focus:outline-none dark:focus:ring-gray-500 focus:transition focus:ease-in focus:duration-75">
                {{ __('Save Spot') }}
              </button>
            </form>
          </section>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  $(document).ready(function () {
      $('#area_id').change(function () {
          var areaId = $(this).val();

          $.ajax({
              type: 'GET',
              url: '/get-locations/' + areaId,
              success: function (data) {
                // Hapus pilihan lokasi yang ada
                $('#location_id').empty();

                // pilihan lokasi baru berdasarkan respons Ajax
                $.each(data, function (index, location) {
                    $('#location_id').append(new Option(location.code + ' - ' + location.name, location.id));
                });

              }
          });
      });
  });
</script>
