import { useBlockProps } from '@wordpress/block-editor';

export default function save() {
	return (
		<p { ...useBlockProps.save() }>
			{ 'Custom block "block-demo" - save.js' }
		</p>
	);
}