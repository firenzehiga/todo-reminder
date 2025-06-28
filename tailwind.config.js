/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                custom: {
                    madder: "#a31621",
                    snow: "#fcf7f8",
                },
                warm: {
                    50: "#fef7ed",
                    100: "#fdedd3",
                    200: "#fbd9a5",
                    300: "#f8bf6d",
                    400: "#f59f33",
                    500: "#f3860b",
                    600: "#e46f06",
                    700: "#bd5708",
                    800: "#97450e",
                    900: "#7a3a0f",
                },
            },
            backgroundImage: {
                "gradient-custom":
                    "linear-gradient(135deg, #667eea 0%, #764ba2 100%)",
                "gradient-warm":
                    "linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%)",
                "gradient-cool":
                    "linear-gradient(135deg, #a8edea 0%, #fed6e3 100%)",
                "dots-pattern":
                    "radial-gradient(circle, #e2e8f0 1px, transparent 1px)",
            },
            backgroundSize: {
                dots: "20px 20px",
            },
        },
    },
    plugins: [],
};
