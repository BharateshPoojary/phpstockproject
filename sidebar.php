
  <aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
      <div class="brand-logo d-flex align-items-center justify-content-between">
        <a href="/PHPDASHBOARD/dashboard.php" class="text-nowrap logo-img">
          <img src="./assets/images/logos/logo.svg" alt="" />
        </a>
        <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
          <i class="ti ti-x fs-8"></i>
        </div>
      </div>
      <!-- Sidebar navigation-->
      <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
        <ul id="sidebarnav">
          <li class="nav-small-cap">
            <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
            <span class="hide-menu">Home</span>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="/PHPDASHBOARD/dashboard.php" aria-expanded="false">
              <iconify-icon icon="solar:widget-add-line-duotone"></iconify-icon>
              <span class="hide-menu">Dashboard</span>
            </a>
          </li>
          <li>
            <span class="sidebar-divider lg"></span>
          </li>
      
 
          
          <li class="nav-small-cap">
            <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
            <span class="hide-menu">UI COMPONENTS</span>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="/PHPDASHBOARD/category.php" aria-expanded="false">
              <iconify-icon icon="solar:passport-minimalistic-outline"></iconify-icon>
              <span class="hide-menu">Categories</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="/PHPDASHBOARD/button.php" aria-expanded="false">
              <iconify-icon icon="solar:layers-minimalistic-bold-duotone"></iconify-icon>
              <span class="hide-menu">Buttons</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="/PHPDASHBOARD/alerts.php" aria-expanded="false">
              <iconify-icon icon="solar:danger-circle-line-duotone"></iconify-icon>
              <span class="hide-menu">Alerts</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="/PHPDASHBOARD/card.php" aria-expanded="false">
              <iconify-icon icon="solar:bookmark-square-minimalistic-line-duotone"></iconify-icon>
              <span class="hide-menu">Card</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="/PHPDASHBOARD/forms.php" aria-expanded="false">
              <iconify-icon icon="solar:file-text-line-duotone"></iconify-icon>
              <span class="hide-menu">Forms</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="/PHPDASHBOARD/typography.php" aria-expanded="false">
              <iconify-icon icon="solar:text-field-focus-line-duotone"></iconify-icon>
              <span class="hide-menu">Typography</span>
            </a>
          </li>
          <div id="auth-options">
            <li>
              <span class="sidebar-divider lg"></span>
            </li>
            <li class="nav-small-cap">
              <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
              <span class="hide-menu">AUTH</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="/PHPDASHBOARD/login.php" aria-expanded="false">
                <iconify-icon icon="solar:login-3-line-duotone"></iconify-icon>
                <span class="hide-menu">Login</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="/PHPDASHBOARD/register.php" aria-expanded="false">
                <iconify-icon icon="solar:user-plus-rounded-line-duotone"></iconify-icon>
                <span class="hide-menu">Register</span>
              </a>
            </li>
          </div>
          <script>
            const isDataPresent = localStorage.getItem("userCreds");
            const authoptions = document.getElementById('auth-options');
            if (isDataPresent) {
              authoptions.style.display="none";
            }else{
              authoptions.style.display="block";
            }
          </script>
          <li>
            <span class="sidebar-divider lg"></span>
          </li>
          <li class="nav-small-cap">
            <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
            <span class="hide-menu">EXTRA</span>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="/PHPDASHBOARD/icontabler.php" aria-expanded="false">
              <iconify-icon icon="solar:sticker-smile-circle-2-line-duotone"></iconify-icon>
              <span class="hide-menu">Icons</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="/PHPDASHBOARD/samplepage.php" aria-expanded="false">
              <iconify-icon icon="solar:planet-3-line-duotone"></iconify-icon>
              <span class="hide-menu">Sample Page</span>
            </a>
          </li>
        </ul>
        <div
          class="unlimited-access d-flex align-items-center hide-menu bg-primary-subtle position-relative mb-7 mt-4 p-3 rounded">
          <div class="me-2 flex-shrink-0">
            <h6 class="fw-semibold fs-4 mb-6 text-dark w-75">
              Upgrade to pro
            </h6>
            <a href="https://adminmart.com/product/matdash-bootstrap-5-admin-dashboard-template/" target="_blank"
              class="btn btn-primary fs-2 fw-semibold lh-sm">Buy Pro</a>
          </div>
          <div class="unlimited-access-img">
            <img src="./assets/images/backgrounds/rupee.png" alt="" class="img-fluid" />
          </div>
        </div>
      </nav>
      <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
  </aside>
