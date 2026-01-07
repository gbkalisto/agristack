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
                                          <a href="{{ route('home') }}">
                                              @if (!empty($settings['logo']))
                                                  <img src="{{ asset('storage') . '/' . $settings['logo'] }}"
                                                      class="logo-icon" alt="logo icon" style="width:70%">
                                              @else
                                                  <img src="{{ asset('theme/images/logo-icon.png') }}" class="logo-icon"
                                                      alt="logo icon">
                                              @endif

                                          </a>
                                      </div>

                                      <div class="toggle-icon ms-auto"><i class="bx bx-arrow-back"></i>
                                      </div>
                                  </div>
                                  <!--navigation-->
                                  <ul class="metismenu" id="menu">
                                      <li>
                                          <a href="{{ route('home') }}">
                                              <div class="parent-icon"><i class="bx bx-home-alt"></i>
                                              </div>
                                              <div class="menu-title">Dashboard</div>
                                          </a>
                                      </li>
                                      <li>
                                          <a href="{{ route('registry.index') }}">
                                              <div class="parent-icon"><i class="bx bx-message-square-edit"></i>
                                              </div>
                                              <div class="menu-title">Farmer registry</div>
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
