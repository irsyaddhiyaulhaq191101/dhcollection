<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
     <div class="position-sticky pt-3">
       <ul class="nav flex-column">
         <li class="nav-item">
           <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" aria-current="page" href="/">
             <span data-feather="home" class="align-text-bottom"></span>
             Dashboard
           </a>
         </li>
         <li class="nav-item">
           <a class="nav-link {{ Request::is('dashboard/pengedar*')  ? 'active' : '' }}" aria-current="page" href="/dashboard/pengedar">
             <span data-feather="user-check" class="align-text-bottom"></span>
             Pengedar Paket
           </a>
         </li>
         <li class="nav-item">
           <a class="nav-link {{ Request::is('dashboard/pelanggan*', 'dashboard/pesanan*')  ? 'active' : '' }}" aria-current="page" href="/dashboard/pelanggan">
             <span data-feather="users" class="align-text-bottom"></span>
             Pelanggan Paket
           </a>
         </li>
         <li class="nav-item">
           <a class="nav-link {{ Request::is('dashboard/barang*')  ? 'active' : '' }}" aria-current="page" href="/dashboard/barang">
             <span data-feather="list" class="align-text-bottom"></span>
             Barang
           </a>
         </li>
         <li class="nav-item">
           <a class="nav-link {{ Request::is('dashboard/category*')  ? 'active' : '' }}" aria-current="page" href="/dashboard/category">
             <span data-feather="slack" class="align-text-bottom"></span>
             Kategori
           </a>
         </li>
       </ul>
     
       <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
         <span>Options</span>
       </h6>
       <ul class="nav flex-column">
         <li class="nav-item">
           <a class="nav-link" aria-current="page" href="#">
             <span data-feather="log-out" class="align-text-bottom"></span>
             Logout
           </a>
         </li>
       </ul>
     </div>
</nav>