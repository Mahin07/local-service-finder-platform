<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Manage Users | Helphub Admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@600;700;800&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
body{font-family:'DM Sans',sans-serif;background:var(--bg);color:var(--text);height:100vh;overflow:hidden;}

/* ─── SCROLLBAR ─── */
::-webkit-scrollbar{width:4px}
::-webkit-scrollbar-track{background:transparent}
::-webkit-scrollbar-thumb{background:#ff6a0040;border-radius:99px}

/* ─── LAYOUT ─── */
.wrapper{display:flex;height:100vh;}

/* ─── SIDEBAR ─── */
.sidebar{
  width:235px;background:var(--surface);border-right:1px solid var(--border);
  padding:22px 14px;display:flex;flex-direction:column;
  flex-shrink:0;overflow-y:auto;position:relative;z-index:10;
}
.logo{display:flex;align-items:center;gap:10px;margin-bottom:30px;padding:0 6px;}
.logo-icon{
  width:34px;height:34px;border-radius:10px;background:var(--gradient);
  display:flex;align-items:center;justify-content:center;
  flex-shrink:0;box-shadow:0 4px 16px rgba(255,106,0,0.35);
}
.logo-icon svg{width:16px;height:16px;fill:#fff;}
.logo-text{font-family:'Syne',sans-serif;font-size:17px;font-weight:800;color:#fff;letter-spacing:0.3px;}

.menu-section{
  font-size:10px;font-weight:600;color:var(--muted);
  letter-spacing:1.2px;text-transform:uppercase;padding:0 10px;margin:10px 0 6px;
}
.menu{display:flex;flex-direction:column;gap:2px;flex:1;}
.menu a{
  display:flex;align-items:center;gap:11px;padding:11px 14px;
  border-radius:var(--radius-sm);color:var(--sub);text-decoration:none;
  font-size:13.5px;font-weight:500;transition:var(--transition);position:relative;
}
.menu a .nav-icon{
  width:32px;height:32px;border-radius:8px;background:rgba(255,255,255,0.04);
  display:flex;align-items:center;justify-content:center;flex-shrink:0;transition:var(--transition);
}
.menu a .nav-icon svg{width:15px;height:15px;stroke:currentColor;fill:none;stroke-width:1.8;}
.menu a:hover{color:#ddd;background:rgba(255,255,255,0.04);}
.menu a:hover .nav-icon{background:rgba(255,106,0,0.1);}
.menu a.active{color:#fff;background:var(--gradient-soft);border:1px solid rgba(255,106,0,0.18);}
.menu a.active .nav-icon{background:var(--gradient);box-shadow:0 4px 12px rgba(255,106,0,0.3);color:#fff;}
.menu a.active::before{
  content:'';position:absolute;right:0;top:50%;transform:translateY(-50%);
  width:3px;height:60%;background:var(--gradient);border-radius:99px;
}
.menu a.logout{color:#ff4d4d;font-weight:600;}
.menu a.logout .nav-icon{background:rgba(255,77,77,0.08);}
.menu a.logout:hover{background:rgba(255,77,77,0.08);color:#ff6666;}

/* ─── MAIN ─── 
.main{flex:1;display:flex;flex-direction:column;overflow:hidden;min-width:0;}*/

/* ─── TOPBAR ─── */
.topbar{
  height:66px;background:var(--surface);border-bottom:1px solid var(--border);
  display:flex;align-items:center;justify-content:space-between;
  padding:0 26px;flex-shrink:0;gap:16px;
}
.topbar-left h3{font-family:'Syne',sans-serif;font-size:17px;font-weight:700;color:#fff;}
.topbar-left p{font-size:12px;color:var(--muted);margin-top:1px;}
.topbar-right{display:flex;align-items:center;gap:10px;}

.search-box{
  flex:1;max-width:300px;display:flex;align-items:center;gap:10px;
  background:var(--panel);border:1px solid var(--border);
  border-radius:99px;padding:9px 18px;transition:var(--transition);
}
.search-box:focus-within{border-color:rgba(255,106,0,0.35);}
.search-box svg{width:15px;height:15px;stroke:var(--muted);fill:none;flex-shrink:0;}
.search-box input{
  background:none;border:none;outline:none;
  font-family:'DM Sans',sans-serif;font-size:13px;color:var(--text);width:100%;
}
.search-box input::placeholder{color:var(--muted);}

.icon-btn{
  width:38px;height:38px;border-radius:var(--radius-sm);
  background:var(--panel);border:1px solid var(--border);
  display:flex;align-items:center;justify-content:center;
  cursor:pointer;position:relative;transition:var(--transition);
}
.icon-btn:hover{border-color:var(--border-hover);background:rgba(255,106,0,0.08);}
.icon-btn svg{width:16px;height:16px;stroke:var(--sub);fill:none;stroke-width:1.8;}
.notif-badge{
  position:absolute;top:7px;right:7px;
  width:7px;height:7px;border-radius:50%;
  background:var(--orange);border:1.5px solid var(--surface);
}

.avatar-wrap{
  display:flex;align-items:center;gap:9px;padding:5px 12px 5px 5px;
  border-radius:99px;background:var(--panel);border:1px solid var(--border);
  cursor:pointer;transition:var(--transition);
}
.avatar-wrap:hover{border-color:var(--border-hover);}
.avatar{width:32px;height:32px;border-radius:50%;object-fit:cover;border:2px solid var(--orange);}
.avatar-info span{display:block;}
.avatar-name{font-size:12.5px;font-weight:600;color:#fff;}
.avatar-role{font-size:10.5px;color:var(--muted);}

/* ─── PROFILE DROPDOWN ─── */
.profile{
  position:absolute;top:76px;right:26px;background:var(--panel);
  border:1px solid var(--border);border-radius:var(--radius);padding:18px;width:200px;
  box-shadow:0 20px 60px rgba(0,0,0,0.5);display:none;z-index:300;
}
.profile b{color:#fff;font-size:14px;}
.profile small{color:var(--muted);font-size:12px;}

/* ─── CONTENT ─── 
.content{flex:1;overflow-y:auto;padding:26px;display:flex;flex-direction:column;gap:20px;}*/

/* ─── PAGE HEADER ─── */
.page-header{display:flex;align-items:center;justify-content:space-between;}
.page-header h2{font-family:'Syne',sans-serif;font-size:20px;font-weight:700;color:#fff;}
.date-badge{
  font-size:12px;color:var(--sub);background:var(--panel);
  border:1px solid var(--border);padding:6px 14px;border-radius:99px;
}

/* ─── SUMMARY PILLS ─── */
.summary-row{display:grid;grid-template-columns:repeat(3,1fr);gap:14px;}
.pill{
  background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);
  padding:18px 20px;display:flex;align-items:center;gap:14px;
  transition:var(--transition);animation:fadeUp 0.5s cubic-bezier(0.22,1,0.36,1) both;
}
.pill:hover{border-color:var(--border-hover);transform:translateY(-2px);}
.pill:nth-child(1){animation-delay:0.05s;}
.pill:nth-child(2){animation-delay:0.1s;}
.pill:nth-child(3){animation-delay:0.15s;}
.pill-icon{width:42px;height:42px;border-radius:12px;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.pill-icon svg{width:18px;height:18px;stroke:#fff;fill:none;stroke-width:1.8;}
.pill-val{font-family:'Syne',sans-serif;font-size:22px;font-weight:700;color:#fff;line-height:1;}
.pill-lbl{font-size:11.5px;color:var(--muted);margin-top:3px;font-weight:500;}

/* ─── CARD ─── */
.card{
  background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);
  overflow:hidden;animation:fadeUp 0.55s cubic-bezier(0.22,1,0.36,1) both;animation-delay:0.2s;
}
.card-header{
  display:flex;align-items:center;justify-content:space-between;
  padding:18px 22px;border-bottom:1px solid var(--border);gap:14px;flex-wrap:wrap;
}
.card-title{font-family:'Syne',sans-serif;font-size:15px;font-weight:700;color:#fff;}

/* ─── TABLE ─── */
.table-wrap{overflow-x:auto;}
table{width:100%;border-collapse:collapse;}
thead tr{background:var(--panel);}
thead th{
  padding:13px 18px;text-align:left;font-size:11px;font-weight:600;
  color:var(--muted);text-transform:uppercase;letter-spacing:0.9px;white-space:nowrap;
}
tbody tr{border-bottom:1px solid var(--border);transition:var(--transition);}
tbody tr:last-child{border-bottom:none;}
tbody tr:hover{background:rgba(255,255,255,0.02);}
tbody td{padding:13px 18px;font-size:13px;color:var(--sub);vertical-align:middle;}

.user-cell{display:flex;align-items:center;gap:10px;}
.user-cell img{width:34px;height:34px;border-radius:50%;object-fit:cover;border:2px solid rgba(255,106,0,0.3);}
.user-name{font-weight:600;color:var(--text);}

.status-pill{display:inline-flex;align-items:center;gap:5px;padding:4px 11px;border-radius:99px;font-size:11px;font-weight:600;}
.status-pill .dot{width:5px;height:5px;border-radius:50%;background:currentColor;}
.status-active{background:rgba(34,197,94,0.12);color:#22c55e;}
.status-inactive{background:rgba(238,9,121,0.12);color:var(--pink);}

.actions{display:flex;align-items:center;gap:6px;}
.act-btn{
  width:32px;height:32px;border-radius:8px;background:var(--panel);
  border:1px solid var(--border);display:flex;align-items:center;justify-content:center;
  cursor:pointer;transition:var(--transition);
}
.act-btn svg{width:14px;height:14px;stroke:var(--sub);fill:none;stroke-width:1.8;}
.act-btn.view:hover{background:rgba(124,58,237,0.12);border-color:rgba(124,58,237,0.3);}
.act-btn.view:hover svg{stroke:#a78bfa;}
.act-btn.edit:hover{background:rgba(255,106,0,0.12);border-color:rgba(255,106,0,0.3);}
.act-btn.edit:hover svg{stroke:var(--orange);}
.act-btn.del:hover{background:rgba(239,68,68,0.12);border-color:rgba(239,68,68,0.3);}
.act-btn.del:hover svg{stroke:#ef4444;}

/* ─── EMPTY STATE ─── */
.empty-state{padding:52px 24px;text-align:center;}
.empty-state svg{width:48px;height:48px;stroke:var(--muted);fill:none;margin-bottom:16px;}
.empty-state p{color:var(--muted);font-size:14px;}

/* ─── MODALS ─── */
.modal{
  position:fixed;inset:0;background:rgba(0,0,0,0.6);
  backdrop-filter:blur(6px);display:none;
  align-items:center;justify-content:center;z-index:1000;
}
.modal.show{display:flex;}
.modal-box{
  background:var(--surface);border:1px solid var(--border);
  border-radius:22px;padding:28px;width:460px;
  max-width:calc(100vw - 32px);box-shadow:0 40px 80px rgba(0,0,0,0.6);
  animation:modalIn 0.28s cubic-bezier(0.22,1,0.36,1) both;
}
@keyframes modalIn{from{opacity:0;transform:scale(0.94) translateY(16px);}to{opacity:1;transform:none;}}

.modal-head{
  display:flex;align-items:center;justify-content:space-between;
  margin-bottom:22px;padding-bottom:16px;border-bottom:1px solid var(--border);
}
.modal-head h3{font-family:'Syne',sans-serif;font-size:17px;font-weight:700;color:#fff;}
.modal-close{
  width:30px;height:30px;border-radius:8px;background:var(--panel);
  border:1px solid var(--border);display:flex;align-items:center;justify-content:center;
  cursor:pointer;transition:var(--transition);
}
.modal-close:hover{border-color:rgba(239,68,68,0.4);background:rgba(239,68,68,0.08);}
.modal-close svg{width:13px;height:13px;stroke:var(--sub);fill:none;stroke-width:2;}

/* view modal detail rows */
.detail-row{display:flex;align-items:flex-start;gap:14px;padding:10px 0;border-bottom:1px solid var(--border);}
.detail-row:last-of-type{border-bottom:none;}
.detail-icon{width:30px;height:30px;border-radius:8px;background:var(--panel);display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.detail-icon svg{width:13px;height:13px;stroke:var(--orange);fill:none;stroke-width:1.8;}
.detail-lbl{font-size:10.5px;color:var(--muted);font-weight:600;text-transform:uppercase;letter-spacing:0.7px;}
.detail-val{font-size:13.5px;color:var(--text);font-weight:500;margin-top:2px;}

/* form fields */
.field{margin-bottom:14px;}
.field-label{display:block;font-size:11px;font-weight:600;color:var(--sub);text-transform:uppercase;letter-spacing:0.8px;margin-bottom:7px;}
.styled-input{
  width:100%;padding:11px 14px;background:var(--panel);border:1px solid var(--border);
  border-radius:var(--radius-sm);color:var(--text);
  font-family:'DM Sans',sans-serif;font-size:13.5px;outline:none;transition:var(--transition);
}
.styled-input:focus{border-color:rgba(255,106,0,0.4);box-shadow:0 0 0 3px rgba(255,106,0,0.07);}
.styled-input::placeholder{color:var(--muted);}

.modal-actions{display:flex;gap:10px;margin-top:20px;}
.btn-primary{
  flex:1;padding:12px;border:none;border-radius:var(--radius-sm);
  background:var(--gradient);color:#fff;font-family:'DM Sans',sans-serif;
  font-size:14px;font-weight:600;cursor:pointer;transition:var(--transition);
  box-shadow:0 4px 16px rgba(255,106,0,0.25);
}
.btn-primary:hover{transform:translateY(-1px);box-shadow:0 6px 20px rgba(255,106,0,0.4);}
.btn-secondary{
  flex:1;padding:12px;border:1px solid var(--border);border-radius:var(--radius-sm);
  background:var(--panel);color:var(--sub);font-family:'DM Sans',sans-serif;
  font-size:14px;font-weight:600;cursor:pointer;transition:var(--transition);
}
.btn-secondary:hover{border-color:var(--border-hover);color:var(--text);}

/* ─── LOGOUT MODAL ─── */
.logout-modal{
  position:fixed;inset:0;background:rgba(0,0,0,0.8);backdrop-filter:blur(10px);
  display:none;align-items:center;justify-content:center;z-index:999;
}
.logout-box{
  background:var(--panel);border:1px solid rgba(255,106,0,0.2);
  padding:34px 30px;width:320px;border-radius:20px;
  box-shadow:0 30px 80px rgba(0,0,0,0.7);text-align:center;
  animation:popIn .25s cubic-bezier(0.34,1.56,0.64,1);
}
.logout-box h3{font-family:'Syne',sans-serif;font-size:20px;font-weight:800;color:#fff;margin-bottom:8px;}
.logout-box p{font-size:13px;color:var(--muted);margin-bottom:26px;}
.logout-actions{display:flex;gap:12px;}
.btn-cancel{
  flex:1;padding:13px;border-radius:var(--radius-sm);border:1px solid var(--border);
  background:transparent;color:var(--sub);font-family:'DM Sans',sans-serif;
  font-size:13px;font-weight:500;cursor:pointer;transition:var(--transition);
}
.btn-cancel:hover{background:rgba(255,255,255,0.05);color:#ddd;}
.btn-logout-confirm{
  flex:1;padding:13px;border-radius:var(--radius-sm);border:none;
  background:var(--gradient);color:#fff;font-family:'DM Sans',sans-serif;
  font-size:13px;font-weight:600;cursor:pointer;
  box-shadow:0 4px 20px rgba(255,106,0,0.3);transition:var(--transition);
}
.btn-logout-confirm:hover{opacity:0.88;transform:translateY(-1px);}

/* ─── ANIMATIONS ─── */
@keyframes fadeUp{from{opacity:0;transform:translateY(16px);}to{opacity:1;transform:none;}}
@keyframes popIn{from{transform:scale(0.88);opacity:0;}to{transform:scale(1);opacity:1;}}

/* ─── LIGHT MODE ─── */
html.light-mode{
  --bg:#f0f2f5;--surface:#ffffff;--panel:#f7f8fa;
  --border:rgba(0,0,0,0.08);--border-hover:rgba(0,0,0,0.15);
  --text:#111118;--muted:#9098a9;--sub:#555566;
}
html.light-mode .logo-text{color:#111;}
html.light-mode .topbar-left h3{color:#111;}
html.light-mode .avatar-name{color:#111;}
html.light-mode .card-title{color:#111;}
html.light-mode .page-header h2{color:#111;}
html.light-mode .pill-val{color:#111;}
html.light-mode .user-name{color:#111;}
html.light-mode .modal-head h3{color:#111;}
html.light-mode .logout-box h3{color:#111;}
html.light-mode .search-box input{color:#111;}
html.light-mode .styled-input{background:#fff;color:#111;border-color:rgba(0,0,0,0.12);}
html.light-mode tbody td{color:#444;}

/* Sidebar ko fixed rakho, par main area ko scroll hone do */
.main { 
  flex: 1; 
  display: flex; 
  flex-direction: column; 
  overflow: hidden; /* Header fixed rahega */
  min-width: 0; 
}

/* Content area mein scrolling enable karo */
.content { 
  flex: 1; 
  overflow-y: auto; /* <--- Ise check karo ki 'auto' hi ho */
  padding: 26px; 
  display: flex; 
  flex-direction: column; 
  gap: 20px; 
  height: calc(100vh - 66px); /* Topbar ki height minus karke fixed height do */
}

/* Table wrap ko scrollable banao agar entries zyada hain */
.card {
  flex-shrink: 0; /* Card ko sikudne se bachao */
  margin-bottom: 20px;
}

body {
  font-family: 'DM Sans', sans-serif;
  background: var(--bg);
  color: var(--text);
  height: 100vh; /* Screen height fix */
  overflow: hidden; /* Bahar wala scroll band */
}

.wrapper { 
  display: flex; 
  height: 100vh; 
  overflow: hidden; 
}

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
      <a href="{{ url('/admin/dashboard') }}">
        <span class="nav-icon"><svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg></span>
        Dashboard
      </a>
      <a href="{{ url('/admin/manageuser') }}" class="active">
        <span class="nav-icon"><svg viewBox="0 0 24 24"><circle cx="9" cy="7" r="4"/><path d="M3 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/><path d="M21 21v-2a4 4 0 0 0-3-3.85"/></svg></span>
        Manage Users
      </a>
      <a href="{{ url('/admin/manageprovider') }}">
        <span class="nav-icon"><svg viewBox="0 0 24 24"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg></span>
        Providers
      </a>
      <a href="{{ url('/admin/managecategories') }}">
        <span class="nav-icon"><svg viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h7"/></svg></span>
        Categories
      </a>
      <a href="{{ url('/admin/managebooking') }}">
        <span class="nav-icon"><svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></span>
        Bookings
      </a>
      <a href="{{ route('admin.provider_services') }}">
        <span class="nav-icon"><svg viewBox="0 0 24 24"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg></span>
        Services
      </a>

      <div class="menu-section" style="padding-top:8px;">Analytics</div>
          <a href="{{ url('/admin/report') }}">
        <span class="nav-icon">
          <svg viewBox="0 0 24 24"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
        </span>
        Reports
      </a>

      <a class="logout" onclick="logoutAdmin()" style="cursor:pointer;">
        <span class="nav-icon"><svg viewBox="0 0 24 24" stroke="#ff4d4d"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg></span>
        Logout
      </a>
    </div>
  </aside>

  <!-- ═══ LOGOUT MODAL ═══ -->
  <div class="logout-modal" id="logoutModal">
    <div class="logout-box">
      <h3>Sign Out?</h3>
      <p>You will be redirected to the login page.</p>
      <div class="logout-actions">
        <button class="btn-cancel" onclick="closeLogout()">Cancel</button>
        <button class="btn-logout-confirm" onclick="confirmLogout()">Logout</button>
      </div>
    </div>
  </div>

  <!-- ═══ MAIN ═══ -->
  <div class="main">

    <!-- TOPBAR -->
    <div class="topbar">
      <div class="topbar-left">
        <h3>Manage Users</h3>
        <p id="topbar-date">Loading date…</p>
      </div>

      <div class="search-box">
        <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        <input type="text" id="searchInp" placeholder="Search users…" onkeyup="tableSearch()">
      </div>

      <div class="topbar-right">
        <div class="icon-btn" title="Notifications">
          <svg viewBox="0 0 24 24"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
          <span class="notif-badge"></span>
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
        <h2>Manage Users</h2>
        <span class="date-badge" id="date-badge">—</span>
      </div>

      <!-- SUMMARY PILLS -->
      <div class="summary-row">
        <div class="pill">
          <div class="pill-icon" style="background:var(--gradient);">
            <svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
          </div>
          <div>
            <div class="pill-val">{{ count($users) }}</div>
            <div class="pill-lbl">Total Users</div>
          </div>
        </div>
        <div class="pill">
          <div class="pill-icon" style="background:linear-gradient(135deg,#22c55e,#16a34a);">
            <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
          </div>
          <div>
            <div class="pill-val">{{ $users->where('status','active')->count() }}</div>
            <div class="pill-lbl">Active</div>
          </div>
        </div>
        <div class="pill">
          <div class="pill-icon" style="background:linear-gradient(135deg,#ee0979,#c2185b);">
            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
          </div>
          <div>
            <div class="pill-val">{{ $users->where('status','inactive')->count() }}</div>
            <div class="pill-lbl">Inactive</div>
          </div>
        </div>
      </div>

      <!-- TABLE CARD -->
      <div class="card">
        <div class="card-header">
          <span class="card-title">User List</span>
        </div>

        <div class="table-wrap">
          <table>
            <thead>
              <tr>
                <th>Name</th>
                <th>User ID</th>
                <th>Email</th>
                <th>Status</th>
                <th>Address</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody id="userTable">
              @forelse($users as $user)
              <tr>
                <td>
                  <div class="user-cell">
                    <img src="{{ $user->image ? asset($user->image) : 'https://i.pravatar.cc/40?img=5' }}" alt="{{ $user->name }}">
                    <span class="user-name">{{ $user->name }}</span>
                  </div>
                </td>
                <td>#{{ $user->id }}</td>
                <td>{{ $user->email }}</td>
                <td>
                  @php $st = strtolower($user->status); @endphp
                  <span class="status-pill status-{{ $st }}">
                    <span class="dot"></span>{{ ucfirst($user->status) }}
                  </span>
                </td>
                <td>{{ $user->address ?? '—' }}</td>
                <td>
                  <div class="actions">
                    <div class="act-btn view" title="View"
                      onclick="viewUser(@js($user->name),@js($user->email),@js($user->address),@js($user->status))">
                      <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    </div>
                    <div class="act-btn edit" title="Edit"
                      onclick="editUser('{{ $user->id }}',@js($user->name),@js($user->email),@js($user->address))">
                      <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                    </div>
                    <form id="del-{{ $user->id }}" action="{{ route('manageuser.destroy', $user->id) }}" method="POST" style="display:none">
                      @csrf @method('DELETE')
                    </form>
                    <div class="act-btn del" title="Delete" onclick="askDelete('{{ $user->id }}')">
                      <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                    </div>
                  </div>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="6">
                  <div class="empty-state">
                    <svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                    <p>No users found.</p>
                  </div>
                </td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
      <!-- /card -->

    </div>
    <!-- /content -->
  </div>
  <!-- /main -->
</div>
<!-- /wrapper -->

<!-- ── VIEW MODAL ── -->
<div class="modal" id="viewModal">
  <div class="modal-box">
    <div class="modal-head">
      <h3 id="vName">User Details</h3>
      <div class="modal-close" onclick="closeModal('viewModal')">
        <svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
      </div>
    </div>
    <div class="detail-row">
      <div class="detail-icon"><svg viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg></div>
      <div><div class="detail-lbl">Email</div><div class="detail-val" id="vEmail">—</div></div>
    </div>
    <div class="detail-row">
      <div class="detail-icon"><svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg></div>
      <div><div class="detail-lbl">Address</div><div class="detail-val" id="vAddress">—</div></div>
    </div>
    <div class="detail-row">
      <div class="detail-icon"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="20 6 9 17 4 12"/></svg></div>
      <div><div class="detail-lbl">Status</div><div class="detail-val" id="vStatus">—</div></div>
    </div>
    <div class="modal-actions">
      <button class="btn-primary" onclick="closeModal('viewModal')">Close</button>
    </div>
  </div>
</div>

<!-- ── EDIT MODAL ── -->
<div class="modal" id="editModal">
  <div class="modal-box">
    <div class="modal-head">
      <h3>Edit User</h3>
      <div class="modal-close" onclick="closeModal('editModal')">
        <svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
      </div>
    </div>
    <form id="editForm" method="POST">
      @csrf @method('PUT')
      <div class="field">
        <label class="field-label">Name</label>
        <input class="styled-input" name="name" id="eName" placeholder="Full name">
      </div>
      <div class="field">
        <label class="field-label">Email</label>
        <input class="styled-input" type="email" name="email" id="eEmail" placeholder="Email address">
      </div>
      <div class="field">
        <label class="field-label">Address</label>
        <input class="styled-input" name="address" id="eAddress" placeholder="Address">
      </div>
      <div class="modal-actions">
        <button type="button" class="btn-secondary" onclick="closeModal('editModal')">Cancel</button>
        <button type="submit" class="btn-primary">Save Changes</button>
      </div>
    </form>
  </div>
</div>

<form id="adminLogoutForm" action="{{ route('admin.logout') }}" method="POST" style="display:none;">
  @csrf
</form>

<script>
// ── Date badge ──
const _dateStr = new Date().toLocaleDateString('en-US', { weekday:'long', year:'numeric', month:'long', day:'numeric' });
document.getElementById('date-badge').textContent = _dateStr;
document.getElementById('topbar-date').textContent = _dateStr;

// ── Avatar ──
document.getElementById('avatar').src =
  localStorage.getItem('adminImage') || 'https://i.imgur.com/6VBx3io.png';

// ── Profile dropdown ──
function toggleProfile(){
  const p = document.getElementById('profile');
  p.style.display = p.style.display === 'block' ? 'none' : 'block';
}
document.addEventListener('click', e => {
  if(!e.target.closest('.avatar-wrap') && !e.target.closest('#profile'))
    document.getElementById('profile').style.display = 'none';
});

// ── Theme ──
function toggleTheme(){
  const isLight = document.documentElement.classList.toggle('light-mode');
  localStorage.setItem('theme', isLight ? 'light' : 'dark');
}
if(localStorage.getItem('theme') === 'light'){
  document.documentElement.classList.add('light-mode');
}

// ── Search ──
function tableSearch(){
  const q = document.getElementById('searchInp').value.toLowerCase();
  document.querySelectorAll('#userTable tr').forEach(row => {
    row.style.display = row.innerText.toLowerCase().includes(q) ? '' : 'none';
  });
}

// ── Modal helpers ──
function openModal(id)  { document.getElementById(id).classList.add('show'); }
function closeModal(id) { document.getElementById(id).classList.remove('show'); }
document.querySelectorAll('.modal').forEach(m => {
  m.addEventListener('click', e => { if(e.target === m) closeModal(m.id); });
});

// ── View ──
function viewUser(name, email, address, status){
  document.getElementById('vName').textContent    = name;
  document.getElementById('vEmail').textContent   = email;
  document.getElementById('vAddress').textContent = address || 'N/A';
  document.getElementById('vStatus').textContent  = status;
  openModal('viewModal');
}

// ── Edit ──
function editUser(id, name, email, address){
  document.getElementById('eName').value    = name;
  document.getElementById('eEmail').value   = email;
  document.getElementById('eAddress').value = address || '';
  document.getElementById('editForm').action = '/admin/manageuser/' + id;
  openModal('editModal');
}

// ── Delete ──
function askDelete(id){
  Swal.fire({
    title: 'Are you sure?',
    text: 'This will remove the user permanently.',
    icon: 'warning',
    background: '#16161d',
    color: '#f0f0f0',
    showCancelButton: true,
    confirmButtonColor: '#ff6a00',
    cancelButtonColor: '#1c1c26',
    confirmButtonText: 'Yes, remove it!'
  }).then(result => {
    if(result.isConfirmed) document.getElementById('del-' + id).submit();
  });
}

// ── Logout ──
function logoutAdmin(){ document.getElementById('logoutModal').style.display = 'flex'; }
function closeLogout(){ document.getElementById('logoutModal').style.display = 'none'; }
function confirmLogout(){ document.getElementById('adminLogoutForm').submit(); }
</script>

@if(session('success'))
<script>
  Swal.fire({
    icon: 'success', title: 'Done!',
    text: "{{ session('success') }}",
    background: '#16161d', color: '#f0f0f0',
    timer: 1500, showConfirmButton: false
  });
</script>
@endif

</body>
</html>
