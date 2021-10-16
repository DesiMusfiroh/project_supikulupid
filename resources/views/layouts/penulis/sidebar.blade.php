<div class="main-sidebar">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="index.html">SipuKulupid</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">SK</a>
      </div>
      <ul class="sidebar-menu">
          <li class="menu-header">Dashboard</li>
          <li class="{{(request()->is('/home')) ? 'active' : ''}}" ><a class="nav-link" href="/home"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>

          <li class="menu-header">Postingan</li>
          <li class="nav-item dropdown {{(request()->is('penulis/postingan')) ? 'active' : ''}}">
            <a href="#" class="nav-link has-dropdown"><i class="far fa-file-alt"></i> <span>Postingan</span></a>
            <ul class="dropdown-menu">
              <li><a class="nav-link" href="/postingan/create">Buat Postingan</a></li>
              <li><a class="nav-link" href="/postingan_penulis">Riwayat Postingan</a></li>
            </ul>
          </li>
          <li class="{{(request()->is('logs_penulis')) ? 'active' : ''}}"><a class="nav-link" href="/logs_penulis"><i class="fas fa-pencil-ruler"></i> <span>Aktivitas</span></a></li>
        
          <li class="menu-header">Pengaturan</li>
          
          <li class="{{(request()->is('/profil/edit')) ? 'active' : ''}}"><a class="nav-link" href="/profil/edit"><i class="fa fa-user"></i> <span>Profil</span></a></li>
          <li class="{{(request()->is('pengaturan_penulis')) ? 'active' : ''}}"><a class="nav-link" href="/pengaturan_penulis"><i class="fa fa-cog"></i> <span>Pengaturan Akun</span></a></li>
        
        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
          <a href="/" class="btn btn-primary btn-lg btn-block btn-icon-split">
            <i class="fas fa-rocket"></i> Ke Halaman Utama
          </a>
        </div>
    </aside>
  </div>