
<div class="container-fluid">

    <!-- Search Form -->
    <h1 class="h3 mb-2 text-black-800">Report Post Mortem</h1>
    <hr>
    <form action="<?= base_url('post_mortem/export_excel') ?>" method="post" class="my-3">
        <div class="form-group">
            <label for="today">Pilih Hari:</label>
            <input type="date" name="today" id="today" class="form-control" value="<?= date("Y-m-d") ?>">
        </div>
        <button type="submit" class="btn btn-success"><i class="fas fa-file-excel"></i> Download Report</button>
    </form>

</div>
<!-- Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</div>
<style type="text/css">
    label {
        font-size: 20px;
        font-weight: bold;
    }
    .my-3{
        width: 35%;
    }
    h1{
        color: black;
    }
</style>
