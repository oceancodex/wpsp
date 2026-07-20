<div class="popup-overlay" id="{{ $id ?? '' }}" style="display:none;">
	<div class="popup-outer">
		<div id="poststuff" class="pt-0">
			<div class="meta-box-sortables ui-sortable">
				<div class="postbox mb-0">
					<div class="postbox-header">
						<h2 class="ui-sortable-handle">
							{!! $title !!}
						</h2>
						<div class="handle-actions">
							<button type="button" class="button-close-popup bg-transparent border-0 fw-bold fs-6 me-1" style="cursor:pointer;">
								✕
							</button>
						</div>
					</div>
					<div class="inside w-auto mt-0" style="max-height: 950px; overflow: auto;">
						{!! $content !!}
					</div>
					<div class="postbox-footer" style="padding: 12px;">
						<div class="bg-light border-top text-end" style="padding: 12px;">
							{!! $footer !!}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>