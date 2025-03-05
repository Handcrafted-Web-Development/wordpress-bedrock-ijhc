import { defineConfig } from 'vite';
import VitePluginSvgSpritemap from '@spiriit/vite-plugin-svg-spritemap';

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
	plugins: [
		VitePluginSvgSpritemap('./src/icons/*.svg'),
		{
			injectSVGOnDev: true,
			styles: 'src/sass/sprites.css',
		},
	],
});
