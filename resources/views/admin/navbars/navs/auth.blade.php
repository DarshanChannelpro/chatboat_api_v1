<!-- Top navbar -->
<nav class="navbar navbar-top navbar-expand-md" id="navbar-main">
    <div class="container-fluid">

        <!-- Brand -->
        <a class="h4 mb-0 text-uppercase d-none d-lg-inline-block">@yield('admin_title')</a>
        
        <!-- Form -->
        <form method="GET" class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
           
        </form>
       
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">

           
          <!-- If user is owner or staff, show go to store-->
          @if((auth()->user()->hasRole('owner')||auth()->user()->hasRole('staff')))
            @if (auth()->user()->hasRole('owner'))
              <?php $urlToVendor=auth()->user()->companies()->get()->first()->getLinkAttribute(); ?>
            @endif  
            @if (auth()->user()->hasRole('staff'))
            <?php $urlToVendor=auth()->user()->company->getLinkAttribute(); ?>
            @endif
            @if (config('settings.show_company_page',true))
              <a href="{{ $urlToVendor }}" target="_blank" class="nav-link" role="button">
                <i class="ni ni-shop"></i>  
                <span class="nav-link-inner--text bold">{{ __(config('settings.vendor_entity_name'))}}</span>
              </a>
            @endif
            
          @endif
          {{-- <!-- End owner and staf -->
            <?php
                $availableLanguagesENV = config('settings.front_languages');
                $exploded = explode(',', $availableLanguagesENV);
                $availableLanguages = [];
                for ($i = 0; $i < count($exploded); $i += 2) {
                    $availableLanguages[$exploded[$i]] = $exploded[$i + 1];
                }
                $locale =isset($locale)?$locale:(Cookie::get('lang') ? Cookie::get('lang') : config('settings.app_locale'));
            ?>
            @if(isset($availableLanguages)&&count($availableLanguages)>1&&isset($locale))
            <li class="nav-item dropdown">
              <a href="#" class="nav-link" data-toggle="dropdown" role="button">
                
                @foreach ($availableLanguages as $short => $lang)
                  @if(strtolower($short) == strtolower($locale))<span class="nav-link-inner--text">{{ __($lang) }}</span>@endif
                @endforeach
              </a>
              <div class="dropdown-menu">
                @foreach ($availableLanguages as $short => $lang)
                <a href="{{ route('home',$short)}}" class="dropdown-item">
                  {{ __($lang) }}</a>
                @endforeach
              </div>
            </li>
          @endif --}}
          
            <li class="nav-item dropdown">
                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
{{--                             
                            <img id="profile-image-nav" alt="..." src="{{'https://www.gravatar.com/avatar/'.md5(auth()->user()->email) }}"> --}}
                            <img id="profile-image-nav" alt="..." src="{{ asset('whatsapp_api_profile.png') }}" >
                            {{-- C:\chat_boat_api\public\whatsapp_api_profile.png --}}
                        </span>
                        <div class="media-body ml-2 d-none d-lg-block">
                              <span>Partner</span>
                            <span class="mb-0 text-sm  font-weight-bold">{{ auth()->user()->name }}</span>
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                    </div>            
                    <a href="{{ route('profile.show') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('My profile') }}</span>
                    </a>
                    @if (config('settings.app_code_name','')=="wpbox"&&auth()->user()->hasRole('owner'))
                      <a href="{{ route('whatsapp.setup') }}" class="dropdown-item">
                          <i class="ni ni-support-16"></i>
                          <span>{{ __('Whatsapp Cloud API Setup') }}</span>
                      </a>
                  @endif
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>

    </div>

</nav>
