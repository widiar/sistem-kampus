<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        .img-thumbnail {
            padding: 0.25rem;
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
            max-width: 100%;
            height: 6cm;
            width: 5.4cm;
            position: absolute;
            left: 0;
            object-fit: cover;
            object-position: center;
        }

        .text-center {
            text-align: center !important;
        }

        table {
            margin-left: 200px;
        }

        table th {
            text-align: left;
        }

        table tr {
            height: 50px;
        }

        th,
        td {
            font-size: 1.2rem
        }

        .text-underline {
            text-decoration: underline !important;
        }

        h3 {
            font-size: 1.8rem;
            margin: 0
        }

        li,
        p {
            font-size: 20px;
            text-align: justify;
            line-height: 1.5
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center text-underline" style="margin-bottom: 30px">Curriculum Vitae</h1>
        <img src="{{ $data["profile_img"] }}" class="img-thumbnail" alt="">
        <table style="padding-left: 20px">
            <tr>
                <th> Nama</th>
                <td>: {{ $data["nama"] }}</td>
            </tr>
            <tr>
                <th>Jenis kelamin</th>
                <td>: {{ $data["gender"] }}</td>
            </tr>
            <tr>
                <th>Tempat/Tanggal lahir</th>
                <td>: {{ $data["ttl"] }}</td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td>: {{ $data["alamat"] }}</td>
            </tr>
            <tr>
                <th>No. Telpon</th>
                <td>: {{ $data["notlp"] }}</td>
            </tr>
        </table>
        <h3 class="text-underline">Deskirpsi</h3>
        <hr>
        <p class="text-justify" style="margin-bottom: 36px">{{ $data['deskripsi'] }}</p>
        @isset($data["skill"])
        <h3 class="text-underline">Skill</h3>
        <hr>
        <ul style="margin-bottom: 36px">

            @foreach ($data["skill"] as $skill)
            <li>{{ $skill }}</li>
            @endforeach
        </ul>
        @endisset
        @isset($data["exp"])
        <h3 class="text-underline">Pengalaman</h3>
        <hr>
        <ul style="margin-bottom: 36px">
            @foreach ($data["exp"] as $key => $exp)
            <li>{{ $exp }} ( {{$data["year"][$key]}} )</li>
            @endforeach
        </ul>
        @endisset
        @isset($data["sch"])
        <h3 class="text-underline">Pendidikan</h3>
        <hr>
        <ul style="margin-bottom: 36px">
            @foreach ($data["sch"] as $key => $exp)
            <li>{{ $exp }} ( {{$data["tahun"][$key]}} )</li>
            @endforeach
        </ul>
        @endisset
    </div>
</body>

</html>