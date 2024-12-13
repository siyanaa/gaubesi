<style>
    .nav-item {
        list-style-type: none;
    }
</style>

<nav class="navbar navbar-light navbar-vertical navbar-expand-xl">
    <script>
        var navbarStyle = localStorage.getItem("navbarStyle");
        if (navbarStyle && navbarStyle !== 'transparent') {
            document.querySelector('.navbar-vertical').classList.add(`navbar-${navbarStyle}`);
        }
    </script>
    <div class="d-flex align-items-center">
        <div class="toggle-icon-wrapper">
            <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle" data-bs-toggle="tooltip"
                data-bs-placement="left" aria-label="Toggle Navigation" data-bs-original-title="Toggle Navigation"><span
                    class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
        </div><a class="navbar-brand" href="{{ route('admin.index') }}">
            <div class="d-flex align-items-center py-3"><img class="me-2"
                    src="{{ asset('adminassets/assets/img/icons/spot-illustrations/falcon.png') }}" alt=""
                    width="40"><span class="font-sans-serif">Admin</span></div>
        </a>
    </div>
    <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
        <div class="navbar-vertical-content scrollbar">
            <ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">
                <li class="nav-item">
                    <a class="nav-link dropdown-indicator" href="#dashboard" role="button" data-bs-toggle="collapse"
                        aria-expanded="true" aria-controls="dashboard">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <svg class="svg-inline--fa fa-chart-pie fa-w-17" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="chart-pie" role="img"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 544 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M527.79 288H290.5l158.03 158.03c6.04 6.04 15.98 6.53 22.19.68 38.7-36.46 65.32-85.61 73.13-140.86 1.34-9.46-6.51-17.85-16.06-17.85zm-15.83-64.8C503.72 103.74 408.26 8.28 288.8.04 279.68-.59 272 7.1 272 16.24V240h223.77c9.14 0 16.82-7.68 16.19-16.8zM224 288V50.71c0-9.55-8.39-17.4-17.84-16.06C86.99 51.49-4.1 155.6.14 280.37 4.5 408.51 114.83 513.59 243.03 511.98c50.4-.63 96.97-16.87 135.26-44.03 7.9-5.6 8.42-17.23 1.57-24.08L224 288z">
                                    </path>
                                </svg>
                                <a href="#"><span class="nav-link-text ps-1">Dashboard</span></a>
                            </span>
                        </div>
                    </a>
                </li>


                {{-- Beginning of Site Settings --}}

                <li class="nav-item">
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label">Site Settings</div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider">
                        </div>
                    </div>
                <li class="nav-item">
                    <a class="nav-link dropdown-indicator {{ Request::segment(2) == 'site-settings' ? '' : 'collapsed' }}"
                        href="#dashboard1" role="button" data-bs-toggle="collapse"
                        aria-expanded="{{ Request::segment(2) == 'site-settings' ? 'true' : 'false' }}"
                        aria-controls="dashboard1">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"><i class="fas fa-cogs"></i></span>
                            <span class="nav-link-text ps-1">Site Settings</span>
                        </div>
                    </a>
                    <ul class="nav collapse {{ Request::segment(2) == 'site-settings' ? 'show' : '' }}" id="dashboard1">

                        <li class="nav-item">
                            <a class="nav-link {{ Request::segment(2) == 'site-settings' ? 'active' : '' }}"
                                href="{{ route('sitesettings.index') }}">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-icon"><i class="fas fa-cog"></i></span>
                            <span class="nav-link-text ps-1">Sitesetting</span>
                                </div>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ Request::segment(2) == 'favicons' ? 'active' : '' }}"
                                href="{{ route('favicons.index') }}">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-icon"><i class="fas fa-globe"></i></span>
                            <span class="nav-link-text ps-1">Favicons</span>
                                </div>
                            </a>
                        </li>


                        {{-- <li class="nav-item">
                            <a class="nav-link {{ Request::segment(2) == 'social-links' ? 'active' : '' }}"
                                href="{{ route('social-links.index') }}">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-angle-double-right"></i> Social Links
                                </div>
                            </a>
                        </li> --}}

                    </ul>
                </li>
                </li>

                {{-- End of Site Settings --}}



                {{-- Start of the Information --}}
                <li class="nav-item">
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label">Informations</div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider">
                        </div>
                    </div>
                <li class="nav-item">
                    <a class="nav-link dropdown-indicator {{ Request::segment(2) == 'information' ? '' : 'collapsed' }}"
                        href="#dashboard2" role="button" data-bs-toggle="collapse"
                        aria-expanded="{{ Request::segment(2) == 'information' ? 'true' : 'false' }}"
                        aria-controls="dashboard2">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"><i class="fas fa-info"></i></span>
                            <span class="nav-link-text ps-1">Informations</span>
                        </div>
                    </a>
                    <ul class="nav collapse" id="dashboard2">

                        {{-- <li class="nav-item">
                            <!-- Top-level link for AboutUs -->
                            <a class="nav-link {{ Request::is('admin/aboutus*') ? 'active' : '' }}"
                                href="{{ route('aboutus.index') }}">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-icon"><i class="fas fa-history"></i></span>
                                    <span class="nav-link-text ps-1">About Us</span>
                                </div>
                            </a>
                        </li> --}}


                        {{-- <li class="nav-item">
                            <!-- Top-level link for AboutUs -->
                            <a class="nav-link {{ Request::is('admin/about_descriptions*') ? 'active' : '' }}"
                                href="{{ route('admin.about_descriptions.index') }}">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-icon"><i class="fas fa-balance-scale"></i></span>
                                    <span class="nav-link-text ps-1">MVC</span>
                                </div>
                            </a>
                        </li> --}}


                        {{-- <li class="nav-item">
                            <!-- Top-level link for WhyUs -->
                            <a class="nav-link {{ Request::is('admin/whyus*') ? 'active' : '' }}"
                                href="{{ route('whyus.index') }}">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-icon"><i class="fas fa-handshake"></i></span>
                                    <span class="nav-link-text ps-1">Why Us</span>
                                </div>
                            </a>
                        </li> --}}



                        <li class="nav-item">
                            <!-- Top-level link for AboutUs -->
                            <a class="nav-link {{ Request::is('admin/team*') ? 'active' : '' }}"
                                href="{{ route('admin.team.index') }}">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-icon"><i class="fas fa-user-friends"></i></span>
                                    <span class="nav-link-text ps-1">Team</span>
                                </div>
                            </a>
                        </li>

                        {{-- <li class="nav-item">
                            <!-- Top-level link for Services -->
                            <a class="nav-link {{ Request::is('admin/services*') ? 'active' : '' }}"
                                href="{{ route('services.index') }}">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-icon"><i class="fas fa-bullhorn"></i></span>
                                    <span class="nav-link-text ps-1">Services</span>
                                </div>
                            </a>
                        </li> --}}

                        <li class="nav-item">
                            <!-- Top-level link for AboutUs -->
                            <a class="nav-link {{ Request::is('admin/faqs*') ? 'active' : '' }}"
                                href="{{ route('admin.faqs.index') }}">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-icon"><i class="fas fa-question-circle"></i></span>
                                    <span class="nav-link-text ps-1">FAQS</span>
                                </div>
                            </a>
                        </li>

                        <li class="nav-item">
                        <!-- Top-level link for Contact -->
                        <a class="nav-link {{ Request::is('admin/contact*') ? 'active' : '' }}"
                        href="{{ route('contact.index') }}">
                         <div class="d-flex align-items-center">
                             <span class="nav-link-icon"><i class="fas fa-phone"></i></span>
                             <span class="nav-link-text ps-1">Contact</span>
                         </div>
                     </a>
                 </li>


                 <li class="nav-item">
                     <!-- Top-level link for Reviews -->
                     <a class="nav-link {{ Request::is('admin/review*') ? 'active' : '' }}"
                        href="{{ route('review.index') }}">
                         <div class="d-flex align-items-center">
                             <span class="nav-link-icon"><i class="fas fa-star"></i></span>
                             <span class="nav-link-text ps-1">Reviews/Ratings</span>
                         </div>
                     </a>
                 </li>

                 <li class="nav-item">
                    <!-- Top-level link for Favorites -->
                    <a class="nav-link {{ Request::is('admin/favorites*') ? 'active' : '' }}"
                       href="{{ route('favorites.index') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"><i class="fas fa-heart"></i></span>
                            <span class="nav-link-text ps-1">User's Favorite</span>
                        </div>
                    </a>
                </li>

                <li class="nav-item">
                    <!-- Top-level link for Orders -->
                    <a class="nav-link {{ Request::is('admin/orders*') ? 'active' : '' }}"
                       href="{{ route('orders.index') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"><i class="fas fa-order"></i></span>
                            <span class="nav-link-text ps-1">Orders</span>
                        </div>
                    </a>
                </li>

                {{-- <li class="nav-item">
                    <!-- Top-level link for Cart -->
                    <a class="nav-link {{ Request::is('admin/cart*') ? 'active' : '' }}"
                       href="{{ route('cart.index') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"><i class="fas fa-cart"></i></span>
                            <span class="nav-link-text ps-1">Cart</span>
                        </div>
                    </a>
                </li> --}}

                    </ul>
                </li>
                </li>



                {{-- For Product Management --}}

                <li class="nav-item">
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label">Product Management</div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider">
                        </div>
                    </div>
                    <li class="nav-item">
                        <a class="nav-link dropdown-indicator {{ Request::segment(2) == 'information' ? '' : 'collapsed' }}"
                            href="#dashboard3" role="button" data-bs-toggle="collapse"
                            aria-expanded="{{ Request::segment(2) == 'information' ? 'true' : 'false' }}"
                            aria-controls="dashboard3">
                            <div class="d-flex align-items-center">
                                <span class="nav-link-icon"><i class="fas fa-map-marker-alt"></i></span>
                                <span class="nav-link-text ps-1">Products</span>
                            </div>
                        </a>
                        <ul class="nav collapse" id="dashboard3">

                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('admin/categories*') ? 'active' : '' }}"
                                    href="{{ route('categories.index') }}">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-icon"><i class="fas fa-project-diagram"></i></span>
                                        <span class="nav-link-text ps-1">Category</span>
                                    </div>
                                </a>

                            </li>


                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('admin/subcategories*') ? 'active' : '' }}"
                                    href="{{ route('subcategories.index') }}">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-icon"><i class="fas fa-tags"></i></span>
                                        <span class="nav-link-text ps-1">Subcategories</span>
                                    </div>
                                </a>
                            </li>

                            {{-- <li class="nav-item">
                                <a class="nav-link {{ Request::is('admin/amenities*') ? 'active' : '' }}"
                                    href="{{ route('amenities.index') }}">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-icon"><i class="fas fa-shower"></i></span>
                                        <span class="nav-link-text ps-1">Amenities</span>
                                    </div>
                                </a>
                            </li> --}}

                            <li class="nav-item">
                                <!-- Top-level link for Product -->
                                <a class="nav-link {{ Request::is('admin/product*') ? 'active' : '' }}"
                                    href="{{ route('product.index') }}">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-icon"><i class="fas fa-building"></i></span>
                                        <span class="nav-link-text ps-1">Products</span>
                                    </div>
                                </a>
                            </li>




                        </ul>
                    </li>
                </li>



                {{-- For the Users Management --}}

                
                <li class="nav-item">
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label">Content Management</div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider">
                        </div>
                    </div>
                    <li class="nav-item">
                        <a class="nav-link dropdown-indicator {{ Request::segment(2) == 'users' ? '' : 'collapsed' }}"
                            href="#dashboard4" role="button" data-bs-toggle="collapse"
                            aria-expanded="{{ Request::segment(2) == 'users' ? 'true' : 'false' }}"
                            aria-controls="dashboard4">
                            <div class="d-flex align-items-center">
                                <span class="nav-link-icon"><i class="fas fa-folder"></i></span>
                                <span class="nav-link-text ps-1">Content Management</span>
                            </div>
                        </a>
                        <ul class="nav collapse" id="dashboard4">

                            <li class="nav-item">
                   
                                <a class="nav-link {{ Request::is('admin/blogs*') ? 'active' : '' }}"
                                    href="{{ route('admin.blogs.index') }}">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-icon"><i class="fas fa-blog"></i></span>
                                        <span class="nav-link-text ps-1">Blogs</span>
                                    </div>
                                </a>
                            </li>
                           
                            {{-- <li class="nav-item">
                                <!-- Top-level link for Testimonials -->
                                <a class="nav-link {{ Request::is('admin/testimonials*') ? 'active' : '' }}"
                                    href="{{ route('testimonials.index') }}">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-icon"><i class="fas fa-comments"></i></span>
                                        <span class="nav-link-text ps-1">Testimonials</span>
                                    </div>
                                </a>
                            </li> --}}

                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('admin/advertisements*') ? 'active' : '' }}"
                                   href="{{ route('admin.advertisements.index') }}">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-icon"><i class="fas fa-ad"></i></span>
                                        <span class="nav-link-text ps-1">Advertisement</span>
                                    </div>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('admin/termsandconditions*') ? 'active' : '' }}"
                                   href="{{ route('termsandconditions.index') }}">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-icon"><i class="fas fa-file-alt"></i></span>
                                        <span class="nav-link-text ps-1">Terms & Conditions</span>
                                    </div>
                                </a>
                            </li>
                            

                        </ul>
                    </li>
                </li>
                {{-- For the Users Management --}}

                
                <li class="nav-item">
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label">Users Management</div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider">
                        </div>
                    </div>
                    <li class="nav-item">
                        <a class="nav-link dropdown-indicator {{ Request::segment(2) == 'users' ? '' : 'collapsed' }}"
                            href="#dashboard5" role="button" data-bs-toggle="collapse"
                            aria-expanded="{{ Request::segment(2) == 'users' ? 'true' : 'false' }}"
                            aria-controls="dashboard5">
                            <div class="d-flex align-items-center">
                                <span class="nav-link-icon"><i class="fas fa-users"></i></span>
                                <span class="nav-link-text ps-1">User Management</span>
                            </div>
                        </a>
                        <ul class="nav collapse" id="dashboard5">


                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.permissions.index') }}" role="button">
                                    <div class="d-flex align-items-center"><span class="nav-link-icon">
                                            <i class="fas fa-user-shield"></i>
                                            <!-- <span class="fas fa-comments"></span> Font Awesome fontawesome.com --></span><span
                                            class="nav-link-text ps-1">Permissions</span></div>
                                </a>
                           </li>
                           <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.roles.index') }}" role="button">
                                    <div class="d-flex align-items-center"><span class="nav-link-icon">
                                            <i class="fas fa-user-tag"></i>
                                            <!-- <span class="fas fa-comments"></span> Font Awesome fontawesome.com --></span><span
                                            class="nav-link-text ps-1">Roles</span></div>
                                </a>
                           </li>

                       

                           <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.users.index') }}" role="button">
                                    <div class="d-flex align-items-center"><span class="nav-link-icon">
                                            <i class="fas fa-users"></i>
                                            <!-- <span class="fas fa-comments"></span> Font Awesome fontawesome.com --></span><span
                                            class="nav-link-text ps-1">Users</span></div>
                                </a>
                           </li>
                           



                        </ul>
                    </li>
                </li>







                <li class="nav-item">
                    <!-- label-->
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label">History</div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider">
                        </div>
                    </div>




                    {{-- @can('hasPermission', 'view_blogs') --}}
              




                </li>
            </ul>
        </div>
    </div>
</nav>

