<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Helphub — Admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@600;700;800&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
<style>
:root{
  --bg:#0e0e12;
  --surface:#16161d;
  --panel:#1c1c26;
  --border:rgba(255,255,255,0.07);
  --border-hover:rgba(255,255,255,0.13);
  --orange:#ff6a00;
  --pink:#ee0979;
  --violet:#7c3aed;
  --gradient:linear-gradient(135deg,#ff6a00,#ee0979);
  --gradient-soft:linear-gradient(135deg,rgba(255,106,0,0.15),rgba(238,9,121,0.08));
  --text:#f0f0f0;
  --muted:#606070;
  --sub:#9898a8;
  --radius:16px;
  --radius-sm:10px;
  --transition:all 0.22s cubic-bezier(0.4,0,0.2,1);
}

*{margin:0;box-sizing:border-box;}

body{
  font-family:'DM Sans',sans-serif;
  background:var(--bg);
  color:var(--text);
  height:100vh;
  overflow:hidden;
}

/* ─── SCROLLBAR ─── */
::-webkit-scrollbar{width:4px}
::-webkit-scrollbar-track{background:transparent}
::-webkit-scrollbar-thumb{background:#ff6a0040;border-radius:99px}

/* ─── LAYOUT ─── */
.wrapper{display:flex;height:100vh;}

/* ─── SIDEBAR ─── 
.sidebar{
  width:235px;
  background:var(--surface);
  border-right:1px solid var(--border);
  padding:22px 14px;
  display:flex;
  flex-direction:column;
  flex-shrink:0;
  position:relative;
  z-index:10;
}

/* glow line on right edge 
.sidebar::after{
  content:'';
  position:absolute;
  right:-1px;top:20%;bottom:20%;
  width:1px;
  background:linear-gradient(180deg,transparent,#ff6a0055,transparent);
}*/

.sidebar {
  width: 235px;
  background: var(--surface);
  border-right: 1px solid var(--border);
  padding: 22px 14px;
  display: flex;
  flex-direction: column;
  flex-shrink: 0;
  position: relative;
  z-index: 10;
  overflow-y: auto;  /* ADD THIS — makes sidebar scrollable */
}

.menu a.logout {
  margin-top: 0;  /* CHANGE auto → 0 */
  color: #ff4d4d;
  font-weight: 600;
}
.logo{
  display:flex;
  align-items:center;
  gap:10px;
  margin-bottom:30px;
  padding:0 6px;
}

.logo-icon{
  width:34px;height:34px;
  border-radius:10px;
  background:var(--gradient);
  display:flex;align-items:center;justify-content:center;
  flex-shrink:0;
  box-shadow:0 4px 16px rgba(255,106,0,0.35);
}

.logo-icon svg{width:16px;height:16px;fill:#fff;}

.logo-text{
  font-family:'Syne',sans-serif;
  font-size:17px;font-weight:800;
  color:#fff;letter-spacing:0.3px;
}

.menu-section{
  font-size:10px;
  font-weight:600;
  color:var(--muted);
  letter-spacing:1.2px;
  text-transform:uppercase;
  padding:0 10px;
  margin:10px 0 6px;
}

.menu{display:flex;flex-direction:column;gap:2px;flex:1;}

.menu a{
  display:flex;align-items:center;gap:11px;
  padding:11px 14px;
  border-radius:var(--radius-sm);
  color:var(--sub);
  text-decoration:none;
  font-size:13.5px;font-weight:500;
  transition:var(--transition);
  position:relative;
}

.menu a .nav-icon{
  width:32px;height:32px;
  border-radius:8px;
  background:rgba(255,255,255,0.04);
  display:flex;align-items:center;justify-content:center;
  flex-shrink:0;
  transition:var(--transition);
}

.menu a .nav-icon svg{width:15px;height:15px;stroke:currentColor;fill:none;stroke-width:1.8;}

.menu a:hover{color:#ddd;background:rgba(255,255,255,0.04);}
.menu a:hover .nav-icon{background:rgba(255,106,0,0.1);}

.menu a.active{
  color:#fff;
  background:var(--gradient-soft);
  border:1px solid rgba(255,106,0,0.18);
}
.menu a.active .nav-icon{
  background:var(--gradient);
  box-shadow:0 4px 12px rgba(255,106,0,0.3);
  color:#fff;
}
.menu a.active::before{
  content:'';
  position:absolute;right:0;top:50%;transform:translateY(-50%);
  width:3px;height:60%;
  background:var(--gradient);
  border-radius:99px;
}

.menu a.logout{margin-top:auto;color:#ff4d4d;}
.menu a.logout .nav-icon{background:rgba(255,77,77,0.08);}
.menu a.logout:hover{background:rgba(255,77,77,0.08);color:#ff6666;}

/* ─── MAIN ─── */
.main{flex:1;display:flex;flex-direction:column;overflow:hidden;min-width:0;}

/* ─── TOPBAR ─── */
.topbar{
  height:66px;
  background:var(--surface);
  border-bottom:1px solid var(--border);
  display:flex;align-items:center;
  justify-content:space-between;
  padding:0 26px;
  flex-shrink:0;
  gap:16px;
}

.topbar-left h3{
  font-family:'Syne',sans-serif;
  font-size:17px;font-weight:700;
  color:#fff;
}

.topbar-left p{font-size:12px;color:var(--muted);margin-top:1px;}

.search-box{
  flex:1;max-width:340px;
  display:flex;align-items:center;gap:10px;
  background:var(--panel);
  border:1px solid var(--border);
  border-radius:99px;
  padding:9px 18px;
  transition:var(--transition);
}

.search-box:focus-within{border-color:rgba(255,106,0,0.35);}

.search-box svg{width:15px;height:15px;stroke:var(--muted);fill:none;flex-shrink:0;}

.search-box input{
  background:none;border:none;outline:none;
  font-family:'DM Sans',sans-serif;
  font-size:13px;color:var(--text);
  width:100%;
}
.search-box input::placeholder{color:var(--muted);}

.topbar-right{display:flex;align-items:center;gap:10px;}

.icon-btn{
  width:38px;height:38px;
  border-radius:var(--radius-sm);
  background:var(--panel);
  border:1px solid var(--border);
  display:flex;align-items:center;justify-content:center;
  cursor:pointer;
  position:relative;
  transition:var(--transition);
}
.icon-btn:hover{border-color:var(--border-hover);background:rgba(255,106,0,0.08);}
.icon-btn svg{width:16px;height:16px;stroke:var(--sub);fill:none;stroke-width:1.8;}

.notif-badge{
  position:absolute;top:7px;right:7px;
  width:7px;height:7px;
  border-radius:50%;
  background:var(--orange);
  border:1.5px solid var(--surface);
}

.avatar-wrap{
  display:flex;align-items:center;gap:9px;
  padding:5px 12px 5px 5px;
  border-radius:99px;
  background:var(--panel);
  border:1px solid var(--border);
  cursor:pointer;
  transition:var(--transition);
}
.avatar-wrap:hover{border-color:var(--border-hover);}

.avatar{
  width:32px;height:32px;
  border-radius:50%;
  object-fit:cover;
  border:2px solid var(--orange);
}

.avatar-info span{display:block;}
.avatar-name{font-size:12.5px;font-weight:600;color:#fff;}
.avatar-role{font-size:10.5px;color:var(--muted);}

/* ─── PROFILE DROPDOWN ─── */
.profile{
  position:absolute;top:76px;right:26px;
  background:var(--panel);
  border:1px solid var(--border);
  border-radius:var(--radius);
  padding:18px;width:200px;
  box-shadow:0 20px 60px rgba(0,0,0,0.5);
  display:none;z-index:300;
}
.profile b{color:#fff;font-size:14px;}
.profile small{color:var(--muted);font-size:12px;}

/* ─── CONTENT ─── */
.content{
  padding:22px 26px;
  overflow-y:auto;
  flex:1;
}

/* ─── PAGE HEADER ─── */
.page-header{
  display:flex;align-items:center;
  justify-content:space-between;
  margin-bottom:20px;
}
.page-header h2{
  font-family:'Syne',sans-serif;
  font-size:20px;font-weight:700;color:#fff;
}
.page-header .date-badge{
  font-size:12px;color:var(--sub);
  background:var(--panel);
  border:1px solid var(--border);
  padding:6px 14px;border-radius:99px;
}

/* ─── STAT GRID ─── */
.grid4{
  display:grid;
  grid-template-columns:repeat(4,1fr);
  gap:16px;
}

.stat{
  background:var(--panel);
  border:1px solid var(--border);
  border-radius:var(--radius);
  padding:20px;
  position:relative;
  overflow:hidden;
  transition:var(--transition);
  cursor:default;
}
.stat:hover{border-color:var(--border-hover);transform:translateY(-2px);}

.stat-glow{
  position:absolute;top:-40px;right:-40px;
  width:120px;height:120px;
  border-radius:50%;
  background:radial-gradient(circle,rgba(255,106,0,0.12),transparent 70%);
  pointer-events:none;
}

.stat-top{
  display:flex;align-items:center;
  justify-content:space-between;
  margin-bottom:14px;
}

.stat-label{
  font-size:11px;font-weight:600;
  color:var(--muted);
  text-transform:uppercase;
  letter-spacing:0.8px;
}

.stat-badge{
  width:36px;height:36px;
  border-radius:10px;
  display:flex;align-items:center;justify-content:center;
}
.stat-badge svg{width:16px;height:16px;fill:none;stroke:currentColor;stroke-width:1.8;}
.badge-orange{background:rgba(255,106,0,0.15);color:var(--orange);}
.badge-pink{background:rgba(238,9,121,0.15);color:var(--pink);}
.badge-violet{background:rgba(124,58,237,0.15);color:var(--violet);}
.badge-green{background:rgba(34,197,94,0.15);color:#22c55e;}

.stat h2{
  font-family:'Syne',sans-serif;
  font-size:28px;font-weight:800;
  color:#fff;line-height:1;
  margin-bottom:5px;
}

.stat-meta{
  display:flex;align-items:center;gap:6px;
  font-size:11.5px;color:var(--muted);
}
.stat-up{color:#22c55e;}
.stat-down{color:var(--pink);}

/* ─── MAIN GRID ─── */
.grid2{
  display:grid;
  grid-template-columns:2fr 1fr;
  gap:16px;
  margin-top:18px;
}
.grid2eq{
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:16px;
  margin-top:18px;
}

/* ─── PANEL CARD ─── */
.card{
  background:var(--panel);
  border:1px solid var(--border);
  border-radius:var(--radius);
  padding:22px;
  transition:var(--transition);
}
.card:hover{border-color:var(--border-hover);}

.card-header{
  display:flex;align-items:center;
  justify-content:space-between;
  margin-bottom:18px;
}
.card-title{
  font-family:'Syne',sans-serif;
  font-size:14px;font-weight:700;color:#fff;
}
.card-badge{
  font-size:11px;color:var(--orange);
  background:rgba(255,106,0,0.1);
  border:1px solid rgba(255,106,0,0.2);
  padding:4px 10px;border-radius:99px;
}

/* ─── TABLE ─── */
table{width:100%;border-collapse:collapse;}
thead tr{border-bottom:1px solid var(--border);}
th{
  font-size:10.5px;font-weight:600;
  color:var(--muted);
  text-transform:uppercase;
  letter-spacing:0.7px;
  padding:0 10px 10px;
  text-align:left;
}
td{
  padding:11px 10px;
  font-size:13px;color:var(--sub);
  vertical-align:middle;
}
tbody tr{transition:var(--transition);}
tbody tr:hover td{color:#ddd;background:rgba(255,255,255,0.02);}
tbody tr:not(:last-child) td{border-bottom:1px solid var(--border);}

.status-pill{
  display:inline-flex;align-items:center;gap:5px;
  padding:4px 10px;
  border-radius:99px;
  font-size:11px;font-weight:600;
}
.status-confirmed{background:rgba(34,197,94,0.12);color:#22c55e;}
.status-pending{background:rgba(255,106,0,0.12);color:var(--orange);}
.status-rejected{background:rgba(238,9,121,0.12);color:var(--pink);}
.status-dot{width:5px;height:5px;border-radius:50%;background:currentColor;}

/* ─── CHART ─── */
.chart{
  height:160px;
  display:flex;align-items:flex-end;gap:8px;
  padding:0 2px;
}
.bar{
  flex:1;
  background:var(--gradient);
  border-radius:6px 6px 0 0;
  animation:growUp 0.7s ease both;
  cursor:pointer;
  transition:opacity 0.2s;
  position:relative;
}
.bar:hover{opacity:0.75;}
.bar[data-label]::after{
  content:attr(data-label);
  position:absolute;bottom:-20px;left:50%;transform:translateX(-50%);
  font-size:9px;color:var(--muted);white-space:nowrap;
}
@keyframes growUp{
  from{transform:scaleY(0);transform-origin:bottom;}
  to{transform:scaleY(1);transform-origin:bottom;}
}

/* ─── QUICK ACTIONS ─── */
.action-btn{
  display:flex;align-items:center;gap:12px;
  width:100%;padding:13px 16px;
  border:none;border-radius:var(--radius-sm);
  background:rgba(255,255,255,0.04);
  border:1px solid var(--border);
  color:var(--sub);
  font-family:'DM Sans',sans-serif;
  font-size:13px;font-weight:500;
  cursor:pointer;
  text-decoration:none;
  margin-bottom:9px;
  transition:var(--transition);
  text-align:left;
}
.action-btn:hover{
  background:var(--gradient-soft);
  border-color:rgba(255,106,0,0.25);
  color:#fff;
}
.action-btn .ab-icon{
  width:30px;height:30px;
  border-radius:8px;
  background:var(--gradient);
  display:flex;align-items:center;justify-content:center;
  flex-shrink:0;
}
.action-btn .ab-icon svg{width:14px;height:14px;stroke:#fff;fill:none;stroke-width:2;}

/* ─── ALERTS ─── */
.alert-item{
  display:flex;align-items:flex-start;gap:12px;
  padding:12px 14px;
  border-radius:var(--radius-sm);
  background:rgba(255,255,255,0.03);
  border:1px solid var(--border);
  margin-bottom:9px;
  cursor:pointer;
  transition:var(--transition);
  text-decoration:none;
  color:inherit;
}
.alert-item:hover{background:rgba(255,255,255,0.06);border-color:var(--border-hover);}
.alert-dot{
  width:8px;height:8px;border-radius:50%;
  margin-top:4px;flex-shrink:0;
}
.alert-text{font-size:12.5px;color:var(--sub);line-height:1.5;}
.alert-text b{color:#ddd;font-weight:600;}
.alert-time{font-size:11px;color:var(--muted);margin-top:2px;}

/* ─── LOGOUT MODAL ─── */
.logout-modal{
  position:fixed;inset:0;
  background:rgba(0,0,0,0.8);
  backdrop-filter:blur(10px);
  display:none;
  align-items:center;justify-content:center;
  z-index:999;
}
.logout-box{
  background:var(--panel);
  border:1px solid rgba(255,106,0,0.2);
  padding:34px 30px;width:320px;
  border-radius:20px;
  box-shadow:0 30px 80px rgba(0,0,0,0.7);
  text-align:center;
  animation:popIn .25s cubic-bezier(0.34,1.56,0.64,1);
}
.logout-box h3{
  font-family:'Syne',sans-serif;
  font-size:20px;font-weight:800;
  color:#fff;margin-bottom:8px;
}
.logout-box p{font-size:13px;color:var(--muted);margin-bottom:26px;}
.logout-actions{display:flex;gap:12px;}
.btn-cancel{
  flex:1;padding:13px;
  border-radius:var(--radius-sm);
  border:1px solid var(--border);
  background:transparent;
  color:var(--sub);
  font-family:'DM Sans',sans-serif;
  font-size:13px;font-weight:500;
  cursor:pointer;
  transition:var(--transition);
}
.btn-cancel:hover{background:rgba(255,255,255,0.05);color:#ddd;}
.btn-logout{
  flex:1;padding:13px;
  border-radius:var(--radius-sm);
  border:none;
  background:var(--gradient);
  color:#fff;
  font-family:'DM Sans',sans-serif;
  font-size:13px;font-weight:600;
  cursor:pointer;
  box-shadow:0 4px 20px rgba(255,106,0,0.3);
  transition:var(--transition);
}
.btn-logout:hover{opacity:0.88;transform:translateY(-1px);}

@keyframes popIn{
  from{transform:scale(0.88);opacity:0;}
  to{transform:scale(1);opacity:1;}
}

/* ─── MINI SPARKLINE ─── */
.sparkline{
  height:36px;margin-top:10px;
  opacity:0.7;
}

/* ─── LIGHT MODE ─── */
html.light-mode {
  --bg:      #f0f2f5;
  --surface: #ffffff;
  --panel:   #f7f8fa;
  --border:  rgba(0,0,0,0.08);
  --border-hover: rgba(0,0,0,0.15);
  --text:    #111118;
  --muted:   #9098a9;
  --sub:     #555566;
}

html.light-mode .sidebar::after {
  background: linear-gradient(180deg, transparent, #ff6a0033, transparent);
}

html.light-mode .logo-text        { color: #111; }
html.light-mode .topbar-left h3   { color: #111; }
html.light-mode .avatar-name      { color: #111; }
html.light-mode .card-title,
html.light-mode .cht              { color: #111; }
html.light-mode .stat h2          { color: #111; }
html.light-mode .page-header h2   { color: #111; }
html.light-mode .search-box input { color: #111; }
html.light-mode td                { color: #444; }
html.light-mode .alert-text b     { color: #222; }
</style>
</head>
<body>

<div class="wrapper">

  <!-- ═══ SIDEBAR ═══ -->
  <aside class="sidebar">
    <div class="logo">
      <div class="logo-icon">
        <svg viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
      </div>
      <span class="logo-text">Helphub</span>
    </div>

    <div class="menu-section">Main Menu</div>
    <div class="menu">
      <a href="{{ url('/admin/dashboard') }}" class="active">
        <span class="nav-icon">
          <svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>
        </span>
        Dashboard
      </a>
      <a href="{{ url('/admin/manageuser') }}">
        <span class="nav-icon">
          <svg viewBox="0 0 24 24"><circle cx="9" cy="7" r="4"/><path d="M3 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/><path d="M21 21v-2a4 4 0 0 0-3-3.85"/></svg>
        </span>
        Manage Users
      </a>
      <a href="{{ url('/admin/manageprovider') }}">
        <span class="nav-icon">
          <svg viewBox="0 0 24 24"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
        </span>
        Providers
      </a>
      <a href="{{ url('/admin/managecategories') }}">
        <span class="nav-icon">
          <svg viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h7"/></svg>
        </span>
        Categories
      </a>
      <a href="{{ url('/admin/managebooking') }}">
        <span class="nav-icon">
          <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
        </span>
        Bookings
      </a>
      <a href="{{ route('admin.provider_services') }}">
        <span class="nav-icon">
          <svg viewBox="0 0 24 24"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
        </span>
        Services
      </a>

      <div class="menu-section" style="padding-top:8px;">Analytics</div>

      <a href="{{ url('/admin/report') }}">
        <span class="nav-icon">
          <svg viewBox="0 0 24 24"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
        </span>
        Reports
      </a>

   <!-- ✅ LOGOUT RIGHT HERE — after Reports -->
  <a class="logout" onclick="logoutAdmin()">
    <span class="nav-icon">
      <svg viewBox="0 0 24 24" stroke="#ff4d4d"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
    </span>
    Logout
  </a>
  </aside>

  <!-- ═══ LOGOUT MODAL ═══ -->
  <div class="logout-modal" id="logoutModal">
    <div class="logout-box">
      <h3>Sign Out?</h3>
      <p>You will be redirected to the login page.</p>
      <div class="logout-actions">
        <button class="btn-cancel" onclick="closeLogout()">Cancel</button>
        <button class="btn-logout" onclick="confirmLogout()">Logout</button>
      </div>
    </div>
  </div>

  <!-- ═══ MAIN ═══ -->
  <div class="main">

    <!-- TOPBAR -->
    <div class="topbar">
      <div class="topbar-left">
        <h3>Admin Dashboard</h3>
        <p id="topbar-date">Loading date…</p>
      </div>

      <div class="search-box">
        <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        <input type="text" placeholder="Search users, bookings, providers…">
      </div>

      <div class="topbar-right">
            <div style="position: relative;"> 
        <div class="icon-btn" onclick="toggleNotifDropdown(event)" title="Notifications" style="cursor: pointer; position: relative; display: flex; align-items: center; justify-content: center;">
            <svg viewBox="0 0 24 24" style="width: 20px; height: 20px; fill: none; stroke: currentColor; stroke-width: 2;">
                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/>
            </svg>
            
            @if($pendingCount > 0)
                <span style="position: absolute; top: 0; right: 0; width: 8px; height: 8px; background: var(--orange); border-radius: 50%; border: 2px solid var(--surface);"></span>
            @endif
        </div>

        <div id="bell-dropdown" style="display: none; position: absolute; top: 45px; right: 0; width: 280px; background: var(--surface); border: 1px solid var(--border); border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.5); z-index: 9999; overflow: hidden;">
            <div style="padding: 12px; border-bottom: 1px solid var(--border); background: rgba(255,255,255,0.02);">
                <h4 style="margin:0; font-family:'Syne'; font-size: 13px; color: #fff;">New Requests</h4>
            </div>
            
            <div style="max-height: 250px; overflow-y: auto;">
                @forelse($pendingNotifications as $notif)
                    <a href="/admin/providers" style="display: flex; gap: 10px; padding: 12px; border-bottom: 1px solid var(--border); text-decoration: none; align-items: center; transition: 0.3s;">
                        <div style="background: var(--gradient); width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 800; font-size: 12px; flex-shrink: 0;">
                            {{ strtoupper(substr($notif->name, 0, 1)) }}
                        </div>
                        <div style="overflow: hidden;">
                            <div style="color: #fff; font-size: 12px; font-weight: 600;">{{ $notif->name }}</div>
                            <div style="color: #9898a8; font-size: 11px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Wants to join as provider</div>
                        </div>
                    </a>
                @empty
                    <div style="padding: 20px; text-align: center; color: #606070; font-size: 12px;">No new notifications</div>
                @endforelse
            </div>
        </div>
    </div>
        <div class="icon-btn" onclick="toggleTheme()" title="Toggle theme">
          <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>
        </div>
        <div class="avatar-wrap" onclick="toggleProfile()">
          <img id="avatar" class="avatar" src="https://i.imgur.com/6VBx3io.png" alt="Admin">
          <div class="avatar-info">
            <span class="avatar-name">Admin</span>
            <span class="avatar-role">Super Admin</span>
          </div>
        </div>
      </div>
    </div>
    



    

    <!-- PROFILE DROPDOWN -->
    <div class="profile" id="profile">
      <b>Admin</b><br>
      <small>Super Administrator</small>
    </div>

    <!-- CONTENT -->
    <div class="content">

      <!-- Page Header -->
      <div class="page-header">
        <h2>Overview</h2>
        <span class="date-badge" id="date-badge">—</span>
      </div>

      <!-- STAT CARDS -->
      <div class="grid4">
        <div class="stat">
          <div class="stat-glow"></div>
          <div class="stat-top">
            <span class="stat-label">Total Users</span>
            <span class="stat-badge badge-orange">
              <svg viewBox="0 0 24 24"><circle cx="9" cy="7" r="4"/><path d="M3 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2"/></svg>
            </span>
          </div>
          <h2>{{ $totalUsers }}</h2>
          <div class="stat-meta"><span class="stat-up">↑ 12%</span> vs last month</div>
          <svg class="sparkline" viewBox="0 0 80 30" preserveAspectRatio="none">
            <polyline points="0,25 13,20 26,22 40,12 53,15 66,8 80,10" fill="none" stroke="#ff6a00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>

        <div class="stat">
          <div class="stat-glow" style="background:radial-gradient(circle,rgba(124,58,237,0.12),transparent 70%)"></div>
          <div class="stat-top">
            <span class="stat-label">Providers</span>
            <span class="stat-badge badge-violet">
              <svg viewBox="0 0 24 24"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
            </span>
          </div>
          <h2>{{ $totalProviders }}</h2>
          <div class="stat-meta"><span class="stat-up">↑ 5%</span> vs last month</div>
          <svg class="sparkline" viewBox="0 0 80 30" preserveAspectRatio="none">
            <polyline points="0,28 13,22 26,24 40,18 53,20 66,14 80,12" fill="none" stroke="#7c3aed" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>

        <div class="stat">
          <div class="stat-glow" style="background:radial-gradient(circle,rgba(238,9,121,0.1),transparent 70%)"></div>
          <div class="stat-top">
            <span class="stat-label">Bookings</span>
            <span class="stat-badge badge-pink">
              <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            </span>
          </div>
          <h2>{{ $totalBookings }}</h2>
          <div class="stat-meta"><span class="stat-up">↑ 18%</span> vs last month</div>
          <svg class="sparkline" viewBox="0 0 80 30" preserveAspectRatio="none">
            <polyline points="0,26 13,20 26,15 40,18 53,10 66,12 80,6" fill="none" stroke="#ee0979" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>

        <div class="stat">
          <div class="stat-glow" style="background:radial-gradient(circle,rgba(255,106,0,0.1),transparent 70%)"></div>
          <div class="stat-top">
            <span class="stat-label">Pending</span>
            <span class="stat-badge badge-orange">
              <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            </span>
          </div>
          <h2>{{ $pendingApprovals }}</h2>
          <div class="stat-meta"><span class="stat-down">Needs review</span></div>
          <svg class="sparkline" viewBox="0 0 80 30" preserveAspectRatio="none">
            <polyline points="0,10 13,18 26,14 40,20 53,16 66,22 80,18" fill="none" stroke="#ff6a00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
      </div>

      <!-- MIDDLE ROW -->
      <div class="grid2">

        <!-- Recent Bookings Table -->
        <div class="card">
          <div class="card-header">
            <span class="card-title">Recent Bookings</span>
            <a href="{{ url('/admin/managebooking') }}" class="card-badge">View all →</a>
          </div>
          <table>
            <thead>
              <tr>
                <th>Booking</th>
                <th>User</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @forelse($recentBookings as $i => $booking)
              <tr>
                <td style="color:#ddd;font-weight:600;">#BK{{ str_pad($booking->id ?? ($i+1), 4, '0', STR_PAD_LEFT) }}</td>
                <td>User #{{ $booking->user_id }}</td>
                <td>
                  @if($booking->status == 'reject' || $booking->status == 'rejected')
                    <span class="status-pill status-rejected"><span class="status-dot"></span>Rejected</span>
                  @elseif($booking->status == 'pending')
                    <span class="status-pill status-pending"><span class="status-dot"></span>Pending</span>
                  @else
                    <span class="status-pill status-confirmed"><span class="status-dot"></span>{{ ucfirst($booking->status) }}</span>
                  @endif
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="3" style="text-align:center;color:var(--muted);padding:24px;">No bookings found.</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <!-- Platform Stats Chart -->
        <div class="card">
          <div class="card-header">
            <span class="card-title">Platform Stats</span>
            <span class="card-badge">This month</span>
          </div>
          <div class="chart">
            @foreach($chartStats as $stat)
              @php $height = ($stat['count'] / ($maxCount ?: 1)) * 100; @endphp
              <div class="bar" style="height:{{ max($height, 8) }}%" data-label="{{ $stat['label'] }}" title="{{ $stat['label'] }}: {{ $stat['count'] }}"></div>
            @endforeach
          </div>
          <div style="display:flex;justify-content:space-between;margin-top:24px;gap:4px;">
            @foreach($chartStats as $stat)
              <span style="flex:1;text-align:center;font-size:10px;color:var(--muted);font-weight:600;text-transform:uppercase;letter-spacing:0.5px;">{{ $stat['label'] }}</span>
            @endforeach
          </div>
        </div>
      </div>

      <!-- BOTTOM ROW -->
      <div class="grid2eq">

        <!-- Quick Actions -->
        <div class="card">
          <div class="card-header">
            <span class="card-title">Quick Actions</span>
          </div>
          <a href="{{ url('/admin/manageprovider') }}" class="action-btn">
            <span class="ab-icon">
              <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            </span>
            Approve Providers
          </a>
          <a href="{{ url('/admin/manageuser') }}" class="action-btn">
            <span class="ab-icon">
              <svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
            </span>
            Manage Users
          </a>
          <a href="{{ url('/admin/managebooking') }}" class="action-btn">
            <span class="ab-icon">
              <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            </span>
            View Bookings
          </a>
        </div>

        <!-- System Alerts -->
        <div class="card">
          <div class="card-header">
            <span class="card-title">System Alerts</span>
            @if($pendingApprovals > 0 || $rejectedCount > 0)
              <span class="card-badge" style="color:var(--pink);border-color:rgba(238,9,121,0.2);background:rgba(238,9,121,0.08);">{{ $pendingApprovals + $rejectedCount }} active</span>
            @endif
          </div>

          <a href="{{ url('/admin/manageprovider') }}" class="alert-item">
            <span class="alert-dot" style="background:var(--orange);"></span>
            <div>
              <div class="alert-text"><b>{{ $pendingApprovals }}</b> providers awaiting approval</div>
              <div class="alert-time">Requires action</div>
            </div>
          </a>

          <a href="{{ url('/admin/managebooking') }}" class="alert-item">
            <span class="alert-dot" style="background:var(--pink);"></span>
            <div>
              <div class="alert-text"><b>{{ $rejectedCount }}</b> bookings cancelled</div>
              <div class="alert-time">Review recommended</div>
            </div>
          </a>

          <div class="alert-item" style="cursor:default;">
            <span class="alert-dot" style="background:#22c55e;"></span>
            <div>
              <div class="alert-text"><b>{{ $todayUsers }}</b> new users joined today</div>
              <div class="alert-time">All good</div>
            </div>
          </div>
        </div>

      </div>
    </div>
    <!-- /content -->
  </div>
  <!-- /main -->
</div>
<!-- /wrapper -->

<form id="adminLogoutForm" action="{{ route('admin.logout') }}" method="POST" style="display:none;">
  @csrf
</form>

<script>
// Date
const now = new Date();
const opts = { weekday:'long', year:'numeric', month:'long', day:'numeric' };
const dateStr = now.toLocaleDateString('en-US', opts);
document.getElementById('topbar-date').textContent = dateStr;
document.getElementById('date-badge').textContent = dateStr;

// Avatar
const avatar = document.getElementById('avatar');
avatar.src = localStorage.getItem('adminImage') || 'https://i.imgur.com/6VBx3io.png';

// Profile dropdown
function toggleProfile(){
  const p = document.getElementById('profile');
  p.style.display = p.style.display === 'block' ? 'none' : 'block';
}
document.addEventListener('click', e => {
  if(!e.target.closest('.avatar-wrap') && !e.target.closest('#profile')){
    document.getElementById('profile').style.display = 'none';
  }
});



function toggleTheme() {
  const isLight = document.documentElement.classList.toggle('light-mode');
  localStorage.setItem('theme', isLight ? 'light' : 'dark');

  // swap the icon too
  const icon = document.querySelector('.icon-btn svg circle');
}

// Auto-apply saved theme on page load
if (localStorage.getItem('theme') === 'light') {
  document.documentElement.classList.add('light-mode');
}

// Logout modal
function logoutAdmin(){
  document.getElementById('logoutModal').style.display = 'flex';
}
function closeLogout(){
  document.getElementById('logoutModal').style.display = 'none';
}
function confirmLogout(){
  document.getElementById('adminLogoutForm').submit();
}


function toggleNotifDropdown(event) {
    event.stopPropagation(); // Yeh layout ko hilne se bachata hai aur click control karta hai
    const dropdown = document.getElementById('bell-dropdown');
    // Baki dropdown band karo
    const profile = document.getElementById('profile');
    if(profile) profile.style.display = 'none';

    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
}
</script>

</body>
</html>
