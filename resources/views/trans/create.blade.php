{!! Form::open(['route' => $url['store'], 'method' => 'POST', 'id' => 'dform']) !!}
@include($form)
<div class="d-flex justify-content-end align-items-center">
    <button type="submit" class="btn btn-primary btn-labeled btn-labeled-start rounded-pill">
        <span class="btn-labeled-icon bg-black bg-opacity-20 m-1 rounded-pill">
            <i class="ph-paper-plane-tilt submit_loader"></i>
        </span>
        Submit
    </button>
</div>
{!! Form::close() !!}

<script type="text/template" id="state-template" />
<tr>
    <td>
        {!! Form::select('merch_id[]', $data['list_merch'], null, [
            'class' => 'form-control tform select',
            'placeholder' => 'Item',
        ]) !!}
    </td>
    <td>
        {!! Form::number('qty', null, [
            'class' => in_array('qty', $errors->keys()) ? 'form-control is-invalid' : 'form-control',
            'placeholder' => 'Qty',
        ]) !!}
    </td>
    <td>
        <div onclick="RemoveRow(this)" class="btn_add_row">
            <i class="ph-x-circle text-danger"></i>
        </div>
    </td>
</tr>
</script>
<script>
    const DuplicateForm = () => {
        const row = $('#state-template').html();
        const clone = $(row).clone();
        $(clone).appendTo($('.table-responsive').find(
            '.table-tbody'));
        $('.select').select2();
    }

    const RemoveRow = (el) => {
        $(el).closest('tr').remove();
    }
</script>
