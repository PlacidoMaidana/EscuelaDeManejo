<div class="side-menu sidebar-inverse">
    <nav class="navbar navbar-default" role="navigation">
        <div class="side-menu-container">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ route('voyager.dashboard') }}">
                    <div class="logo-icon-container">
                        <?php $admin_logo_img = Voyager::setting('admin.icon_image', ''); ?>
                        @if($admin_logo_img == '')
                            <img src="{{ voyager_asset('images/logo-icon-light.png') }}" alt="Logo Icon">
                        @else
                            <img src="{{ Voyager::image($admin_logo_img) }}" alt="Logo Icon">
                        @endif
                    </div>
                    <div class="title">{{Voyager::setting('admin.title', 'VOYAGER')}}</div>
                </a>
            </div><!-- .navbar-header -->

            <div class="panel widget center bgimage"
                 style="background-image:url({{ Voyager::image( Voyager::setting('admin.bg_image'), voyager_asset('images/bg.jpg') ) }}); background-size: cover; background-position: 0px;">
                <div class="dimmer"></div>
                <div class="panel-content">
                    <img src="{{ $user_avatar }}" class="avatar" alt="{{ Auth::user()->name }} avatar">
                    <h4>{{ ucwords(Auth::user()->name) }}</h4>
                    <p>{{ Auth::user()->email }}</p>

                    <a href="{{ route('voyager.profile') }}" class="btn btn-primary">{{ __('voyager::generic.profile') }}</a>
                    <div style="clear:both"></div>
                </div>
            </div>

        </div>
   
        <div id="adminmenu">
            @php
            $uid =  Auth::User()->id;
            @endphp

            @if(Auth::user()->getRole($uid)=="Administrativo")
              <admin-menu :items="{{menu('Administrativo','my_menu') }}"></admin-menu>       
                @else
                @if(Auth::user()->getRole($uid)=="Instructor")
                   <admin-menu :items="{{menu('Instructor','my_menu') }}"></admin-menu>                       
                   @else
                   <admin-menu :items="{{ menu('admin', '_json') }}"></admin-menu>
                @endif
            @endif       
        </div>
    </nav>
</div>

          {{-- 
                @if(Auth::user()->getRole($uid)=="Gerente")
                        <admin-menu :items="{{menu('Gerencia','my_menu') }}"></admin-menu>               
                   @else
                        @if(Auth::user()->getRole($uid)=="Administrativo")
                             <admin-menu :items="{{menu('Administrativo','my_menu') }}"></admin-menu>               
                           @else
                                @if(Auth::user()->getRole($uid)=="Instructor")
                                    <admin-menu :items="{{menu('instructor') }}"></admin-menu>               
                                   @else
                                    <admin-menu :items="{{ menu('admin', '_json') }}"></admin-menu>
                                @endif
                         @endif
                @endif  
            --}}             
    