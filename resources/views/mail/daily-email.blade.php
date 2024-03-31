<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    .link {
      display: flex;
      flex-direction: column;
      align-items: center;
      border-radius: 0.5rem;
      border-width: 1px;
      border-color: #E5E7EB;
      background-color: #ffffff;
      box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
      text-decoration: none;
      color: inherit;
    }

    .container {
      padding: 1.5rem;
    }

    .link:hover {
      background-color: #F3F4F6;
    }

    .image {
      object-fit: cover;
      object-position: 100% 100%;
      border-top-left-radius: 0.5rem;
      border-top-right-radius: 0.5rem;
      max-height: 500px;
      width: 100%;
    }

    .title-container {
      padding: 1rem;
      justify-content: space-between;
      line-height: 1.5;
    }

    .title {
      margin-bottom: 0.5rem;
      font-size: 1.5rem;
      line-height: 2rem;
      font-weight: 700;
      letter-spacing: -0.025em;
      color: #3730A3;
    }


    @media screen and (min-width: 768px) {
      .link {
        flex-direction: row;
        gap: 5rem;
      }

      .container {
        border-top-width: 0;
        border-left-width: 1px;
      }

      .image {
        border-radius: 0;
        width: 24rem;
        height: 24rem;
      }
    }
  </style>
</head>

<body>
  <h1 style="text-align: center;">Checkout todays news...</h1>
  <div class="container">
    @foreach ($articles as $key => $value )
    @php
    $title= $value["title"];
    $body = $value["body"];
    $id = $value["id"];
    @endphp
    <a href='http://localhost:3000/article/{{$id}}' class="link">
      <img class="image" src="https://picsum.photos/800/600" />
      <div class="title-container">
        <h5 class="title">
          {{ $title }}
        </h5>
        <p>{{$body}}</p>
      </div>
    </a>
    @endforeach
  </div>
</body>

</html>