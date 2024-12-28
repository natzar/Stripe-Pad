<div class="">
  <div class="flex flex-wrap items-center gap-6 px-4 py-2 sm:flex-nowrap sm:px-6 lg:px-8">
    <h1 class="text-base font-semibold leading-7 text-gray-900"><?= ucfirst($table) ?> (<?= count($items) ?>)</h1>
    <div class="order-last flex w-full gap-x-8 text-sm font-semibold leading-6 sm:order-none sm:w-auto sm:border-l sm:border-gray-200 sm:pl-6 sm:leading-7">
<span class="isolate inline-flex rounded-md shadow-sm">
    	<? if ($table == "customers"): ?>
      <a class="relative -ml-px inline-flex items-center  bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10" href="/table/customers/usersId/0">Todos (No asignados)</a> <a class="relative -ml-px inline-flex items-center  bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10" href="/table/customers/usersId/3">Marina</a> <a class="relative -ml-px inline-flex items-center  bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10" href="/table/customers/usersId/1">Beto</a>  <a class="relative -ml-px inline-flex items-center  bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10" href="/table/customers/leadsstatusId/4">Planes de Mantenimiento</a>  
<a class="relative -ml-px inline-flex items-center  bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10"  href="/table/customers/usersId/10000">Infierno</a> 
<? endif; ?>

	<? if ($table == "tickets"): ?>



 


  <a class="relative -ml-px inline-flex items-center  bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10" href="/table/tickets/ticketsstatusId/1">Abiertos</a> <!-- | <a href="/table/tickets/ticketsstatusId/2">Abiertos</a>  --><a class="trelative -ml-px inline-flex items-center  bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10" href="/table/tickets/ticketsstatusId/3">En Espera</a>   <a class="relative -ml-px inline-flex items-center  bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10" href="/table/tickets/ticketsstatusId/4">Cerrados</a>   <a class="relative -ml-px inline-flex items-center  bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10" href="/table/tickets/ticketsstatusId/5">Archivo</a> <a class="relative -ml-px inline-flex items-center  bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10" href="/table/tickets/ticketsstatusId/6">Descartado</a> 
<? endif; ?>





<? if ($table == "emailtemplates" ): ?>
<a class="relative -ml-px inline-flex items-center  bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10" href="/table/emailtemplates/tag/manual">Manual</a> <a class="relative -ml-px inline-flex items-center  bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10" href="/table/emailtemplates/tag/automatic">Automáticos</a>  <a class="relative -ml-px inline-flex items-center  bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10"href="/table/emailtemplates">Todos</a>  

<? endif; ?>
</span>
    </div>
    <a href="<?= APP_DOMAIN ?>/form/<?= $table ?>" class="ml-auto flex items-center gap-x-1 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
      <svg class="-ml-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
        <path d="M10.75 6.75a.75.75 0 00-1.5 0v2.5h-2.5a.75.75 0 000 1.5h2.5v2.5a.75.75 0 001.5 0v-2.5h2.5a.75.75 0 000-1.5h-2.5v-2.5z" />
      </svg>
      Nuevo +
    </a>
  </div>
</div>


<? if (isset($HOOK_TOP)) echo $HOOK_TOP; ?>
<? if (isset($_GET['i']) and $_GET['i'] == 'success'): ?>
	<div class="alert alert-success">
		<a class="close" data-dismiss='alert'>&times;</a>
		<strong>OK</strong> <?= $notification ?>
	</div>	
<? endif; ?>

<!--           <h3 class="page-header"><?= ucfirst($table_label)?></h3> -->
<? if (isset($_SESSION['errors']) and !empty($_SESSION['errors'])): ?>
<div id="errors" class="alert alert-success">    <?= $_SESSION['errors'] ?>     </div>
<? 
unset($_SESSION['errors']);
endif; ?>
         




<? if (count($items) > 0):  ?>
<table id="leads" class=" w-full whitespace-no-wrap text-left overflow-hidden  text-clip">
  <thead class="bg-gray-50">
    <tr>
      <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
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

    for($i = 0; $i < $itemsTotal; $i++): 
      $row = $items[$i]; 
      $rowClass = ($table == "tickets" && $row['prioritysId'] == "Urgente") ? 'bg-red-100 border-red-400 b-1 text-white' : 'hover:bg-gray-50';
    ?>
      <tr id="recordsArray_<?= $row[$table_no_prefix.'Id'] ?>" class="<?= $rowClass ?>">
        <td class="px-4 py-5 text-sm font-semibold text-gray-900">
          <a alt='edit' title='edit' href='<?= APP_DOMAIN ?>form/<?= $table ?>/<?= $row[$table."Id"] ?>' style="font-size:16px;font-weight:bold;" class="ls-modal-no">#<?= $row[$table."Id"] ?></a>
        </td>
        
        <?php 
        $j = 0;
        foreach ($row as $cell): 
          if ($j > 0): 
            $sort_data = strip_tags($cell);
            $sort_data = fingerprint($sort_data);
        ?>
          <td class="px-4 py-5 text-sm text-gray-600  overflow-hidden  text-clip">
            <span class="font-semibold md:hidden"><?= $items_head[$j-1] ?></span> <?= $cell; ?>
          </td>
        <?php 
          endif;
          $j++;
        endforeach; 
        ?>

        <td class="px-4 py-5 text-right">
          <a class="text-xs bg-red-100 hover:bg-red-600 text-red-800 font-medium mr-2 px-2.5 py-0.5 rounded" alt='delete' title='delete' href="javascript: DeleteRegistro('recordsArray_<?= $row[$table.'Id'] ?>', '<?= $row[$table.'Id'] ?>', '', '<?= $table ?>');">Eliminar</a>
          <a href='<?= APP_BASE_URL ?>form/<?= $table ?>/<?= $row[$table.'Id'] ?>' rel="nofollow">
            <svg class="h-5 w-5 flex-none text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
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
         	<?	foreach ($items_head as $item): ?>
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
  <span class="mt-2 block text-sm font-semibold text-gray-900">No hay resultados, <?= $_SESSION['user']['name'] ?></span>
</div>


    
<? endif; ?>

<? if(!empty($HOOK_FOOTER)) echo $HOOK_FOOTER; ?>
