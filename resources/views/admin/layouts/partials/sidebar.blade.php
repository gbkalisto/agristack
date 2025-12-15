          @php
              $admin = auth('admin')->user();
          @endphp

          <div class="sidebar-wrapper" data-simplebar="init">
              <div class="simplebar-wrapper" style="margin: 0px;">
                  <div class="simplebar-height-auto-observer-wrapper">
                      <div class="simplebar-height-auto-observer"></div>
                  </div>
                  <div class="simplebar-mask">
                      <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                          <div class="simplebar-content-wrapper" style="height: 100%; overflow: hidden scroll;">
                              <div class="simplebar-content" style="padding: 0px;">
                                  <div class="sidebar-header">
                                      <div>

                                          <a href="{{ route('admin.dashboard') }}">
                                              @if (!empty($settings['logo']))
                                                  <img src="{{ asset('storage') . '/' . $settings['logo'] }}"
                                                      class="logo-icon" alt="logo icon" style="width:70%">
                                              @else
                                                  <img src="{{ asset('theme/images/logo-icon.png') }}" class="logo-icon"
                                                      alt="logo icon">
                                              @endif

                                          </a>
                                      </div>
                                      {{-- <div>
                                          <a href="">
                                              <h4 class="logo-text">{{ $settings['site_name'] ?? 'Rocker' }}</h4>
                                          </a>
                                      </div> --}}
                                      <div class="toggle-icon ms-auto"><i class="bx bx-arrow-back"></i>
                                      </div>
                                  </div>
                                  <!--navigation-->
                                  <ul class="metismenu" id="menu">

                                      @can('view dashboard')
                                          <li>
                                              <a href="{{ route('admin.dashboard') }}">
                                                  <div class="parent-icon"><i class="bx bx-home-alt"></i>
                                                  </div>
                                                  <div class="menu-title">Dashboard</div>
                                              </a>
                                          </li>
                                      @endcan
                                      {{-- @can('view profile') --}}
                                      <li>
                                          <a href="{{ route('admin.profile') }}">
                                              <div class="parent-icon"><i class="bx bx-user-circle"></i>
                                              </div>
                                              <div class="menu-title">Profile</div>
                                          </a>
                                      </li>
                                      <li>
                                          <a href="{{ route('admin.accounts.index') }}">
                                              <div class="parent-icon"><i class="bx bx-card"></i>
                                              </div>
                                              <div class="menu-title">Accounts</div>
                                          </a>
                                      </li>
                                      {{-- @endcan --}}
                                      {{-- @can('view colleges')
                                      <li>
                                          <a href="{{ route('admin.colleges.index') }}">
                                              <div class="parent-icon"><i class="bx bx-book-open"></i>
                                              </div>
                                              <div class="menu-title">Colleges</div>
                                          </a>
                                      </li>
                                      @endcan --}}
                                      {{-- @can('view settings') --}}
                                      <li>
                                          <a href="{{ route('admin.settings.index') }}">
                                              <div class="parent-icon"><i class="bx bx-cog"></i>
                                              </div>
                                              <div class="menu-title">Settings</div>
                                          </a>
                                      </li>
                                      {{-- @endcan --}}
                                      {{-- @if ($admin && ($admin->can('view admins') || $admin->can('view roles') || $admin->can('view permissions'))) --}}
                                      <li class="">
                                          <a href="javascript:;" class="has-arrow" aria-expanded="false">
                                              <div class="parent-icon"><i class="bx bx-id-card"></i></div>
                                              <div class="menu-title">Admin</div>
                                          </a>
                                          <ul class="mm-collapse" style="height: 0px;">
                                              {{-- @can('view admins') --}}
                                              <li>
                                                  <a href="{{ route('admin.divisions.index') }}">
                                                      <i class="bx bx-radio-circle"></i>Divisions
                                                  </a>
                                              </li>
                                              <li>
                                                  <a href="{{ route('admin.districts.index') }}">
                                                      <i class="bx bx-radio-circle"></i>Districts
                                                  </a>
                                              </li>
                                              <li>
                                                  <a href="{{ route('admin.blocks.index') }}">
                                                      <i class="bx bx-radio-circle"></i>Blocks
                                                  </a>
                                              </li>
                                              <li>
                                                  <a href="{{ route('admin.admins.index') }}">
                                                      <i class="bx bx-radio-circle"></i>Admins
                                                  </a>
                                              </li>
                                              {{-- @endcan --}}

                                          </ul>
                                      </li>
                                      {{-- @endif --}}
                                      <li>
                                          <a href="{{ route('admin.logout') }}">
                                              <div class="parent-icon"><i class="bx bx-log-out-circle"></i>
                                              </div>
                                              <div class="menu-title">Logout</div>
                                          </a>
                                      </li>



                                  </ul>
                                  <!--end navigation-->
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="simplebar-placeholder" style="width: auto; height: 1236px;"></div>
              </div>
              <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                  <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
              </div>
              <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                  <div class="simplebar-scrollbar"
                      style="height: 183px; transform: translate3d(0px, 0px, 0px); display: block;">
                  </div>
              </div>
          </div>
