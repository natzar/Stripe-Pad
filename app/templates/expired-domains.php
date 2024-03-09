<meta name="robots" content="revisit-after: 1 days">


<div class=" px-6 py-24 pb-8 sm:pt-16 sm:pb-16 lg:px-8 border-gray-800 border-b">
  <div class="mx-auto max-w-2xl text-center">
    <h1 class="text-4xl font-bold tracking-tight text-white sm:text-6xl nunito">{Expired Domains}</h1>
    <p class="mt-4 text-sm leading-8 text-gray-500">Daily list of expired domains. Renewed every day at 00:01 (GMT+1)</p>
  </div>
</div>


  <div class="mx-auto max-w-7xl px-4 pb-8 sm:px-6 lg:px-8">
    <div class="mx-auto grid max-w-2xl grid-cols-1 grid-rows-1 items-start gap-x-8 gap-y-8 lg:mx-0 lg:max-w-none lg:grid-cols-3">
        <!-- Invoice summary -->
      <div class="lg:col-start-3 lg:row-end-1 mt-10" id="summary">
        <h2 class="sr-only">Summary</h2>
        <div class="rounded-lg bg-gray-900 shadow-sm ring-1 ring-gray-900/5">
          <dl class="flex flex-wrap">
            <div class="flex-auto pl-6 pt-6">
              <dt class="text-base font-semibold leading-6 text-white" id="product_name">Today's expired domains <?= $date ?> </dt>
              <dd class="mt-1 text-sm  leading-6 text-gray-400" id="product_content"><?= $count ?> domain names expiring today</dd>
              <!-- <p>Updated and verified details of each result</p> -->
            </div>
            <!-- <div class="flex-none self-end px-6 pt-4">
              <dt class="sr-only">Status</dt>
              <dd class="rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-600 ring-1 ring-inset ring-green-600/20">Paid</dd>
            </div> -->
            <div class="mt-6 flex w-full flex-none gap-x-4 border-t border-gray-900/5 px-6 pt-6">
               <dt class="flex-none">
                <span class="sr-only">File Type</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-400">
  <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
</svg>

              </dt>
              <dd class="text-sm font-medium leading-6 text-white">File type: CSV</dd>
            </div>
            <div class="mt-4 flex w-full flex-none gap-x-4 border-t border-gray-900/5 px-6 ">
              <dt class="flex-none">
                <span class="sr-only">File Type</span>
         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-400">
  <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
  <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
</svg>

              </dt>
              <dd class="text-sm font-medium leading-6 text-white underline">domstry-expireds-<?= Date("Y-m-d") ?>.csv</dd>
            </div>

            <div class="mt-4 flex w-full flex-none gap-x-4 border-t border-gray-900/5 px-6 ">
             
              <dt class="flex-none">
                <span class="sr-only">Client</span>
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-400">
  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 15.75V18m-7.5-6.75h.008v.008H8.25v-.008Zm0 2.25h.008v.008H8.25V13.5Zm0 2.25h.008v.008H8.25v-.008Zm0 2.25h.008v.008H8.25V18Zm2.498-6.75h.007v.008h-.007v-.008Zm0 2.25h.007v.008h-.007V13.5Zm0 2.25h.007v.008h-.007v-.008Zm0 2.25h.007v.008h-.007V18Zm2.504-6.75h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V13.5Zm0 2.25h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V18Zm2.498-6.75h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V13.5ZM8.25 6h7.5v2.25h-7.5V6ZM12 2.25c-1.892 0-3.758.11-5.593.322C5.307 2.7 4.5 3.65 4.5 4.757V19.5a2.25 2.25 0 0 0 2.25 2.25h10.5a2.25 2.25 0 0 0 2.25-2.25V4.757c0-1.108-.806-2.057-1.907-2.185A48.507 48.507 0 0 0 12 2.25Z" />
</svg>

              </dt>
              <dd class="text-sm font-medium leading-6 text-white" id="product_price">$<?= $count * 0.02 ?></dd>
              <p class="text-xs text-gray-500">$0.02 / row</p>

            </div>
   <!--          <div class="mt-4 flex w-full flex-none gap-x-4 px-6">
              <dt class="flex-none">
                <span class="sr-only">Due date</span>
                <svg class="h-6 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path d="M5.25 12a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H6a.75.75 0 01-.75-.75V12zM6 13.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V14a.75.75 0 00-.75-.75H6zM7.25 12a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H8a.75.75 0 01-.75-.75V12zM8 13.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V14a.75.75 0 00-.75-.75H8zM9.25 10a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H10a.75.75 0 01-.75-.75V10zM10 11.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V12a.75.75 0 00-.75-.75H10zM9.25 14a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H10a.75.75 0 01-.75-.75V14zM12 9.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V10a.75.75 0 00-.75-.75H12zM11.25 12a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H12a.75.75 0 01-.75-.75V12zM12 13.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V14a.75.75 0 00-.75-.75H12zM13.25 10a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H14a.75.75 0 01-.75-.75V10zM14 11.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V12a.75.75 0 00-.75-.75H14z" />
                  <path fill-rule="evenodd" d="M5.75 2a.75.75 0 01.75.75V4h7V2.75a.75.75 0 011.5 0V4h.25A2.75 2.75 0 0118 6.75v8.5A2.75 2.75 0 0115.25 18H4.75A2.75 2.75 0 012 15.25v-8.5A2.75 2.75 0 014.75 4H5V2.75A.75.75 0 015.75 2zm-1 5.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25v-6.5c0-.69-.56-1.25-1.25-1.25H4.75z" clip-rule="evenodd" />
                </svg>
              </dt>
              <dd class="text-sm leading-6 text-gray-500">
                <time datetime="2023-01-31"></time>
              </dd>
            </div> -->
            
          </dl>
          
          <div class="mt-6 border-t border-gray-900/5 px-6 py-6">
          	<a class="py-2 w-full block px-3 rounded-md bg-green-600 text-white text-sm font-bold hover:bg-indigo-900" href="#" id="download_list"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline mr-3">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 9.75v6.75m0 0-3-3m3 3 3-3m-8.25 6a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z" />
</svg>

 Download Expired Domains List (csv)</a>
            <a href="#" class="text-xs  font-light leading-6 text-gray-500">Download will start automatically <span aria-hidden="true">&rarr;</span></a>
<div class="mt-4 flex w-full flex-none gap-x-4 ">
              <dt class="flex-none">
                <span class="sr-only">Status</span>
                <svg class="h-6 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M2.5 4A1.5 1.5 0 001 5.5V6h18v-.5A1.5 1.5 0 0017.5 4h-15zM19 8.5H1v6A1.5 1.5 0 002.5 16h15a1.5 1.5 0 001.5-1.5v-6zM3 13.25a.75.75 0 01.75-.75h1.5a.75.75 0 010 1.5h-1.5a.75.75 0 01-.75-.75zm4.75-.75a.75.75 0 000 1.5h3.5a.75.75 0 000-1.5h-3.5z" clip-rule="evenodd" />
                </svg>
              </dt>
              <dd class="text-xs leading-6 text-gray-500">Pay with Card</dd>
            </div>
          </div>
        </div>

<h2 class=" text-gray-200 text-base mt-10 mb-4">Expireds this past week</h2>
<ul>
        <?php
// Establece la zona horaria predeterminada, si es necesario
date_default_timezone_set('America/New_York');

// Comienza desde ayer
$start_date = strtotime("-1 day");

// Bucle para los 7 días anteriores
for ($i = 0; $i < 7; $i++) {
    // Imprime la fecha∂
   # if (file_exists(dirname(__FILE__)."/../../cdn/expireds-".date("Y-m-d", strtotime("-$i day", $start_date)).".php")){    
    echo "<li class='text-gray-100'>

    <a class='text-gray-400 hover:text-gray-600' href='expired-domains/".date("Y-m-d", strtotime("-$i day", $start_date)) . "'> ➔ ".date("Y-m-d", strtotime("-$i day", $start_date)) ."</a> </li>";
#}
}
?>
</ul>

      </div>




      <div class="-mx-4 px-4 py-8 shadow-sm ring-1 ring-gray-900/5 sm:mx-0 sm:rounded-lg sm:px-8 sm:pb-14 lg:col-span-2 lg:row-span-2 lg:row-end-2 xl:px-16 xl:pb-20 xl:pt-16">
        <!-- <h2 class="text-base font-semibold leading-6 text-white">Invoice</h2> -->
        
         

        <table class=" w-full whitespace-nowrap text-left text-sm leading-6">
          <colgroup>
            <col class="w-full">
            <col>
            <col>
            <col>
          </colgroup>
          <thead class="border-b border-gray-600 text-white">
            <tr>
              <th scope="col" class="px-0 py-3 font-semibold">Sample: First 20 Domains</th>
          <!--     <th scope="col" class="hidden py-3 pl-8 pr-0 text-right font-semibold sm:table-cell">Page Rank</th>
              <th scope="col" class="hidden py-3 pl-8 pr-0 text-right font-semibold sm:table-cell">Ranking</th> -->
              <th scope="col" class="py-3 pl-8 pr-0 text-right font-semibold">Expiration Date</th>
            </tr>
          </thead>
          <tbody>
          	<? if (is_array($domains) and count($domains) > 0): ?>
          	<? foreach($domains as $domain): ?>
            <tr class="border-b border-gray-600 domainResult" cid="<?= $domain['id'] ?>">
              <td class="max-w-0 px-0 py-5 align-top">
                <div class="truncate font-medium text-white text-capitalize"><a href="https://<?= $domain['url'] ?>/?ref=domstry.com" target="_blank"><?= $domain['url'] ?></a></div>
                <div class="truncate text-gray-500"><?= $domain['description'] ?></div>

               
         <? if ($domain['name'] != "" && $domain['name'] != null ) { ?>
         <p class="mt-1 truncate  text-xs leading-5 text-gray-400"> <?= $domain['name'] ?></p>
		<? } ?>

         <? if ($domain['description'] != "" && $domain['description'] != null ) { ?>
         <p class="mt-1 truncate  text-xs leading-5 text-gray-400"> <?= $domain['description'] ?></p>
		<? } ?>

         



          <? if ($domain['pr'] != "" && $domain['pr'] != null ) { ?>
			 <p class="mt-1 truncate text-xs leading-5 text-gray-400">	# Page Rank: <?= $domain['pr'] ?></p>
          <? } ?>


          <? if ($domain['rank'] != "" && $domain['rank'] != null ) { ?>
          	 <p class="mt-1 truncate text-xs leading-5 text-gray-400"># Ranking: <?= $domain['rank'] ?></p>
          <? } ?>
         <? if ($domain['country'] != "" && $domain['country'] != null ) { ?><img alt="<?= $domain['country'] ?>" width="20" height="auto" class="inline" src="https://cdn.domstry.com/flags/<?= strtolower($domain['country']) ?>.png"><? } ?> 
         


              </td>
              <!-- <td class="hidden py-5 pl-8 pr-0 text-right align-top tabular-nums text-gray-700 sm:table-cell"><?= $domain['pr'] ?></td>
              <td class="hidden py-5 pl-8 pr-0 text-right align-top tabular-nums text-gray-700 sm:table-cell"><?= $domain['rank'] ?></td> -->
              <td class="py-5 pl-8 pr-0 text-right align-top tabular-nums text-gray-400"><?= $domain['expiration_date'] ?></td>
            </tr>
        <? endforeach; ?>
            <? else: ?>
            	<tr><td colspan="4" class="text-white text-center">No Expiring Domains Today</td></tr>
            <? endif; ?>
          </tbody>
          <tfoot>
            <!-- <tr>
              <th scope="row" class="px-0 pb-0 pt-6 font-normal text-gray-700 sm:hidden">Subtotal</th>
              <th scope="row" colspan="3" class="hidden px-0 pb-0 pt-6 text-right font-normal text-gray-700 sm:table-cell">Subtotal</th>
              <td class="pb-0 pl-8 pr-0 pt-6 text-right tabular-nums text-white">$8,800.00</td>
            </tr>
             -->
          </tfoot>
        </table>



<details class="mt-16">
    <summary class=" text-gray-300">How to use expired domains?</summary>
    

<p class="mb-4 text-sm text-gray-400">Expired domains offer key benefits for businesses and individuals. They provide branding opportunities with unique names, SEO perks like established backlinks, and financial gains through domain flipping. Moreover, holding these domains is akin to digital real estate, representing valuable assets that might appreciate as ".com" names become scarcer.</p>

<p class="text-sm text-gray-400"><strong>Established Backlinks:</strong> Many expired domains come with a history of backlinks. Acquiring such a domain can give you a head start in terms of search engine rankings, as backlinks play a crucial role in SEO.</p>
<p class="text-sm text-gray-400"><strong>Domain Authority:</strong> Older domains often have a better domain authority due to their age and established backlinks. This can help in achieving better rankings faster compared to a brand new domain.</p>
<p class="text-sm text-gray-400"><strong>Relevant Content:</strong> If the expired domain was previously in your niche, it might already have relevant content. This can be a goldmine for SEO, and with a bit of updating and refining, you can have a website up and running in no time.</p>
<p class="text-sm text-gray-400"><strong>Catchy Names:</strong> Finding the perfect domain name for a new brand can be a challenge. Expired domains can provide you with unique and catchy names that were once valued and can be repurposed.</p>
<p class="text-sm text-gray-400"><strong>Domain Memory:</strong> If an expired domain had a significant amount of traffic or was a known brand, there's inherent value in its name recognition. Users might still type in the domain expecting to find relevant content.</p>
<p class="text-sm text-gray-400"><strong>Domain Flipping:</strong> Some people acquire expired domains only to sell (or "flip") them at a higher price. Domains with a good history, brand value, or keyword relevance can fetch a good sum.</p>
<p class="text-sm text-gray-400"><strong>Monetization:</strong> With established traffic, expired domains can be turned into ad revenue sources or affiliate marketing sites.</p>

<p class="text-sm text-gray-400"><strong>Digital Assets:</strong> Domains are like real estate of the digital world. Holding onto valuable domains can be seen as an investment, which might appreciate over time, especially as good ".com" names become scarcer.</p>

</details>
      </div>

     
    </div>
  </div>

  <? $HOOK_JS = "
           
                
                if ($('#download_list').length){
    $('#download_list').click(function(e){
        e.preventDefault();
        e.stopPropagation();
        var order = {
            count: ". $count .",
            name: 'Expiring Domains ".$date."',
            expiration_date: '".$date."'
        };
        $.post('app/stripe.php',order,function(data){
            console.log('Stripe response',data);
            window.location.href=data.url;
        },'json')
        return false;
    });
}
            
            ";
