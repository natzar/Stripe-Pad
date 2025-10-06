<header class="pb-6 ">
  <div class="mx-auto  ">
    <h1 class="text-3xl font-bold tracking-tight text-gray-800">Settings</h1>


  </div>

</header>

<div class="max-w-4xl mx-auto bg-white p-5 rounded-md shadow">
    <h1 class="text-xl font-semibold mb-4">Manage Settings</h1>

    <!-- Integration Settings -->
    <div class="mb-6">
        <h2 class="font-bold text-lg">Integration</h2>
        <div>
            <label for="thirdParty" class="block text-sm font-medium text-gray-700 mt-2">Third-Party Integration</label>
            <textarea id="thirdParty" rows="3" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm"
                placeholder="Enter integration details..."></textarea>
        </div>
        <div>
            <label for="apiKeys" class="block text-sm font-medium text-gray-700 mt-4">API Keys</label>
            <textarea id="apiKeys" rows="3" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm"
                placeholder="Manage API keys..."></textarea>
        </div>
    </div>

    <!-- User Interface Preferences -->
    <div class="mb-6">
        <h2 class="font-bold text-lg">User Interface Preferences</h2>
        <div>
            <label for="language" class="block text-sm font-medium text-gray-700">Language and Region</label>
            <select id="language" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm">
                <option>English (US)</option>
                <option>Spanish (ES)</option>
                <option>French (FR)</option>
                <!-- Add other languages as needed -->
            </select>
        </div>
        <div>
            <label for="themes" class="block text-sm font-medium text-gray-700 mt-4">Themes</label>
            <select id="themes" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm">
                <option>Light</option>
                <option>Dark</option>
            </select>
        </div>
    </div>

    <!-- Accessibility Options -->
    <div class="mb-6">
        <h2 class="font-bold text-lg">Accessibility</h2>
        <div class="flex items-center mt-2">
            <input id="textSize" type="checkbox" class="h-4 w-4 text-blue-600 border-gray-300 rounded">
            <label for="textSize" class="ml-2 block text-sm text-gray-900">
                Increase Text Size
            </label>
        </div>
        <div class="flex items-center mt-2">
            <input id="highContrast" type="checkbox" class="h-4 w-4 text-blue-600 border-gray-300 rounded">
            <label for="highContrast" class="ml-2 block text-sm text-gray-900">
                High Contrast Mode
            </label>
        </div>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
        Save Settings
    </button>
</div>