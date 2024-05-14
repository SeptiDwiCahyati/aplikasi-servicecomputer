function confirmDelete(keluhanId) {
    if (confirm("Apakah Anda yakin ingin menyelesaikan keluhan ini?")) {
        document.getElementById("delete-form-" + keluhanId).submit();
    }
}
