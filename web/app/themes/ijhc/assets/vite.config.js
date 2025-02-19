import { defineConfig } from 'vite';

export default defineConfig({
	server: {
		origin: 'https://ijhc.local',
		cors: true,
		hmr: {
			host: 'localhost',
		},
	},
	build: {
		manifest: true,
		sourcemap: true,
		assetsDir: '',
		rollupOptions: {
			input: ['./src/main.ts'],
		},
	},
});
