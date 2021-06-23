<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DATA PENGAJUAN KASUS HUKUM</title>
</head>

<body>
    <div class="header">
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th style="font-size: 16px; font-weight:600;">
                        <h3 style="text-align: center;">DATA PENGAJUAN KASUS HUKUM</h3>
                    </th>
                </tr>
            </thead>
        </table>
    </div>
    <div class="page">
        <table class="layout display responsive-table">
            <thead>
                <tr>
                    <th></th>
                    <th style="text-align: center; font-weight: bold;">No.</th>
                    <th style="text-align: center; font-weight: bold;">No Pengajuan</th>
                    <th style="text-align: center; font-weight: bold;">Kategori</th>
                    <th style="text-align: center; font-weight: bold;">Dokumen Permasalahan 1</th>
                    <th style="text-align: center; font-weight: bold;">Dokumen Permasalahan 2</th>
                    <th style="text-align: center; font-weight: bold;">Dokumen Permasalahan 3</th>
                    <th style="text-align: center; font-weight: bold;">Tanggal Sidang</th>
                    <th style="text-align: center; font-weight: bold;">Status</th>
                    <th style="text-align: center; font-weight: bold;">User</th>
                </tr>
            </thead>
            <tbody>
                @php $i=1; @endphp
                @if(count($laporan))
                @foreach($laporan as $lapor)
                <tr>
                    <td></td>
                    <td style="text-align: center; width:5px;">{{$i++}}</td>
                    <td style="text-align: center;">{{ $lapor->no_pengajuan }}</td>
                    <td style="text-align: center;">{{ $lapor->category->name }}</td>
                    <td style="text-align: center;">{{ $lapor->file_1 }}</td>
                    <td style="text-align: center;">{{ $lapor->file_2 }}</td>
                    <td style="text-align: center;">{{ $lapor->file_3 }}</td>
                    <td style="text-align: center;">
                        {{ $lapor->tgl_sidang ? date('d/m/Y', strtotime($lapor->tgl_sidang)) : $lapor->tgl_sidang }}
                    </td>
                    <td style="text-align: center;">{{ ['Diajukan', 'Disetujui', 'Ditolak'][$lapor->status] }}</td>
                    <td style="text-align: center;">{{ $lapor->user->name }}</td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</body>
</html>