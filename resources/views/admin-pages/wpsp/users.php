<?php
global $selected_user;

if(
    isset($requestParams['action']) && $requestParams['action'] == 'show'
    && isset($requestParams['id']) && $requestParams['id']
) :
?>
    <div id="poststuff">
        <div class="actions mt-2 mb-3">
            <a class="button" href="?page=<?php echo $menuSlug; ?>&tab=users">Back</a>
        </div>
        <div  class="row gx-3">
            <div class="col">
                <div class="meta-box-sortables ui-sortable">
                    <div class="postbox">

                        <div class="postbox-header">
                            <h2 class="hndle ui-sortable-handle">Information</h2>
                            <div class="handle-actions">
                                <button type="button" class="handlediv" aria-expanded="true">
                                    <span class="toggle-indicator"></span>
                                </button>
                            </div>
                        </div>

                        <div class="inside">
                            <table>
                                <tbody>
                                <tr>
                                    <td>
                                        <?php
                                        echo '<pre>'; print_r($selected_user->toArray()); echo '</pre>';
                                        ?>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col">
                <div class="meta-box-sortables ui-sortable">
                    <div class="postbox">

                        <div class="postbox-header">
                            <h2 class="hndle ui-sortable-handle">Roles</h2>
                            <div class="handle-actions">
                                <button type="button" class="handlediv" aria-expanded="true">
                                    <span class="toggle-indicator"></span>
                                </button>
                            </div>
                        </div>

                        <div class="inside">
                            <table>
                                <tbody>
                                <tr>
                                    <td>
                                        <?php
                                        echo '<pre>'; print_r($selected_user->roles()->toArray()); echo '</pre>';
                                        ?>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <div class="meta-box-sortables ui-sortable">
                    <div class="postbox">

                        <div class="postbox-header">
                            <h2 class="hndle ui-sortable-handle">Permissions</h2>
                            <div class="handle-actions">
                                <button type="button" class="handlediv" aria-expanded="true">
                                    <span class="toggle-indicator"></span>
                                </button>
                            </div>
                        </div>

                        <div class="inside">
                            <table>
                                <tbody>
                                <tr>
                                    <td>
                                        <?php
                                        echo '<pre>'; print_r($selected_user->rolesAndPermissions()); echo '</pre>';
                                        ?>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
elseif(
    isset($requestParams['action']) && $requestParams['action'] == 'create'
) :
?>
    <form method="POST">
        <input name="action" value="create_user" type="hidden"/>
        <div id="poststuff" class="row gx-3">
            <div class="col">
                <div class="meta-box-sortables ui-sortable">
                    <div class="postbox">

                        <div class="postbox-header">
                            <h2 class="hndle ui-sortable-handle">{{ wpsp_trans('Add new user', true) }}</h2>
                            <div class="handle-actions">
                                <button type="button" class="handlediv" aria-expanded="true">
                                    <span class="toggle-indicator"></span>
                                </button>
                            </div>
                        </div>

                        <div class="inside form-table w-auto">

                            <div class="input-group mt-2 mb-3">
                                <label for="username">
                                    {{ wpsp_trans('Username', true) }}:
                                    <input type="text" id="username" name="username" class="w-100 mt-1" value="{{ $_POST['username'] ?? 'username_' . time() }}"/>
                                </label>
                            </div>

                            <div class="input-group mt-2 mb-3">
                                <label for="email">
                                    {{ wpsp_trans('Email', true) }}:
                                    <input type="text" id="email" name="email" class="w-100 mt-1" value="{{ $_POST['email'] ?? 'email_' . time() . '@example.com' }}"/>
                                </label>
                            </div>

                            <div class="input-group mt-2">
                                <label for="password">
                                    {{ wpsp_trans('Password', true) }}:
                                    <input type="text" id="password" name="password" class="w-100 mt-1" value="{{ $_POST['password'] ?? '123456' }}"/>
                                </label>
                            </div>

                        </div>

                    </div>
                    <button type="submit" class="button button-primary">{{ wpsp_trans('Add new', true) }}</button>
                </div>
            </div>
        </div>
    </form>

<?php
else :
?>
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
<?php
endif;