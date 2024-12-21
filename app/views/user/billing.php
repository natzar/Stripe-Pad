<div class="container mx-auto px-4">
    <div class="flex flex-col md:flex-row justify-between items-center bg-gray-100 p-5 rounded-lg shadow-md">
        <div>
            <h2 class="text-xl font-bold">Customer Details</h2>
            <p class="text-gray-700">Name: John Doe</p>
            <p class="text-gray-700">Email: john@example.com</p>
        </div>
        <div>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Edit Details
            </button>
        </div>
    </div>
    <div class="mt-5">
        <h2 class="text-xl font-bold mb-3">Invoices</h2>
        <div class="overflow-x-auto">
            <table class="table-auto w-full">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2 text-left">Invoice ID</th>
                        <th class="px-4 py-2 text-left">Date</th>
                        <th class="px-4 py-2 text-left">Amount</th>
                        <th class="px-4 py-2 text-left">Status</th>
                        <th class="px-4 py-2 text-left">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b">
                        <td class="px-4 py-2">0001</td>
                        <td class="px-4 py-2">2024-03-31</td>
                        <td class="px-4 py-2">$100.00</td>
                        <td class="px-4 py-2 text-green-500">Paid</td>
                        <td class="px-4 py-2">
                            <a href="#" class="text-blue-500 hover:text-blue-800">View</a>
                        </td>
                    </tr>
                    <!-- Repeat for other invoices -->
                </tbody>
            </table>
        </div>
    </div>
</div>