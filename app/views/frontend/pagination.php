<?php
	// template app/support/KPPresenter
	$presenter = new KPPresenter($paginator);
?>


<?php if ($paginator->getLastPage() > 1): ?>
			<?php echo $presenter->render(); ?>
<?php endif; ?>