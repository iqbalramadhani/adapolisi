<option value="">Pilih Polsek</option>
@foreach($polsek as $pls)
<option value="{{ $pls->id }}" {{ $polsek_code == $pls->id ? 'selected' : '' }}>{{ $pls->name }}</option>
@endforeach