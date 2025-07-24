<!-- FOOTer -->
<footer class="" aria-labelledby="footer-heading">
  <div class="mx-auto max-w-7xl px-6 pb-8 pt-16 sm:pt-24 lg:px-8 lg:pt-32">
    <div class="mt-10 border-t border-white/10 pt-8 ">
      <p class="text-xs leading-5 text-gray-400">&copy; <a href="<?= APP_BASE_URL ?>"><?= APP_DOMAIN ?></a> <?= $SEO_TITLE ?> &copy; <?= Date("Y") ?> Ayesa Digital SLU. All rights reserved</p>
      <p class="text-xs leading-5 text-gray-500">
        Powered by <a href="//stripepad.com">Stripe Pad v.0.0.1 </a> · Get Support: <a href="mailto:<?= ADMIN_EMAIL ?>"><?= ADMIN_EMAIL ?></a></p>
    </div>
</footer>

</div>
</main>
</div>
</div>

<? include dirname(__FILE__) . "/../../common/modal.php"; ?>

<!-- PHP to JS -->
<script>
  var isAuthorized = <?= $isAuthenticated ? 1 : 0 ?>;
  var base_url = '<?= APP_BASE_URL ?>';
  var agent = <?= json_encode($_SESSION['agent']) ?>;
  var usersId = <?= $_SESSION['user']['usersId']; ?>;
</script>

<script src="<?= APP_CDN ?>js/feedback.js"></script>
<script src="<?= APP_CDN ?>js/system.js"></script>
<script src="<?= APP_CDN ?>js/import.js"></script>
<script>
  <? if (!empty($HOOK_FOOTER)) echo $HOOK_FOOTER; ?>
  <? if (!empty($HOOK_JS)) echo $HOOK_JS; ?>
</script>

</body>

</html>