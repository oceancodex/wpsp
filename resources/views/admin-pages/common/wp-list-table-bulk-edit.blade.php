<div id="poststuff">
	<div id="post-body" class="columns-1">
		<div class="postbox-container">
			<div class="postbox">
				<div class="postbox-header">
					<h2>
						@if (isset($qe_title) && $qe_title)
							{{ $qe_title }}
						@else
							@yield('qe_title', 'Quick edit')
						@endif
					</h2>
				</div>
				<div class="inside form-table w-auto">
					@if (isset($qe_content) && $qe_content)
						{{ $qe_content }}
					@else
						@yield('qe_content')
					@endif
				</div>
				<div class="border-top bg-light" style="padding: 12px;">
					<button class="button button-primary">
						@if (isset($qe_save_button_label) && $qe_save_button_label)
							{{ $qe_save_button_label }}
						@else
							@yield('qe_save_button_label', 'Save changes')
						@endif
					</button>
				</div>
			</div>
		</div>
	</div>
</div>