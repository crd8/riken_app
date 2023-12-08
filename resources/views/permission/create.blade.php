<x-app-layout>
  <div class="py-12">
    <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-gray-50 dark:bg-gray-800 overflow-hidden rounded-lg">
        <div class="p-8 text-gray-900 dark:text-gray-200">
          <section>
            
            <a class="text-sky-800 dark:text-gray-200 hover:border-b hover:border-b-sky-800 inline-flex items-center" href="{{ route('permission.index') }}">
              <svg class="w-4 h-4 mt-1 mr-1 text-sky-800 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/>
              </svg>
              Back
            </a>
            <header class="max-w-xl mb-7 mt-5">
              <h2 class="text-gray-800 text-lg font-semibold dark:text-gray-200">
                {{ __('Create a new Permission') }}
              </h2>
              <p class="text-sm text-gray-700 dark:text-gray-300">
                {{ __('The process of creating new permissions in a system or app.') }}
              </p>
            </header>
            
            <form class="max-w-xl" action="{{ route('permission.store') }}" method="POST">
              @csrf
              <div class="mt-6">
                <label for="name" class="block mb-1.5 text-sm text-gray-800 dark:text-gray-200">Permission Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" class="dark:bg-gray-700 text-sm w-8/12 text-gray-700 dark:text-gray-200 py-2 border-b-2 border-gray-400/30 dark:border-gray-600/30 border-b-gray-400 dark:border-b-gray-500 rounded focus:ring-0 focus:border-t-gray-400/30 focus:border-b-2 focus:border-b-sky-600 dark:focus:border-b-gray-200 focus:border-x-gray-400/30" required autofocus>
                @foreach ($errors->get('name') as $error)
                    <span class="block text-xs mt-0.5 text-red-600 dark:text-red-700">{{ $error }}</span>
                @endforeach

                {{-- <div class="my-10"></div>
                <label class="block mb-2 text-sm" for="">Permission Name</label>
                <input type="text" class="block w-full text-gray-900 border-b-2 border-gray-500/40 rounded bg-gray-50 focus:ring-gray-700 focus:border-gray-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-gray-400 dark:focus:border-gray-400">
                
                <x-input-label for="name" :value="__('Name')"/>
                <x-text-input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus autocomplete="name"/>
                <x-input-error class="mt-2" :messages="$errors->get('name')" /> --}}
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
