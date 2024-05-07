<a href="{{ route('billing.payment',$id) }}" data-toggle="tooltip" data-original-title="Edit" class="btn btn-sm btn-success text-white">
    Pay</i>
</a>

<a href="{{ route('billing.edit',$id) }}" data-toggle="tooltip" data-original-title="Edit" class="btn btn-sm btn-primary text-white">
    Edit</i>
</a>
<a href="#" onclick="confirmDelete('{{ route('billing.destroy', $id) }}')" data-toggle="tooltip" data-original-title="Delete" class="btn btn-sm btn-danger text-white">
    Delete
</a>

<script>
    function confirmDelete(url) {
        if (confirm('Are You Sure Want To Delete This Data?')) {
            window.location.href = url;
        }
    }
</script>
