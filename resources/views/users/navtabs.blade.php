<ul class="nav nav-tabs nav-justified mb-3">
    {{-- ユーザ詳細タブ ここではタイムラインが表示される --}}
    <li class="nav-item">
        {{-- タイムラインの投稿数をここでカウントする --}}
        <?php
         $tl_posts = $user->feed_microposts()->get();
         $tl_count = 0;
         foreach($tl_posts as $tl_post) {
            $tl_count++;
         };
        ?>
        <a href="{{ route('users.show', ['user' => $user->id]) }}" class="nav-link {{ Request::routeIs('users.show') ? 'active' : '' }}">
            TimeLine
            <span class="badge badge-secondary">{{$tl_count}}</span>
        </a>
    </li>
    {{-- フォロー一覧タブ --}}
    <li class="nav-item">
        <a href="{{ route('users.followings', ['id' => $user->id]) }}" class="nav-link {{ Request::routeIs('users.followings') ? 'active' : '' }}">
            Followings
            <span class="badge badge-secondary">{{ $user->followings_count }}</span>
        </a>
    </li>
    {{-- フォロワー一覧タブ --}}
    <li class="nav-item">
        <a href="{{ route('users.followers', ['id' => $user->id]) }}" class="nav-link {{ Request::routeIs('users.followers') ? 'active' : '' }}">
            Followers
            <span class="badge badge-secondary">{{ $user->followers_count }}</span>
        </a>
    </li>
    {{-- ファボ一覧タブ --}}
    <li class="nav-item">
        <a href="{{ route('users.favorites', ['id' => $user->id]) }}" class="nav-link{{ Request::routeIs('users.favorites') ? 'active' : '' }}">
            Favorites
            <span class="badge badge-secondary">{{ $user->favorites_count }}</span>
        </a>
    </li>
    {{-- 投稿一覧 --}}
    <li class="nav-item">
        <a href="{{ route('users.ownposts', ['id' => $user->id]) }}" class="nav-link{{ Request::routeIs('users.ownposts') ? 'active' : '' }}">
            Posts
            <span class="badge badge-secondary">{{ $user->microposts_count }}</span>
        </a>
    </li>
</ul>