<div>
    <form method="POST">
        @csrf
        <div class="row">
            <div class="col-4">
                <label class="inputlabel">Arrested Crime</label>
                <select class="selectpicker" data-style="select-with-transition" title="Arrested Crime" name="roleid" id="roleid">

            </select>
            </div>
            <div class="col-4">
                <label class="inputlabel">Arrested Date</label>
                <input type="date" class="form-control" id="useremail" name="useremail">
            </div>
            <div class="col-4">
                <label class="inputlabel">Arrested Station</label>
                <select class="selectpicker" data-style="select-with-transition" title="Arrested Station" name="roleid" id="roleid">
            </select>
            </div>
        </div>
        @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
            {{ $error }}
            @endforeach
        </div>
        @endif

        <hr style="width:100%; height:1px; background-color:#000000;">
        <div class="modal-footer justify-content-center">
            @can('User-Create')
            <button type="submit" name="btnsubmituser" id="btnsubmituser" class="btn btn-info">
                <i class="fas fa-save"></i>&nbsp;Save Crime Record
            </button>
            @endcan
            <input type="hidden" id="recordID" name="recordID">
        </div>
    </form>
</div>
