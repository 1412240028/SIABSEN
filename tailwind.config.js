import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                "body-sm": ["Figtree"],
                "label-xs": ["Figtree"],
                "headline-lg": ["Figtree"],
                "headline-2xl": ["Figtree"],
                "headline-xl": ["Figtree"],
                "label-medium": ["Figtree"],
                "numeric-token": ["JetBrains Mono"],
                "body-base": ["Figtree"]
            },
            colors: {
                "surface-container-high": "#dde9ff",
                "on-secondary-container": "#6c4700",
                "secondary-container": "#ffb229",
                "status-hadir": "#16A34A",
                "error-container": "#ffdad6",
                "surface-variant": "#d5e3fd",
                "surface-container": "#e6eeff",
                "primary": "#005e57",
                "on-primary-container": "#a7fdf2",
                "error": "#ba1a1a",
                "inverse-on-surface": "#ebf1ff",
                "surface-tint": "#006a63",
                "outline": "#6e7977",
                "surface-bright": "#f8f9ff",
                "on-error-container": "#93000a",
                "secondary-fixed": "#ffddb1",
                "slate-900": "#0F172A",
                "surface-container-highest": "#d5e3fd",
                "primary-fixed-dim": "#80d5cb",
                "status-alpa": "#DC2626",
                "on-tertiary-container": "#ffe9e1",
                "status-sakit": "#D97706",
                "on-background": "#0d1c2f",
                "surface-container-low": "#eff4ff",
                "on-primary-fixed-variant": "#00504a",
                "on-primary-fixed": "#00201d",
                "inverse-primary": "#80d5cb",
                "on-tertiary-fixed": "#370e00",
                "on-secondary-fixed-variant": "#624000",
                "status-izin": "#2563EB",
                "slate-50": "#F8FAFC",
                "on-tertiary": "#ffffff",
                "outline-variant": "#bdc9c6",
                "on-secondary-fixed": "#291800",
                "background": "#f8f9ff",
                "tertiary-fixed": "#ffdbce",
                "on-secondary": "#ffffff",
                "on-error": "#ffffff",
                "surface-container-lowest": "#ffffff",
                "on-tertiary-fixed-variant": "#71361c",
                "primary-container": "#157870",
                "tertiary-container": "#9e593c",
                "surface-dim": "#ccdbf4",
                "secondary-fixed-dim": "#ffba49",
                "on-surface": "#0d1c2f",
                "primary-fixed": "#9cf2e8",
                "surface": "#f8f9ff",
                "inverse-surface": "#233144",
                "on-primary": "#ffffff",
                "secondary": "#815600",
                "tertiary": "#814227",
                "on-surface-variant": "#3e4947",
                "tertiary-fixed-dim": "#ffb598"
            },
            borderRadius: {
                DEFAULT: "0.25rem",
                lg: "0.5rem",
                xl: "0.75rem",
                full: "9999px"
            },
            spacing: {
                "grid-gap-desktop": "1.5rem",
                "card-padding": "1.5rem",
                "sidebar-expanded": "16rem",
                "form-gutter": "1rem",
                "navbar-height": "4rem",
                "sidebar-collapsed": "5rem",
                "grid-gap-mobile": "1rem"
            },
            fontSize: {
                "body-sm": ["14px", { lineHeight: "20px", fontWeight: "400" }],
                "label-xs": ["12px", { lineHeight: "16px", fontWeight: "500" }],
                "headline-lg": ["18px", { lineHeight: "28px", fontWeight: "600" }],
                "headline-2xl": ["24px", { lineHeight: "32px", fontWeight: "600" }],
                "headline-xl": ["20px", { lineHeight: "28px", fontWeight: "600" }],
                "label-medium": ["14px", { lineHeight: "20px", fontWeight: "500" }],
                "numeric-token": ["16px", { lineHeight: "24px", fontWeight: "500" }],
                "body-base": ["16px", { lineHeight: "24px", fontWeight: "400" }]
            },
            boxShadow: {
                "soft": "0 2px 8px -2px rgba(15, 23, 42, 0.05), 0 4px 12px -4px rgba(15, 23, 42, 0.05)",
                "card": "0 4px 16px -4px rgba(15, 23, 42, 0.1), 0 8px 24px -8px rgba(15, 23, 42, 0.1)"
            }
        },
    },

    plugins: [forms],
};
