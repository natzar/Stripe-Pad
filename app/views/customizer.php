<?
if (!isset($_GET['id'])) {
 	header("location: /");
 	die();
}
include "./widget/bd.php";

$WIDGET_ID = $_GET['id'];

if (isset($_POST['submit'])):

  $json = json_encode($_POST);
  $q = $bd->prepare("UPDATE users set settings = :json where hash = :hash");
  $q->bindParam(":json",$json);
  $q->bindParam(":hash",$WIDGET_ID);
  $q->execute();

  echo "Saved!";

endif;

 

 $q = $bd->prepare("SELECT * from users where hash = :e limit 1" );
 $q->bindParam(":e",$WIDGET_ID);
 $q->execute();
 $user = $q->fetch();

 if (empty($user)){
 	header("location: /");
 	die();
 }

 $settings = json_decode($user['settings'],true);

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>RefBoost | Private</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <link href="https://refboost.com/referrals-widget.css" rel="stylesheet">
  </head>
<body>
<script>

var toClipBoard = function(el){
	 
	 var value = '<script'+' src="https://refboost.com/widget/?id=<?=  $WIDGET_ID ?>"></'+'script>';
	 navigator.clipboard.writeText(value);
	 el.innerHTML = "copied!";
}
</script>




 <!-- MAIN -->

<div class="bg-gray-100 py-16">
	<div class="max-w-5xl mx-auto">
		<div>
  <div class="md:grid md:grid-cols-3 md:gap-6">
    <div class="md:col-span-1">
      <div class="px-4 sm:px-0">
      	<img width="70" class="" src="https://refboost.com/refboost-logo.png">
        <h3 class="text-lg font-semibold leading-8 tracking-tight text-indigo-600 mt-10">Widget Settings</h3>
        <p class="mt-1 mb-10 text-base leading-7 text-gray-600">Customize settings for the widget, contact hello@refboost.com for custom requests</p>

             <a href="https://buy.stripe.com/3cs3fNegF9597gA004" class="inline-block rounded-lg bg-indigo-100 px-4 py-2.5 text-center text-sm font-semibold leading-5 text-indigo-700 hover:bg-indigo-100">Remove branding <span aria-hidden="true">→</span></a>
            <div class=" text-base leading-7 text-gray-600">Remove branding from RefBoost + export collected leads <span class="font-semibold text-gray-900">$9/month</span></div>
          </div>
        
  
  
    </div>
    <div class="mt-5 md:col-span-2 md:mt-0">

    	<div class="relative mx-auto mb-8 ">
      <div class="mx-auto max-w-md lg:max-w-4xl">

       
        
        <div class="flex flex-col gap-6 rounded-3xl p-8 ring-1 ring-gray-900/10 sm:p-10 lg:flex-row lg:items-center lg:gap-8">
          <div class="lg:min-w-0 lg:flex-1">
            <h3 class="text-lg font-semibold leading-8 tracking-tight text-indigo-600">Copy this line and paste it in your website's html:</h3>
            <div class="mt-2 text-base leading-7 text-gray-600">
      	  <span class="text-xs text-gray-900"><code>&lt;script src="https://refboost.com/widget/?id=<?=  $WIDGET_ID ?>"&gt;&lt;/script&gt;</code></span></div>
          </div>
          <div>
            <a href="#" onclick="toClipBoard(this);" class="inline-block rounded-lg bg-indigo-50 px-4 py-2.5 text-center text-sm font-semibold leading-5 text-indigo-700 hover:bg-indigo-100">Copy <span aria-hidden="true">→</span></a>
          </div>
        </div>
      </div>
    </div>

      <form action="" method="POST">
        <div class="shadow sm:overflow-hidden sm:rounded-md">
          <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
            <div class="grid grid-cols-3 gap-6">
              <div class="col-span-3 sm:col-span-2">
                <label for="company-website" class="block text-sm font-medium text-gray-700">Website</label>
                <div class="mt-1 flex rounded-md shadow-sm">
                  <span class="inline-flex items-center rounded-l-md border border-r-0 border-gray-300 bg-gray-50 px-3 text-sm text-gray-500">https://</span>
                  <input type="text" name="url" id="company-website" class="block w-full flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="<?= $settings['url'] ?>" required="required">
                </div>
              </div>
            </div>
             
            <div class="col-span-6 sm:col-span-3">
                <label for="first-name" class="block text-sm font-medium text-gray-700">Trigger CTA</label>
                <p class="mt-2 text-sm text-gray-500">This text will appear in the floating trigger button</p>
                <input type="text" name="trigger_cta" required="required" autocomplete="false" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="<?= empty($settings['trigger_cta']) ? $settings['button_cta'] :$settings['trigger_cta']  ?>">
              </div>
               

             <div class="col-span-6 sm:col-span-3">
                <label for="first-name" class="block text-sm font-medium text-gray-700">Widget Header</label>
                <input type="text" name="deal_title" required="required" autocomplete="false" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="<?= $settings['deal_title'] ?>">
              </div>
               <div>
              <label for="about" class="block text-sm font-medium text-gray-700">Widget Subheader</label>
               <p class="mt-2 text-sm text-gray-500">This text will appear just after the widget header, keep it short.</p>
              <div class="mt-1">
                <textarea name="deal_description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder=""><?= $settings['deal_description'] ?></textarea>
              </div>
             
            </div>

            <div class="col-span-6 sm:col-span-3">
                <label for="first-name" class="block text-sm font-medium text-gray-700">Number of friends</label>
                  <p class="mt-2 text-sm text-gray-500">Number of input fields shown</p>
                <input type="number" name="max_friends" required="required" autocomplete="false" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="<?= $settings['max_friends'] ?>" min="1" max="5">
              </div>

              <div class="col-span-6 sm:col-span-3">
                <label for="last-name" class="block text-sm font-medium text-gray-700">Primary Color</label>
                <input type="color" name="primary_color" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="<?= $settings['primary_color'] ?>">
              </div>

              <div class="col-span-6 sm:col-span-4">
                <label for="email-address" class="block text-sm font-medium text-gray-700">Button CTA</label>
                <input type="text" name="button_cta" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="<?= $settings['button_cta'] ?>">
              </div>
           
            <div>
              <label for="about" class="block text-sm font-medium text-gray-700">E-mail to main contact</label>
                <p class="mt-2 text-sm text-gray-500">This email will be sent to the main contact. You can use {{name}} = main's contact name</p>

              <div class="mt-1">
                <textarea  name="body_main" rows="7" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder=""><?= $settings['body_main'] ?></textarea>
              </div>
            
            </div>


            <div>
              <label for="about" class="block text-sm font-medium text-gray-700">E-mail to friends</label>
                 <p class="mt-2 text-sm text-gray-500">This email will be sent to all referred friends</p>
              <div class="mt-1">
                <textarea name="body_friends" rows="7" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder=""><?= $settings['body_friends'] ?></textarea>
              </div>
           
            </div>

  			
<!-- 
           
    <div class="space-y-6 divide-y divide-gray-200 pt-8 sm:space-y-5 sm:pt-10">
      <div>
        <h3 class="text-lg font-medium leading-6 text-gray-900">ON/OFF Settings</h3>
        <p class="mt-1 max-w-2xl text-sm text-gray-500">We'll always let you know about important changes, but you pick what else you want to hear about.</p>
      </div>
      <div class="space-y-6 divide-y divide-gray-200 sm:space-y-5">
        <div class="pt-6 sm:pt-5">
          <div role="group" aria-labelledby="label-email">
            <div class="sm:grid sm:grid-cols-3 sm:items-baseline sm:gap-4">
              <div>
                <div class="text-base font-medium text-gray-900 sm:text-sm sm:text-gray-700" id="label-email">By Email</div>
              </div>
              <div class="mt-4 sm:col-span-2 sm:mt-0">
                <div class="max-w-lg space-y-4">
                  <div class="relative flex items-start">
                    <div class="flex h-5 items-center">
                      <input name="mobile" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" checked>
                    </div>
                    <div class="ml-3 text-sm">
                      <label for="comments" class="font-medium text-gray-700">Enable on mobile devices</label>
                      <p class="text-gray-500">The widget will show up in devices with a resolution under 900 pixels wide</p>
                    </div>
                  </div>
                  <div class="relative flex items-start">
                    <div class="flex h-5 items-center">
                      <input id="candidates" name="candidates" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    </div>
                    <div class="ml-3 text-sm">
                      <label for="candidates" class="font-medium text-gray-700">Send the </label>
                      <p class="text-gray-500">Get notified when a candidate applies for a job.</p>
                    </div>
                  </div>
                  <div class="relative flex items-start">
                    <div class="flex h-5 items-center">
                      <input id="offers" name="offers" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    </div>
                    <div class="ml-3 text-sm">
                      <label for="offers" class="font-medium text-gray-700">Offers</label>
                      <p class="text-gray-500">Get notified when a candidate accepts or rejects an offer.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> -->

            
          </div>
          <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
            <button type="submit" name="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>




</div>
</div>

</body>

</html>