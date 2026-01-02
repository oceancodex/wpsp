<?php
if(isset($requestParams['action']) && $requestParams['action'] == 'create') :
?>
    <form method="POST">
        <input name="action" value="create_role" type="hidden"/>
        <div id="poststuff" class="row gx-3">
            <div class="col">
                <div class="meta-box-sortables ui-sortable">
                    <div class="postbox">

                        <div class="postbox-header">
                            <h2 class="hndle ui-sortable-handle">Add new role</h2>
                            <div class="handle-actions">
                                <button type="button" class="handlediv" aria-expanded="true">
                                    <span class="toggle-indicator"></span>
                                </button>
                            </div>
                        </div>

                        <div class="inside form-table w-auto">

                            <div class="input-group mt-2 mb-3">
                                <label for="name">
                                    Name:
                                    <input type="text" id="name" name="name" class="w-100 mt-1" value="<?php echo $_POST['name'] ?? '' ?>"/>
                                </label>
                            </div>

                            <div class="input-group mt-2">
                                <label for="guard_name">
                                    Guard name:
                                    <input type="text" id="guard_name" name="guard_name" class="w-100 mt-1" value="<?php echo $_POST['guard_name'] ?? '' ?>"/>
                                </label>
                            </div>

                        </div>

                    </div>
                    <button type="submit" class="button button-primary">Add new</button>
                </div>
            </div>
        </div>
    </form>
<?php else : ?>
    <form method="GET">
        <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?? '' ?>"/>
        <input type="hidden" name="tab" value="<?php echo $_REQUEST['tab'] ?? '' ?>"/>
        <?php
        $table->prepare_items();
        $table->views();
        $table->search_box('Search', 'search_id');
        $table->display();
        ?>
    </form>
<?php endif; ?>