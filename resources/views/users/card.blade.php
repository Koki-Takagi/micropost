<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ $user->name }}</h3>
    </div>
    <div class="card-body">
        {{-- ユーザのメールアドレスをもとにGravatarを取得して表示 --}}
        <img class="rounded img-fluid" src="{{ Gravatar::get($user->email, ['size' => 500]) }}" alt="">
    </div>
    <div class='card-body'>
        <h6>{{ $user->profile }}</h6>
    </div>
</div>
{{-- フォロー／アンフォローボタン --}}
@include('user_follow.follow_button')
    {{-- プロフィール編集ページへのリンク --}}
    {!! link_to_route('users.edit', 'プロフィールを編集', ['user' => $user->id], ['class' => 'btn btn-light']) !!}