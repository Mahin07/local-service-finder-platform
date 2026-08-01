<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Login | Helphub</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
<style>
:root{--bg:#0e0e12;--surface:#16161d;--panel:#1c1c26;--border:rgba(255,255,255,0.07);--orange:#ff6a00;--pink:#ee0979;--gradient:linear-gradient(135deg,#ff6a00,#ee0979);--text:#f0f0f0;--muted:#606070;--sub:#9898a8;--radius:14px;--radius-sm:11px;}
html.light-mode{--bg:#f0f2f5;--surface:#ffffff;--panel:#f7f8fa;--border:rgba(0,0,0,0.08);--text:#111118;--muted:#9098a9;--sub:#555566;}
*,*::before,*::after{margin:0;box-sizing:border-box;}
body{font-family:'DM Sans',sans-serif;background:var(--bg);color:var(--text);height:100vh;display:flex;align-items:center;justify-content:center;overflow:hidden;}
.theme-btn{position:absolute;top:22px;right:22px;width:38px;height:38px;border-radius:var(--radius-sm);background:var(--surface);border:1px solid var(--border);display:flex;align-items:center;justify-content:center;cursor:pointer;transition:all 0.2s ease;z-index:10;}
.theme-btn:hover{border-color:rgba(255,106,0,0.35);background:rgba(255,106,0,0.08);}
.theme-btn svg{width:16px;height:16px;stroke:var(--sub);fill:none;stroke-width:1.8;}
.login-card{display:flex;width:860px;max-width:96vw;min-height:520px;border-radius:20px;overflow:hidden;box-shadow:0 30px 80px rgba(0,0,0,0.5);border:1px solid var(--border);}
.left{flex:1;background:var(--surface);border-right:1px solid var(--border);padding:48px 44px;display:flex;flex-direction:column;justify-content:center;position:relative;overflow:hidden;}
.glow-top{position:absolute;top:-80px;left:-80px;width:280px;height:280px;border-radius:50%;background:radial-gradient(circle,rgba(255,106,0,0.13),transparent 70%);pointer-events:none;}
.glow-bottom{position:absolute;bottom:-60px;right:-60px;width:220px;height:220px;border-radius:50%;background:radial-gradient(circle,rgba(238,9,121,0.1),transparent 70%);pointer-events:none;}
.brand{display:flex;align-items:center;gap:11px;margin-bottom:42px;}
.brand-icon{width:38px;height:38px;border-radius:11px;background:var(--gradient);display:flex;align-items:center;justify-content:center;box-shadow:0 4px 16px rgba(255,106,0,0.35);flex-shrink:0;}
.brand-icon svg{width:18px;height:18px;stroke:#fff;fill:none;stroke-width:2;}
.brand-name{font-family:'Syne',sans-serif;font-size:20px;font-weight:800;color:var(--text);}
.hero-tag{display:inline-flex;align-items:center;gap:7px;background:rgba(255,106,0,0.1);border:1px solid rgba(255,106,0,0.2);border-radius:99px;padding:5px 13px;margin-bottom:18px;width:fit-content;}
.hero-dot{width:6px;height:6px;border-radius:50%;background:var(--orange);}
.hero-tag span{font-size:11px;font-weight:600;color:var(--orange);letter-spacing:0.5px;}
.hero-title{font-family:'Syne',sans-serif;font-size:26px;font-weight:800;color:var(--text);line-height:1.3;margin-bottom:14px;}
.hero-title .accent{background:var(--gradient);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;}
.hero-sub{font-size:13px;color:var(--muted);line-height:1.75;margin-bottom:36px;}
.stats-row{display:flex;gap:14px;}
.stat-mini{background:var(--panel);border:1px solid var(--border);border-radius:12px;padding:14px 18px;flex:1;}
.stat-mini-num{font-family:'Syne',sans-serif;font-size:20px;font-weight:800;color:var(--text);}
.stat-mini-label{font-size:10px;color:var(--muted);font-weight:600;text-transform:uppercase;letter-spacing:0.5px;margin-top:3px;}
.right{width:380px;flex-shrink:0;background:var(--bg);padding:40px 38px;display:flex;flex-direction:column;justify-content:center;}

/* AVATAR */
.avatar-upload{display:flex;flex-direction:column;align-items:center;margin-bottom:22px;}
.avatar-ring{width:78px;height:78px;border-radius:50%;background:var(--surface);border:2px dashed rgba(255,106,0,0.45);display:flex;align-items:center;justify-content:center;cursor:pointer;position:relative;overflow:hidden;transition:all 0.22s ease;margin-bottom:7px;}
.avatar-ring:hover{border-color:var(--orange);box-shadow:0 0 0 4px rgba(255,106,0,0.1);}
.avatar-ring:hover .avatar-overlay{opacity:1;}
.avatar-placeholder{display:flex;flex-direction:column;align-items:center;gap:3px;}
.avatar-placeholder svg{width:22px;height:22px;stroke:var(--muted);fill:none;stroke-width:1.6;}
.avatar-placeholder span{font-size:9.5px;color:var(--muted);font-weight:500;}
.avatar-preview{width:100%;height:100%;object-fit:cover;border-radius:50%;display:none;}
.avatar-overlay{position:absolute;inset:0;background:rgba(255,106,0,0.5);display:flex;align-items:center;justify-content:center;opacity:0;transition:opacity 0.2s;border-radius:50%;}
.avatar-overlay svg{width:16px;height:16px;stroke:#fff;fill:none;stroke-width:2;}
.avatar-badge{position:absolute;bottom:2px;right:2px;width:20px;height:20px;border-radius:50%;background:var(--gradient);display:flex;align-items:center;justify-content:center;border:2px solid var(--bg);}
.avatar-badge svg{width:9px;height:9px;stroke:#fff;fill:none;stroke-width:2.5;}
.avatar-hint{font-size:11px;color:var(--muted);text-align:center;}
#fileInput{display:none;}

.form-header{margin-bottom:18px;text-align:center;}
.form-title{font-family:'Syne',sans-serif;font-size:20px;font-weight:800;color:var(--text);margin-bottom:4px;}
.form-sub{font-size:12.5px;color:var(--muted);}
.alert-error{background:rgba(238,9,121,0.08);border:1px solid rgba(238,9,121,0.2);border-radius:var(--radius-sm);padding:10px 13px;font-size:12.5px;color:var(--pink);margin-bottom:14px;display:none;}
.field{margin-bottom:13px;}
.field label{display:block;font-size:11px;font-weight:600;color:var(--sub);text-transform:uppercase;letter-spacing:0.7px;margin-bottom:6px;}
.input-wrap{display:flex;align-items:center;gap:10px;background:var(--surface);border:1px solid var(--border);border-radius:var(--radius-sm);padding:11px 15px;transition:all 0.2s ease;}
.input-wrap:focus-within{border-color:rgba(255,106,0,0.4);background:var(--panel);box-shadow:0 0 0 3px rgba(255,106,0,0.08);}
.input-wrap svg{width:15px;height:15px;stroke:var(--muted);fill:none;stroke-width:1.8;flex-shrink:0;}
.input-wrap input{background:none;border:none;outline:none;font-family:'DM Sans',sans-serif;font-size:13.5px;color:var(--text);width:100%;}
.input-wrap input::placeholder{color:var(--muted);}
.eye-btn{cursor:pointer;flex-shrink:0;opacity:0.5;transition:opacity 0.2s;}
.eye-btn:hover{opacity:1;}
.form-row{display:flex;align-items:center;justify-content:space-between;margin-bottom:18px;}
.remember{display:flex;align-items:center;gap:8px;cursor:pointer;user-select:none;}
.check-box{width:17px;height:17px;border-radius:5px;border:1px solid rgba(255,255,255,0.15);background:var(--surface);display:flex;align-items:center;justify-content:center;transition:all 0.2s;flex-shrink:0;}
.check-box.checked{background:var(--gradient);border-color:transparent;}
.check-box svg{width:10px;height:10px;stroke:#fff;fill:none;stroke-width:2.5;display:none;}
.check-box.checked svg{display:block;}
.remember span{font-size:12.5px;color:var(--sub);}
.forgot{font-size:12.5px;color:var(--orange);font-weight:500;cursor:pointer;text-decoration:none;}
.forgot:hover{opacity:0.75;}
.login-btn{width:100%;padding:13px;border:none;border-radius:var(--radius-sm);background:var(--gradient);color:#fff;font-family:'DM Sans',sans-serif;font-size:14px;font-weight:700;cursor:pointer;box-shadow:0 4px 24px rgba(255,106,0,0.3);transition:all 0.22s ease;}
.login-btn:hover{opacity:0.88;transform:translateY(-1px);}
.login-btn:active{transform:scale(0.98);}
.btn-loader{display:none;width:16px;height:16px;border:2px solid rgba(255,255,255,0.3);border-top-color:#fff;border-radius:50%;animation:spin 0.7s linear infinite;margin:0 auto;}
@keyframes spin{to{transform:rotate(360deg);}}
.divider{display:flex;align-items:center;gap:12px;margin:15px 0;}
.divider-line{flex:1;height:1px;background:var(--border);}
.divider span{font-size:11px;color:var(--muted);white-space:nowrap;}
.ssl-badge{display:flex;align-items:center;justify-content:center;gap:8px;background:var(--surface);border:1px solid var(--border);border-radius:var(--radius-sm);padding:11px;}
.ssl-badge svg{width:14px;height:14px;stroke:var(--muted);fill:none;stroke-width:1.8;}
.ssl-badge span{font-size:11.5px;color:var(--muted);}
</style>
</head>
<body>

<button class="theme-btn" onclick="toggleTheme()" title="Toggle theme">
  <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>
</button>

<div class="login-card">

  <div class="left">
    <div class="glow-top"></div>
    <div class="glow-bottom"></div>
    <div class="brand">
      <div class="brand-icon">
        <svg viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
      </div>
      <span class="brand-name">Helphub</span>
    </div>
    <div class="hero-tag"><span class="hero-dot"></span><span>Admin Portal</span></div>
    <h1 class="hero-title">Manage your platform<br>with <span class="accent">full control</span></h1>
    <p class="hero-sub">Access the complete admin dashboard to manage users, providers, bookings, and platform analytics all in one place.</p>
    <div class="stats-row">
      <div class="stat-mini"><div class="stat-mini-num">120+</div><div class="stat-mini-label">Users</div></div>
      <div class="stat-mini"><div class="stat-mini-num">48</div><div class="stat-mini-label">Providers</div></div>
      <div class="stat-mini"><div class="stat-mini-num">310</div><div class="stat-mini-label">Bookings</div></div>
    </div>
  </div>

  <div class="right">

    <!-- ROUND AVATAR UPLOAD -->
    <div class="avatar-upload">
      <div class="avatar-ring" id="avatarBox" onclick="document.getElementById('fileInput').click()">
        <div class="avatar-placeholder" id="avatarPlaceholder">
          <svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
          <span>Upload</span>
        </div>
        <img id="avatarPreview" class="avatar-preview" alt="Admin">
        <div class="avatar-overlay">
          <svg viewBox="0 0 24 24"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
        </div>
        <div class="avatar-badge">
          <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        </div>
      </div>
      <span class="avatar-hint">Click to upload photo</span>
    </div>

    <input type="file" id="fileInput" accept="image/*">

    <div class="form-header">
      <div class="form-title">Welcome back</div>
      <div class="form-sub">Sign in to your admin account</div>
    </div>

    <div class="alert-error" id="alertBox">
      @if($errors->any()){{ $errors->first() }}@endif
    </div>

    <form method="POST" action="/admin/login" id="loginForm">
      @csrf
      <div class="field">
        <label>Username</label>
        <div class="input-wrap">
          <svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
          <input type="text" name="username" placeholder="Enter your username" value="{{ old('username') }}" autocomplete="username" required>
        </div>
      </div>
      <div class="field">
        <label>Password</label>
        <div class="input-wrap">
          <svg viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
          <input type="password" name="password" id="passwordInput" placeholder="Enter your password" autocomplete="current-password" required>
          <span class="eye-btn" onclick="togglePassword()">
            <svg id="eyeIcon" viewBox="0 0 24 24" width="15" height="15" stroke="var(--muted)" fill="none" stroke-width="1.8"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
          </span>
        </div>
      </div>
      <div class="form-row">
        <div class="remember" onclick="toggleRemember()">
          <div class="check-box checked" id="checkBox">
            <svg viewBox="0 0 12 12"><polyline points="2 6 5 9 10 3"/></svg>
          </div>
          <span>Remember me</span>
        </div>
        <a href="#" class="forgot">Forgot password?</a>
      </div>
      <button type="submit" class="login-btn" id="loginBtn">
        <span id="btnText">Sign In to Dashboard</span>
        <div class="btn-loader" id="btnLoader"></div>
      </button>
    </form>

    <div class="divider"><div class="divider-line"></div><span>secured access</span><div class="divider-line"></div></div>

    <div class="ssl-badge">
      <svg viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
      <span>Protected by 256-bit SSL encryption</span>
    </div>
  </div>
</div>

<script>
function toggleTheme(){const l=document.documentElement.classList.toggle('light-mode');localStorage.setItem('theme',l?'light':'dark');}
if(localStorage.getItem('theme')==='light'){document.documentElement.classList.add('light-mode');}

const fileInput=document.getElementById('fileInput');
const preview=document.getElementById('avatarPreview');
const placeholder=document.getElementById('avatarPlaceholder');
fileInput.onchange=()=>{
  const file=fileInput.files[0];if(!file)return;
  const reader=new FileReader();
  reader.onload=e=>{
    preview.src=e.target.result;
    preview.style.display='block';
    placeholder.style.display='none';
    localStorage.setItem('adminImage',e.target.result);
  };
  reader.readAsDataURL(file);
};

function togglePassword(){
  const inp=document.getElementById('passwordInput');
  const icon=document.getElementById('eyeIcon');
  if(inp.type==='password'){inp.type='text';icon.innerHTML='<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>';}
  else{inp.type='password';icon.innerHTML='<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>';}
}

function toggleRemember(){document.getElementById('checkBox').classList.toggle('checked');}

document.getElementById('loginForm').addEventListener('submit',function(){
  document.getElementById('btnText').style.display='none';
  document.getElementById('btnLoader').style.display='block';
  document.getElementById('loginBtn').disabled=true;
});

document.addEventListener('DOMContentLoaded',()=>{
  const box=document.getElementById('alertBox');
  if(box&&box.textContent.trim())box.style.display='block';
});
</script>
</body>
</html>