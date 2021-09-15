<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Surat Pengantar</title>

        <style>
            * {
                margin: 0;
                padding: 0;
            }

            body {
                padding: 10px;
            }

            table {
                width: 100%;
                margin-top: 30px;
            }

            table tr td {
                padding: 0 10px;
                font-size: 14px;
            }

            .text-right{
                text-align: right;
            }
            .text-center{
                text-align: center;
            }

            .text-center h2{
                margin: 10px 0;
            }

            .section-center{
                margin: 0 auto;
                width: 500px;
            }

            table .center{
                margin-left: auto;
                margin-right: auto;
            }

            .section-left{
                width: 250px;
                float: left;
            }
            .section-right{
                width: 250px;
                float: right;
               
            }
            .biodata{
                height: 120px;
                margin: 50px auto;
            }

        .sign{
            width: 100px;
            height: 100px;
        }

        .margin-top{
            margin-top: 50px;
        }

        .mb-5{
            margin-top: 10px;
            margin-bottom: 10px;
        }
        </style>
    </head>
    <body>
        <table class="center">
            <tr>
                <td><b>RUKUN TETANGGA : {{$current_rt}}</b></td>
                <td></td>
                <td class="text-right">
                    <b>DESA/KELURAHAN : Sukapura</b>
                </td>
            </tr>
            <tr>
                <td><b>RUKUN WARGA : {{$current_rw}}</b></td>
                <td></td>
                <td class="text-right ">
                    <b class="mb-5">KECAMATAN : Bojongsoang</b>
                </td>
            </tr>
            <tr>
                <td><p class="mb-5">Sekretariat RT : {{$sekretariat}}.</p></td>
                <td class="text-center"><p class="mb-5">Telepon : {{$telepon}}</p></td>
                <td class="text-right"><p class="mb-5">Kode Pos : ................</p></td>
                
            </tr>
            <tr>
                <td colspan="3" class="text-center">
                    <hr style="margin-bottom: 40px;">
                    <h2>SURAT PENGANTAR</h2>
                </td>
            </tr>
            <tr>
                <td colspan="3" class="text-center">
                    <p>Nomor : {{$nomor_surat}}</p>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class="section-center margin-top">
                        <p>
                            Yang bertanda tangan dibawah ini, Ketua {{$current_rt}},
                            {{$current_rw}} Desa/Kelurahan: Sukapura
                        </p>
                        <p>
                            Kecamatan Bojongsoang, Kabupaten
                            Bandung, dengan ini menerangkan bahwa :
                        </p>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class="section-center biodata">
                        <div class="section-left">
                            <p>Nama Lengkap</p>
                            <p>Alamat</p>
                            <p>Tempat/Tanggal Lahir</p>
                            <p>Pekerjaan</p>
                            <p>Agama</p>
                            <p>Status Perkawinan</p>
                            <p>No. KTP</p>
                        </div>
                        <div class="section-right">
                            <p>: {{$nama_lengkap}}</p>
                            <p>: {{$alamat_pemohon}}</p>
                            <p>: {{$tempat}}, {{$tanggal_lahir}}</p>
                            <p>: {{$pekerjaan}}</p>
                            <p>: {{$agama}}</p>
                            <p>: @if($status_perkawinan == 0)
                                Belum Kawin
                                @else
                                Sudah Kawin
                                @endif
                            </p>
                            <p>: {{$nik}}</p>
                        </div>
                        <div class="clear"></div>
                    </div>
                </td>
            </tr>

            <tr>
                <td colspan="3">
                    <div class="section-center">
                        <p>
                            Adalah benar warga kami sesuai dengan data
                            kependudukan yang ada.
                        </p>
                        <p>
                            Surat Keterangan ini kami berikan kepada yang
                            bersangkutan untuk keperluan :
                        </p>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class="section-center">
                        <b style="margin: 10px 0;">
                            {{$keperluan}}
                        </b>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class="section-center">
                        <p>
                            Demikian Surat Keterangan ini kami buat dengan
                            sebenarnya untuk dipergunakan yang
                        </p>
                        <p>bersangkutan sebagaimana mestinya.</p>
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                    <div class="text-right margin-top">
                        <p style="margin-right: 6px;">Mengetahui</p>
                        <b>KETUA RW</b>
                        <div class="sign" style="margin-left: auto">
                        </div>
                        <p>(....................)</p>
                    </div>
                </td>
                <td></td>
                <td>
                    <div class="margin-top">
                        <p>..........................</p>
                        <b>KETUA RT</b>
                        <div class="sign">
                        </div>
                        <p>(....................)</p>
                    </div>
                </td>
            </tr>
        </table>
    </body>
</html>
