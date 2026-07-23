<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>FlexiPay — @yield('title', 'Account')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Syne:wght@500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --gold-400: #FACC15;
            --gold-500: #EAB308;
            --gold-600: #CA8A04;
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
            --radius-sm: 8px;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Space Grotesk', sans-serif;
            background: linear-gradient(135deg, #0A0A0B 0%, #121214 50%, #0A0A0B 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        a { text-decoration: none; }
        ::selection { background: var(--gold-500); color: var(--near-black); }

        .fp-auth-nav {
            width: 100%;
            background: rgba(18,18,20,0.9);
            backdrop-filter: blur(12px);
            padding: 14px 24px;
            border-bottom: 2px solid var(--gold-500);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .fp-auth-brand { display: flex; align-items: center; gap: 10px; }
        .fp-auth-brand-icon {
            width: 38px; height: 38px; border-radius: 10px;
            background: linear-gradient(135deg, var(--gold-500), var(--gold-600));
            display: flex; align-items: center; justify-content: center;
            color: var(--near-black); font-size: 18px;
        }
        .fp-auth-brand span { font-family: 'Syne', sans-serif; font-size: 20px; font-weight: 800; color: var(--text-primary); }
        .fp-auth-brand span span { color: var(--gold-500); }
        .fp-auth-home {
            color: var(--text-muted);
            font-weight: 600;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: color 0.2s;
        }
        .fp-auth-home:hover { color: var(--gold-400); }
    </style>
</head>
<body>
    <nav class="fp-auth-nav" aria-label="Site navigation">
        <a href="{{ url('/') }}" class="fp-auth-brand">
            <div class="fp-auth-brand-icon"><i class="bi bi-currency-exchange"></i></div>
            <span>Flexi<span>Pay</span></span>
        </a>
        <a href="{{ url('/') }}" class="fp-auth-home">
            <i class="bi bi-house-fill"></i> Back to Home
        </a>
    </nav>
    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>