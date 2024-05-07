<a href="{{ route('paket.edit',$id) }}" data-toggle="tooltip" data-original-title="Edit" class="btn btn-sm btn-primary text-white">
    Edit</i>
</a>
<a href="#" onclick="confirmDelete('{{ route('paket.destroy', $id) }}')" data-toggle="tooltip" data-original-title="Delete" class="btn btn-sm btn-danger text-white">
    Delete
</a>

<script>
    function confirmDelete(url) {
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            window.location.href = url;
        }
    }
</script>