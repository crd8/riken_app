<x-app-layout>
  <div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-gray-50 dark:bg-gray-800 overflow-hidden rounded-lg">
        <div class="p-8 text-gray-900 dark:text-gray-200">
          <section>
            <a class="text-sky-800 dark:text-gray-200 hover:border-b hover:border-b-sky-800 inline-flex items-center" href="{{ route('location.index') }}">
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
            <form action="{{ route('location.store') }}" method="POST">
              @csrf
              <div class="max-w-xl">
                <div class="mt-6">
                  <label for="code" class="block mb-1.5 text-sm text-gray-800 dark:text-gray-200">Location Code</label>
                  <input type="text" id="code" name="code" value="{{ old('code') }}" class="dark:bg-gray-700 text-sm w-8/12 text-gray-700 dark:text-gray-200 py-2 border-b-2 border-gray-400/30 dark:border-gray-600/30 border-b-gray-400 dark:border-b-gray-500 rounded focus:ring-0 focus:border-t-gray-400/30 focus:border-b-2 focus:border-b-sky-600 dark:focus:border-b-gray-200 focus:border-x-gray-400/30" required autofocus>
                  @foreach ($errors->get('code') as $error)
                    <span class="block text-xs mt-0.5 text-red-600 dark:text-red-700">{{ $error }}</span>
                  @endforeach
                </div>
                <div class="mt-6">
                  <label for="area_id" class="block mb-1.5 text-sm text-gray-800 dark:text-gray-200">Area</label>
                  <select name="area_id" id="area_id" class="dark:bg-gray-700 text-sm w-7/12 text-gray-700 dark:text-gray-200 py-2 border-b-2 border-gray-400/30 dark:border-gray-600/30 border-b-gray-400 dark:border-b-gray-500 rounded focus:ring-0 focus:border-t-gray-400/30 focus:border-b-2 focus:border-b-sky-600 dark:focus:border-b-gray-200 focus:border-x-gray-400/30" required>
                    <option value=""></option>
                    @forelse ($areas as $area)
                    <option value="{{ $area->id }}">{{ $area->name }}</option>
                    @empty
                      ----
                    @endforelse
                  </select>
                  @foreach ($errors->get('area_id') as $error)
                    <span class="block text-xs mt-0.5 text-red-600 dark:text-red-700">{{ $error }}</span>
                  @endforeach
                  
                  {{-- <h3 class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Area</h3>
                  <div class="grid grid-cols-2 gap-2 text-sm">
                    @forelse ($areas as $area)
                      <div class="flex bg-gray-200 dark:bg-gray-600 p-2 rounded items-center">
                        <label>
                          <input class="w-4 h-4 mb-1 text-sky-600 bg-gray-200 border-gray-500 rounded-xl text-xl focus:ring-sky-500 dark:focus:ring-sky-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-900 dark:border-gray-600" type="radio" name="area_id" value="{{ $area->id }}">
                          <span class="capitalize text-gray-800">
                            {{ $area->name }}
                          </span>
                        </label>
                      </div>
                    @empty
                      ----
                    @endforelse
                    @foreach ($errors->get('area_id') as $error)
                    <span class="block text-xs mt-0.5 text-red-600 dark:text-red-700">{{ $error }}</span>
                    @endforeach
                  </div> --}}
                </div>
                <div class="mt-6">
                  <label for="name" class="block mb-1.5 text-sm text-gray-800 dark:text-gray-200">Name</label>
                  <input type="text" id="name" name="name" value="{{ old('name') }}" class="dark:bg-gray-700 text-sm w-8/12 text-gray-700 dark:text-gray-200 py-2 border-b-2 border-gray-400/30 dark:border-gray-600/30 border-b-gray-400 dark:border-b-gray-500 rounded focus:ring-0 focus:border-t-gray-400/30 focus:border-b-2 focus:border-b-sky-600 dark:focus:border-b-gray-200 focus:border-x-gray-400/30" required>
                  @foreach ($errors->get('name') as $error)
                    <span class="block text-xs mt-0.5 text-red-600 dark:text-red-700">{{ $error }}</span>
                  @endforeach
                </div>
                <div class="mt-6">
                  <label for="description" class="block mb-1.5 text-sm text-gray-800 dark:text-gray-200">Description</label>
                  <textarea name="description" id="description" rows="4" class="dark:bg-gray-700 text-sm w-11/12 text-gray-700 dark:text-gray-200 py-2 border-b-2 border-gray-400/30 dark:border-gray-600/30 border-b-gray-400 dark:border-b-gray-500 rounded focus:ring-0 focus:border-t-gray-400/30 focus:border-b-2 focus:border-b-sky-600 dark:focus:border-b-gray-200 focus:border-x-gray-400/30" required>{{ old('description') }}</textarea>
                  <x-input-error class="mt-2" :messages="$errors->get('description')" />
                </div>
              </div>
              <button type="submit" class="mt-6 border border-gray-500/40 text-gray-700 dark:text-gray-200 hover:text-sky-600 dark:hover:text-sky-50 bg-gray-50 dark:bg-gray-600 focus:ring-2 ring-offset-2 ring-offset-gray-200 dark:ring-offset-gray-900 focus:ring-sky-500 rounded text-sm font-semibold px-5 py-2.5 mr-2 mb-2 focus:outline-none dark:focus:ring-gray-500 focus:transition focus:ease-in focus:duration-75">
                {{ __('Save Location') }}
              </button>
            </form>
          </section>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>