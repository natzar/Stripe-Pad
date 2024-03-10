<!-- header and menu are included automatically -->


<!-- STARTING POINT --> 

<main id="app">
    




</main>





<!-- any defined variablies in $this->view->show(template, ARRAY) the ARRAY, are available here $var1, $var2 .... -->





<!-- Transfer any PHP vars to JS -->

<? if (isset($currentQuery)): ?>
    <script>
        var currentQuery = JSON.parse('<?= json_encode($currentQuery) ?>') ;
        console.log('CURRENT QUERY:',currentQuery);
        var isAuthenticated = <?= $isAuthenticated ? 1:0 ?>;
    </script>
<? endif; ?>

<!-- include JS -->

<script src="https://cdn.jsdelivr.net/npm/underscore@1.13.4/underscore-umd-min.js" ></script>
<script src="<?= APP_CDN ?>backbone.js"></script>
<script src="<?= APP_CDN ?>app.js" ></script>

<!-- The footer is not included by default, you can include it include("footer.php"); -->

</body>
</html>