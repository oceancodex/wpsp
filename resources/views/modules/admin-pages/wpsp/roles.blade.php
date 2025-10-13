@extends('modules.admin-pages.layout')

@section('title')
    {{ wpsp_trans('Roles', true) }}
@endsection

@section('after-title')
    <a href="?page={{$menuSlug}}&tab=roles&action=add_new" class="page-title-action">{{ wpsp_trans('Add new', true) }}</a>
    <a href="?page={{$menuSlug}}&tab=roles&action=refresh" class="button-primary page-title-action">{{ wpsp_trans('Refresh all custom roles', true) }}</a>
@endsection

@section('content')

    @if ($current_request->get('action') == 'add_new')
        <form method="POST">
            <input name="action" value="add_new_role" type="hidden"/>
            <div id="poststuff" class="row gx-2">
                <div class="col">
                    <div class="meta-box-sortables ui-sortable">
                        <div class="postbox">

                            <div class="postbox-header">
                                <h2 class="hndle ui-sortable-handle">{{ wpsp_trans('Add new role', true) }}</h2>
                                <div class="handle-actions">
                                    <button type="button" class="handlediv" aria-expanded="true">
                                        <span class="toggle-indicator"></span>
                                    </button>
                                </div>
                            </div>

                            <div class="inside form-table w-auto">

                                <div class="input-group mt-2 mb-3">
                                    <label for="name">
                                        {{ wpsp_trans('Name', true) }}:
                                        <input type="text" id="name" name="name" class="w-100 mt-1" value="{{ $_POST['name'] ?? '' }}"/>
                                    </label>
                                </div>

                                <div class="input-group mt-2">
                                    <label for="guard_name">
                                        {{ wpsp_trans('Guard name', true) }}:
                                        <input type="text" id="guard_name" name="guard_name" class="w-100 mt-1" value="{{ $_POST['guard_name'] ?? '' }}"/>
                                    </label>
                                </div>

                            </div>

                        </div>
                        <button type="submit" class="button button-primary">{{ wpsp_trans('Add new', true) }}</button>
                    </div>
                </div>
            </div>
        </form>
    @else
        <form method="GET">
            <input type="hidden" name="page" value="{{ $_REQUEST['page'] ?? '' }}"/>
            <input type="hidden" name="tab" value="{{ $_REQUEST['tab'] ?? '' }}"/>
            @php
                $table->prepare_items();
                $table->views();
                $table->search_box('Search', 'search_id');
                $table->display();
            @endphp
        </form>
    @endif
@endsection