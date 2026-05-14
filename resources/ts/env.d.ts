/// <reference types="vite/client" />

interface ImportMetaEnv {
	readonly VITE_WPSP_APP_NAME: string
}

interface ImportMeta {
	readonly env: ImportMetaEnv
}