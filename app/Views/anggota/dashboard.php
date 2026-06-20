<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — Karang Taruna Waru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --green:       #16a34a;
            --green-light: #dcfce7;
            --green-dark:  #14532d;
            --green-mid:   #22c55e;
            --sidebar-w:   260px;
            --bg:          #f0f4f0;
            --card:        #ffffff;
            --text:        #1a2e1a;
            --muted:       #6b7280;
            --border:      #e5e7eb;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            display: flex;
        }

        /* ══ SIDEBAR ══ */
        .sidebar {
            width: var(--sidebar-w);
            min-height: 100vh;
            background: var(--green-dark);
            display: flex;
            flex-direction: column;
            position: fixed;
            left: 0; top: 0;
            z-index: 100;
            overflow: hidden;
        }
        .sidebar::before {
            content: '';
            position: absolute;
            top: -80px; right: -80px;
            width: 260px; height: 260px;
            background: radial-gradient(circle, rgba(34,197,94,0.18), transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }
        .sidebar::after {
            content: '';
            position: absolute;
            bottom: -60px; left: -60px;
            width: 220px; height: 220px;
            background: radial-gradient(circle, rgba(34,197,94,0.12), transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }
        .sidebar-brand {
            padding: 28px 24px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.07);
            position: relative; z-index: 1;
        }
        .sidebar-brand .brand-logo {
            width: 42px; height: 42px;
            background: linear-gradient(135deg, var(--green-mid), var(--green));
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.2rem; color: white;
            box-shadow: 0 4px 14px rgba(34,197,94,0.4);
            margin-bottom: 12px;
        }
        .sidebar-brand .brand-name {
            font-family: 'Sora', sans-serif;
            font-weight: 700; font-size: 0.95rem;
            color: white; line-height: 1.3;
        }
        .sidebar-brand .brand-sub {
            font-size: 0.72rem; color: rgba(255,255,255,0.45);
            font-weight: 500; text-transform: uppercase; letter-spacing: 0.8px;
        }
        .sidebar-nav { flex: 1; padding: 20px 14px; position: relative; z-index: 1; }
        .nav-label {
            font-size: 0.65rem; font-weight: 700;
            text-transform: uppercase; letter-spacing: 1.2px;
            color: rgba(255,255,255,0.3);
            padding: 0 10px; margin: 16px 0 6px;
        }
        .nav-link {
            display: flex; align-items: center; gap: 11px;
            padding: 11px 14px; border-radius: 10px;
            color: rgba(255,255,255,0.65) !important;
            font-size: 0.875rem; font-weight: 500;
            text-decoration: none; transition: all 0.22s;
            margin-bottom: 2px; position: relative;
        }
        .nav-link i { font-size: 1rem; width: 18px; text-align: center; }
        .nav-link:hover { background: rgba(255,255,255,0.08); color: white !important; }
        .nav-link.active {
            background: linear-gradient(135deg, rgba(34,197,94,0.25), rgba(34,197,94,0.1));
            color: #a7f3c0 !important;
            box-shadow: inset 0 0 0 1px rgba(34,197,94,0.25);
        }
        .nav-link.active i { color: var(--green-mid); }
        .sidebar-footer {
            padding: 16px 14px;
            border-top: 1px solid rgba(255,255,255,0.07);
            position: relative; z-index: 1;
        }
        .sidebar-footer .admin-card {
            display: flex; align-items: center; gap: 10px;
            padding: 10px 12px; background: rgba(255,255,255,0.06);
            border-radius: 10px; margin-bottom: 10px;
        }
        .admin-avatar {
            width: 34px; height: 34px;
            background: linear-gradient(135deg, var(--green-mid), var(--green));
            border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.85rem; color: white; font-weight: 700;
        }
        .admin-info .name { font-size: 0.82rem; font-weight: 600; color: white; }
        .admin-info .role { font-size: 0.68rem; color: rgba(255,255,255,0.4); }
        .btn-logout {
            display: flex; align-items: center; gap: 8px;
            width: 100%; padding: 9px 14px;
            background: rgba(239,68,68,0.12); border: 1px solid rgba(239,68,68,0.2);
            border-radius: 10px; color: #fca5a5;
            font-size: 0.82rem; font-weight: 600;
            text-decoration: none; transition: all 0.2s;
        }
        .btn-logout:hover { background: rgba(239,68,68,0.22); color: #fecaca; }

        /* ══ MAIN ══ */
        .main {
            margin-left: var(--sidebar-w);
            flex: 1; min-height: 100vh;
            display: flex; flex-direction: column;
        }
        .topbar {
            background: white; border-bottom: 1px solid var(--border);
            padding: 0 32px; height: 64px;
            display: flex; align-items: center; justify-content: space-between;
            position: sticky; top: 0; z-index: 50;
        }
        .topbar-left .page-title {
            font-family: 'Sora', sans-serif;
            font-size: 1.05rem; font-weight: 700; color: var(--text);
        }
        .topbar-left .breadcrumb-text { font-size: 0.75rem; color: var(--muted); margin-top: 1px; }
        .topbar-right { display: flex; align-items: center; gap: 12px; }
        .topbar-date {
            font-size: 0.78rem; color: var(--muted);
            background: var(--bg); padding: 6px 14px; border-radius: 8px;
        }
        .notif-btn {
            width: 36px; height: 36px;
            background: var(--bg); border: none; border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
            color: var(--muted); cursor: pointer; transition: all 0.2s; position: relative;
        }
        .notif-btn:hover { background: var(--green-light); color: var(--green); }
        .notif-dot {
            position: absolute; top: 7px; right: 7px;
            width: 7px; height: 7px; background: #22c55e;
            border-radius: 50%; border: 1.5px solid white;
        }
        .content { padding: 28px 32px 40px; flex: 1; }

        /* ══ WELCOME BANNER ══ */
        .welcome-banner {
            background: linear-gradient(135deg, var(--green-dark) 0%, #166534 50%, #15803d 100%);
            border-radius: 20px; padding: 28px 32px; margin-bottom: 28px;
            position: relative; overflow: hidden;
            animation: bannerIn 0.6s cubic-bezier(.22,1,.36,1) both;
        }
        .welcome-banner::before {
            content: ''; position: absolute; top: -60px; right: -40px;
            width: 280px; height: 280px;
            background: radial-gradient(circle, rgba(255,255,255,0.07), transparent 65%);
            border-radius: 50%;
        }
        .welcome-banner::after {
            content: ''; position: absolute; bottom: -80px; right: 120px;
            width: 200px; height: 200px;
            background: radial-gradient(circle, rgba(34,197,94,0.2), transparent 65%);
            border-radius: 50%;
        }
        .welcome-banner .wt {
            font-size: 0.75rem; color: rgba(255,255,255,0.5);
            font-weight: 600; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 6px;
        }
        .welcome-banner h2 {
            font-family: 'Sora', sans-serif;
            font-size: 1.7rem; font-weight: 800; color: white;
            margin-bottom: 6px; position: relative; z-index: 1;
        }
        .welcome-banner p { color: rgba(255,255,255,0.65); font-size: 0.88rem; position: relative; z-index: 1; }
        .welcome-pills { display: flex; gap: 8px; margin-top: 16px; flex-wrap: wrap; position: relative; z-index: 1; }
        .welcome-pill {
            display: inline-flex; align-items: center; gap: 6px;
            background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.15);
            padding: 5px 14px; border-radius: 50px;
            font-size: 0.78rem; color: rgba(255,255,255,0.85); font-weight: 600;
        }
        .welcome-pill i { color: var(--green-mid); }
        @keyframes bannerIn {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ══ STAT CARDS ══ */
        .stat-cards { margin-bottom: 28px; }
        .stat-card {
            background: var(--card); border-radius: 18px; padding: 24px;
            border: 1px solid var(--border); position: relative; overflow: hidden;
            transition: all 0.3s cubic-bezier(.22,1,.36,1);
            animation: cardIn 0.5s cubic-bezier(.22,1,.36,1) both;
            height: 100%;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 16px 40px rgba(0,0,0,0.09);
            border-color: transparent;
        }
        .stat-card::after {
            content: ''; position: absolute;
            bottom: 0; left: 0; right: 0; height: 3px;
            border-radius: 0 0 18px 18px;
        }
        .stat-card.green::after  { background: linear-gradient(90deg, #16a34a, #4ade80); }
        .stat-card.blue::after   { background: linear-gradient(90deg, #2563eb, #60a5fa); }
        .stat-card.amber::after  { background: linear-gradient(90deg, #d97706, #fbbf24); }
        @keyframes cardIn {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .stat-card:nth-child(1) { animation-delay: 0.1s; }
        .stat-card:nth-child(2) { animation-delay: 0.2s; }
        .stat-card:nth-child(3) { animation-delay: 0.3s; }
        .stat-icon {
            width: 48px; height: 48px; border-radius: 13px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.3rem; margin-bottom: 16px;
        }
        .stat-icon.green { background: #dcfce7; color: #16a34a; }
        .stat-icon.blue  { background: #dbeafe; color: #2563eb; }
        .stat-icon.amber { background: #fef3c7; color: #d97706; }
        .stat-label { font-size: 0.75rem; font-weight: 700; color: var(--muted); text-transform: uppercase; letter-spacing: 0.8px; }
        .stat-value {
            font-family: 'Sora', sans-serif;
            font-size: 2.4rem; font-weight: 800; color: var(--text);
            line-height: 1; margin: 6px 0 10px; letter-spacing: -1px;
        }
        .stat-desc { font-size: 0.78rem; color: var(--muted); }
        .stat-link {
            display: inline-flex; align-items: center; gap: 5px;
            margin-top: 14px; font-size: 0.78rem; font-weight: 700;
            text-decoration: none; padding: 6px 14px; border-radius: 8px; transition: all 0.2s;
        }
        .stat-link.green { color: #16a34a; background: #dcfce7; }
        .stat-link.green:hover { background: #bbf7d0; }
        .stat-link.blue  { color: #2563eb; background: #dbeafe; }
        .stat-link.blue:hover  { background: #bfdbfe; }
        .stat-link.amber { color: #d97706; background: #fef3c7; }
        .stat-link.amber:hover { background: #fde68a; }

        /* ══ UPLOAD BAGAN (stat card kiri) ══ */
        .upload-bagan-label {
            cursor: pointer;
            background: #f0fdf4;
            border: 2px dashed #86efac;
            border-radius: 10px;
            padding: 16px 12px;
            text-align: center;
            display: block;
            transition: all 0.2s;
            position: relative;
        }
        .upload-bagan-label:hover { background: var(--green-light); border-color: var(--green); }
        .upload-bagan-label input[type="file"] {
            position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%;
        }
        .upload-bagan-label .ub-icon {
            font-size: 1.8rem; color: var(--green); display: block; margin-bottom: 6px;
        }
        .upload-bagan-label .ub-title {
            font-family: 'Sora', sans-serif;
            font-size: 0.8rem; font-weight: 700; color: var(--text); display: block; margin-bottom: 2px;
        }
        .upload-bagan-label .ub-sub { font-size: 0.68rem; color: var(--muted); display: block; }

        #previewKecilWrap {
            display: none; margin-top: 10px; border-radius: 8px; overflow: hidden;
            border: 1px solid var(--border); position: relative;
        }
        #previewKecilWrap img {
            width: 100%; max-height: 72px; object-fit: contain; background: #fafafa; display: block;
        }
        .preview-kecil-info {
            display: flex; align-items: center; gap: 6px;
            padding: 5px 8px; background: #f0fdf4;
            font-size: 0.68rem; font-weight: 700; color: var(--green);
        }
        .btn-simpan-bagan-card {
            margin-top: 12px; width: 100%; padding: 9px;
            background: linear-gradient(135deg, var(--green), var(--green-mid));
            color: white; border: none; border-radius: 9px;
            font-family: 'Sora', sans-serif; font-size: 0.8rem; font-weight: 700;
            cursor: pointer; box-shadow: 0 3px 10px rgba(22,163,74,0.3);
            transition: all 0.2s; display: flex; align-items: center; justify-content: center; gap: 7px;
        }
        .btn-simpan-bagan-card:hover {
            filter: brightness(1.08); transform: translateY(-1px);
            box-shadow: 0 5px 14px rgba(22,163,74,0.35);
        }

        /* ══ BAGAN PREVIEW BESAR + STATISTIK (pengganti 2 chart) ══ */
        .section-card {
            background: var(--card); border-radius: 18px; border: 1px solid var(--border);
            overflow: hidden; animation: cardIn 0.5s cubic-bezier(.22,1,.36,1) 0.4s both;
            height: 100%;
        }
        .section-card:last-child { animation-delay: 0.5s; }
        .section-header {
            padding: 18px 24px; border-bottom: 1px solid var(--border);
            display: flex; align-items: center; justify-content: space-between;
        }
        .section-title {
            font-family: 'Sora', sans-serif;
            font-size: 0.95rem; font-weight: 700; color: var(--text);
        }
        .section-sub { font-size: 0.72rem; color: var(--muted); margin-top: 2px; }
        .section-badge {
            font-size: 0.7rem; font-weight: 700; padding: 4px 10px; border-radius: 6px;
            background: var(--green-light); color: var(--green);
        }
        .section-body { padding: 20px 24px; }

        /* Drop zone besar */
        .drop-zone-besar {
            border: 2px dashed #86efac; border-radius: 14px; background: #f0fdf4;
            padding: 40px 20px; text-align: center; cursor: pointer; transition: all 0.2s;
            position: relative;
        }
        .drop-zone-besar:hover, .drop-zone-besar.dragover {
            background: var(--green-light); border-color: var(--green);
        }
        .drop-zone-besar input[type="file"] {
            position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%;
        }
        .dz-icon-besar {
            width: 64px; height: 64px; background: var(--green-light); border-radius: 16px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.8rem; color: var(--green); margin: 0 auto 14px;
        }
        .dz-title-besar {
            font-family: 'Sora', sans-serif;
            font-size: 0.95rem; font-weight: 700; color: var(--text); margin-bottom: 4px;
        }
        .dz-sub-besar { font-size: 0.76rem; color: var(--muted); }
        .dz-sub-besar span { color: var(--green); font-weight: 700; text-decoration: underline; }

        #previewBesarWrap { display: none; position: relative; }
        #previewBesarWrap img {
            width: 100%; max-height: 280px; object-fit: contain;
            border-radius: 12px; background: #fafafa; display: block;
            border: 1px solid var(--border);
        }
        .preview-actions {
            display: flex; gap: 8px; margin-top: 10px;
        }
        .btn-ganti-bagan {
            flex: 1; padding: 8px; border-radius: 9px;
            background: var(--green-light); color: var(--green);
            border: 1px solid #86efac; font-size: 0.78rem; font-weight: 700;
            cursor: pointer; transition: all 0.2s; position: relative;
        }
        .btn-ganti-bagan input[type="file"] {
            position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%;
        }
        .btn-ganti-bagan:hover { background: #bbf7d0; }
        .btn-hapus-bagan {
            padding: 8px 16px; border-radius: 9px;
            background: #fee2e2; color: #ef4444;
            border: 1px solid #fecaca; font-size: 0.78rem; font-weight: 700;
            cursor: pointer; transition: all 0.2s;
        }
        .btn-hapus-bagan:hover { background: #fecaca; }
        .btn-publish {
            margin-top: 12px; width: 100%; padding: 11px;
            background: linear-gradient(135deg, var(--green), var(--green-mid));
            color: white; border: none; border-radius: 11px;
            font-family: 'Sora', sans-serif; font-size: 0.88rem; font-weight: 700;
            cursor: pointer; box-shadow: 0 4px 12px rgba(22,163,74,0.3);
            transition: all 0.2s; display: flex; align-items: center; justify-content: center; gap: 8px;
        }
        .btn-publish:hover {
            filter: brightness(1.07); transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(22,163,74,0.35);
        }

        /* Mini stat (panel kanan) */
        .mini-stat {
            display: flex; align-items: center; gap: 14px;
            padding: 13px 0; border-bottom: 1px solid var(--border);
        }
        .mini-stat:last-child { border-bottom: none; padding-bottom: 0; }
        .mini-icon {
            width: 42px; height: 42px; border-radius: 11px; flex-shrink: 0;
            display: flex; align-items: center; justify-content: center; font-size: 1.1rem;
        }
        .mini-icon.green { background: #dcfce7; color: #16a34a; }
        .mini-icon.blue  { background: #dbeafe; color: #2563eb; }
        .mini-icon.amber { background: #fef3c7; color: #d97706; }
        .mini-icon.rose  { background: #ffe4e6; color: #e11d48; }
        .mini-label { font-size: 0.72rem; color: var(--muted); font-weight: 600; }
        .mini-value {
            font-family: 'Sora', sans-serif;
            font-size: 1.4rem; font-weight: 800; color: var(--text); line-height: 1.1;
        }
        .mini-badge {
            margin-left: auto; font-size: 0.68rem; font-weight: 700;
            padding: 3px 9px; border-radius: 6px; white-space: nowrap;
        }
        .mini-badge.green { background: #dcfce7; color: #16a34a; }
        .mini-badge.blue  { background: #dbeafe; color: #2563eb; }
        .mini-badge.amber { background: #fef3c7; color: #d97706; }
        .mini-badge.rose  { background: #ffe4e6; color: #e11d48; }

        /* Milestone bar */
        .milestone-bar {
            margin-top: 16px; padding-top: 16px;
            border-top: 1px solid var(--border);
        }
        .milestone-label { font-size: 0.72rem; color: var(--muted); font-weight: 700; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.7px; }
        .progress-wrap { background: #f3f4f6; border-radius: 50px; height: 8px; overflow: hidden; }
        .progress-fill {
            height: 100%; border-radius: 50px;
            background: linear-gradient(90deg, var(--green), var(--green-mid));
            transition: width 1.2s cubic-bezier(.22,1,.36,1);
        }
        .milestone-note { font-size: 0.7rem; color: var(--muted); margin-top: 5px; }

        /* ══ ACTIVITY + QUICK ACCESS ══ */
        .activity-card {
            background: var(--card); border-radius: 18px; border: 1px solid var(--border);
            animation: cardIn 0.5s cubic-bezier(.22,1,.36,1) 0.45s both;
        }
        .activity-header {
            padding: 20px 24px; border-bottom: 1px solid var(--border);
            display: flex; align-items: center; justify-content: space-between;
        }
        .activity-title {
            font-family: 'Sora', sans-serif;
            font-size: 0.95rem; font-weight: 700; color: var(--text);
        }
        .activity-item {
            display: flex; align-items: flex-start; gap: 14px;
            padding: 14px 24px; border-bottom: 1px solid var(--border); transition: background 0.15s;
        }
        .activity-item:last-child { border-bottom: none; }
        .activity-item:hover { background: #fafafa; }
        .activity-dot {
            width: 36px; height: 36px; border-radius: 10px; flex-shrink: 0;
            display: flex; align-items: center; justify-content: center; font-size: 0.9rem;
        }
        .activity-dot.green  { background: #dcfce7; color: #16a34a; }
        .activity-dot.blue   { background: #dbeafe; color: #2563eb; }
        .activity-dot.amber  { background: #fef3c7; color: #d97706; }
        .activity-text { font-size: 0.82rem; color: var(--text); font-weight: 500; line-height: 1.5; }
        .activity-time { font-size: 0.72rem; color: var(--muted); margin-top: 2px; }
        .chart-badge {
            font-size: 0.7rem; font-weight: 700; padding: 4px 10px; border-radius: 6px;
            background: var(--green-light); color: var(--green);
        }
        .quick-card {
            background: var(--card); border-radius: 18px; border: 1px solid var(--border);
            padding: 22px 24px; animation: cardIn 0.5s cubic-bezier(.22,1,.36,1) 0.5s both;
        }
        .quick-title {
            font-family: 'Sora', sans-serif;
            font-size: 0.95rem; font-weight: 700; color: var(--text); margin-bottom: 16px;
        }
        .quick-btn {
            display: flex; align-items: center; gap: 12px; padding: 12px 16px;
            border-radius: 12px; text-decoration: none;
            font-size: 0.83rem; font-weight: 600; transition: all 0.2s;
            margin-bottom: 8px; border: 1px solid transparent;
        }
        .quick-btn .qicon {
            width: 34px; height: 34px; border-radius: 9px; flex-shrink: 0;
            display: flex; align-items: center; justify-content: center; font-size: 0.95rem;
        }
        .quick-btn.green { color: #15803d; background: #f0fdf4; border-color: #dcfce7; }
        .quick-btn.green:hover { background: #dcfce7; }
        .quick-btn.green .qicon { background: #dcfce7; color: #16a34a; }
        .quick-btn.blue  { color: #1d4ed8; background: #eff6ff; border-color: #dbeafe; }
        .quick-btn.blue:hover  { background: #dbeafe; }
        .quick-btn.blue .qicon  { background: #dbeafe; color: #2563eb; }
        .quick-btn.amber { color: #92400e; background: #fffbeb; border-color: #fef3c7; }
        .quick-btn.amber:hover { background: #fef3c7; }
        .quick-btn.amber .qicon { background: #fef3c7; color: #d97706; }
        .quick-btn .qarrow { margin-left: auto; color: inherit; opacity: 0.5; font-size: 0.8rem; }
    </style>
</head>
<body>

<!-- ══════════════ SIDEBAR ══════════════ -->
<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-logo"><i class="bi bi-flower2"></i></div>
        <div class="brand-name">Karang Taruna</div>
        <div class="brand-sub">Desa Waru</div>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-label">Menu Utama</div>
        <a href="<?= site_url('dashboard') ?>" class="nav-link active">
            <i class="bi bi-grid-1x2-fill"></i> Dashboard
        </a>
        <a href="<?= site_url('anggota') ?>" class="nav-link">
            <i class="bi bi-people-fill"></i> Data Anggota
        </a>
        <a href="<?= site_url('admin/kegiatan') ?>" class="nav-link">
            <i class="bi bi-calendar-event-fill"></i> Kegiatan
        </a>
        <a href="<?= site_url('umkm') ?>" class="nav-link">
            <i class="bi bi-shop-window"></i> UMKM
        </a>
        <a href="<?= site_url('admin/events') ?>" class="nav-link">
            <i class="bi bi-megaphone-fill"></i> Data Event
        </a>

        <div class="nav-label">Lainnya</div>
        <a href="<?= site_url('/') ?>" class="nav-link" target="_blank">
            <i class="bi bi-box-arrow-up-right"></i> Lihat Website
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="admin-card">
            <div class="admin-avatar">A</div>
            <div class="admin-info">
                <div class="name">Admin</div>
                <div class="role">Administrator</div>
            </div>
        </div>
        <a href="<?= site_url('logout') ?>" class="btn-logout">
            <i class="bi bi-box-arrow-left"></i> Keluar
        </a>
    </div>
</aside>

<!-- ══════════════ MAIN ══════════════ -->
<div class="main">

    <!-- TOPBAR -->
    <header class="topbar">
        <div class="topbar-left">
            <div class="page-title">Dashboard</div>
            <div class="breadcrumb-text">Karang Taruna Waru &rsaquo; Dashboard</div>
        </div>
        <div class="topbar-right">
            <div class="topbar-date">
                <i class="bi bi-calendar3 me-1"></i>
                <span id="tanggalHari"></span>
            </div>
            <button class="notif-btn">
                <i class="bi bi-bell-fill"></i>
                <span class="notif-dot"></span>
            </button>
        </div>
    </header>

    <!-- CONTENT -->
    <div class="content">

        <!-- WELCOME BANNER -->
        <div class="welcome-banner">
            <div class="wt">Selamat Datang Kembali 👋</div>
            <h2>Halo, Admin!</h2>
            <p>Pantau dan kelola data Karang Taruna Desa Waru dari sini.</p>
            <div class="welcome-pills">
                <span class="welcome-pill"><i class="bi bi-people-fill"></i> <?= $totalAnggota ?> Anggota</span>
                <span class="welcome-pill"><i class="bi bi-calendar-check-fill"></i> <?= $totalKegiatan ?? 0 ?> Kegiatan</span>
                <span class="welcome-pill"><i class="bi bi-shop"></i> <?= $totalUmkm ?? 0 ?> UMKM</span>
            </div>
        </div>

        <!-- STAT CARDS -->
        <div class="row g-3 stat-cards">

            <!-- Card 1: Upload Bagan Struktur -->
            <div class="col-md-4">
                <div class="stat-card green" style="padding: 20px 22px;">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div>
                            <div class="stat-label mb-1">Struktur Organisasi</div>
                            <div style="font-family:'Sora',sans-serif; font-size:0.83rem; font-weight:700; color:var(--text);">
                                Upload Bagan Struktur
                            </div>
                        </div>
                        <div class="stat-icon green" style="margin-bottom:0; flex-shrink:0;">
                            <i class="bi bi-diagram-3-fill"></i>
                        </div>
                    </div>

                    <form action="<?= site_url('struktur/upload') ?>" method="post" enctype="multipart/form-data" id="formBagan">
                        <?= csrf_field() ?>

                        <label class="upload-bagan-label" id="dropKecil">
                            <input type="file" name="gambar_bagan" id="inputBagan" accept="image/*"
                                   onchange="handlePilihBagan(this)">
                            <i class="bi bi-image-fill ub-icon"></i>
                            <span class="ub-title" id="ubTitle">Pilih atau seret gambar</span>
                            <span class="ub-sub">PNG, JPG, WEBP · maks. 5MB</span>
                        </label>

                        <div id="previewKecilWrap">
                            <img id="previewKecilImg" src="#" alt="preview">
                            <div class="preview-kecil-info">
                                <i class="bi bi-check-circle-fill"></i>
                                <span id="namaFileKecil"></span>
                            </div>
                        </div>

                        <button type="submit" class="btn-simpan-bagan-card">
                            <i class="bi bi-cloud-upload-fill"></i>
                            Simpan &amp; Publikasikan
                        </button>
                    </form>

                    <?php if (!empty($baganAktif)): ?>
                    <div style="margin-top:14px; padding-top:14px; border-top:1px solid var(--border);">
                        <div style="font-size:0.68rem; font-weight:700; color:var(--muted); text-transform:uppercase; letter-spacing:0.7px; margin-bottom:6px;">
                            Bagan Aktif Sekarang
                        </div>
                        <img src="<?= base_url('uploads/struktur/' . $baganAktif) ?>"
                             alt="Bagan Aktif"
                             style="width:100%; border-radius:8px; border:1px solid var(--border);
                                    object-fit:contain; max-height:64px; background:#fafafa;">
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Card 2: Total Kegiatan -->
            <div class="col-md-4">
                <div class="stat-card blue">
                    <div class="stat-icon blue"><i class="bi bi-calendar-event-fill"></i></div>
                    <div class="stat-label">Total Kegiatan</div>
                    <div class="stat-value" data-target="<?= $totalKegiatan ?? 0 ?>">0</div>
                    <div class="stat-desc">Kegiatan yang tercatat</div>
                    <a href="<?= site_url('admin/kegiatan') ?>" class="stat-link blue">
                        Kelola <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>

            <!-- Card 3: Total UMKM -->
            <div class="col-md-4">
                <div class="stat-card amber">
                    <div class="stat-icon amber"><i class="bi bi-shop-window"></i></div>
                    <div class="stat-label">Total UMKM</div>
                    <div class="stat-value" data-target="<?= $totalUmkm ?? 0 ?>">0</div>
                    <div class="stat-desc">UMKM binaan aktif</div>
                    <a href="<?= site_url('umkm') ?>" class="stat-link amber">
                        Kelola <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="row g-3 mb-4">

            <!-- KIRI: Pratinjau bagan besar -->
            <div class="col-lg-7">
                <div class="section-card">
                    <div class="section-header">
                        <div>
                            <div class="section-title">Pratinjau Bagan Struktur</div>
                            <div class="section-sub">Tampilan bagan yang akan terlihat di halaman publik</div>
                        </div>
                        <span class="section-badge"><i class="bi bi-diagram-3 me-1"></i>Struktur</span>
                    </div>
                    <div class="section-body">

                        <?php if (!empty($baganAktif)): ?>
                        <div id="previewBesarWrap" style="display:block;">
                            <img id="previewBesarImg"
                                 src="<?= base_url('uploads/struktur/' . $baganAktif) ?>"
                                 alt="Bagan Struktur Aktif">
                            <div class="preview-actions">
                                <label class="btn-ganti-bagan">
                                    <input type="file" accept="image/*" onchange="gantiPreviewBesar(this)">
                                    <i class="bi bi-arrow-repeat me-1"></i> Ganti Gambar
                                </label>
                            </div>
                        </div>
                        <div id="dropZoneBesar" style="display:none;"
                             class="drop-zone-besar"
                             ondragover="event.preventDefault(); this.classList.add('dragover')"
                             ondragleave="this.classList.remove('dragover')"
                             ondrop="handleDropBesar(event)">
                            <input type="file" accept="image/*" onchange="previewBesarDariDrop(this)">
                            <div class="dz-icon-besar"><i class="bi bi-image"></i></div>
                            <div class="dz-title-besar">Upload Bagan Struktur</div>
                            <div class="dz-sub-besar">Seret gambar ke sini atau <span>pilih file</span></div>
                        </div>
                        <?php else: ?>
                        <div id="dropZoneBesar" class="drop-zone-besar"
                             ondragover="event.preventDefault(); this.classList.add('dragover')"
                             ondragleave="this.classList.remove('dragover')"
                             ondrop="handleDropBesar(event)">
                            <input type="file" accept="image/*" onchange="previewBesarDariDrop(this)">
                            <div class="dz-icon-besar"><i class="bi bi-image"></i></div>
                            <div class="dz-title-besar">Upload Bagan Struktur</div>
                            <div class="dz-sub-besar">Seret gambar ke sini atau <span>pilih file</span></div>
                        </div>
                        <div id="previewBesarWrap">
                            <img id="previewBesarImg" src="#" alt="Preview">
                            <div class="preview-actions">
                                <label class="btn-ganti-bagan">
                                    <input type="file" accept="image/*" onchange="gantiPreviewBesar(this)">
                                    <i class="bi bi-arrow-repeat me-1"></i> Ganti Gambar
                                </label>
                                <button type="button" class="btn-hapus-bagan" onclick="hapusPreviewBesar()">
                                    <i class="bi bi-trash me-1"></i> Hapus
                                </button>
                            </div>
                        </div>
                        <?php endif; ?>

                        <button type="button" class="btn-publish" onclick="document.getElementById('formBagan').submit()">
                            <i class="bi bi-cloud-upload-fill"></i>
                            Simpan &amp; Publikasikan Bagan
                        </button>

                    </div>
                </div>
            </div>

            <!-- KANAN: Ringkasan statistik -->
            <div class="col-lg-5">
                <div class="section-card">
                    <div class="section-header">
                        <div>
                            <div class="section-title">Ringkasan Organisasi</div>
                            <div class="section-sub">Data terkini Karang Taruna Waru</div>
                        </div>
                        <span class="section-badge"><i class="bi bi-bar-chart-fill me-1"></i>Statistik</span>
                    </div>
                    <div class="section-body">

                        <div class="mini-stat">
                            <div class="mini-icon green"><i class="bi bi-people-fill"></i></div>
                            <div>
                                <div class="mini-label">Total Anggota</div>
                                <div class="mini-value"><?= $totalAnggota ?></div>
                            </div>
                            <span class="mini-badge green">Aktif</span>
                        </div>

                        <div class="mini-stat">
                            <div class="mini-icon blue"><i class="bi bi-calendar-event-fill"></i></div>
                            <div>
                                <div class="mini-label">Total Kegiatan</div>
                                <div class="mini-value"><?= $totalKegiatan ?? 0 ?></div>
                            </div>
                            <span class="mini-badge blue">Tercatat</span>
                        </div>

                        <div class="mini-stat">
                            <div class="mini-icon amber"><i class="bi bi-shop-window"></i></div>
                            <div>
                                <div class="mini-label">UMKM Binaan</div>
                                <div class="mini-value"><?= $totalUmkm ?? 0 ?></div>
                            </div>
                            <span class="mini-badge amber">Binaan</span>
                        </div>

                        <div class="mini-stat">
                            <div class="mini-icon rose"><i class="bi bi-award-fill"></i></div>
                            <div>
                                <div class="mini-label">Usia Organisasi</div>
                                <div class="mini-value"><?= date('Y') - 2010 ?> Tahun</div>
                            </div>
                            <span class="mini-badge rose">Sejak 2010</span>
                        </div>

                        <div class="milestone-bar">
                            <div class="milestone-label">Target Anggota Tahun Ini</div>
                            <?php
                                $target = 50;
                                $pct = min(100, round(($totalAnggota / $target) * 100));
                            ?>
                            <div class="progress-wrap">
                                <div class="progress-fill" id="progressFill" style="width: 0%"></div>
                            </div>
                            <div class="milestone-note">
                                <strong><?= $totalAnggota ?></strong> dari
                                <strong><?= $target ?></strong> anggota
                                &nbsp;·&nbsp; <strong><?= $pct ?>%</strong> tercapai
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

        <!-- BOTTOM ROW -->
        <div class="row g-3">
            <!-- ACTIVITY -->
            <div class="col-lg-8">
                <div class="activity-card">
                    <div class="activity-header">
                        <div class="activity-title">Aktivitas Terkini</div>
                        <span class="chart-badge">Live</span>
                    </div>
                    <div class="activity-item">
                        <div class="activity-dot green"><i class="bi bi-people-fill"></i></div>
                        <div>
                            <div class="activity-text">Total <strong><?= $totalAnggota ?> anggota</strong> terdaftar di sistem</div>
                            <div class="activity-time"><i class="bi bi-clock me-1"></i>Data terkini</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-dot blue"><i class="bi bi-calendar-event-fill"></i></div>
                        <div>
                            <div class="activity-text"><strong><?= $totalKegiatan ?? 0 ?> kegiatan</strong> telah diselenggarakan</div>
                            <div class="activity-time"><i class="bi bi-clock me-1"></i>Data terkini</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-dot amber"><i class="bi bi-shop-window"></i></div>
                        <div>
                            <div class="activity-text"><strong><?= $totalUmkm ?? 0 ?> UMKM</strong> aktif terdaftar sebagai binaan</div>
                            <div class="activity-time"><i class="bi bi-clock me-1"></i>Data terkini</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-dot green"><i class="bi bi-calendar3"></i></div>
                        <div>
                            <div class="activity-text">Karang Taruna Desa Waru berdiri sejak <strong>2010</strong> — sudah <strong><?= date('Y') - 2010 ?> tahun</strong> berkarya</div>
                            <div class="activity-time"><i class="bi bi-award me-1"></i>Milestone</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- QUICK ACCESS -->
            <div class="col-lg-4">
                <div class="quick-card">
                    <div class="quick-title">Akses Cepat</div>
                    <a href="<?= site_url('anggota') ?>" class="quick-btn green">
                        <div class="qicon"><i class="bi bi-person-plus-fill"></i></div>
                        <span>Tambah Anggota</span>
                        <i class="bi bi-chevron-right qarrow"></i>
                    </a>
                    <a href="<?= site_url('admin/kegiatan') ?>" class="quick-btn blue">
                        <div class="qicon"><i class="bi bi-calendar-plus-fill"></i></div>
                        <span>Tambah Kegiatan</span>
                        <i class="bi bi-chevron-right qarrow"></i>
                    </a>
                    <a href="<?= site_url('umkm') ?>" class="quick-btn amber">
                        <div class="qicon"><i class="bi bi-bag-plus-fill"></i></div>
                        <span>Tambah UMKM</span>
                        <i class="bi bi-chevron-right qarrow"></i>
                    </a>
                    <a href="<?= site_url('/') ?>" class="quick-btn green" target="_blank" style="margin-top:4px;">
                        <div class="qicon"><i class="bi bi-globe2"></i></div>
                        <span>Lihat Website Publik</span>
                        <i class="bi bi-chevron-right qarrow"></i>
                    </a>
                </div>
            </div>
        </div>

    </div><!-- /content -->
</div><!-- /main -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// ── TANGGAL ──
const hari = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
const bulanNama = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
const now = new Date();
document.getElementById('tanggalHari').textContent =
    hari[now.getDay()] + ', ' + now.getDate() + ' ' + bulanNama[now.getMonth()] + ' ' + now.getFullYear();

// ── COUNTER ANIMATION ──
document.querySelectorAll('.stat-value[data-target]').forEach(el => {
    const target = parseInt(el.dataset.target);
    const duration = 1400;
    const step = target / (duration / 16);
    let current = 0;
    const timer = setInterval(() => {
        current += step;
        if (current >= target) { el.textContent = target; clearInterval(timer); }
        else el.textContent = Math.floor(current);
    }, 16);
});

// ── PROGRESS BAR MILESTONE ──
setTimeout(() => {
    const pf = document.getElementById('progressFill');
    if (pf) pf.style.width = '<?= $pct ?>%';
}, 300);

// ── SINKRONISASI: pilih file → update kedua preview ──
function syncFile(file) {
    if (!file || !file.type.startsWith('image/')) return;
    const dt = new DataTransfer();
    dt.items.add(file);
    document.getElementById('inputBagan').files = dt.files;

    const reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById('previewKecilImg').src = e.target.result;
        document.getElementById('previewKecilWrap').style.display = 'block';
        const nama = file.name;
        document.getElementById('namaFileKecil').textContent = nama.length > 24 ? nama.substring(0,24)+'…' : nama;
        document.getElementById('ubTitle').textContent = 'File dipilih ✓';

        document.getElementById('previewBesarImg').src = e.target.result;
        document.getElementById('previewBesarWrap').style.display = 'block';
        const dz = document.getElementById('dropZoneBesar');
        if (dz) dz.style.display = 'none';
    };
    reader.readAsDataURL(file);
}

function handlePilihBagan(input) {
    if (input.files && input.files[0]) syncFile(input.files[0]);
}
function previewBesarDariDrop(input) {
    if (input.files && input.files[0]) syncFile(input.files[0]);
}
function gantiPreviewBesar(input) {
    if (input.files && input.files[0]) syncFile(input.files[0]);
}
function hapusPreviewBesar() {
    document.getElementById('previewBesarWrap').style.display = 'none';
    document.getElementById('previewKecilWrap').style.display = 'none';
    document.getElementById('ubTitle').textContent = 'Pilih atau seret gambar';
    document.getElementById('inputBagan').value = '';
    const dz = document.getElementById('dropZoneBesar');
    if (dz) dz.style.display = 'block';
}
function handleDropBesar(event) {
    event.preventDefault();
    event.currentTarget.classList.remove('dragover');
    const file = event.dataTransfer.files[0];
    if (file) syncFile(file);
}
</script>
</body>
</html>