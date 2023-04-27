@if (session('status'))
    <div class="row">
        <div class="col-12">
            <div style="display: flex" class="alert alert-success justify-content-between" role="alert">
                {{session('status')}}
                <button type="button" class="close btn" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
@endif
