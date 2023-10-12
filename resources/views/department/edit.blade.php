<x-app-layout>
  <div class="py-12">
    <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-8 text-gray-900 dark:text-gray-200">
          <section>
            <section>
              <a class="text-sky-700 dark:text-white bg-sky-200 hover:bg-sky-100 focus:ring-4 focus:ring-sky-100 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-sky-900 dark:hover:bg-sky-800 focus:outline-none dark:focus:ring-sky-900" href="{{ route('department.index') }}">
                {{ __('Back to All Departments') }}
              </a>
              <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
              
              <form class="max-w-xl" action="{{ route('department.update', $department->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mt-6">
                  <x-input-label for="code" :value="__('Code')"/>
                  <x-text-input id="code" name="code" type="text" value="{{ old('code', $department->code) }}" required autofocus autocomplete="code"/>
                  <x-input-error class="mt-2" :messages="$errors->get('code')" />
                </div>
                <div class="mt-6">
                  <x-input-label for="name" :value="__('Name')"/>
                  <x-text-input id="name" name="name" type="text" value="{{ old('name', $department->name) }}" required autocomplete="name"/>
                  <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>
                <div class="mt-6">
                  <x-input-label for="description" :value="__('Description')"/>
                  <textarea name="description" id="description" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-sky-500 dark:focus:border-sky-500" required>{{ old('description', $department->description) }}</textarea>
                  <x-input-error class="mt-2" :messages="$errors->get('description')" />
                </div>
                <button type="submit" class="mt-6 text-white bg-sky-700 hover:bg-sky-800 focus:ring-4 focus:ring-sky-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-sky-600 dark:hover:bg-sky-700 focus:outline-none dark:focus:ring-sky-800">
                  {{ __('Update Department') }}
                </button>
              </form>
            </section>       
          </section>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
