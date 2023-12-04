<x-app-layout>
  <div class="py-12">
    <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-8 text-gray-900 dark:text-gray-200">
          <section>
            <a class="text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 hover:bg-gray-200 focus:ring-4 focus:ring-gray-300 rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:hover:bg-gray-800 focus:outline-none dark:focus:ring-gray-700" href="{{ route('area.index') }}">
              {{ __('Back to All Areas') }}
            </a>
            <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
            <header class="max-w-xl">
              <h2 class="text-gray-600 dark:text-gray-200">
                {{ __('Create a new Area') }}
              </h2>
              <p class="mt-1 text-sm text-gray-400 dark:text-gray-400">
                {{ __('The process of creating new area in a system or app.') }}
              </p>
            </header>
            <form class="max-w-xl" action="{{ route('area.store') }}" method="POST">
              @csrf
              <div class="mt-6">
                <x-input-label for="code" :value="__('Code')"/>
                <x-text-input id="code" name="code" type="text" value="{{ old('code') }}" required autofocus autocomplete="code"/>
                <x-input-error class="mt-2" :messages="$errors->get('code')" />
              </div>
              <div class="mt-6">
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text" value="{{ old('name') }}" required />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
              </div>
              <div class="mt-6">
                <x-input-label for="address" :value="__('Address')"/>
                <textarea name="address" id="address" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-sky-500 dark:focus:border-sky-500" required>{{ old('address') }}</textarea>
                <x-input-error class="mt-2" :messages="$errors->get('address')" />
              </div>
              <button type="submit" class="mt-6 text-white bg-sky-700 hover:bg-sky-800 focus:ring-4 focus:ring-sky-300 rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-sky-600 dark:hover:bg-sky-700 focus:outline-none dark:focus:ring-sky-800">
                {{ __('Save Area') }}
              </button>
            </form>
          </section>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
