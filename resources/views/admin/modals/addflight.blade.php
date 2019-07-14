<flight-form inline-template>
    <div class="modal fade" id="addflightModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Dodawanie nowego turysty</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="modal-body">
                <form method="POST">
                    <div class="form-group row">
                        <label for="dt" class="col-md-4 col-form-label text-md-right">{{ __('admin.departure') }}</label>

                        <div class="col-md-6">
                            <input id="dt" type="datetime-local" class="form-control" name="departure_time" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="at" class="col-md-4 col-form-label text-md-right">{{ __('admin.arrival') }}</label>

                        <div class="col-md-6">
                            <input id="at" type="datetime-local" class="form-control" name="arrival_time" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="seats" class="col-md-4 col-form-label text-md-right">{{ __('admin.seats') }}</label>

                        <div class="col-md-6">
                            <input id="seats" type="number" min="1" class="form-control" name="seats" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('admin.price') }}</label>

                        <div class="col-md-6">
                            <input id="price" type="number" min="0.01" step="0.01" class="form-control" name="price" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('admin.cancel') }}</button>
                <button type="button" class="btn btn-primary add-button" v-on:click="addflight()">{{ __('admin.addflight') }}</button>
            </div>
            </div>
        </div>
    </div>
</flight-form>