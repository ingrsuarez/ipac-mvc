<h2><?php echo $title; ?></h2>


   <div class="list-group">
      <?php foreach ($empleados_item as $todo) { ?>
        <div class="list-group-item clearfix">
          <?php echo $todo['nombre']; ?>
        </div>
      <?php } ?>
    </div>
<h3><?php print_r($empleados_item[1]); ?></h3>

