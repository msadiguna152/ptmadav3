<script type="text/javascript">
    $(document).ready(function() {
        console.log("ready!");


        sum();



        function sum() {

            var jumlah = document.getElementById('jml_pembayaran').value;
            var jumlah_tagihan = document.getElementById('jumlah_tagihan').value;
            var jumlah_bayar = document.getElementById('jumlah_bayar').value;
            //var sisa_bayar = document.getElementById('sisa_bayar').value;

            //mehitung sisa bayar
            var sisa_bayar = Math.round(jumlah_tagihan) - (Math.round(jumlah) + Math.round(jumlah_bayar));

            if (sisa_bayar < 0) {
                sisa_bayar = 0;
                alert("Jumlah Bayar Melebihi Jumlah Tagihan");
                $('#bttn').prop('disabled', true);
            }else{
                $('#bttn').prop('disabled', false);
            }

            console.log(sisa_bayar);
            //get value 
            if (!isNaN(sisa_bayar)) {
                document.getElementById('sisa_bayar_post').value = Math.round(sisa_bayar);
                document.getElementById('sisa_bayar').value = convertToRupiah(Math.round(sisa_bayar));

            }
        }

        function convertToRupiah(angka) {
            var rupiah = '';
            var angkarev = angka.toString().split('').reverse().join('');
            for (var i = 0; i < angkarev.length; i++)
                if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
            return rupiah.split('', rupiah.length - 1).reverse().join('');
        }

        $("#jml_pembayaran").keyup(function() {
            sum();
        });
    });
</script>