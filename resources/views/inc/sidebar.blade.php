<!-- Start sidebar-->  

<div class="col-md-3">
    <div class="card">
        <div class="card-body">
            @if (auth()->user()->id === 1)
                <a href="/dashboard" class="btn btn-primary btn-block">
                    {{ __('Cписок пользователей') }}
                </a>
            @endif
            <a href="/documents" class="btn btn-primary btn-block">
                {{ __('Мои документы') }}
            </a>
            <a href="/documents/create" class="btn btn-primary btn-block">
                {{ __('Создать документ') }}
            </a>
            <hr>
            <a href="/profile" class="btn btn-primary btn-block">
                {{ __('Настройки профиля') }}
            </a>
        </div>
    </div>
</div>

<!-- End sidebar--> 