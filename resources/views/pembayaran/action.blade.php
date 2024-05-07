
<a href="#" onclick="confirmDelete('{{ route('pembayaran.destroy', $id) }}')" data-toggle="tooltip" data-original-title="Delete" class="btn btn-sm btn-danger text-white">
    Unpay
</a>

<script>
    function confirmDelete(url) {
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            window.location.href = url;
        }
    }
</script>