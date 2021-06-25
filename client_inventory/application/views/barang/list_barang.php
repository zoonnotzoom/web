<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <a href="#" onclick="loadMenu('<?= base_url('barang/form_create')?>')" class="btn btn-primary">Tambah Data Barang</a>

                <hr/>

                <div class="row">
                    <div class="col-md-3">
                        <label>Nama Barang</label> <br>
                        <input type="text" name="cari_nama" id="cari_nama" class="form-control form-input-cari">
                    </div>
                    <div class="col-md-3">
                        <label>Deskripsi</label> <br>
                        <input type="text" name="cari_nama" id="cari_nama" class="form-control form-input-cari">
                    </div>
                    <div class="col-md-3">
                        <label>Maksimal Stok</label> <br>
                        <input type="text" name="cari_nama" id="cari_nama" class="form-control form-input-cari">
                    </div>
                    <div class="col-md-3">
                        <br>
                        <button class="btn btn-info" id="btn-cari">Cari</button>
                    </div>
                </div>

            </hr>

                <h4>Dibawah Ini Adalah Data Barang</h4>
                <table id="table_barang" class="table">

                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function loadKonten(url) {
        $.ajax(url, {
            type: 'GET',
            success: function(data, status, xhr) {
                var objData = JSON.parse(data);

                $('#table_barang').html(objData.konten);

                reload_event();
            },
            error: function(jqXHR, testStatus, errorMsg) {
                alert('Error : ' + errorMsg);
            }
        })
    }


    function reload_event() {
        $('.linkEditBarang').on('click', function (){
            var hashClean = this.hash.replace('#','');
            loadMenu('<?= base_url('barang/form_edit/')?>' + hashClean);
        });

        $('.linkHapusBarang').on('click', function() {
            var hashClean = this.hash.replace('#','');
            hapusData(hashClean);
        });
    }

    function hapusData(id_barang) {
        //var url = 'http://localhost/backend_inventory/Barang/delete_data?id_barang='+id_barang;
        var url = 'http://localhost/backend_inventory/Barang/soft_delete_data?id_barang='+id_barang;

        $.ajax(url, {
            type: 'GET',
            success: function (data, status, xhr) {
                var objData = JSON.parse(data);
                alert(objData['pesan']);
                loadKonten('http://localhost/backend_inventory/Barang/list_barang');
            },
            error: function (jqXHR, textStatus, errorMsg) {
                alert('Error : ' + errorMsg);
            }
        })
    }

    function cariData() {

        var url = 'http://localhost/backend_inventory/barang/cari_barang';
        var dataForm = {};
        var allInput = $('.form-input-cari');

        $.each(allInput, function (i, val) {
            dataForm[val['name']] = val ['value'];
        });

        $.ajax(url, {
            type: 'POST',
            data: dataForm,
            success: function (data, status, xhr) {
                var objData = JSON.parse(data);
                $('#tabel_barang').html(objData.konten);

                reload_event();
            },
            error: function (jqXHR, textStatus, errorMsg) {
                alert('Error : ' + errorMsg);
            }
        })
    }

    $('#btn-cari').on('click', function () {
        cariData();
    });

    loadKonten('http://localhost/backend_inventory/barang/list_barang');
</script>