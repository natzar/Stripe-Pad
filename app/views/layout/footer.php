<!-- FOOTer -->
<footer class="mt-10 border-t border-gray-200 border-t-1" aria-labelledby="footer-heading">
  <div class="mx-auto ">
    <div class="pt-8 ">
      <p class="text-xs leading-5 text-gray-400"><a href="<?= APP_URL ?>"><?= APP_NAME ?></a> &copy; <?= Date("Y") ?> <?= APP_NAME ?>. All rights reserved</p>
      <p class="text-xs leading-5 text-gray-500">
        Get Support: <a href="mailto:<?= ADMIN_EMAIL ?>"><?= ADMIN_EMAIL ?></a></p>
    </div>
</footer>

</div>
</main>
</div>
</div>

<!-- Global notification live region, render this permanently at the end of the document -->
<div id="notif_bubble" style="display: none;" aria-live="assertive" class=" pointer-events-none top-20 fixed inset-0 flex items-end px-4 py-6 sm:items-start sm:p-6">
  <div class="flex w-full flex-col items-center space-y-4 sm:items-end">
    <!--
      Notification panel, dynamically insert this into the live region when it needs to be displayed

      Entering: "transform ease-out duration-300 transition"
        From: "translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
        To: "translate-y-0 opacity-100 sm:translate-x-0"
      Leaving: "transition ease-in duration-100"
        From: "opacity-100"
        To: "opacity-0"
    -->
    <div class="pointer-events-auto w-full max-w-sm overflow-hidden rounded-lg bg-white shadow-lg ring-1 ring-black/5">
      <div class="p-4">
        <div class="flex items-start">
          <div class="shrink-0">
            <svg class="size-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
          </div>
          <div class="ml-3 w-0 flex-1 pt-0.5">
            <p class="text-sm font-medium text-gray-900" id="notif_bubble_title">Successfully saved!</p>
            <p id="notif_bubble_text" class="mt-1 text-sm text-gray-500">Anyone with a link can now view this file.</p>
          </div>
          <div class="ml-4 flex shrink-0">
            <button type="button" class="inline-flex rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
              <span class="sr-only">Close</span>
              <svg class="size-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                <path d="M6.28 5.22a.75.75 0 0 0-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 1 0 1.06 1.06L10 11.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L11.06 10l3.72-3.72a.75.75 0 0 0-1.06-1.06L10 8.94 6.28 5.22Z" />
              </svg>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<? include dirname(__FILE__) . "/../modal.php"; ?>

<!-- PHP to JS -->
<script>
  var isAuthorized = <?= $isAuthenticated ? 1 : 0 ?>;
  var base_url = '<?= APP_URL ?>';
  var agent = <?= json_encode($_SESSION['account']) ?>;
  var usersId = <?= $_SESSION['user']['usersId']; ?>;
</script>

<!-- PHP to JS -->
<script>
  $ = $ || jQuery;

  var active_link_class = "bg-white shadow-sm ";

  function toggle_user_accounts_popup() {
    const popup = document.getElementById("popup");
    popup.classList.toggle("hidden");
  }

  $(document).ready(function() {
    console.log("STRIPE PAD Loaded...");
    // Add style to the link hrefing the current page
    var uri = unescape(document.location.href).trim();
    //  uri = uri.substr(uri.indexOf(base_url) + base_url.length);
    $("a[href='" + uri + "']").each(function() {
      $(this).addClass(active_link_class);
    });



    // Toggle Menu Mobile
    var openBtn = document.getElementById('button_open_mobile_menu');
    var closeBtn = document.getElementById('button_close_mobile_menu');
    var mobileMenu = document.getElementById('mobile_menu');

    if (openBtn && mobileMenu) {
      openBtn.addEventListener('click', function() {
        mobileMenu.classList.remove('hidden');
      });
    }

    if (closeBtn && mobileMenu) {
      closeBtn.addEventListener('click', function() {
        mobileMenu.classList.add('hidden');
      });
    }

    // Multi account switch selector


  });
</script>
<script src="<?= APP_CDN ?>js/feedback.js"></script>
<script src="<?= APP_CDN ?>js/system.js"></script>
<script src="<?= APP_CDN ?>js/import.js"></script>
<script src="<?= APP_CDN ?>js/table_tools.js"></script>
<script>
  <? if (!empty($HOOK_FOOTER)) echo $HOOK_FOOTER; ?>
  <? if (!empty($HOOK_JS)) echo $HOOK_JS; ?>
</script>

</body>

</html>