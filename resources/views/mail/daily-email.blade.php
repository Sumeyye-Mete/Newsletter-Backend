<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    .container-table {
      width: 512px;
      margin-left: auto;
      margin-right: auto;
      background-color: #f3f4f6;
      padding: 10px;
      border-spacing: 30px;
    }

    td {
      border-bottom: 2px black solid;
      padding-bottom: 10px;
    }

    .content:hover {
      background-color: rgba(0, 128, 128, 0.418);
    }

    .content a {
      text-decoration: none;
      color: inherit;
    }

    .title {
      margin-bottom: 0.5rem;
      font-size: 30px;
      font-weight: 700;
      color: #3730a3;
    }

    .truncated-text {
      height: 4.5em;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    @media screen and (max-width: 768px) {
      .container-table {
        width: 90%;
      }
    }
  </style>
</head>

<body>
  <table class="container-table">
    <tbody>
      <tr>
        <td>
          <h1 style="text-align: center">Your Daily Newsletter Digest</h1>
        </td>
      </tr>
      @foreach ($articles as $key => $value )
      @php
      $title= $value["title"];
      $body = $value["body"];
      $id = $value["id"];
      @endphp
      <tr>
        <td class="content">
          <a href="http://localhost:3000/article/{{$id}}">
            <img src="https://picsum.photos/800/600" width="100%" style="object-fit: cover; aspect-ratio: 1" />
            <div>
              <h5 class="title">{{ $title }} </h5>
              <p class="truncated-text">{{$body}} </p>
            </div>
          </a>
        </td>
      </tr>
      @endforeach

    </tbody>
  </table>
</body>

</html>