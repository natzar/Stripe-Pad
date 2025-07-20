<? include "app/views/layout/page_header.php"; ?>
<header class="pb-6 ">

  <div class="mx-auto  flex items-center space-x-4 ">

    <a href="<?= APP_DOMAIN ?>form/<?= $table ?>" class="items-center  rounded-full bg-blue-600 px-5 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">

      <?= _('Añadir nuevo &raquo;') ?>
    </a>

  </div>

</header>



<div class="flex min-h-screen flex-col ">
  <div class="mx-auto flex min-h-screen w-full  items-start gap-x-8 ">
    <main class="flex-1 text-gray-100">

      <? if (isset($HOOK_TOP)) echo $HOOK_TOP; ?>
      <? if (isset($_GET['i']) and $_GET['i'] == 'success'): ?>
        <div class="alert alert-success">
          <a class="close" data-dismiss='alert'>&times;</a>
          <strong>OK</strong> <?= $notification ?>
        </div>
      <? endif; ?>

      <!--           <h3 class="page-header"><?= ucfirst($table_label) ?></h3> -->
      <? if (isset($_SESSION['errors']) and !empty($_SESSION['errors'])): ?>
        <div id="errors" class="alert alert-success"> <?= $_SESSION['errors'] ?> </div>
      <?
        unset($_SESSION['errors']);
      endif; ?>





      <? if (count($items) > 0):  ?>
        <table id="leads" class="rounded-lg shadow-xl w-full whitespace-no-wrap text-left overflow-hidden  text-clip">
          <thead class="bg-gray-50">
            <tr>
              <!-- <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th> -->
              <th class="px-4 py-3"></th>
              <?php foreach ($items_head as $header): ?>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><?= $header ?></th>
              <?php endforeach; ?>
              <th class="px-4 py-3"></th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <?php
            $itemsTotal = count($items);
            $table_no_prefix = $table;

            for ($i = 0; $i < $itemsTotal; $i++):
              $row = $items[$i];
              $rowClass = ($table == "tickets" && $row['prioritysId'] == "Urgente") ? 'bg-blue-100 border-blue-400 b-1 text-white' : 'hover:bg-gray-50';
            ?>
              <tr id="recordsArray_<?= $row[$table_no_prefix . 'Id'] ?>" class="<?= $rowClass ?> items-center">
                <td class="px-4 py-5 text-sm font-semibold text-gray-900 items-center">
                  <a class="hover:text-blue-500" href='<?= APP_BASE_URL ?>app_<?= $table ?>/<?= $row[$table . 'Id'] ?>' rel="nofollow"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                    </svg>
                  </a>
                </td>

                <?php
                $j = 0;
                foreach ($row as $cell):
                  if ($j > 0):
                    $sort_data = strip_tags($cell);
                    // $sort_data = fingerprint($sort_data);
                ?>
                    <td class="px-4 py-5 text-sm text-gray-600  overflow-hidden  text-clip">
                      <span class="font-semibold md:hidden"><?= $items_head[$j - 1] ?></span> <?= $cell; ?>
                    </td>
                <?php
                  endif;
                  $j++;
                endforeach;
                ?>

                <td class="px-4 py-5 text-right text-center space-x-4 text-gray-700 flex items-center justify-center">

                  <a class="hover:text-blue-500" alt='delete' title='delete' href="javascript: Emilio.DeleteRegistro('recordsArray_<?= $row[$table . 'Id'] ?>', '<?= $row[$table . 'Id'] ?>', '', '<?= $table ?>');"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>
                  </a>

                </td>
              </tr>
            <?php endfor; ?>
          </tbody>
        </table>




        <!--     
        <thead class="sm:table-header-group">
            <tr>
<th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900" scope="col" nowrap=nowrap width="60"></th>
         	<? foreach ($items_head as $item): ?>
            	<th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900" scope="col" nowrap=nowrap nowrap><?= ucfirst($item) ?>	</th>		 
            <? endforeach; ?>
            </tr>
        </thead>
 -->




      <? else: ?>

        <div type="button" class="relative block w-full rounded-lg border-2 border-dashed border-gray-300 p-12 text-center hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
          <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v20c0 4.418 7.163 8 16 8 1.381 0 2.721-.087 4-.252M8 14c0 4.418 7.163 8 16 8s16-3.582 16-8M8 14c0-4.418 7.163-8 16-8s16 3.582 16 8m0 0v14m0-4c0 4.418-7.163 8-16 8S8 28.418 8 24m32 10v6m0 0v6m0-6h6m-6 0h-6" />
          </svg>
          <span class="mt-2 block text-sm font-semibold text-gray-100">Nothing here, <?= $_SESSION['user']['name'] ?></span>
        </div>



      <? endif; ?>
    </main>
  </div>