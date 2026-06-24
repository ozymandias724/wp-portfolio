import { defineConfig } from 'vite';

export default defineConfig({
    build: {
        outDir: 'dist',
        emptyOutDir: true,

        rollupOptions: {
            input: 'assets/js/main.js',

            output: {
                entryFileNames: 'js/main.js',

                assetFileNames: (assetInfo) => {
                    if (
                        assetInfo.names &&
                        assetInfo.names.some((name) => name.endsWith('.css'))
                    ) {
                        return 'css/main.css';
                    }

                    return 'assets/[name][extname]';
                },
            },
        },
    },
});