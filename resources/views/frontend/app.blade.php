<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'FlexiPay Store — Buy Now, Pay in Installments')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Syne:wght@500;600;700;800&display=swap" rel="stylesheet">
    @stack('styles')
    <style>
        :root {
            --gold-50: #FFFBEB;
            --gold-100: #FEF3C7;
            --gold-200: #FDE68A;
            --gold-400: #FACC15;
            --gold-500: #EAB308;
            --gold-600: #CA8A04;
            --gold-700: #A16207;
            --dark-50: #FAFAFA;
            --dark-100: #F4F4F5;
            --dark-200: #E4E4E7;
            --dark-400: #A1A1AA;
            --dark-600: #52525B;
            --dark-800: #27272A;
            --dark-900: #18181B;
            --dark-950: #09090B;
            --near-black: #0A0A0B;
            --surface-dark: #121214;
            --card-dark: #1A1A1E;
            --card-border: #2A2A2E;
            --text-primary: #F4F4F5;
            --text-muted: #A1A1AA;
            --text-dim: #71717A;
            --shadow-gold: 0 4px 20px rgba(234,179,8,0.15);
            --shadow-gold-lg: 0 8px 40px rgba(234,179,8,0.2);
            --shadow-card: 0 4px 24px rgba(0,0,0,0.3);
            --shadow-card-hover: 0 8px 40px rgba(234,179,8,0.1);
            --radius: 14px;
            --radius-sm: 8px;
            --radius-lg: 20px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }

        body {
            font-family: 'Space Grotesk', sans-serif;
            background: var(--near-black);
            color: var(--text-primary);
            overflow-x: hidden;
            line-height: 1.6;
        }

        a { text-decoration: none; color: inherit; }
        ::selection { background: var(--gold-500); color: var(--near-black); }

        #pageLoader {
            position: fixed; inset: 0; background: var(--near-black);
            display: flex; flex-direction: column; align-items: center;
            justify-content: center; z-index: 99999;
            transition: opacity 0.6s ease, visibility 0.6s;
        }
        #pageLoader.hidden { opacity: 0; visibility: hidden; }
        .loader-logo { font-size: 32px; font-weight: 800; color: var(--gold-500); margin-bottom: 24px; font-family: 'Syne', sans-serif; }
        .loader-logo span { color: var(--text-primary); }
        .loader-bar { width: 220px; height: 4px; background: var(--card-dark); border-radius: 99px; overflow: hidden; }
        .loader-bar-fill { height: 100%; background: linear-gradient(90deg, var(--gold-500), var(--gold-400)); border-radius: 99px; animation: loaderFill 1.2s ease-in-out infinite; }
        @keyframes loaderFill { 0% { width: 0%; } 100% { width: 100%; } }

        #scrollTop {
            position: fixed; bottom: 30px; right: 30px; width: 48px; height: 48px;
            background: var(--gold-500); color: var(--near-black); border: none; border-radius: 12px;
            display: flex; align-items: center; justify-content: center; font-size: 20px;
            cursor: pointer; z-index: 999; opacity: 0; visibility: hidden; transition: all 0.3s;
            box-shadow: var(--shadow-gold);
        }
        #scrollTop.visible { opacity: 1; visibility: visible; }
        #scrollTop:hover { background: var(--gold-600); transform: translateY(-3px); box-shadow: var(--shadow-gold-lg); }

        .alert-success-custom, .alert-danger-custom {
            padding: 14px 20px; text-align: center; font-weight: 600; position: relative; z-index: 1000;
            display: flex; align-items: center; justify-content: center; gap: 8px;
            animation: slideDownAlert 0.5s ease-out;
        }
        .alert-success-custom { background: linear-gradient(135deg, #166534, #15803D); color: #FEF9C3; }
        .alert-danger-custom { background: linear-gradient(135deg, #7F1D1D, #991B1B); color: #FECACA; }
        @keyframes slideDownAlert { from { transform: translateY(-100%); opacity: 0; } to { transform: translateY(0); opacity: 1; } }

        .btn-primary-gold {
            display: inline-flex; align-items: center; gap: 8px;
            background: linear-gradient(135deg, var(--gold-500), var(--gold-600));
            color: var(--near-black); padding: 12px 28px; border-radius: var(--radius-sm);
            font-weight: 700; font-size: 14px; border: none; cursor: pointer;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            font-family: inherit;
        }
        .btn-primary-gold:hover { transform: translateY(-2px); box-shadow: var(--shadow-gold-lg); color: var(--near-black); }

        .btn-outline-gold {
            display: inline-flex; align-items: center; gap: 8px;
            background: transparent; color: var(--gold-400);
            padding: 12px 28px; border-radius: var(--radius-sm);
            font-weight: 600; font-size: 14px; border: 2px solid var(--gold-500);
            cursor: pointer; transition: all 0.3s; font-family: inherit;
        }
        .btn-outline-gold:hover { background: rgba(234,179,8,0.1); color: var(--gold-300); }

        /* Section styles */
        .section-padding { padding: 80px 0; }
        .section-head {
            text-align: center; margin-bottom: 48px;
        }
        .section-badge {
            display: inline-flex; align-items: center; gap: 6px;
            background: rgba(234,179,8,0.1); color: var(--gold-400);
            border: 1px solid rgba(234,179,8,0.2);
            padding: 6px 16px; border-radius: 99px;
            font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;
            margin-bottom: 14px;
        }
        .section-head h2 {
            font-family: 'Syne', sans-serif;
            font-size: clamp(28px, 4vw, 40px);
            font-weight: 800; color: var(--text-primary);
            margin-bottom: 12px;
        }
        .section-head p { color: var(--text-muted); font-size: 16px; max-width: 600px; margin: 0 auto; }

        /* Card Base */
        .card-dark {
            background: var(--card-dark);
            border: 1px solid var(--card-border);
            border-radius: var(--radius);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .card-dark:hover {
            border-color: rgba(234,179,8,0.3);
            box-shadow: var(--shadow-card-hover);
            transform: translateY(-4px);
        }

        /* Counter animation */
        .counter-num {
            font-family: 'Syne', sans-serif;
            font-size: 36px; font-weight: 800;
            background: linear-gradient(135deg, var(--gold-400), var(--gold-600));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1.2;
        }

        /* Reveal animation */
        .reveal-up {
            opacity: 0; transform: translateY(30px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }
        .reveal-up.visible { opacity: 1; transform: translateY(0); }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: var(--near-black); }
        ::-webkit-scrollbar-thumb { background: var(--card-border); border-radius: 99px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--gold-600); }

        @media (max-width: 768px) {
            .section-padding { padding: 50px 0; }
        }
    </style>
</head>
<body>
    <div id="pageLoader">
        <div class="loader-logo">Flexi<span>Pay</span></div>
        <div class="loader-bar"><div class="loader-bar-fill"></div></div>
    </div>
    <button id="scrollTop" onclick="window.scrollTo({top:0,behavior:'smooth'})"><i class="bi bi-chevron-up"></i></button>

    @include('frontend.partials.menu')
    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
    <script>
        window.addEventListener('load', () => {
            setTimeout(() => { document.getElementById('pageLoader').classList.add('hidden'); }, 700);
        });
        window.addEventListener('scroll', () => {
            const s = document.getElementById('scrollTop');
            window.scrollY > 400 ? s.classList.add('visible') : s.classList.remove('visible');
        });

        // Scroll Reveal
        const revealObs = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) { e.target.classList.add('visible'); revealObs.unobserve(e.target); }
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
        document.querySelectorAll('.reveal-up').forEach(el => revealObs.observe(el));

        // Counter Animation
        const counterObs = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    const el = e.target;
                    const target = parseInt(el.dataset.count);
                    if (!target) { counterObs.unobserve(el); return; }
                    const dur = 2000, step = target / (dur / 16);
                    let cur = 0;
                    const t = setInterval(() => {
                        cur += step;
                        if (cur >= target) { cur = target; clearInterval(t); }
                        el.textContent = Math.floor(cur).toLocaleString();
                    }, 16);
                    counterObs.unobserve(el);
                }
            });
        }, { threshold: 0.5 });
        document.querySelectorAll('[data-count]').forEach(el => counterObs.observe(el));
    </script>
</body>
</html>