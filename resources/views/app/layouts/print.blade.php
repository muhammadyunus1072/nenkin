<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>J-Expert</title>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;600;700;800&amp;family=Inter:wght@300;400;500;600&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
            "colors": {
                    "on-secondary-container": "#53647c",
                    "primary-fixed-dim": "#a2c9ff",
                    "on-error-container": "#93000a",
                    "on-surface": "#191c20",
                    "on-primary": "#ffffff",
                    "secondary-fixed": "#d3e4ff",
                    "secondary-container": "#cfe1fd",
                    "on-error": "#ffffff",
                    "secondary-fixed-dim": "#b6c8e4",
                    "outline-variant": "#c2c6d1",
                    "surface-container-highest": "#e2e2e7",
                    "primary-fixed": "#d3e4ff",
                    "on-tertiary": "#ffffff",
                    "tertiary-container": "#804900",
                    "on-primary-container": "#acceff",
                    "tertiary-fixed-dim": "#ffb872",
                    "background": "#f9f9fe",
                    "on-tertiary-fixed-variant": "#6a3b00",
                    "on-background": "#191c20",
                    "error": "#ba1a1a",
                    "surface-tint": "#2c609a",
                    "primary-container": "#215891",
                    "surface-variant": "#e2e2e7",
                    "on-primary-fixed-variant": "#044880",
                    "surface-bright": "#f9f9fe",
                    "inverse-primary": "#a2c9ff",
                    "surface-container-high": "#e7e8ed",
                    "surface-container-low": "#f3f3f9",
                    "tertiary": "#5f3500",
                    "on-secondary-fixed": "#0a1c31",
                    "inverse-surface": "#2e3035",
                    "inverse-on-surface": "#f0f0f6",
                    "tertiary-fixed": "#ffdcbf",
                    "error-container": "#ffdad6",
                    "outline": "#727781",
                    "on-secondary": "#ffffff",
                    "surface": "#f9f9fe",
                    "on-primary-fixed": "#001c38",
                    "secondary": "#4f5f78",
                    "surface-dim": "#d9dadf",
                    "surface-container-lowest": "#ffffff",
                    "on-tertiary-container": "#ffbf83",
                    "on-surface-variant": "#424750",
                    "on-tertiary-fixed": "#2d1600",
                    "on-secondary-fixed-variant": "#37485f",
                    "primary": "#004074",
                    "surface-container": "#ededf3"
            },
            "borderRadius": {
                    "DEFAULT": "0.125rem",
                    "lg": "0.25rem",
                    "xl": "0.5rem",
                    "full": "0.75rem"
            },
            "fontFamily": {
                    "headline": ["Public Sans"],
                    "body": ["Inter"],
                    "label": ["Inter"]
            }
            },
        },
        }
    </script>
    <style>
        @page {
            size: A4 portrait;
            /* size: A4 landscape; */
            margin: 0mm;
        }
        @media print {

            table {
                width: 100% !important;
                table-layout: auto !important;
            }

        }

        .print-page {
            page-break-before: always;
        }
        body {
            color: black;
        }

        .report-content-cell {
            /* padding: 32px; */
        }

        .report-header-cell {
            height: 140px;
        }

        .report-footer-cell {
            height: 80px;
        }

        .report-container {
            width: 100%;
        }

        .report-header {
            display: table-header-group;
        }

        .report-footer {
            display: table-footer-group;
        }

        .image-header {
            width: 100%;
            margin-top: 16px;
            height: auto;
            object-fit: scale-down;
        }

        .image-footer {
            width: 100%;
            height: auto;
            object-fit: scale-down;
        }

        .header {
            position: fixed;
            width: 100%;
            height: auto;
        }

        .footer {
            display: flex;
            align-items: center;
            justify-content: center;
            position: fixed;
            bottom: 16px;
            width: 100%;
            height: 100px;
        }
    </style>
    <style>
        .material-symbols-outlined {
        font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        display: inline-block;
        line-height: 1;
        text-transform: none;
        letter-spacing: normal;
        word-wrap: normal;
        white-space: nowrap;
        direction: ltr;
        }
        @media print {
        @page {
        size: landscape;
        margin: 0;
        }
        body {
        background: white;
        }
        .no-print {
        display: none;
        }
        }
        .watermark-container {
        position: relative;
        overflow: hidden;
        }
        .watermark-bg {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 0;
        opacity: 0.05;
        width: 60%;
        pointer-events: none;
        }
        .content-layer {
        position: relative;
        z-index: 1;
        }
    </style>

   
    
    @stack('css')
</head>

<body class="bg-surface text-on-surface font-body selection:bg-primary-container selection:text-white">
        <!-- Watermark -->
    <div class="watermark-bg">
        <img alt="Corporate Logo Watermark" class="w-full object-contain" data-alt="faded minimalist corporate logo graphic with geometric circular elements and professional abstract lines in soft blue tones" src="https://nenkin.turhamunselvia.site/files/images/LOGO%20J-EXPERT.svg"/>
    </div>
    @yield('content')
</body>

    {{-- JAVASCRIPT --}}
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    @stack('js')
</body>

</html>
