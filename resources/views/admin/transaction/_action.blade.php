

<div class="dropdown">
    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
        <i data-feather="more-vertical"></i>
    </button>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="{{ route('transactions.show', $model->id) }}">
            <i data-feather="eye" class="mr-50"></i>
            <span>Lihat</span>
        </a>
        <form action="{{ route('transactions.destroy', $model->id) }}" method="POST" class="d-none delete">
            @csrf
            @method('DELETE')
            <button class="d-none" title="Hapus Coupon" type="submit">
                <i data-feather='trash-2'></i>
            </button>
        </form>
        <a class="dropdown-item" href="javascript:void(0)" onclick="return $(this).parent().find('button').click()">
            <i data-feather="trash" class="mr-50"></i>
            <span>Hapus</span>
        </a>
    </div>
</div>




{{-- <a href="{{ route('orders.edit', $model->id) }}" class="btn btn-sm btn-success" title="Edit Coupon"><i
        data-feather='edit'></i></a>
--}}