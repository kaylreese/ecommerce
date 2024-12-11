<div class="mobile-menu-container">
    <div class="mobile-menu-wrapper">
        <span class="mobile-menu-close"><i class="icon-close"></i></span>

        <form action="#" method="get" class="mobile-search">
            <label for="mobile-search" class="sr-only">Search</label>
            <input type="search" class="form-control" name="mobile-search" id="mobile-search" placeholder="Search in..." required>
            <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
        </form>
        
        <nav class="mobile-nav">
            <ul class="mobile-menu">
                <li class="active">
                    <a href="{{ url('') }}">Home</a>
                </li>
                @php
                    $getCategories = App\Models\Category::getCategoriesMenu();
                @endphp

                @foreach ($getCategories as $value)
                    @if (!@empty($value->getSubCategory->count()))
                        <li>
                            <a href="{{ url($value->url)}}">{{ $value->name }}</a>
                            <ul>
                                @foreach ($value->getSubCategory as $val)
                                    <li><a href="{{ url($value->url.'/'.$val->url) }}">{{ $val->name }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                @endforeach
            </ul>
        </nav>

        <div class="social-icons">
            @if (!empty($getSettingsApp->facebook_link))
                <a href="{{ $getSettingsApp->facebook_link }}" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
            @endif
            
            @if (!empty($getSettingsApp->twitter_link))
                <a href="{{ $getSettingsApp->twitter_link }}" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
            @endif
            
            @if (!empty($getSettingsApp->instagram_link))
                <a href="{{ $getSettingsApp->instagram_link }}" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
            @endif
            
            @if (!empty($getSettingsApp->youtube_link))
                <a href="{{ $getSettingsApp->youtube_link }}" class="social-icon" title="Youtube" target="_blank"><i class="icon-youtube"></i></a>
            @endif
            
            @if (!empty($getSettingsApp->pinterest_link))
                <a href="{{ $getSettingsApp->pinterest_link }}" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
            @endif
        </div>
    </div>
</div>