<script>
    function sum() {
        var biaya_admin = document.getElementById('biaya_admin').value;
        var biaya_materai = document.getElementById('biaya_materai').value;
        var biaya_materai_agent = document.getElementById('biaya_materai_agent').value;
        var trf_min_bank = document.getElementById('trf_min_bank').value;
        var trf_maxbulan = document.getElementById('trf_maxbulan').value;
        var trf_enambulan = document.getElementById('trf_enambulan').value;
        var trf_min = document.getElementById('trf_min').value;
        var trf_agent = document.getElementById('trf_agent').value;
        var trf_jamkrida = document.getElementById('trf_jamkrida').value;
        var trf_min2 = document.getElementById('trf_min2').value;
        var trf_agent2 = document.getElementById('trf_agent2').value;
        var jangka_waktu = document.getElementById('jangka_waktu').value;
        var nilai_jaminan = document.getElementById('nilai_jaminan').value;
        var diskon = document.getElementById('diskon').value;
        var kd_jp = document.getElementById("kd_jp").value;
        var trf_13 = document.getElementById('trf_13').value;
        var trf_19 = document.getElementById('trf_19').value;

        //menghitung service agent
        if (jangka_waktu <= 3) {
            var service_agent = (parseInt(nilai_jaminan) / 100) * parseFloat(trf_agent);
        } else if (jangka_waktu <= 6) {
            var service_agent = (parseInt(nilai_jaminan) / 100) * parseFloat(trf_agent) * 2;
        } else if (jangka_waktu <= 9) {
            var service_agent = (parseInt(nilai_jaminan) / 100) * parseFloat(trf_agent) * 3;
        } else if (jangka_waktu <= 12) {
            var service_agent = (parseInt(nilai_jaminan) / 100) * parseFloat(trf_agent) * 4;
        } else if (jangka_waktu <= 15) {
            var service_agent = (parseInt(nilai_jaminan) / 100) * parseFloat(trf_agent) * 5;
        } else if (jangka_waktu <= 18) {
            var service_agent = (parseInt(nilai_jaminan) / 100) * parseFloat(trf_agent) * 6;
        } else if (jangka_waktu <= 21) {
            var service_agent = (parseInt(nilai_jaminan) / 100) * parseFloat(trf_agent) * 7;
        } else if (jangka_waktu <= 24) {
            var service_agent = (parseInt(nilai_jaminan) / 100) * parseFloat(trf_agent) * 8;
        } else {
            alert("jangka waktu tidak valid");
        }

        //menghitung service jamkrida
        if (jangka_waktu <= 3) {
            var service_jamkrida = (parseInt(nilai_jaminan) / 100) * parseFloat(trf_jamkrida);
        } else if (jangka_waktu <= 6) {
            var service_jamkrida = (parseInt(nilai_jaminan) / 100) * parseFloat(trf_jamkrida) * 2;
        } else if (jangka_waktu <= 9) {
            var service_jamkrida = (parseInt(nilai_jaminan) / 100) * parseFloat(trf_jamkrida) * 3;
        } else if (jangka_waktu <= 12) {
            var service_jamkrida = (parseInt(nilai_jaminan) / 100) * parseFloat(trf_jamkrida) * 4;
        } else if (jangka_waktu <= 15) {
            var service_jamkrida = (parseInt(nilai_jaminan) / 100) * parseFloat(trf_jamkrida) * 5;
        } else if (jangka_waktu <= 18) {
            var service_jamkrida = (parseInt(nilai_jaminan) / 100) * parseFloat(trf_jamkrida) * 6;
        } else if (jangka_waktu <= 21) {
            var service_jamkrida = (parseInt(nilai_jaminan) / 100) * parseFloat(trf_jamkrida) * 7;
        } else if (jangka_waktu <= 24) {
            var service_jamkrida = (parseInt(nilai_jaminan) / 100) * parseFloat(trf_jamkrida) * 8;
        } else {
            alert("jangka waktu tidak valid");
        }

        //menghitung (service agent)
        if (service_agent <= trf_min) {
            var service_agent2 = trf_min;
        } else if (service_agent > trf_min) {
            var service_agent2 = service_agent;
        } else {
            alert("Service Charge Agent tidak valid");
        }

        //menghitung (service jamkrida)
        if (service_jamkrida <= trf_min2) {
            var service_jamkrida2 = trf_min2;
        } else if (service_jamkrida > trf_min2) {
            var service_jamkrida2 = service_jamkrida;
        } else {
            alert("Service Charge Jamkrida tidak valid");
        }

        //menghitung ijp agent
        var ijpagent = parseInt(biaya_admin) + parseInt(biaya_materai) + parseFloat(service_agent2)+parseInt(biaya_materai_agent);

        //menghitung ijp jamkrida
        var ijpjamkrida = parseInt(biaya_admin) + parseInt(biaya_materai) + parseFloat(service_jamkrida2);

        //menghitung garansibank tersembunyi
        if (jangka_waktu <= 6) {
            var garansi_bank2 = (parseInt(nilai_jaminan) / 100) * parseFloat(trf_maxbulan) + 12000;
        } else if (jangka_waktu <= 12) {
            var garansi_bank2 = (parseInt(nilai_jaminan) / 100) * parseFloat(trf_enambulan) + 12000;
        } else if (jangka_waktu <= 18) {
            var garansi_bank2 = (parseInt(nilai_jaminan) / 100) * parseFloat(trf_13) + 12000;
        } else if (jangka_waktu <= 24) {
            var garansi_bank2 = (parseInt(nilai_jaminan) / 100) * parseFloat(trf_19) + 12000;
        } else {
            alert("jangka waktu tidak valid");
        }


        //menghitung garansi bank asli
        if (kd_jp == 2) {
            if (garansi_bank2 <= trf_min_bank) {
                var garansi_bank = trf_min_bank;
            } else if (garansi_bank2 > trf_min_bank) {
                var garansi_bank = Math.round(garansi_bank2);
            } else {
                alert("tidak valid");
            }
        } else {
            var garansi_bank = 0;
        }

        
        //menghitung nilai diskon
        var nilaidiskon = parseInt(ijpagent) * (parseFloat(diskon) / 100);


        //memghtiung totl biaya
        var totalbiaya = Math.round(ijpagent) + parseInt(garansi_bank) - Math.round(nilaidiskon);

        //menghitung total biua
        var totalbiaya2 = parseInt(ijpjamkrida) + parseInt(garansi_bank);
        // alert(ijpjamkrida + '=' + garansi_bank + '=' + nilaidiskon)

        var saldo = Math.round(totalbiaya - totalbiaya2);
        
        //get value 
        if (!isNaN(nilaidiskon)) {
            document.getElementById('nilaidiskon_post').value = Math.round(nilaidiskon);
            document.getElementById('nilaidiskon').value = convertToRupiah(Math.round(nilaidiskon));

        }


        if (!isNaN(service_agent)) {
            document.getElementById('service_agent_post').value = Math.round(service_agent);
            document.getElementById('service_agent').value = convertToRupiah(Math.round(service_agent));

        }

        if (!isNaN(service_jamkrida)) {
            document.getElementById('service_jamkrida').value = convertToRupiah(Math.round(service_jamkrida));
            document.getElementById('service_jamkrida_post').value = Math.round(service_jamkrida);
        }

        if (!isNaN(service_agent2)) {
            document.getElementById('service_agent2').value = convertToRupiah(Math.round(service_agent2));
            document.getElementById('service_agent2_post').value = Math.round(service_agent2);
        }

        if (!isNaN(service_jamkrida2)) {
            document.getElementById('service_jamkrida2').value = convertToRupiah(Math.round(service_jamkrida2));
            document.getElementById('service_jamkrida2_post').value = Math.round(service_jamkrida2);
        }

        if (!isNaN(ijpagent)) {
            document.getElementById('ijpagent').value = convertToRupiah(Math.round(ijpagent));
            document.getElementById('ijpagent_post').value = Math.round(ijpagent);
        }

        if (!isNaN(ijpjamkrida)) {
            document.getElementById('ijpjamkrida').value = convertToRupiah(Math.round(ijpjamkrida));
            document.getElementById('ijpjamkrida_post').value = Math.round(ijpjamkrida);
        }

        if (!isNaN(garansi_bank2)) {
            document.getElementById('garansi_bank2').value = convertToRupiah(Math.round(garansi_bank2));

        }

        if (!isNaN(totalbiaya2)) {
            document.getElementById('total_biaya2').value = convertToRupiah(Math.round(totalbiaya2));
            document.getElementById('total_biaya2_post').value = Math.round(totalbiaya2);
        }


        //1  SURTY BOND

        if (kd_jp == 1) {

            if (!isNaN(totalbiaya)) {
                document.getElementById('total_biaya').value = convertToRupiah(Math.round(totalbiaya));
                document.getElementById('total_biaya_post').value = Math.round(totalbiaya);
            }

            document.getElementById('total_biaya2').value = convertToRupiah(Math.round(ijpjamkrida));
            document.getElementById('total_biaya2_post').value = Math.round(ijpjamkrida);

            document.getElementById('saldo').value = convertToRupiah(Math.round(saldo));
            document.getElementById('saldo_post').value = Math.round(saldo);
            

            document.getElementById('garansi_bank').value = 0;
            document.getElementById('garansi_bank').value = 0;
            document.getElementById('garansi_bankcpy').value = 0;
            document.getElementById('garansi_bank_post').value = 0;
        } else if (kd_jp == 2) {
            if (!isNaN(garansi_bank)) {
                document.getElementById('garansi_bank').value = convertToRupiah(garansi_bank);
                document.getElementById('garansi_bankcpy').value = convertToRupiah(garansi_bank);
                document.getElementById('garansi_bank_post').value = garansi_bank;
            }
            if (!isNaN(totalbiaya)) {
                document.getElementById('total_biaya').value = convertToRupiah(Math.round(totalbiaya));
                document.getElementById('total_biaya_post').value = Math.round(totalbiaya);
            } else {
                alert("Nilai tidak valid atau Kosong");
            }


            if (!isNaN(saldo)) {
                document.getElementById('saldo').value = convertToRupiah(saldo);
                document.getElementById('saldo_post').value = Math.round(saldo);
            }
        } else {
            alert("jenis permohonan tidak valid");
        }
        
    }

    function convertToRupiah(angka) {
        var rupiah = '';
        var angkarev = angka.toString().split('').reverse().join('');
        for (var i = 0; i < angkarev.length; i++)
            if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
        return rupiah.split('', rupiah.length - 1).reverse().join('');
    }
</script>