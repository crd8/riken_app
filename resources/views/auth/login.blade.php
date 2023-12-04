<x-guest-layout>
  <!-- Session Status -->
  
  <form method="POST" action="{{ route('login') }}">
    @csrf
    <div x-data="{ email: '', checkEmailFormat: function() { if (!this.email.match(/^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/)) { console.log('invalid email format'); } } }">
      <div>
        <label class="block mb-2 text-sm text-gray-600 dark:text-gray-300" for="email">
          {{ __('Email') }}
        </label>
        <input type="text" x-model="email" name="email" @input="checkEmailFormat" :class="{'focus:ring-sky-500 focus:border-sky-500 dark:focus:ring-sky-500 dark:focus:border-sky-500': email.length == 0,'border-red-500 dark:border-red-700 bg-red-50 focus:ring-red-500 dark:focus:ring-red-600 focus:border-red-500 dark:focus:border-red-600 text-red-600 dark:text-red-400': email.length > 0 && !email.match(/^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/), 'border-green-500 dark:border-green-700 bg-green-50 focus:ring-green-500 dark:focus:ring-green-500 focus:border-green-500 dark:focus:border-green-600 text-green-600 dark:text-green-400': email.length > 0 && email.match(/^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/), 'bg-gray-50 border border-gray-300 text-gray-900 rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white': true }" pattern="[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}" value="{{ old('email') }}" required autofocus autocomplete="email">
        <div class="block">
          <span x-show="email.length > 0 && !email.match(/^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/)" class="text-xs text-red-700 dark:text-red-500">Invalid email format.</span>
          <span x-show="email.length > 0 && email.match(/^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/)" class="text-xs text-green-700">Valid email format.</span>
        </div>
      </div>
      <div class="mt-4">
        <label class="block mb-2 text-sm text-gray-600 dark:text-gray-300" for="email">
          {{ __('Password') }}
        </label>
        <input type="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-sky-500 dark:focus:border-sky-500" id="password" required>
      </div>
      <!-- Remember Me -->
      <div class="block mt-4">
        <label for="remember_me" class="inline-flex items-center">
          <input id="remember_me" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800" name="remember">
          <span class="ml-2 text-sm text-gray-600 dark:text-gray-300">{{ __('Remember me') }}</span>
        </label>
      </div>
      <div class="flex items-center justify-start mt-5">
        <button type="submit" class="text-sky-50 bg-sky-600 hover:bg-sky-700 focus:ring-4 focus:ring-sky-300 rounded text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-sky-800 dark:hover:bg-sky-900 focus:outline-none dark:focus:ring-sky-800">
          {{ __('Sign in') }}
        </button>
        {{-- <button type="submit" :disabled="email.length === 0 || !email.match(/^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/)" :class="{'cursor-not-allowed opacity-50': email.length === 0 || !email.match(/^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/),'text-white mt-5 bg-sky-700 hover:bg-sky-800 focus:ring-4 focus:ring-sky-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-sky-600 dark:hover:bg-sky-700 focus:outline-none dark:focus:ring-sky-800': true}">
          {{ __('Sign in') }}
        </button> --}}
      </div>
    </div>
  </form>
</x-guest-layout>
