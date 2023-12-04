<x-app-layout>
  <div class="py-12">
    <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-gray-200 dark:bg-gray-800 overflow-hidden rounded-lg">
        <div class="p-8 text-gray-900 dark:text-gray-200">
          <section>
            <header class="max-w-xl mb-7">
              <h2 class="text-gray-800 text-lg font-semibold dark:text-gray-200">
                {{ __('Create a new Permission') }}
              </h2>
              <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">
                {{ __('The process of creating new permissions in a system or app.') }}
              </p>
            </header>
            <a class="border border-gray-500/40 text-gray-700 dark:text-gray-200 hover:text-sky-600 dark:hover:text-sky-50 bg-gray-50 dark:bg-gray-600 focus:ring-2 ring-offset-2 ring-offset-gray-200 dark:ring-offset-gray-900 focus:ring-sky-500 rounded text-sm font-semibold px-5 py-2.5 mr-2 mb-2 focus:outline-none dark:focus:ring-gray-500 focus:transition focus:ease-in focus:duration-75" href="{{ route('permission.index') }}">
              {{ __('Back to All Permissions') }}
            </a>
            
            <form class="max-w-xl" action="{{ route('permission.store') }}" method="POST">
              @csrf
              <div class="mt-6">
                <x-input-label for="name" :value="__('Name')"/>
                <x-text-input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus autocomplete="name"/>
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
              </div>
              <button type="submit" class="mt-6 border border-gray-500/40 text-gray-700 dark:text-gray-200 hover:text-sky-600 dark:hover:text-sky-50 bg-gray-50 dark:bg-gray-600 focus:ring-2 ring-offset-2 ring-offset-gray-200 dark:ring-offset-gray-900 focus:ring-sky-500 rounded text-sm font-semibold px-5 py-2.5 mr-2 mb-2 focus:outline-none dark:focus:ring-gray-500 focus:transition focus:ease-in focus:duration-75">
                {{ __('Save Permission') }}
              </button>
            </form>
          </section>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
