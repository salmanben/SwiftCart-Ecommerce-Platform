<nav class="navbar ms-auto bg-warning">
    <div class="container-fluid py-3 px-4 d-flex justify-content-between align-items-center">
     <i class="fa-solid fa-bars text-white fs-4"></i>
      <div class="d-flex align-item-center">
         <div class="dropdown">
             <a class="dropdown-toggle text-white text-decoration-none" style="position: relative; bottom:5px" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{auth()->user()->image ? asset('storage/upload/'.auth()->user()->image) : asset('site_image/alt_img_profile.png')}}"
                class="rounded-circle"  alt="">
                <span class="admin-name ms-2">
                   Hi, {{auth()->user()->name}}
               </span>
             </a>
             <ul class="dropdown-menu admin-menu">
               <li><a class="dropdown-item" href="{{route('admin.profile')}}"><i class="fa-solid fa-user me-3"></i>Profile</a></li>
               <li><hr class="dropdown-divider"></hr></li>
               <li><form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{route('logout')}}"class="dropdown-item has-icon text-danger logout">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
              </form></li>
             </ul>
         </div>
      </div>
    </div>
</nav>

