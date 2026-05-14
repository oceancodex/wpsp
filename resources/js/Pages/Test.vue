<script lang="ts" setup>
import {Head, Link} from '@inertiajs/vue3'
import * as WebController from '@/actions/WPSP/App/Http/Controllers/WebController';
</script>

<template>
	<Head title="Test" />

	This is "test" page.
	<br/>
	<Link :href="WebController.index()">Go to home page</Link>
</template>