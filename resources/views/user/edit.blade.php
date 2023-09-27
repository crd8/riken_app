<x-app-layout>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-8 text-gray-900 dark:text-gray-200">
          <section>
            <a class="text-sky-700 dark:text-white bg-sky-200 hover:bg-sky-100 focus:ring-4 focus:ring-sky-100 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-sky-900 dark:hover:bg-sky-800 focus:outline-none dark:focus:ring-sky-900" href="{{ route('user.index') }}">
              {{ __('Back to All Users') }}
            </a>
            <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
            <header class="max-w-xl">
              <h2 class="text-lg font-medium text-gray-900 dark:text-gray-200">
                {{ __('Edit a User') }}
              </h2>
              <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('The process of editing a user in a system or app.') }}
              </p>
            </header>
            <form class="max-w-xl" action="{{ route('user.update', $user->id) }}" method="POST">
              @csrf
              @method('PUT')
              <div class="mt-6">
                <x-input-label for="name" :value="__('Name')"/>
                <x-text-input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name"/>
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
              </div>
              <div class="mt-6">
                <x-input-label for="email" :value="__('Email')"/>
                <x-text-input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="email"/>
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
              </div>
              <div class="mt-6">
                <x-input-label for="password" :value="__('Password')"/>
                <x-text-input id="password" name="password" type="password"/>
                <x-input-error class="mt-2" :messages="$errors->get('password')" />
              </div>
              <div class="mt-6">
                <x-input-label for="password_confirmation" :value="__('Password Confirmation')"/>
                <x-text-input id="password_confirmation" name="password_confirmation" type="password"/>
                <x-input-error class="mt-2" :messages="$errors->get('password_confirmation')" />
              </div>
              <div class="mt-6">
                <h3 class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</h3>
                <div class="grid grid-cols-4 gap-2 text-sm">
                  @forelse ($roles as $role)
                    <div class="flex bg-gray-100 p-2 rounded items-center">
                      <label>
                        <input class="w-4 h-4 text-sky-600 bg-gray-100 border-gray-300 rounded focus:ring-sky-500 dark:focus:ring-sky-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="checkbox" name="roles[]" value="{{ $role->name }}" {{ in_array($role->id, $userHasRoles) ? 'checked' : '' }}> 
                        <span class="capitalize text-gray-800">
                          {{ $role->name }}
                        </span>
                      </label>
                    </div>
                  @empty
                    ----
                  @endforelse
                </div>
              </div>

              <button type="submit" class="mt-6 text-white bg-sky-700 hover:bg-sky-800 focus:ring-4 focus:ring-sky-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-sky-600 dark:hover:bg-sky-700 focus:outline-none dark:focus:ring-sky-800">
                {{ __('Save User') }}
              </button>
            </form>
          </section>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
