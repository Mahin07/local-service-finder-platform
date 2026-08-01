<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Manage Services | Helphub Admin</title>
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

*{ margin:0; box-sizing:border-box; }

body{
  font-family:'DM Sans', sans-serif;
  background:var(--bg);
  color:var(--text);
  height:100vh;
  overflow:hidden;
}

::-webkit-scrollbar{ width:4px; }
::-webkit-scrollbar-track{ background:transparent; }
::-webkit-scrollbar-thumb{ background:#ff6a0040; border-radius:99px; }

.wrapper{ display:flex; height:100vh; }

/* ─── SIDEBAR ─── */
.sidebar{
  width:235px;
  background:var(--surface);
  border-right:1px solid var(--border);
  padding:22px 14px;
  display:flex; flex-direction:column;
  flex-shrink:0; overflow-y:auto;
  position:relative; z-index:10;
}

.logo{ display:flex; align-items:center; gap:10px; margin-bottom:30px; padding:0 6px; }
.logo-icon{
  width:34px; height:34px; border-radius:10px;
  background:var(--gradient);
  display:flex; align-items:center; justify-content:center;
  flex-shrink:0; box-shadow:0 4px 16px rgba(255,106,0,0.35);
}
.logo-icon svg{ width:16px; height:16px; fill:#fff; }
.logo-text{ font-family:'Syne',sans-serif; font-size:17px; font-weight:800; color:#fff; letter-spacing:0.3px; }

.menu-section{
  font-size:10px; font-weight:600; color:var(--muted);
  letter-spacing:1.2px; text-transform:uppercase;
  padding:0 10px; margin:10px 0 6px;
}

.menu{ display:flex; flex-direction:column; gap:2px; flex:1; }

.menu a{
  display:flex; align-items:center; gap:11px;
  padding:11px 14px; border-radius:var(--radius-sm);
  color:var(--sub); text-decoration:none;
  font-size:13.5px; font-weight:500;
  transition:var(--transition); position:relative;
}
.menu a .nav-icon{
  width:32px; height:32px; border-radius:8px;
  background:rgba(255,255,255,0.04);
  display:flex; align-items:center; justify-content:center;
  flex-shrink:0; transition:var(--transition);
}
.menu a .nav-icon svg{ width:15px; height:15px; stroke:currentColor; fill:none; stroke-width:1.8; }

.menu a:hover{ color:#ddd; background:rgba(255,255,255,0.04); }
.menu a:hover .nav-icon{ background:rgba(255,106,0,0.1); }

.menu a.active{ color:#fff; background:var(--gradient-soft); border:1px solid rgba(255,106,0,0.18); }
.menu a.active .nav-icon{ background:var(--gradient); box-shadow:0 4px 12px rgba(255,106,0,0.3); color:#fff; }
.menu a.active::before{
  content:''; position:absolute; right:0; top:50%; transform:translateY(-50%);
  width:3px; height:60%; background:var(--gradient); border-radius:99px;
}

.menu a.logout{ color:#ff4d4d; }
.menu a.logout .nav-icon{ background:rgba(255,77,77,0.08); }
.menu a.logout:hover{ background:rgba(255,77,77,0.08); color:#ff6666; }

/* ─── MAIN ─── 
.main{ flex:1; display:flex; flex-direction:column; overflow:hidden; min-width:0; }*/

/* ─── TOPBAR ─── */
.topbar{
  height:66px; background:var(--surface);
  border-bottom:1px solid var(--border);
  display:flex; align-items:center; justify-content:space-between;
  padding:0 26px; flex-shrink:0; gap:16px;
}
.topbar-left h3{ font-family:'Syne',sans-serif; font-size:17px; font-weight:700; color:#fff; }
.topbar-left p{ font-size:12px; color:var(--muted); margin-top:1px; }
.topbar-right{ display:flex; align-items:center; gap:10px; }
.icon-btn{
  width:38px; height:38px; border-radius:var(--radius-sm);
  background:var(--panel); border:1px solid var(--border);
  display:flex; align-items:center; justify-content:center;
  cursor:pointer; transition:var(--transition); position:relative;
}
.icon-btn:hover{ border-color:var(--border-hover); background:rgba(255,106,0,0.08); }
.icon-btn svg{ width:16px; height:16px; stroke:var(--sub); fill:none; stroke-width:1.8; }

.search-box{
  flex:1; max-width:340px;
  display:flex; align-items:center; gap:10px;
  background:var(--panel);
  border:1px solid var(--border);
  border-radius:99px;
  padding:9px 18px;
  transition:var(--transition);
}
.search-box:focus-within{ border-color:rgba(255,106,0,0.35); }
.search-box svg{ width:15px; height:15px; stroke:var(--muted); fill:none; flex-shrink:0; }
.search-box input{
  background:none; border:none; outline:none;
  font-family:'DM Sans',sans-serif;
  font-size:13px; color:var(--text); width:100%;
}
.search-box input::placeholder{ color:var(--muted); }

.avatar-wrap{
  display:flex; align-items:center; gap:9px;
  padding:5px 12px 5px 5px;
  border-radius:99px;
  background:var(--panel);
  border:1px solid var(--border);
  cursor:pointer;
  transition:var(--transition);
}
.avatar-wrap:hover{ border-color:var(--border-hover); }

.avatar{
  width:32px; height:32px;
  border-radius:50%;
  object-fit:cover;
  border:2px solid var(--orange);
}

.avatar-info span{ display:block; }
.avatar-name{ font-size:12.5px; font-weight:600; color:#fff; }
.avatar-role{ font-size:10.5px; color:var(--muted); }

/* ─── PROFILE DROPDOWN ─── */
.profile{
  position:absolute; top:76px; right:26px;
  background:var(--panel);
  border:1px solid var(--border);
  border-radius:var(--radius);
  padding:18px; width:200px;
  box-shadow:0 20px 60px rgba(0,0,0,0.5);
  display:none; z-index:300;
}
.profile b{ color:#fff; font-size:14px; }
.profile small{ color:var(--muted); font-size:12px; }

/* ─── CONTENT ─── 
.content{ flex:1; overflow-y:auto; padding:26px; display:flex; flex-direction:column; gap:20px; }*/

/* ─── SUMMARY PILLS ─── */
.summary-row{ display:grid; grid-template-columns:repeat(3,1fr); gap:14px; }
.pill{
  background:var(--surface); border:1px solid var(--border);
  border-radius:var(--radius); padding:18px 20px;
  display:flex; align-items:center; gap:14px;
  transition:var(--transition);
  animation:fadeUp 0.5s cubic-bezier(0.22,1,0.36,1) both;
}
.pill:hover{ border-color:var(--border-hover); transform:translateY(-2px); }
.pill:nth-child(1){ animation-delay:0.05s; }
.pill:nth-child(2){ animation-delay:0.1s; }
.pill:nth-child(3){ animation-delay:0.15s; }
.pill-icon{ width:42px; height:42px; border-radius:12px; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.pill-icon svg{ width:18px; height:18px; stroke:#fff; fill:none; stroke-width:1.8; }
.pill-val{ font-family:'Syne',sans-serif; font-size:22px; font-weight:700; color:#fff; line-height:1; }
.pill-lbl{ font-size:11.5px; color:var(--muted); margin-top:3px; font-weight:500; }

/* ─── CARD ─── 
.card{
  background:var(--surface); border:1px solid var(--border);
  border-radius:var(--radius); overflow:hidden;
  animation:fadeUp 0.55s cubic-bezier(0.22,1,0.36,1) both;
  animation-delay:0.2s;
}*/

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
.card-header{
  display:flex; align-items:center; justify-content:space-between;
  padding:18px 22px; border-bottom:1px solid var(--border); gap:14px;
}
.card-title{ font-family:'Syne',sans-serif; font-size:15px; font-weight:700; color:#fff; }

/* add button */
.add-btn{
  display:inline-flex; align-items:center; gap:8px;
  padding:10px 18px; border:none; border-radius:var(--radius-sm);
  background:var(--gradient); color:#fff;
  font-family:'DM Sans',sans-serif; font-size:13px; font-weight:600;
  cursor:pointer; transition:var(--transition);
  box-shadow:0 4px 16px rgba(255,106,0,0.25);
}
.add-btn:hover{ transform:translateY(-1px); box-shadow:0 6px 22px rgba(255,106,0,0.4); }
.add-btn svg{ width:15px; height:15px; stroke:#fff; fill:none; stroke-width:2.2; }

/* ─── TABLE ─── */
.table-wrap{ overflow-x:auto; }
table{ width:100%; border-collapse:collapse; }
thead tr{ background:var(--panel); }
thead th{
  padding:13px 18px; text-align:left;
  font-size:11px; font-weight:600; color:var(--muted);
  text-transform:uppercase; letter-spacing:0.9px; white-space:nowrap;
}
tbody tr{ border-bottom:1px solid var(--border); transition:var(--transition); }
tbody tr:last-child{ border-bottom:none; }
tbody tr:hover{ background:rgba(255,255,255,0.02); }
tbody td{ padding:14px 18px; font-size:13.5px; color:var(--sub); vertical-align:middle; }

.td-id{
  font-family:'Syne',sans-serif; font-size:12px; font-weight:700;
  color:var(--orange); background:rgba(255,106,0,0.08);
  padding:3px 9px; border-radius:6px; display:inline-block;
}
.td-name{ font-weight:600; color:var(--text); }
.td-desc{ color:var(--muted); font-size:13px; max-width:280px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }

.status-active{
  display:inline-flex; align-items:center; gap:6px;
  padding:5px 12px; border-radius:99px; font-size:11.5px; font-weight:600;
  background:rgba(34,197,94,0.1); color:#22c55e; border:1px solid rgba(34,197,94,0.2);
}
.status-inactive{
  display:inline-flex; align-items:center; gap:6px;
  padding:5px 12px; border-radius:99px; font-size:11.5px; font-weight:600;
  background:rgba(239,68,68,0.1); color:#ef4444; border:1px solid rgba(239,68,68,0.2);
}
.status-dot-s{ width:6px; height:6px; border-radius:50%; flex-shrink:0; }
.status-active .status-dot-s{ background:#22c55e; }
.status-inactive .status-dot-s{ background:#ef4444; }

.actions{ display:flex; align-items:center; gap:6px; }
.act-btn{
  width:32px; height:32px; border-radius:8px;
  background:var(--panel); border:1px solid var(--border);
  display:flex; align-items:center; justify-content:center;
  cursor:pointer; transition:var(--transition);
}
.act-btn svg{ width:14px; height:14px; stroke:var(--sub); fill:none; stroke-width:1.8; }
.act-btn.view:hover{ background:rgba(124,58,237,0.12); border-color:rgba(124,58,237,0.3); }
.act-btn.view:hover svg{ stroke:#a78bfa; }
.act-btn.edit:hover{ background:rgba(255,106,0,0.12); border-color:rgba(255,106,0,0.3); }
.act-btn.edit:hover svg{ stroke:var(--orange); }
.act-btn.del:hover{ background:rgba(239,68,68,0.12); border-color:rgba(239,68,68,0.3); }
.act-btn.del:hover svg{ stroke:#ef4444; }

/* empty state */
.empty-state{ padding:52px 24px; text-align:center; }
.empty-state svg{ width:48px; height:48px; stroke:var(--muted); fill:none; margin-bottom:16px; }
.empty-state p{ color:var(--muted); font-size:14px; }

/* ─── MODALS ─── */
.modal{
  position:fixed; inset:0;
  background:rgba(0,0,0,0.6);
  backdrop-filter:blur(6px);
  display:none; align-items:center; justify-content:center;
  z-index:1000;
}
.modal.show{ display:flex; }

.modal-box{
  background:var(--surface); border:1px solid var(--border);
  border-radius:22px; padding:28px; width:440px;
  max-width:calc(100vw - 32px);
  box-shadow:0 40px 80px rgba(0,0,0,0.6);
  animation:modalIn 0.28s cubic-bezier(0.22,1,0.36,1) both;
}
@keyframes modalIn{
  from{ opacity:0; transform:scale(0.94) translateY(16px); }
  to{ opacity:1; transform:none; }
}

.modal-head{
  display:flex; align-items:center; justify-content:space-between;
  margin-bottom:22px; padding-bottom:16px; border-bottom:1px solid var(--border);
}
.modal-head h3{ font-family:'Syne',sans-serif; font-size:17px; font-weight:700; color:#fff; }
.modal-close{
  width:30px; height:30px; border-radius:8px;
  background:var(--panel); border:1px solid var(--border);
  display:flex; align-items:center; justify-content:center;
  cursor:pointer; transition:var(--transition);
}
.modal-close:hover{ border-color:rgba(239,68,68,0.4); background:rgba(239,68,68,0.08); }
.modal-close svg{ width:13px; height:13px; stroke:var(--sub); fill:none; stroke-width:2; }

/* detail rows for view modal */
.detail-row{
  display:flex; align-items:flex-start; gap:14px;
  padding:11px 0; border-bottom:1px solid var(--border);
}
.detail-row:last-child{ border-bottom:none; }
.detail-icon{
  width:32px; height:32px; border-radius:9px;
  background:var(--panel);
  display:flex; align-items:center; justify-content:center; flex-shrink:0;
}
.detail-icon svg{ width:14px; height:14px; stroke:var(--orange); fill:none; stroke-width:1.8; }
.detail-lbl{ font-size:11px; color:var(--muted); font-weight:600; text-transform:uppercase; letter-spacing:0.7px; }
.detail-val{ font-size:14px; color:var(--text); font-weight:500; margin-top:2px; }

/* form fields */
.field{ margin-bottom:16px; }
.field-label{ display:block; font-size:11.5px; font-weight:600; color:var(--sub); text-transform:uppercase; letter-spacing:0.8px; margin-bottom:8px; }

.styled-input,.styled-textarea,.styled-select{
  width:100%; padding:12px 16px;
  background:var(--panel); border:1px solid var(--border);
  border-radius:var(--radius-sm); color:var(--text);
  font-family:'DM Sans',sans-serif; font-size:14px;
  outline:none; transition:var(--transition);
}
.styled-input:focus,.styled-textarea:focus,.styled-select:focus{
  border-color:rgba(255,106,0,0.4);
  box-shadow:0 0 0 3px rgba(255,106,0,0.07);
}
.styled-input::placeholder,.styled-textarea::placeholder{ color:var(--muted); }
.styled-textarea{ resize:vertical; min-height:90px; }
.styled-select{ cursor:pointer; }
.styled-select option{ background:var(--panel); }

/* modal actions */
.modal-actions{ display:flex; gap:10px; margin-top:22px; }

.btn-primary{
  flex:1; padding:13px; border:none; border-radius:var(--radius-sm);
  background:var(--gradient); color:#fff;
  font-family:'DM Sans',sans-serif; font-size:14px; font-weight:600;
  cursor:pointer; transition:var(--transition);
  box-shadow:0 4px 16px rgba(255,106,0,0.25);
}
.btn-primary:hover{ transform:translateY(-1px); box-shadow:0 6px 20px rgba(255,106,0,0.4); }

.btn-secondary{
  flex:1; padding:13px; border:1px solid var(--border);
  border-radius:var(--radius-sm); background:var(--panel); color:var(--sub);
  font-family:'DM Sans',sans-serif; font-size:14px; font-weight:600;
  cursor:pointer; transition:var(--transition);
}
.btn-secondary:hover{ border-color:var(--border-hover); color:var(--text); }

.btn-danger{
  flex:1; padding:13px; border:1px solid rgba(239,68,68,0.25);
  border-radius:var(--radius-sm); background:rgba(239,68,68,0.12); color:#ef4444;
  font-family:'DM Sans',sans-serif; font-size:14px; font-weight:600;
  cursor:pointer; transition:var(--transition);
}
.btn-danger:hover{ background:rgba(239,68,68,0.2); }

/* delete modal */
.delete-center{ text-align:center; }
.delete-icon{
  width:64px; height:64px; border-radius:50%;
  background:rgba(239,68,68,0.1); border:1px solid rgba(239,68,68,0.2);
  display:flex; align-items:center; justify-content:center; margin:0 auto 16px;
}
.delete-icon svg{ width:28px; height:28px; stroke:#ef4444; fill:none; stroke-width:1.8; }
.delete-center h3{ font-family:'Syne',sans-serif; font-size:18px; color:#fff; margin-bottom:8px; }
.delete-center p{ font-size:13.5px; color:var(--muted); }

/* logout modal */
.logout-center{ text-align:center; }
.logout-center-icon{
  width:56px; height:56px; border-radius:50%;
  background:rgba(255,106,0,0.1); border:1px solid rgba(255,106,0,0.2);
  display:flex; align-items:center; justify-content:center; margin:0 auto 14px;
}
.logout-center-icon svg{ width:22px; height:22px; stroke:var(--orange); fill:none; stroke-width:1.8; }
.logout-center h3{ font-family:'Syne',sans-serif; font-size:17px; color:#fff; margin-bottom:6px; }
.logout-center p{ font-size:13px; color:var(--muted); }

/* animations */
@keyframes fadeUp{
  from{ opacity:0; transform:translateY(16px); }
  to{ opacity:1; transform:none; }
}

/* ─── LIGHT MODE ─── */
html.light-mode{
  --bg:#f0f2f5;
  --surface:#ffffff;
  --panel:#f7f8fa;
  --border:rgba(0,0,0,0.08);
  --border-hover:rgba(0,0,0,0.15);
  --text:#111118;
  --muted:#9098a9;
  --sub:#555566;
}
html.light-mode .logo-text{ color:#111; }
html.light-mode .topbar-left h3{ color:#111; }
html.light-mode .card-title{ color:#111; }
html.light-mode .pill-val{ color:#111; }
html.light-mode .modal-head h3{ color:#111; }
html.light-mode .delete-center h3{ color:#111; }
html.light-mode .logout-center h3{ color:#111; }
html.light-mode .detail-val{ color:#111; }
html.light-mode .td-name{ color:#111; }
html.light-mode tbody td{ color:#444; }
html.light-mode .styled-input,
html.light-mode .styled-textarea,
html.light-mode .styled-select{ background:#fff; color:#111; border-color:rgba(0,0,0,0.12); }
html.light-mode .search-box input{ color:#111; }
html.light-mode .avatar-name{ color:#111; }

/* ─── DATE BADGE ─── */
.date-badge{
  font-size:12px; color:var(--sub);
  background:var(--panel);
  border:1px solid var(--border);
  padding:6px 14px; border-radius:99px;
  white-space:nowrap;
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
      <a href="{{ url('/admin/managecategories') }}" class="active">
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

      <a class="logout" onclick="logoutAdmin()">
        <span class="nav-icon">
          <svg viewBox="0 0 24 24" stroke="#ff4d4d"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
        </span>
        Logout
      </a>
    </div>
  </aside>

  <!-- MAIN -->
  <div class="main">

    <!-- TOPBAR -->
    <div class="topbar">
      <div class="topbar-left">
        <h3>Manage Services</h3>
        <p id="topbar-date">Loading date…</p>
      </div>

      <div class="search-box">
        <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        <input type="text" placeholder="Search users, bookings, providers…">
      </div>

      <div class="topbar-right">
            <span class="date-badge" id="date-badge">—</span>
            <div style="position: relative;"> 
        <div class="icon-btn" onclick="toggleNotifDropdown(event)" title="Notifications" style="cursor: pointer; position: relative; display: flex; align-items: center; justify-content: center;">
            <svg viewBox="0 0 24 24" style="width: 20px; height: 20px; fill: none; stroke: currentColor; stroke-width: 2;">
                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/>
            </svg>
        </div>

        <div id="bell-dropdown" style="display: none; position: absolute; top: 45px; right: 0; width: 280px; background: var(--surface); border: 1px solid var(--border); border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.5); z-index: 9999; overflow: hidden;">
            <div style="padding: 12px; border-bottom: 1px solid var(--border); background: rgba(255,255,255,0.02);">
                <h4 style="margin:0; font-family:'Syne'; font-size: 13px; color: #fff;">New Requests</h4>
            </div>
            <div style="padding: 20px; text-align: center; color: #606070; font-size: 12px;">No new notifications</div>
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

      <!-- SUMMARY PILLS -->
      <div class="summary-row">
        <div class="pill">
          <div class="pill-icon" style="background:var(--gradient);">
            <svg viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
          </div>
          <div>
            <div class="pill-val">{{ $services->count() }}</div>
            <div class="pill-lbl">Total Services</div>
          </div>
        </div>
        <div class="pill">
          <div class="pill-icon" style="background:linear-gradient(135deg,#22c55e,#16a34a);">
            <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
          </div>
          <div>
            <div class="pill-val">{{ $services->where('status',1)->count() }}</div>
            <div class="pill-lbl">Active</div>
          </div>
        </div>
        <div class="pill">
          <div class="pill-icon" style="background:linear-gradient(135deg,#ef4444,#dc2626);">
            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
          </div>
          <div>
            <div class="pill-val">{{ $services->where('status',0)->count() }}</div>
            <div class="pill-lbl">Inactive</div>
          </div>
        </div>
      </div>

      <!-- TABLE CARD -->
      <div class="card">
        <div class="card-header">
          <span class="card-title">Service List</span>
          <button class="add-btn" onclick="openForm()">
            <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Add Service
          </button>
        </div>

        <div class="table-wrap">
          <table>
            <thead>
              <tr>
                <th>ID</th>
                <th>Service Name</th>
                <th>Description</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @forelse($services as $service)
              <tr>
                <td><span class="td-id">#{{ $service->id }}</span></td>
                <td><span class="td-name">{{ $service->name }}</span></td>
                <td><span class="td-desc" title="{{ $service->description }}">{{ $service->description }}</span></td>
                <td>
                  @if($service->status == 1)
                    <span class="status-active"><span class="status-dot-s"></span>Active</span>
                  @else
                    <span class="status-inactive"><span class="status-dot-s"></span>Inactive</span>
                  @endif
                </td>
                <td>
                  <div class="actions">
                    <div class="act-btn view" title="View" onclick="viewService({{ $service->id }}, @js($service->name), @js($service->description), {{ $service->status }})">
                      <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    </div>
                    <div class="act-btn edit" title="Edit" onclick="editService({{ $service->id }}, @js($service->name), @js($service->description), {{ $service->status }})">
                      <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                    </div>
                    <form action="{{ route('managecategories.destroy', $service->id) }}" method="POST" style="display:inline" id="del-form-{{ $service->id }}">
                      @csrf @method('DELETE')
                      <div class="act-btn del" title="Delete" onclick="openDeletePopup({{ $service->id }})">
                        <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                      </div>
                    </form>
                  </div>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="5">
                  <div class="empty-state">
                    <svg viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
                    <p>No services found. Add your first one!</p>
                  </div>
                </td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- ── ADD / EDIT MODAL ── -->
<div class="modal" id="formModal">
  <div class="modal-box">
    <div class="modal-head">
      <h3 id="modalTitle">Add Service</h3>
      <div class="modal-close" onclick="closeModal('formModal')">
        <svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
      </div>
    </div>
    <form method="POST" id="serviceForm">
      @csrf
      <input type="hidden" name="_method" id="methodField">
      <div class="field">
        <label class="field-label">Service Name</label>
        <input class="styled-input" name="name" id="serviceName" placeholder="e.g. Plumbing, Electrical…" required>
      </div>
      <div class="field">
        <label class="field-label">Description</label>
        <textarea class="styled-textarea" name="description" id="serviceDesc" placeholder="Brief description of this service…"></textarea>
      </div>
      <div class="field">
        <label class="field-label">Status</label>
        <select class="styled-select" name="status" id="serviceStatus" required>
          <option value="1">Active</option>
          <option value="0">Inactive</option>
        </select>
      </div>
      <div class="modal-actions">
        <button type="button" class="btn-secondary" onclick="closeModal('formModal')">Cancel</button>
        <button type="submit" class="btn-primary">Save Service</button>
      </div>
    </form>
  </div>
</div>

<!-- ── VIEW MODAL ── -->
<div class="modal" id="viewModal">
  <div class="modal-box">
    <div class="modal-head">
      <h3>Service Details</h3>
      <div class="modal-close" onclick="closeModal('viewModal')">
        <svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
      </div>
    </div>
    <div class="detail-row">
      <div class="detail-icon"><svg viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16"/></svg></div>
      <div><div class="detail-lbl">Service Name</div><div class="detail-val" id="viewName">—</div></div>
    </div>
    <div class="detail-row">
      <div class="detail-icon"><svg viewBox="0 0 24 24"><line x1="17" y1="10" x2="3" y2="10"/><line x1="21" y1="6" x2="3" y2="6"/><line x1="21" y1="14" x2="3" y2="14"/><line x1="17" y1="18" x2="3" y2="18"/></svg></div>
      <div><div class="detail-lbl">Description</div><div class="detail-val" id="viewDesc">—</div></div>
    </div>
    <div class="detail-row">
      <div class="detail-icon"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
      <div><div class="detail-lbl">Status</div><div class="detail-val" id="viewStatus">—</div></div>
    </div>
    <div class="modal-actions">
      <button class="btn-primary" onclick="closeModal('viewModal')">Close</button>
    </div>
  </div>
</div>

<!-- ── DELETE MODAL ── -->
<div class="modal" id="deleteModal">
  <div class="modal-box">
    <div class="delete-center">
      <div class="delete-icon">
        <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/></svg>
      </div>
      <h3>Delete Service?</h3>
      <p>This action is permanent and cannot be undone.</p>
    </div>
    <div class="modal-actions" style="margin-top:26px;">
      <button class="btn-secondary" onclick="closeModal('deleteModal')">Cancel</button>
      <button class="btn-danger" id="confirmDeleteBtn">Yes, Delete</button>
    </div>
  </div>
</div>

<!-- ── LOGOUT MODAL ── -->
<div class="modal" id="logoutModal">
  <div class="modal-box">
    <div class="logout-center">
      <div class="logout-center-icon">
        <svg viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
      </div>
      <h3>Logout</h3>
      <p>Are you sure you want to sign out?</p>
    </div>
    <div class="modal-actions" style="margin-top:26px;">
      <button class="btn-secondary" onclick="closeModal('logoutModal')">Cancel</button>
      <button class="btn-primary" onclick="confirmLogout()">Logout</button>
    </div>
  </div>
</div>

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

// Theme toggle
function toggleTheme(){
  const isLight = document.documentElement.classList.toggle('light-mode');
  localStorage.setItem('theme', isLight ? 'light' : 'dark');
}
if(localStorage.getItem('theme') === 'light'){
  document.documentElement.classList.add('light-mode');
}

// Notification dropdown
function toggleNotifDropdown(event) {
  event.stopPropagation();
  const dropdown = document.getElementById('bell-dropdown');
  const profile = document.getElementById('profile');
  if(profile) profile.style.display = 'none';
  dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
}
document.addEventListener('click', e => {
  const dropdown = document.getElementById('bell-dropdown');
  if(dropdown && !e.target.closest('#bell-dropdown') && !e.target.closest('.icon-btn')){
    dropdown.style.display = 'none';
  }
});

// Modal helpers
function openModal(id)  { document.getElementById(id).classList.add('show'); }
function closeModal(id) { document.getElementById(id).classList.remove('show'); }
document.querySelectorAll('.modal').forEach(m => {
  m.addEventListener('click', e => { if (e.target === m) closeModal(m.id); });
});

// Add
function openForm() {
  document.getElementById('modalTitle').textContent = 'Add Service';
  document.getElementById('serviceForm').action = "{{ route('managecategories.store') }}";
  document.getElementById('methodField').value = '';
  document.getElementById('serviceName').value = '';
  document.getElementById('serviceDesc').value = '';
  document.getElementById('serviceStatus').value = '1';
  openModal('formModal');
}

// Edit
function editService(id, name, desc, status) {
  document.getElementById('modalTitle').textContent = 'Edit Service';
  document.getElementById('serviceForm').action = '/admin/managecategories/' + id;
  document.getElementById('methodField').value = 'PUT';
  document.getElementById('serviceName').value = name;
  document.getElementById('serviceDesc').value = desc;
  document.getElementById('serviceStatus').value = status.toString();
  openModal('formModal');
}

// View
function viewService(id, name, desc, status) {
  document.getElementById('viewName').textContent   = name;
  document.getElementById('viewDesc').textContent   = desc || '—';
  document.getElementById('viewStatus').textContent = status == 1 ? 'Active' : 'Inactive';
  openModal('viewModal');
}

// Delete
let deleteId = null;
function openDeletePopup(id) {
  deleteId = id;
  openModal('deleteModal');
}
document.getElementById('confirmDeleteBtn').onclick = function () {
  if (deleteId) document.getElementById('del-form-' + deleteId).submit();
};

// Logout
function logoutAdmin()  { openModal('logoutModal'); }
function confirmLogout(){ document.getElementById('adminLogoutForm').submit(); }
</script>
</body>
</html>
