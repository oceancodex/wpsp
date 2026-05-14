<script lang="ts" setup>
import { Link, Head } from '@inertiajs/vue3';
import * as WebController from '@/actions/WPSP/App/Http/Controllers/WebController';
</script>

<template>
	<Head title="Home" />

	This is home page
	<br/>
	<Link :href="WebController.test()">Go to "test" page</Link>
</template>