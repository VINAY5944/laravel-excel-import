<!DOCTYPE html>
<html>
<head>
    <title>Import Excel File</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h3>Import People from Excel</h3>
            </div>
            <div class="card-body">
                <form id="import-form" action="{{ route('import.people') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="excel_file">Choose Excel File</label>
                        <input type="file" name="excel_file" class="form-control" id="excel_file" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Import</button>
                </form>
                <div id="message" class="mt-3"></div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('import-form').addEventListener('submit', function(event) {
            event.preventDefault();

            let formData = new FormData(this);

            fetch("{{ route('import.people') }}", {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                }
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('message').innerHTML = '<div class="alert alert-success">' + data.status + '</div>';
            })
            .catch(error => {
                document.getElementById('message').innerHTML = '<div class="alert alert-danger">Something went wrong.</div>';
            });
        });
    </script>
</body>
</html>
