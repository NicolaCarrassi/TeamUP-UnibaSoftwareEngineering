{{-- -------------------- Saved Messages -------------------- --}}
@if($get == 'saved')
    <table class="messenger-list-item m-li-divider @if('user_'.Auth::user()->id == $id && $id != "0") m-list-active @endif">
        <tr data-action="0">
            {{-- Avatar side --}}
            <td>
            <div class="avatar av-m" style="background-color: #d9efff; text-align: center;">
                <span class="far fa-bookmark" style="font-size: 22px; color: #68a5ff; margin-top: calc(50% - 10px);"></span>
            </div>
            </td>
            {{-- center side --}}
            <td>
                <p data-id="{{ 'user_'.Auth::user()->id }}">Messaggi salvati <span>Tu</span></p>
                <span>Salva i messaggi che vuoi conservare</span>
            </td>
        </tr>
    </table>
@endif

{{-- -------------------- All users/group list -------------------- --}}
@if($get == 'users')
<table class="messenger-list-item @if($user->id == $id && $id != "0") m-list-active @endif" data-contact="{{ $user->id }}">
    <tr data-action="0">
        {{-- Avatar side --}}
        <td style="position: relative">
            @if($user->active_status)
                <span class="activeStatus"></span>
            @endif

            @if($user->provider === null || strpos($user->avatar, 'https://') === false)
                    <div class="avatar av-m"
                style="background-image: url('{{ asset('/storage/'.config('chatify.user_avatar.folder').'/'.$user->avatar) }}');">
                </div>
                @else
                    <div class="avatar av-m"
                         style="background-image: url('{{ asset($user->avatar) }}');">
                    </div>
            @endif
        </td>
        {{-- center side --}}
        <td>
        <p data-id="{{ $type.'_'.$user->id }}">
            {{ strlen($user->username) > 12 ? trim(substr($user->username,0,12)).'..' : $user->username }}
            <span>{{ $lastMessage->created_at->diffForHumans() }}</span></p>
        <span>
            {{-- Last Message user indicator --}}
            {!!
                $lastMessage->from_id == Auth::user()->id
                ? '<span class="lastMessageIndicator">You :</span>'
                : ''
            !!}
            {{-- Last message body --}}
            @if($lastMessage->attachment == null)
            {{
                strlen($lastMessage->body) > 30
                ? trim(substr($lastMessage->body, 0, 30)).'..'
                : $lastMessage->body
            }}
            @else
            <span class="fas fa-file"></span> Allega
            @endif
        </span>
        {{-- New messages counter --}}
            {!! $unseenCounter > 0 ? "<b>".$unseenCounter."</b>" : '' !!}
        </td>

    </tr>
</table>
@endif

{{-- -------------------- Search Item -------------------- --}}
@if($get == 'search_item')
<table class="messenger-list-item" data-contact="{{ $user->id }}">
    <tr data-action="0">
        {{-- Avatar side --}}
        <td>
            @if(Auth::user()->provider === null || strpos(Auth::user()->avatar, 'https://') == false)
        <div class="avatar av-m"
        style="background-image: url('{{ asset('/storage/'.config('chatify.user_avatar.folder').'/'.$user->avatar) }}');">
        </div>
            @else
                <div class="avatar av-m"
                     style="background-image: url('{{ asset($user->avatar) }}');">
                </div>
            @endif
        </td>
        {{-- center side --}}
        <td>
        <p data-id="{{ $type.'_'.$user->id }}">
            {{ strlen($user->username) > 12 ? trim(substr($user->username,0,12)).'..' : $user->username }}
        </td>

    </tr>
</table>
@endif

{{-- -------------------- Shared photos Item -------------------- --}}
@if($get == 'sharedPhoto')
<div class="shared-photo chat-image" style="background-image: url('{{ $image }}')"></div>
@endif


