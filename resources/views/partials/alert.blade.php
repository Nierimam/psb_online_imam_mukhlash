@if($errors->any() || session('errors'))
<div class="alert alert-danger" role="alert">
    <span><img src="../../../image/icon/cross 2.png" alt=""> {{ $errors->first() }}</span>
    <button type="button" class="close" onclick="this.parentElement.style.display='none';" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

@elseif(session('rejected'))
<div class="alert alert-danger" role="alert">
    <span><img src="../../../image/icon/cross 2.png" alt=""> {{ session('rejected') }}</span>
    <button type="button" class="close" onclick="this.parentElement.style.display='none';" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

{{-- Alert Success --}}
@elseif(session('success'))
<div class="alert alert-success" role="alert">
    <span><img src="../../../image/icon/checked 2.png" alt=""> {{ session('success') }}</span>
    <button type="button" class="close" onclick="this.parentElement.style.display='none';" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

{{-- Alert Warning --}}
@elseif(session('warning'))
<div class="alert alert-warning" role="alert">
    <span><img src="../../../image/icon/warning 2.png" alt=""> {{ session('warning') }}</span>
    <button type="button" class="close" onclick="this.parentElement.style.display='none';" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif


{{-- Di dalam sebuah method controller --}}
{{-- session()->flash('success', 'Aksi berhasil dilakukan!'); --}}
{{-- Di dalam sebuah method controller --}}
{{-- session()->flash('warning', 'Ada sesuatu yang perlu Anda perhatikan!'); --}}