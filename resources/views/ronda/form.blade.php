<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="mesa" class="form-label">{{ __('Mesa') }}</label>
            <input type="text" name="mesa" class="form-control @error('mesa') is-invalid @enderror" value="{{ old('mesa', $ronda?->mesa) }}" id="mesa" placeholder="Mesa">
            {!! $errors->first('mesa', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="numero_mesa" class="form-label">{{ __('Numeromesa') }}</label>
            <input type="text" name="numeroMesa" class="form-control @error('numeroMesa') is-invalid @enderror" value="{{ old('numeroMesa', $ronda?->numeroMesa) }}" id="numero_mesa" placeholder="Numeromesa">
            {!! $errors->first('numeroMesa', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="estado" class="form-label">{{ __('Estado') }}</label>
            <input type="text" name="estado" class="form-control @error('estado') is-invalid @enderror" value="{{ old('estado', $ronda?->estado) }}" id="estado" placeholder="Estado">
            {!! $errors->first('estado', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="mesero" class="form-label">{{ __('Mesero') }}</label>
            <input type="text" name="mesero" class="form-control @error('mesero') is-invalid @enderror" value="{{ old('mesero', $ronda?->mesero) }}" id="mesero" placeholder="Mesero">
            {!! $errors->first('mesero', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="total_ronda" class="form-label">{{ __('Totalronda') }}</label>
            <input type="text" name="totalRonda" class="form-control @error('totalRonda') is-invalid @enderror" value="{{ old('totalRonda', $ronda?->totalRonda) }}" id="total_ronda" placeholder="Totalronda">
            {!! $errors->first('totalRonda', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="timestamp" class="form-label">{{ __('Timestamp') }}</label>
            <input type="text" name="timestamp" class="form-control @error('timestamp') is-invalid @enderror" value="{{ old('timestamp', $ronda?->timestamp) }}" id="timestamp" placeholder="Timestamp">
            {!! $errors->first('timestamp', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="deleted_at" class="form-label">{{ __('Deletedat') }}</label>
            <input type="text" name="deletedAt" class="form-control @error('deletedAt') is-invalid @enderror" value="{{ old('deletedAt', $ronda?->deletedAt) }}" id="deleted_at" placeholder="Deletedat">
            {!! $errors->first('deletedAt', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="productos" class="form-label">{{ __('Productos') }}</label>
            <input type="text" name="productos" class="form-control @error('productos') is-invalid @enderror" value="{{ old('productos', $ronda?->productos) }}" id="productos" placeholder="Productos">
            {!! $errors->first('productos', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="cantidades" class="form-label">{{ __('Cantidades') }}</label>
            <input type="text" name="cantidades" class="form-control @error('cantidades') is-invalid @enderror" value="{{ old('cantidades', $ronda?->cantidades) }}" id="cantidades" placeholder="Cantidades">
            {!! $errors->first('cantidades', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="descripciones" class="form-label">{{ __('Descripciones') }}</label>
            <input type="text" name="descripciones" class="form-control @error('descripciones') is-invalid @enderror" value="{{ old('descripciones', $ronda?->descripciones) }}" id="descripciones" placeholder="Descripciones">
            {!! $errors->first('descripciones', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>