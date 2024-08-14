<header class="bg-beige-100 border-b border-gray-100 ">
    <div class="flex lg:justify-center lg:col-start-3 ">

                    <a href="{{ route('dashboard') }}">
                    <img src="/img/book.png" id="bb" alt="Logo" class="block h-9 w-auto" />
                    </a>
                    <a class="navbar-brand" href="#" id="b">Bienvenido</a>
                
    </div>

    <button class="openbtn" onclick="toggleSidebar()" style="left: 15px;position: fixed">
        <img src="{{ asset('img/menu.png') }}" alt="Menu Icon" style="width:30px;height:30px;">
    </button>
   

    @if (Route::has('login'))
        <nav class="-mx-3 flex flex-1 justify-end">
            @auth
                <a
                    href="{{ route ('dashboard') }}"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                >
                    Dashboard
                </a>
            @else
                <a
                    href="{{ route('login') }}"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                >
                    Log in
                </a>

                @if (Route::has('register'))
                    <a
                        href="{{ route('register') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                    >
                        Register
                    </a>
                @endif
            @endauth
        </nav>
    @endif
</header>
<script>
function toggleSidebar() {
    var sidebar = document.getElementById("mySidebar");
    sidebar.classList.toggle("show");

    if (sidebar.classList.contains("show")) {
        // Si se abre el sidebar, agregar un listener para cerrar si se hace clic fuera
        document.addEventListener('click', closeSidebarOnClickOutside);
    } else {
        // Si se cierra el sidebar, remover el listener
        document.removeEventListener('click', closeSidebarOnClickOutside);
    }
}
</script>
<style>
.openbtn {
    z-index: 1001; 
 
}
#b{
    margin-top: 20px;
    font-size: 1.55rem;
}
#bb{
    margin-top: 19px;
}
nav a {
    font-size: 1.15rem; 
  
}
</style>