<?php
function debug($array) {
  echo '<pre>';
  print_r($array);
  echo '</pre>';
} ?>

<?php function paginationArticle($page, $num, $count) { ?>
  <div class="status">
    <?php if ($page > 1) { ?>
      <a class="btn btn-default status" href="index.php?page=<?php echo $page-1 ?>">Précédent</a>
    <?php } ?>
    <?php if ($page*$num < $count) { ?>
      <a class="btn btn-default status" href="index.php?page=<?php echo $page+1 ?>">Suivant</a>
    <?php } ?>
  </div>
<?php } ?>
