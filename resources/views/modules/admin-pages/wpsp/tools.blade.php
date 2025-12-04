@extends('modules.admin-pages.layout')

@section('title')
    {{ wpsp_trans('messages.tools') }}
@endsection

@section('content')
    <div id="poststuff" class="row gx-2">
        <div class="col">
            <div class="meta-box-sortables ui-sortable">
                <div class="postbox">

                    <div class="postbox-header">
                        <h2 class="hndle ui-sortable-handle">{{ wpsp_trans('messages.tools') }}</h2>
                        <div class="handle-actions">
                            <button type="button" class="handlediv" aria-expanded="true">
                                <span class="toggle-indicator"></span>
                            </button>
                        </div>
                    </div>

                    <div class="inside">
                        ...
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection