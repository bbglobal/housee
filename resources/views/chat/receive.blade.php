<div class="left message">
    <img src="{{ Auth::user()->avatar }}" alt="Avatar" class="chat-avatar">
    <span class="chat-box">
        <small>
            <a href="{{ $message }}">{{ $message }}</a>
        </small>
    </span>
</div>
