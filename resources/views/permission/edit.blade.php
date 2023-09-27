<x-app-layout>
  <div class="py-12">
    <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-8 text-gray-900 dark:text-gray-200">
          <section>
            <section>
              <a class="text-sky-700 dark:text-white bg-sky-200 hover:bg-sky-100 focus:ring-4 focus:ring-sky-100 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-sky-900 dark:hover:bg-sky-800 focus:outline-none dark:focus:ring-sky-900" href="{{ route('permission.index') }}">
                {{ __('Back to All Permissions') }}
              </a>
              <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
              
              <form class="max-w-xl" action="{{ route('permission.update', $permission->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mt-6">
                  <x-input-label for="name" :value="__('Name')"/>
                  <x-text-input id="name" name="name" type="text" value="{{ old('name', $permission->name) }}" required autofocus autocomplete="name"/>
                  <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>
                <button type="submit" class="mt-6 text-white bg-sky-700 hover:bg-sky-800 focus:ring-4 focus:ring-sky-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-sky-600 dark:hover:bg-sky-700 focus:outline-none dark:focus:ring-sky-800">
                  {{ __('Update Permission') }}
                </button>
              </form>
            </section>       
          </section>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
