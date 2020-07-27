<?php if(count($error)): ?>
<?php foreach($error as $errors):?>
    <div class="alert alert-danger">
        <?php print $errors;?>
    </div>
<?php endforeach;?>
<?php endif;?>