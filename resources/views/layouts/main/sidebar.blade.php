<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px"
    data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Logo-->
    <div class="px-6 app-sidebar-logo" id="kt_app_sidebar_logo">
        <!--begin::Logo image-->
        <a href="../../demo1/dist/index.html">
            <img alt="Logo" src="{{ asset('assets/media/logos/logo-magetan.png') }}"
                class="h-30px app-sidebar-logo-default" />
            <img alt="Logo" src="{{ asset('assets/media/logos/logo-magetan.png') }}"
                class="h-20px app-sidebar-logo-minimize" />
        </a>
        <!--end::Logo image-->
        <!--begin::Sidebar toggle-->
        <div id="kt_app_sidebar_toggle"
            class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary body-bg h-30px w-30px position-absolute top-50 start-100 translate-middle rotate"
            data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
            data-kt-toggle-name="app-sidebar-minimize">
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr079.svg-->
            <span class="rotate-180 svg-icon svg-icon-2">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.5"
                        d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z"
                        fill="currentColor" />
                    <path
                        d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z"
                        fill="currentColor" />
                </svg>
            </span>
            <!--end::Svg Icon-->
        </div>
        <!--end::Sidebar toggle-->
    </div>
    <!--end::Logo-->
    <!--begin::sidebar menu-->
    <div class="overflow-hidden app-sidebar-menu flex-column-fluid">
        <!--begin::Menu wrapper-->
        <div id="kt_app_sidebar_menu_wrapper" class="my-5 app-sidebar-wrapper hover-scroll-overlay-y"
            data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto"
            data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
            data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
            <!--begin::Menu-->
            <div class="px-3 menu menu-column menu-rounded menu-sub-indention" id="#kt_app_sidebar_menu"
                data-kt-menu="true" data-kt-menu-expand="false">

                <!--begin:Menu item-->
                {{-- <div data-kt-menu-trigger="click" class="menu-item here show menu-accordion">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="2" y="2" width="9" height="9" rx="2" fill="currentColor" />
                                    <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="currentColor" />
                                    <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="currentColor" />
                                    <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">Dashboards</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->
                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link active" href="../../demo1/dist/index.html">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Default</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--begin:Menu item-->
                    </div>
                    <!--end:Menu sub-->
                </div> --}}
                <!--end:Menu item-->

                @php
                    $currentUrl = url()->current();
                    $allMenus = Auth::user()
                        ->role->menus()
                        ->with([
                            'dropdownChildren' => function ($query) {
                                $query->whereHas('roles', function ($q) {
                                    $q->where('roles.id', Auth::user()->role_id);
                                });
                            },
                        ])
                        ->orderByRaw('is_category = true, created_at ASC')
                        ->get();

                    $categories = $allMenus->where('is_category', true);
                @endphp

                {{-- Categories and their menus --}}
                @foreach ($categories as $category)
                    <div class="pt-5 menu-item">
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">{{ $category->name }}</span>
                        </div>
                    </div>

                    @foreach ($allMenus->where('category_id', $category->id) as $menu)
                        @php
                            $isActive =
                                $currentUrl === url($menu->url) ||
                                ($menu->url === '/' && $currentUrl === url('/')) ||
                                Request::is(trim($menu->url, '/') . '/*');
                            $hasActiveChild = $menu->dropdownChildren->contains(
                                fn($child) => $currentUrl === url($child->url) ||
                                    Request::is(trim($child->url, '/') . '/*'),
                            );
                        @endphp

                        @if ($menu->dropdownChildren->isNotEmpty())
                            {{-- Dropdown Menu --}}
                            <div class="menu-item menu-accordion {{ $hasActiveChild ? 'hover show' : '' }}"
                                data-kt-menu-trigger="click">
                                <span class="menu-link {{ $hasActiveChild ? 'active' : '' }}">
                                    <span class="menu-title">{{ $menu->name }}</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <div class="menu-sub menu-sub-accordion {{ $hasActiveChild ? 'show' : '' }}">
                                    @foreach ($menu->dropdownChildren as $child)
                                        <div class="menu-item">
                                            <a class="menu-link {{ $currentUrl === url($child->url) ? 'active' : '' }}"
                                                href="{{ $child->url }}">
                                                <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                                <span class="menu-title">{{ $child->name }}</span>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @elseif (empty($menu->dropdown_id))
                            {{-- Regular Menu --}}
                            <div class="menu-item">
                                <a class="menu-link {{ $isActive ? 'active' : '' }}" href="{{ $menu->url }}">
                                    <span class="menu-title">{{ $menu->name }}</span>
                                </a>
                            </div>
                        @endif
                    @endforeach
                @endforeach

                {{-- Uncategorized menus --}}
                @foreach ($allMenus->whereNull('category_id')->where('is_category', false) as $menu)
                    @php
                        $isActive =
                            $currentUrl === url($menu->url) ||
                            ($menu->url === '/' && $currentUrl === url('/')) ||
                            Request::is(trim($menu->url, '/') . '/*');
                        $hasActiveChild = $menu->dropdownChildren->contains(
                            fn($child) => $currentUrl === url($child->url) ||
                                Request::is(trim($child->url, '/') . '/*'),
                        );
                    @endphp

                    @if ($menu->dropdownChildren->isNotEmpty())
                        {{-- Dropdown Menu --}}
                        <div class="menu-item menu-accordion {{ $hasActiveChild ? 'hover show' : '' }}"
                            data-kt-menu-trigger="click">
                            <span class="menu-link {{ $hasActiveChild ? 'active' : '' }}">
                                <span class="menu-title">{{ $menu->name }}</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <div class="menu-sub menu-sub-accordion {{ $hasActiveChild ? 'show' : '' }}">
                                @foreach ($menu->dropdownChildren as $child)
                                    <div class="menu-item">
                                        <a class="menu-link {{ $currentUrl === url($child->url) ? 'active' : '' }}"
                                            href="{{ $child->url }}">
                                            <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                            <span class="menu-title">{{ $child->name }}</span>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @elseif (empty($menu->dropdown_id))
                        {{-- Regular Menu --}}
                        <div class="menu-item">
                            <a class="menu-link {{ $isActive ? 'active' : '' }}" href="{{ $menu->url }}">
                                <span class="menu-title">{{ $menu->name }}</span>
                            </a>
                        </div>
                    @endif
                @endforeach

                {{-- Loop through categories --}}
                {{-- @foreach ($categories as $category)
                    <div class="pt-5 menu-item">
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">{{ $category->name }}</span>
                        </div>
                    </div>

                    @foreach ($allMenus->where('category_id', $category->id) as $menu)
                        @php
                            $isActive =
                                $currentUrl === url($menu->url) ||
                                ($menu->url === '/' && $currentUrl === url('/')) ||
                                Request::is(trim($menu->url, '/') . '/*')
                                    ? 'active'
                                    : '';
                            // Check if any child menu is active
                            $hasActiveChild = $menu->dropdownChildren->contains(function ($child) use ($currentUrl) {
                                return $currentUrl === url($child->url) || Request::is(trim($child->url, '/') . '/*');
                            });
                        @endphp
                        @if ($menu->dropdownChildren->isNotEmpty())
                            <div class="menu-item menu-accordion @if ($hasActiveChild) hover show @endif"
                                data-kt-menu-trigger="click">
                                <span class="menu-link @if ($hasActiveChild) active @endif">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-2"></span>
                                    </span>
                                    <span class="menu-title">{{ $menu->name }}</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <div class="menu-sub menu-sub-accordion @if ($hasActiveChild) show @endif">
                                    @foreach ($menu->dropdownChildren as $dropdown)
                                        @php
                                            $isDropdownActive =
                                                $currentUrl === url($dropdown->url) ||
                                                Request::is(trim($dropdown->url, '/') . '/*');
                                        @endphp
                                        <div class="menu-item">
                                            <a class="menu-link @if ($isDropdownActive) active @endif"
                                                href="{{ $dropdown->url }}">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">{{ $dropdown->name }}</span>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @elseif (empty($menu->dropdown_id))
                            <div class="menu-item">
                                <a class="menu-link {{ $isActive ? 'active' : '' }}" href="{{ $menu->url }}">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-2"></span>
                                    </span>
                                    <span class="menu-title">{{ $menu->name }}</span>
                                </a>
                            </div>
                        @endif
                    @endforeach
                @endforeach --}}

                {{-- Uncategorized menus --}}
                {{-- @foreach ($allMenus->whereNull('category_id')->where('is_category', false) as $menu)
                    @php
                        $isActive =
                            $currentUrl === url($menu->url) ||
                            ($menu->url === '/' && $currentUrl === url('/')) ||
                            Request::is(trim($menu->url, '/') . '/*')
                                ? 'active'
                                : '';
                        // Check if any child menu is active
                        $hasActiveChild = $menu->dropdownChildren->contains(function ($child) use ($currentUrl) {
                            return $currentUrl === url($child->url) || Request::is(trim($child->url, '/') . '/*');
                        });
                    @endphp
                    @if ($menu->dropdownChildren->isNotEmpty())
                        <div class="menu-item menu-accordion @if ($hasActiveChild) hover show @endif"
                            data-kt-menu-trigger="click">
                            <span class="menu-link @if ($hasActiveChild) active @endif">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2"></span>
                                </span>
                                <span class="menu-title">{{ $menu->name }}</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <div class="menu-sub menu-sub-accordion @if ($hasActiveChild) show @endif">
                                @foreach ($menu->dropdownChildren as $dropdown)
                                    @php
                                        $isDropdownActive =
                                            $currentUrl === url($dropdown->url) ||
                                            Request::is(trim($dropdown->url, '/') . '/*');
                                    @endphp
                                    <div class="menu-item">
                                        <a class="menu-link @if ($isDropdownActive) active @endif"
                                            href="{{ $dropdown->url }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">{{ $dropdown->name }}</span>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @elseif (empty($menu->dropdown_id))
                        <div class="menu-item">
                            <a class="menu-link {{ $isActive ? 'active' : '' }}" href="{{ $menu->url }}">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2"></span>
                                </span>
                                <span class="menu-title">{{ $menu->name }}</span>
                            </a>
                        </div>
                    @endif
                @endforeach --}}

                <!--begin:Menu item-->
                {{-- <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/communication/com005.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z" fill="currentColor" />
                                    <path opacity="0.3" d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z" fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">User Profile</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->
                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link" href="../../demo1/dist/pages/user-profile/overview.html">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Overview</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                    </div>
                    <!--end:Menu sub-->
                </div> --}}
                <!--end:Menu item-->

                <!--begin:Menu item-->
                {{-- <div class="pt-5 menu-item">
                    <!--begin:Menu content-->
                    <div class="menu-content">
                        <span class="menu-heading fw-bold text-uppercase fs-7">Pages</span>
                    </div>
                    <!--end:Menu content-->
                </div> --}}
                <!--end:Menu item-->

            </div>
            <!--end::Menu-->
        </div>
        <!--end::Menu wrapper-->
    </div>
    <!--end::sidebar menu-->
</div>
