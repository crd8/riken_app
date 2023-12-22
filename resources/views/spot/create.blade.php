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
                {{ __('Create a new location') }}
              </h2>
              <p class="text-sm text-gray-700 dark:text-gray-300">
                {{ __('The process of creating new location in a system or app.') }}
              </p>
            </header>
            
            {{--  --}}
            <form x-data="{ areas: {{ $areas->toJson() }}, locations: [] }">
              <label for="area">Select Area:</label>
              <select id="area" name="area" x-model="selectedArea">
                <template x-for="area in areas" :key="area.id">
                  <option x-bind:value="area.id" x-text="area.name"></option>
                </template>
              </select>
      
              <label for="location">Select Location:</label>
              <select id="location" name="location" x-model="selectedLocation">
                <template x-for="location in locations[selectedArea]" :key="location.id">
                  <option x-bind:value="location.id" x-text="location.name"></option>
                </template>
              </select>
            </form>
            {{--  --}}

          </section>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  $(document).ready(function () {
      $('#area').change(function () {
          var areaId = $(this).val();

          $.ajax({
              type: 'GET',
              url: '/get-locations/' + areaId,
              success: function (data) {
                  // Hapus pilihan lokasi yang ada
                  $('#location').empty();

                  // Tambahkan pilihan lokasi baru berdasarkan respons Ajax
                  $.each(data, function (id, name) {
                      $('#location').append(new Option(name, id));
                  });
              }
          });
      });
  });
</script>
