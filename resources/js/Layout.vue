<script setup>
import { Link } from "@inertiajs/vue3"
</script>

<template>
	<Layout>
		<main>
			<header>
				<Link href="/">Home</Link>
				<Link href="/about">About</Link>
				<Link href="/contact">Contact</Link>
			</header>
			<article>
				<slot />
			</article>
		</main>
	</Layout>
</template>