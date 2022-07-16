<h2><?php echo $title; ?></h2>

<?php foreach ($empleado as $empleado_item): ?>

        <h3><?php echo $empleado_item['title']; ?></h3>
        <div class="main">
                <?php echo $empleado_item['text']; ?>
        </div>
        <p><a href="<?php echo site_url('empleados/'.$empleados_item['id']); ?>">View article</a></p>

<?php endforeach; ?>