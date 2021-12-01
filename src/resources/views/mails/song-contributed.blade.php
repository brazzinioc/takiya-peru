<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contribución</title>
</head>
<body style="font-family: sans-serif; ">
    <div style=" border-width: 1px; border-top-width: 5px; border-style: solid; border-color: black; padding: 5px 10px; ">

        <h1 style="color: blue; ">{{ strtoupper($song['title']) }}</h1>
        <p> <span style="font-weight: bold;">Genre music: </span>{{ $song['music_genre'] }}</p>
        <p> <span style="font-weight: bold;">Author: </span>{{ $song['author'] }}</p>
        <p> <span style="font-weight: bold;">Lyrics: </span>{{ $song['name_lastname_translater'] }}</p>
        <p> <span style="font-weight: bold;">URL: </span> {{ $song['audio_video_url'] }} </p>
        <p> <span style="font-weight: bold;">Name Translator: </span> {{ $song['name_lastname_translater'] }} </p>
        <p> <span style="font-weight: bold;">Email Translator: </span> {{ $song['email_translater'] }} </p>
        <p> <span style="font-weight: bold;">observation: </span> {{ $song['observation'] }} </p>

        <div>
            <h2>Lyrics in Quechua</h2>
            <div style="padding: 10px; border: 1px dashed #5e219b;">
                @php echo nl2br($song['lyrics_que']); @endphp
            </div>
        </div>

        <div>
            <h2>Lyrics in Spanish</h2>
            <div style="padding: 10px; border: 1px dashed #5e219b;">
                @php echo nl2br($song['lyrics_spn']); @endphp
            </div>
        </div>

    </div>
</body>
</html>
