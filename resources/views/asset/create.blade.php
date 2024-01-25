<x-app-layout>
  <div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-gray-50 dark:bg-gray-800 overflow-hidden rounded-lg">
        <div class="p-8 text-gray-900 dark:text-gray-200">
          <section>
            <a class="text-sky-800 dark:text-gray-200 hover:border-b hover:border-b-sky-800 inline-flex items-center" href="{{ route('asset.index') }}">
              <svg class="w-4 h-4 mt-1 mr-1 text-sky-800 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/>
              </svg>
              Back
            </a>
            <header class="max-w-xl mb-7 mt-5">
              <h2 class="text-gray-800 text-lg font-semibold dark:text-gray-200">
                {{ __('Create a new asset') }}
              </h2>
              <p class="text-sm text-gray-700 dark:text-gray-300">
                {{ __('The process of creating new asset in a system or app.') }}
              </p>
            </header>
            <form action="{{ route('asset.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="grid grid-cols-2 gap-2 max-w-3xl">
                <div class="mt-6">
                  <label for="number" class="block mb-1.5 text-sm text-gray-800 dark:text-gray-200">Asset Number</label>
                  <input type="text" id="number" name="number" value="{{ old('number') }}" class="dark:bg-gray-700 text-sm w-full text-gray-700 dark:text-gray-200 py-2 border-b-2 border-gray-400/30 dark:border-gray-600/30 border-b-gray-400 dark:border-b-gray-500 rounded focus:ring-0 focus:border-t-gray-400/30 focus:border-b-2 focus:border-b-sky-600 dark:focus:border-b-gray-200 focus:border-x-gray-400/30" required autofocus>
                  @foreach ($errors->get('number') as $error)
                    <span class="block text-xs mt-0.5 text-red-600 dark:text-red-700">{{ $error }}</span>
                  @endforeach
                </div>
                <div class="mt-6">
                  <label for="name" class="block mb-1.5 text-sm text-gray-800 dark:text-gray-200">Name</label>
                  <input type="text" id="name" name="name" value="{{ old('name') }}" class="dark:bg-gray-700 text-sm w-full text-gray-700 dark:text-gray-200 py-2 border-b-2 border-gray-400/30 dark:border-gray-600/30 border-b-gray-400 dark:border-b-gray-500 rounded focus:ring-0 focus:border-t-gray-400/30 focus:border-b-2 focus:border-b-sky-600 dark:focus:border-b-gray-200 focus:border-x-gray-400/30" required>
                  @foreach ($errors->get('name') as $error)
                    <span class="block text-xs mt-0.5 text-red-600 dark:text-red-700">{{ $error }}</span>
                  @endforeach
                </div>
              </div>
              <div class="grid grid-cols-3 gap-2">
                <div class="mt-6">
                  <label for="assetcategorie_id" class="block mb-1.5 text-sm text-gray-800 dark:text-gray-200">Asset Categorie</label>
                  <select name="assetcategorie_id" id="assetcategorie_id" class="dark:bg-gray-700 text-sm w-full text-gray-700 dark:text-gray-200 py-2 border-b-2 border-gray-400/30 dark:border-gray-600/30 border-b-gray-400 dark:border-b-gray-500 rounded focus:ring-0 focus:border-t-gray-400/30 focus:border-b-2 focus:border-b-sky-600 dark:focus:border-b-gray-200 focus:border-x-gray-400/30" required>
                    <option value=""></option>
                    @forelse ($assetcategories as $assetcategorie)
                    <option value="{{ $assetcategorie->id }}">{{ $assetcategorie->name }}</option>
                    @empty
                      ----
                    @endforelse
                  </select>
                  @foreach ($errors->get('assetcategorie_id') as $error)
                    <span class="block text-xs mt-0.5 text-red-600 dark:text-red-700">{{ $error }}</span>
                  @endforeach
                </div>
                <div class="mt-6">
                  <label for="price" class="block mb-1.5 text-sm text-gray-800 dark:text-gray-200">Price</label>
                  <input type="number" id="price" name="price" value="{{ old('price') }}" class="dark:bg-gray-700 text-sm w-full text-gray-700 dark:text-gray-200 py-2 border-b-2 border-gray-400/30 dark:border-gray-600/30 border-b-gray-400 dark:border-b-gray-500 rounded focus:ring-0 focus:border-t-gray-400/30 focus:border-b-2 focus:border-b-sky-600 dark:focus:border-b-gray-200 focus:border-x-gray-400/30" required>
                  @foreach ($errors->get('price') as $error)
                    <span class="block text-xs mt-0.5 text-red-600 dark:text-red-700">{{ $error }}</span>
                  @endforeach
                </div>
                <div class="mt-6">
                  <label for="purchase_date" class="block mb-1.5 text-sm text-gray-800 dark:text-gray-200">Date of Purchase</label>
                  <input type="date" id="purchase_date" name="purchase_date" value="{{ old('purchase_date') }}" class="dark:bg-gray-700 text-sm w-full text-gray-700 dark:text-gray-200 py-2 border-b-2 border-gray-400/30 dark:border-gray-600/30 border-b-gray-400 dark:border-b-gray-500 rounded focus:ring-0 focus:border-t-gray-400/30 focus:border-b-2 focus:border-b-sky-600 dark:focus:border-b-gray-200 focus:border-x-gray-400/30" required>
                  @foreach ($errors->get('purchase_date') as $error)
                    <span class="block text-xs mt-0.5 text-red-600 dark:text-red-700">{{ $error }}</span>
                  @endforeach
                </div>
              </div>
              <div class="grid grid-cols-3 gap-2">
                <div class="mt-6">
                  <label for="spot_id" class="block mb-1.5 text-sm text-gray-800 dark:text-gray-200">Asset Spot</label>
                  <select name="spot_id" id="spot_id" class="dark:bg-gray-700 text-sm w-full text-gray-700 dark:text-gray-200 py-2 border-b-2 border-gray-400/30 dark:border-gray-600/30 border-b-gray-400 dark:border-b-gray-500 rounded focus:ring-0 focus:border-t-gray-400/30 focus:border-b-2 focus:border-b-sky-600 dark:focus:border-b-gray-200 focus:border-x-gray-400/30" required>
                    <option value=""></option>
                    @forelse ($spots as $spot)
                    <option value="{{ $spot->id }}">{{ $spot->name }}</option>
                    @empty
                      ----
                    @endforelse
                  </select>
                  @foreach ($errors->get('spot_id') as $error)
                    <span class="block text-xs mt-0.5 text-red-600 dark:text-red-700">{{ $error }}</span>
                  @endforeach
                </div>
                <div class="mt-6">
                  <label for="owner" class="block mb-1.5 text-sm text-gray-800 dark:text-gray-200">User Asset</label>
                  <input type="text" id="owner" name="owner" value="{{ old('owner') }}" class="dark:bg-gray-700 text-sm w-full text-gray-700 dark:text-gray-200 py-2 border-b-2 border-gray-400/30 dark:border-gray-600/30 border-b-gray-400 dark:border-b-gray-500 rounded focus:ring-0 focus:border-t-gray-400/30 focus:border-b-2 focus:border-b-sky-600 dark:focus:border-b-gray-200 focus:border-x-gray-400/30" required>
                  @foreach ($errors->get('owner') as $error)
                    <span class="block text-xs mt-0.5 text-red-600 dark:text-red-700">{{ $error }}</span>
                  @endforeach
                </div>
                <div class="mt-6">
                  <label for="purchase_date" class="block mb-1.5 text-sm text-gray-800 dark:text-gray-200">Asset Status</label>
                  <select name="status" id="status" class="dark:bg-gray-700 text-sm w-full text-gray-700 dark:text-gray-200 py-2 border-b-2 border-gray-400/30 dark:border-gray-600/30 border-b-gray-400 dark:border-b-gray-500 rounded focus:ring-0 focus:border-t-gray-400/30 focus:border-b-2 focus:border-b-sky-600 dark:focus:border-b-gray-200 focus:border-x-gray-400/30" required>
                    <option value=""></option>
                    <option value="Active">Active</option>
                    <option value="Not Active">Not Active</option>
                    <option value="Missing">Missing</option>
                    <option value="Damaged">Damaged</option>
                  </select>
                  @foreach ($errors->get('status') as $error)
                    <span class="block text-xs mt-0.5 text-red-600 dark:text-red-700">{{ $error }}</span>
                  @endforeach
                </div>
              </div>
              <div class="mt-6">
                <label for="information" class="block mb-1.5 text-sm text-gray-800 dark:text-gray-200">Asset Information</label>
                <textarea name="information" id="information" rows="4" class="dark:bg-gray-700 text-sm w-8/12 text-gray-700 dark:text-gray-200 py-2 border-b-2 border-gray-400/30 dark:border-gray-600/30 border-b-gray-400 dark:border-b-gray-500 rounded focus:ring-0 focus:border-t-gray-400/30 focus:border-b-2 focus:border-b-sky-600 dark:focus:border-b-gray-200 focus:border-x-gray-400/30" required>{{ old('information') }}</textarea>
                <x-input-error class="mt-2" :messages="$errors->get('information')" />
              </div>
              <div class="mt-6">
                <label for="photo" class="block mb-1.5 text-sm text-gray-800 dark:text-gray-200">Asset Image</label>
                <input type="file" id="photo" name="photo" accept="image/jpeg, image/jpg, image/png" class="block w-8/12 text-sm text-gray-700 border border-gray-300 cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 border-b-2 border-gray-400/30 dark:border-gray-600/30 border-b-gray-400 dark:border-b-gray-500 rounded focus:ring-0 focus:border-t-gray-400/30 focus:border-b-2 focus:border-b-sky-600 dark:focus:border-b-gray-200 focus:border-x-gray-400/30" aria-describedby="photo_help" required>
                <p class="mt-0.5 text-xs text-gray-500 dark:text-gray-400" id="photo_help">Maximum file size is 1MB, only <span class="underline underline-offset-2 font-bold text-gray-800 dark:text-gray-200">JPG</span>, <span class="underline underline-offset-2 font-bold text-gray-800 dark:text-gray-200">JPEG</span>, and <span class="underline underline-offset-2 font-bold text-gray-800 dark:text-gray-200">PNG</span> formats.</p>
                <x-input-error class="mt-2" :messages="$errors->get('photo')" />
              </div>              
              <button type="submit" class="mt-6 border border-gray-500/40 text-gray-700 dark:text-gray-200 hover:text-sky-600 dark:hover:text-sky-50 bg-gray-50 dark:bg-gray-600 focus:ring-2 ring-offset-2 ring-offset-gray-200 dark:ring-offset-gray-900 focus:ring-sky-500 rounded text-sm font-semibold px-5 py-2.5 mr-2 mb-2 focus:outline-none dark:focus:ring-gray-500 focus:transition focus:ease-in focus:duration-75">
                {{ __('Save Asset') }}
              </button>
            </form>
          </section>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/datepicker.min.js"></script>