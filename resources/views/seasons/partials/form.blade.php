<div class="form-group">
    <label for="exampleInputEmail1">Име</label>
    <input type="text" class="form-control" name="name" placeholder="Име"
           value="{{ isset($season) ? $season->name : 'Сезон ' . $seasons->last()->count() }}"
           {{ isset($season) ? 'disabled' : null }}
           required>
</div>
<div class="row">
    <div class="col-12 col-lg-6">
        <div class="form-group">
            <label for="exampleInputEmail1">Начало</label>
            <input type="date" class="form-control" name="start" placeholder="Начало дата"
                   value="{{ isset($season) ? $season->start : \Carbon\Carbon::parse($seasons->last()->end)->addDay()->format('Y-m-d') }}" required>
        </div>
    </div>
    <div class="col-12 col-lg-6">
        <div class="form-group">
            <label for="exampleInputEmail1">Край</label>
            <input type="date" class="form-control" name="end" placeholder="Край дата"
                   value="{{ isset($season) ? $season->end : \Carbon\Carbon::parse($seasons->last()->end)->addMonths(6)->format('Y-m-d') }}" required>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="form-group">
            <div class="select2-info">
                <select class="select2" name="cities[]" multiple="multiple" data-placeholder="Градове за провеждане" data-dropdown-css-class="select2-info" style="width: 100%;" required>
                    @foreach($cities as $city)
                        <option value="{{ $city->id }}" {{ isset($season) && in_array($city->id, $season->cities->pluck('id')->toArray()) ? 'selected' : null }}>{{ $city->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>
