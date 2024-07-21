<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="no_mesa" class="form-label">{{ __('Nomesa') }}</label>
            <input type="text" name="noMesa" class="form-control @error('noMesa') is-invalid @enderror" value="{{ old('noMesa', $mesa?->noMesa) }}" id="no_mesa" placeholder="Nomesa">
            {!! $errors->first('noMesa', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="cliente" class="form-label">{{ __('Cliente') }}</label>
            <input type="text" name="cliente" class="form-control @error('cliente') is-invalid @enderror" value="{{ old('cliente', $mesa?->cliente) }}" id="cliente" placeholder="Cliente">
            {!! $errors->first('cliente', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="estado" class="form-label">{{ __('Estado') }}</label>
            <input type="text" name="estado" class="form-control @error('estado') is-invalid @enderror" value="{{ old('estado', $mesa?->estado) }}" id="estado" placeholder="Estado">
            {!! $errors->first('estado', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="total_cuenta" class="form-label">{{ __('Totalcuenta') }}</label>
            <input type="text" name="totalCuenta" class="form-control @error('totalCuenta') is-invalid @enderror" value="{{ old('totalCuenta', $mesa?->totalCuenta) }}" id="total_cuenta" placeholder="Totalcuenta">
            {!! $errors->first('totalCuenta', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="hora_pago" class="form-label">{{ __('Horapago') }}</label>
            <input type="text" name="horaPago" class="form-control @error('horaPago') is-invalid @enderror" value="{{ old('horaPago', $mesa?->horaPago) }}" id="hora_pago" placeholder="Horapago">
            {!! $errors->first('horaPago', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>