<form method="GET">
    <input type="hidden" name="page" value="{{ $_REQUEST['page'] ?? '' }}"/>
    <input type="hidden" name="tab" value="{{ $_REQUEST['tab'] ?? '' }}"/>
    <?php
        $table->prepare_items();
        $table->views();
        $table->search_box('Search', 'search_id');
        $table->display();
    ?>
</form>