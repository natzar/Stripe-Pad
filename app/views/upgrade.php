<header class="pb-6 ">
    <div class="mx-auto  ">
        <h1 class="text-3xl font-bold tracking-tight text-gray-800">Upgrade</h1>


    </div>

</header>

<div class="container mx-auto px-4">

    <div class="mt-5">

        <div class="overflow-x-auto">
            <table class="table-auto w-full">

                <tbody>
                    <? if (empty($products)): ?>
                        <tr>
                            <td colspan="5" class="px-4 py-4 text-center text-gray-500">No products or upsells found</td>
                        </tr>
                    <? endif; ?>
                    <?php foreach ($products as $p): ?>
                        <tr class="border-b">
                            <td class="px-4 py-2"><?= $p['category'] ?></td>
                            <td class="px-4 py-2"><?= $p['name'] ?></td>
                            <td class="px-4 py-2"><?= $p['description'] ?></td>
                            <td class="px-4 py-2 text-green-500">$<?= number_format($p['amount'] / 100, 2, ",", ".") ?><?= $p['interval'] ? '/month' : '' ?></td>
                            <td class="px-4 py-2">
                                <a class="bg-sky-500 hover:bg-sky-700 text-white py-2 px-3 font-bold rounded-full" href="<?= APP_URL ?>checkout/<?= $p['productsId'] ?>/<?= $_SESSION['user']['usersId'] ?>" class="text-blue-500 hover:text-blue-800">Order now &raquo;</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <!-- Repeat for other invoices -->
                </tbody>
            </table>
        </div>
    </div>

</div>