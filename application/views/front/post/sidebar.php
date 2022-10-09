<div class="card">
    <div class="card-header bg-white">
        <b>Category</b>
    </div>
    <ul class="list-group list-group-flush">
        <?php foreach ($category as $category) : ?>
            <li class="list-group-item"><a class="text-decoration-none text-muted" href="<?php echo base_url('category/item/' . $category->category_slug); ?>"> <i class="bi-tag"></i> <?php echo $category->category_name; ?></a></li>
        <?php endforeach; ?>
    </ul>
</div>